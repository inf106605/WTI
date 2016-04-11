package wti.manager.gui.widgets.readonlylist;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.List;

public class ReadOnlyList extends List {

	public ReadOnlyList(Composite parent, int style) {
		super(parent, style);
		makeReadOnly();
	}

	private void makeReadOnly() {
		makeGray();
		makeUnselectable();
	}

	private void makeGray() {
		setBackground(getDisplay().getSystemColor(SWT.COLOR_WIDGET_BACKGROUND));
	}

	private void makeUnselectable() {
		addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				setSelection(-1);
			}
		});
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
	
}
