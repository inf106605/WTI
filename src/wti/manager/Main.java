package wti.manager;

import wti.manager.gui.windows.main.MainWindow;

public class Main {

	public static void main(String[] args) {
		try {
			MainWindow window = new MainWindow();
			window.open();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
}
