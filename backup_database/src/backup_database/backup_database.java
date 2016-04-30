package backup_database;

import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Date;

public class backup_database {

	    public static void main(String[] args) throws Exception {
	    
	    	String dirMysql = "C:\\xampp2\\mysql\\bin";
	    	
			DateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd_HH-mm-ss");
			Date date = new Date(); 
	    	Runtime.getRuntime().exec("cmd.exe /c cd \""+dirMysql+"\" & start cmd.exe /c \"mysqldump -u krzysiek1994 -pk123rzysiek1994 testcs > C:\\xampp2\\backupFolder\\backupDatabase\\backup_" + dateFormat.format(date).toString() +  ".sql\"");
	    }
}


