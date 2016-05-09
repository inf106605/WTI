package wti.manager.backup;

import java.io.IOException;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

public class DatabaseBackup {

	private static final String MYSQL_DIR_PATH = "C:\\xampp2\\mysql\\bin"; //FIXME this is just dumb
	private static final String BACKUP_FOLDER_PATH = "C:\\xampp2\\backupFolder\\backupDatabase\\";
	
	
    public static void create() {
    	try {
	    	DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd_HH-mm-ss");
			Date date = new Date(); 
			String backupFilePath = BACKUP_FOLDER_PATH + "backup_" + dateFormat.format(date).toString() + ".sql";
			String login = "aaa"; //TODO
			String password = "bbb"; //TODO
	    	Runtime.getRuntime().exec("cmd.exe /c cd \""+MYSQL_DIR_PATH+"\" & start cmd.exe /c \"mysqldump -u " + login + " -p" + password + " testcs > " + backupFilePath +  "\"");
    	} catch (IOException e) {
    		//TODO
    	}
    }
    
}


