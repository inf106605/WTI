package wti.manager.gui.windows.connection;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.MessageBox;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.Text;

import wti.manager.database.ShopDatabase;

public class ConnectionWindow {
	
	private Shell shell;
	private Text textAddress;
	private Text textDatabaseName;
	private Text textConnectionString;
	private Text textLogin;
	private Text textPassword;
	private Button btnConnect;

	
	/**
	 * @wbp.parser.entryPoint
	 */
	public void open() {
		createShell();
		createControls(shell);
		openShell();
	}

	private void createShell() {
		shell = new Shell(SWT.CLOSE | SWT.TITLE | SWT.MIN);
		shell.setSize(450, 225);
		shell.setText("Menad\u017Cer sklepu - \u0142\u0105czenie z baz\u0105 danych");
		shell.setLayout(new GridLayout(2, false));
	}

	private void createControls(Composite parent) {
		createAddressControls(parent);
		createDatabaseNameControls(parent);
		createConnectionStringControls(parent);
		createSeparator(parent);
		createLoginControls(parent);
		createPasswordControls(parent);
		createButtonConnect(parent);
	}

	private void createAddressControls(Composite parent) {
		textAddress = createControlPair(parent, "Adres");
		textAddress.addModifyListener((event) -> refreshConnectionString());
	}

	private void createDatabaseNameControls(Composite parent) {
		textDatabaseName = createControlPair(parent, "Nazwa bazy");
		textDatabaseName.addModifyListener((event) -> refreshConnectionString());
	}

	private void createConnectionStringControls(Composite parent) {
		textConnectionString = createControlPair(parent, "Ci\u0105g po\u0142\u0105czenia");
		textConnectionString.setEditable(false);
		refreshConnectionString();
	}
	
	private void refreshConnectionString() {
		String address = getAddress();
		String databaseName = textDatabaseName.getText();
		String connectionString = ShopDatabase.generateConnctionString(address, databaseName);
		textConnectionString.setText(connectionString);
	}

	private void createSeparator(Composite parent) {
		Label separator = new Label(parent, SWT.SEPARATOR | SWT.HORIZONTAL);
		separator.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 2, 1));
	}

	private void createLoginControls(Composite parent) {
		textLogin = createControlPair(parent, "Login");
	}

	private void createPasswordControls(Composite parent) {
		textPassword = createControlPair(parent, "Has\u0142o");
	}

	private Text createControlPair(Composite parent, String label) {
		createLabel(parent, label);
		return createText(parent);
	}

	private void createLabel(Composite parent, String text) {
		Label label = new Label(parent, SWT.NONE);
		label.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		label.setText(text);
	}

	private Text createText(Composite parent) {
		Text text = new Text(parent, SWT.BORDER);
		text.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, true, 1, 1));
		return text;
	}

	private void createButtonConnect(Composite parent) {
		btnConnect = new Button(parent, SWT.NONE);
		btnConnect.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				connect();
			}
		});
		btnConnect.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 2, 1));
		btnConnect.setText("Po³¹cz");
	}
	
	private void connect() {
		try {
			btnConnect.setEnabled(false);
			btnConnect.setText("£¹czenie...");
			setDatabaseConnectionProperties();
			ShopDatabase.tryToGetSessionFactory();
			shell.close();
		} catch (RuntimeException e) {
			MessageBox messageBox = new MessageBox(shell, SWT.ICON_ERROR);
			messageBox.setText("B³¹d po³¹czenia");
			messageBox.setMessage("Nie mo¿na po³¹czyæ z baz¹ danych.\n\nTreœæ wyj¹tku:\n"+e.getMessage());
			messageBox.open();
			btnConnect.setText("Po³¹cz");
			btnConnect.setEnabled(true);
		}
	}

	private void setDatabaseConnectionProperties() {
		String address = getAddress();
		ShopDatabase.setAddress(address);
		String databaseName = textDatabaseName.getText();
		ShopDatabase.setDatabaseName(databaseName);
		String login = textLogin.getText();
		ShopDatabase.setUsername(login);
		String password = textPassword.getText();
		ShopDatabase.setPassword(password);
	}

	private String getAddress() {
		String address = textAddress.getText();
		if (address.isEmpty())
			address = "localhost";
		return address;
	}

	private void openShell() {
		Display display = Display.getDefault();
		shell.open();
		shell.layout();
		while (!shell.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
	}

}
