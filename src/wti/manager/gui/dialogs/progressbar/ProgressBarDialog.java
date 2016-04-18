package wti.manager.gui.dialogs.progressbar;

import java.util.concurrent.atomic.AtomicBoolean;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Dialog;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.ProgressBar;
import org.eclipse.swt.widgets.Shell;

public class ProgressBarDialog<T> extends Dialog {

	public interface ProgressBarRunnable<T> {
		public T run(AtomicBoolean canceling);
	}
	

	private String description = "";
	private AtomicBoolean canceling = new AtomicBoolean(false);
	private T result;
	
	private Shell shell;
	private Label lblDescription;

	public ProgressBarDialog(Shell parent, int style) {
		super(parent, style);
	}

	public boolean open(ProgressBarRunnable<T> runnable) {
		createContents();
		shell.open();
		shell.layout();
		Runnable internalRunnable = createInternalRunnable(runnable);
		Thread thread = new Thread(internalRunnable);
		thread.start();
		Display display = getParent().getDisplay();
		while (!shell.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
		return canceling.get();
	}
	
	private Runnable createInternalRunnable(ProgressBarRunnable<T> runnable) {
		Runnable internalRunnable = new Runnable() {
			@Override
			public void run() {
				result = runnable.run(canceling);
				Display display = shell.getDisplay();
				display.asyncExec(() -> {
						shell.close();
					});
			}
		};
		return internalRunnable;
	}

	private void createContents() {
		createShell();
		createDescription();
		createProgressBar();
		createCancelButton();
	}

	private void createShell() {
		shell = new Shell(getParent(), getStyle());
		shell.setSize(450, 200);
		shell.setText(getText());
		shell.setLayout(new GridLayout(1, false));
	}

	private void createDescription() {
		lblDescription = new Label(shell, SWT.WRAP);
		lblDescription.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, true, 1, 1));
		lblDescription.setText(description);
	}

	private void createProgressBar() {
		ProgressBar progressBar = new ProgressBar(shell, SWT.SMOOTH | SWT.INDETERMINATE);
		GridData gd_progressBar = new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1);
		gd_progressBar.heightHint = 25;
		progressBar.setLayoutData(gd_progressBar);
	}

	private void createCancelButton() {
		Button btnCancel = new Button(shell, SWT.NONE);
		btnCancel.setLayoutData(new GridData(SWT.RIGHT, SWT.BOTTOM, true, true, 1, 1));
		btnCancel.setText("Anuluj");
		btnCancel.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				canceling.set(true);
				btnCancel.setEnabled(false);
				btnCancel.setText("Anulowanie...");
				shell.layout();
			}
		});
	}

	public void setDescription(String description) {
		this.description = description;
	}
	
	public T getResult() {
		return result;
	}
	
}
