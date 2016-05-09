package wti.manager.gui.tabs.backups;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Group;

import wti.manager.backup.DatabaseBackup;
import wti.manager.backup.HtmlBackup;

public class BackupsTabComposite extends Composite {
	
	public BackupsTabComposite(Composite parent, int style) {
		super(parent, style);
		setLayout();
		createControls();
	}

	private void setLayout() {
		setLayout(new GridLayout(1, false));
	}

	private void createControls() {
		createHtmlGroup();
		createDatabaseGroup();
	}

	private void createHtmlGroup() {
		Group grpHtmls = createHTMLsGroupItself();
		createHtmlBackupButton(grpHtmls);
	}

	private Group createHTMLsGroupItself() {
		Group grpHtmls = new Group(this, SWT.NONE);
		grpHtmls.setLayout(new GridLayout(1, false));
		grpHtmls.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		grpHtmls.setText("HTMLs");
		return grpHtmls;
	}

	private void createHtmlBackupButton(Group grpHtmls) {
		Button btnDoHtmlsBackup = new Button(grpHtmls, SWT.NONE);
		btnDoHtmlsBackup.setLayoutData(new GridData(SWT.CENTER, SWT.CENTER, true, true, 1, 1));
		btnDoHtmlsBackup.setText("Do HTMLs backup");
		btnDoHtmlsBackup.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				HtmlBackup.create();
			}
		});
	}

	private void createDatabaseGroup() {
		Group grpDatabase = createDatabaseGroupItself();
		createDatabaseBackupButton(grpDatabase);
	}

	private Group createDatabaseGroupItself() {
		Group grpDatabase = new Group(this, SWT.NONE);
		grpDatabase.setLayout(new GridLayout(1, false));
		grpDatabase.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		grpDatabase.setText("Database");
		return grpDatabase;
	}

	private void createDatabaseBackupButton(Group grpDatabase) {
		Button btnDoDatabaseBackup = new Button(grpDatabase, SWT.NONE);
		btnDoDatabaseBackup.setLayoutData(new GridData(SWT.CENTER, SWT.CENTER, true, true, 1, 1));
		btnDoDatabaseBackup.setText("Do database backup");
		btnDoDatabaseBackup.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				DatabaseBackup.create();
			}
		});
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
}
