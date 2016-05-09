package wti.manager.backup;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.zip.ZipEntry;
import java.util.zip.ZipOutputStream;

public class HtmlBackup {
	
	private static final String HTML_DIR_PATH = "C:\\xampp2\\htdocs\\sklep";
	private static final String BACKUP_DIR_PATH = "C:\\xampp2\\backupFolder\\";
	

	 public static void create() {
		 try {
			 DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd_HH-mm-ss");
			 Date date = new Date(); 
			 String backupFilePath = BACKUP_DIR_PATH + "backup_"+ dateFormat.format(date).toString() + ".zip";
			 zipFolder(HTML_DIR_PATH, backupFilePath);
		 } catch (IOException e) {
			 //TODO
		 }
	 }

	private static void zipFolder(String srcFolder, String destZipFile) throws IOException {
		ZipOutputStream zip = null;
		FileOutputStream fileWriter = null;

		fileWriter = new FileOutputStream(destZipFile);
		zip = new ZipOutputStream(fileWriter);

		addFolderToZip("", srcFolder, zip);
		zip.flush();
		zip.close();
	}

	private static void addFileToZip(String path, String srcFile, ZipOutputStream zip) throws IOException {
		File folder = new File(srcFile);
		if (folder.isDirectory()) {
			addFolderToZip(path, srcFile, zip);
		} else {
			byte[] buf = new byte[1024];
			int len;
			try (FileInputStream in = new FileInputStream(srcFile))
			{
				zip.putNextEntry(new ZipEntry(path + "/" + folder.getName()));
				while ((len = in.read(buf)) > 0) {
					zip.write(buf, 0, len);
				}
			}
		}
		}

	static private void addFolderToZip(String path, String srcFolder, ZipOutputStream zip) throws IOException {
		File folder = new File(srcFolder);

		for (String fileName : folder.list()) {
			if (path.equals("")) {
				addFileToZip(folder.getName(), srcFolder + "/" + fileName, zip);
			} else {
				addFileToZip(path + "/" + folder.getName(), srcFolder + "/" + fileName, zip);
			}
		}
	}
}
