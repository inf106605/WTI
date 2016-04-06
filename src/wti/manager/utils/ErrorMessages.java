package wti.manager.utils;

import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.widgets.Shell;

public final class ErrorMessages {
	
	public static void showListLoadError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B³¹d wczytywania "+listName);
		messageBox.setMessage("Nie uda³o siê pobraæ listy "+listName+" z bazy danych!\n\nTreœæ wyj¹tku:\n"+e.getMessage());
		messageBox.open();
	}
	
	public static void showSaveError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B³¹d zapisywania "+listName);
		messageBox.setMessage("Nie uda³o siê zapisaæ "+listName+" do bazy danych!\n\nTreœæ wyj¹tku:\n"+e.getMessage());
		messageBox.open();
	}
	
	public static void showDeleteError(Shell shell, String listName, DatabaseException e) {
		MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
		messageBox.setText("B³¹d usuwania "+listName);
		messageBox.setMessage("Nie uda³o siê usun¹æ "+listName+" z bazy danych!\n\nTreœæ wyj¹tku:\n"+e.getMessage());
		messageBox.open();
	}
	
}
