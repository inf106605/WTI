package wti.manager.gui.widgets.findinglist;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.List;

import wti.manager.gui.widgets.textwithhint.TextWithHint;

public abstract class FindingList<T> extends Composite {
	
	private TextWithHint textFilter;
	private List list;
	
	private java.util.List<T> input;

	
	public FindingList(Composite parent, int style) {
		super(parent, style);
		setLayout();
		createControls();
	}

	private void setLayout() {
		GridLayout gridLayout = new GridLayout(1, false);
		gridLayout.marginWidth = 0;
		gridLayout.marginHeight = 0;
		setLayout(gridLayout);
	}

	private void createControls() {
		createTextFilter();
		createList();
	}

	private void createTextFilter() {
		textFilter = new TextWithHint(this, SWT.BORDER);
		textFilter.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		textFilter.setHint(getHint());
		textFilter.addModifyListener((event) -> refresh());
	}
	
	protected abstract String getHint();

	private void createList() {
		list = new List(this, SWT.BORDER | SWT.V_SCROLL);
		list.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
	}

	public java.util.List<T> getInput() {
		return input;
	}

	public void setInput(java.util.List<T> input) {
		this.input = input;
		refresh();
	}

	private void refresh() {
		list.removeAll();
		if (input == null)
			return;
		String filter = textFilter.getText();
		for (T object : input) {
			String objectName = getName(object);
			if (!objectName.contains(filter))
				continue;
			list.add(objectName);
			list.setData(""+(list.getItemCount()-1), object);
		}
	}
	
	protected abstract String getName(T object);

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}

}
