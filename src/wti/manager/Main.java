package wti.manager;

import wti.manager.database.ShopDatabase;
import wti.manager.gui.windows.connection.ConnectionWindow;
import wti.manager.gui.windows.main.MainWindow;

public class Main {

	public static void main(String[] args) {
		try {
			openConnectionWindow();
			checkConnection();
			openMainWindow();
		} catch (Exception e) {
			e.printStackTrace();
		} finally {
			closeDatabaseConnection();
		}
	}

	private static void openConnectionWindow() {
		ConnectionWindow window = new ConnectionWindow();
		window.open();
	}
	
	private static void checkConnection() {
		ShopDatabase.getSessionFactory();
	}

	private static void openMainWindow() {
		MainWindow window = new MainWindow();
		window.open();
	}

	private static void closeDatabaseConnection() {
		ShopDatabase.close();
	}
	
}
