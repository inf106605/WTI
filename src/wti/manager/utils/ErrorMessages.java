package wti.manager.utils;

import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.widgets.Shell;

public final class ErrorMessages {
	
	public static void showListLoadError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B��d wczytywania "+listName);
		messageBox.setMessage("Nie uda�o si� pobra� listy "+listName+" z bazy danych!\n\nTre�� wyj�tku:\n"+e.getMessage());
		messageBox.open();
	}
	
	public static void showSaveError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B��d zapisywania "+listName);
		messageBox.setMessage("Nie uda�o si� zapisa� "+listName+" do bazy danych!\n\nTre�� wyj�tku:\n"+e.getMessage());
		messageBox.open();
	}
	
	public static void showDeleteError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B��d usuwania "+listName);
		messageBox.setMessage("Nie uda�o si� usun�� "+listName+" z bazy danych!\n\nTre�� wyj�tku:\n"+e.getMessage());
		messageBox.open();
	}
	
}
