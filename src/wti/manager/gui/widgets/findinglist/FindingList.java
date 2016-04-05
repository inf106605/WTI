package wti.manager.gui.widgets.findinglist;

import java.util.LinkedList;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.List;

import wti.manager.gui.widgets.textwithhint.TextWithHint;
import wti.manager.utils.IHasId;

public abstract class FindingList<T extends IHasId> extends Composite {
	
	public static interface UndoableSelectionListener {
		public boolean selectionChanged(SelectionEvent event);
	}
	
	
	private TextWithHint textFilter;
	private List list;
	private java.util.List<UndoableSelectionListener> undoableSelectionListeners = new LinkedList<UndoableSelectionListener>();
	
	private java.util.List<T> input;
	private int lastSelectedId = -1;

	
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
		textFilter.addModifyListener((event) -> refreshList());
	}
	
	protected abstract String getHint();

	private void createList() {
		list = new List(this, SWT.BORDER | SWT.V_SCROLL);
		list.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		list.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				onSelection(event);
			}
		});
	}
	
	private void onSelection(SelectionEvent event) {
		for (UndoableSelectionListener usl : undoableSelectionListeners)
			if (!usl.selectionChanged(event))
			{
				undoSelection();
				return;
			}
		lastSelectedId = getSelectedItem().getId();
	}

	private void undoSelection() {
		reselectItem();
	}

	public void reselectItem() {
		list.deselectAll();
		if (lastSelectedId == -1)
			return;
		int i = 0;
		for (T item : input) {
			if (item.getId() == lastSelectedId) {
				list.setSelection(i);
				return;
			}
			++i;
		}
		lastSelectedId = -1;
	}

	public java.util.List<T> getInput() {
		return input;
	}

	public void setInput(java.util.List<T> input) {
		this.input = input;
		refreshList();
	}

	private void refreshList() {
		list.removeAll();
		if (input == null)
			return;
		String filter = textFilter.getText();
		for (T object : input) {
			String objectName = getName(object);
			if (!objectName.contains(filter))
				continue;
			list.add(objectName);
		}
	}
	
	protected abstract String getName(T object);
	
	public void addSelectionListener(UndoableSelectionListener listener) {
		undoableSelectionListeners.add(listener);
	}
	
	public void removeSelectionListener(UndoableSelectionListener listener) {
		undoableSelectionListeners.remove(listener);
	}
	
	public T getSelectedItem() {
		int selectionIndex = list.getSelectionIndex();
		T selectedItem = input.get(selectionIndex);
		return selectedItem;
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}

}
