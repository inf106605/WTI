package wti.manager.gui.tabs;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;

import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.gui.widgets.properties.BasePropertiesComposite;
import wti.manager.interfaces.ITableRow;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.ErrorMessages;
import wti.manager.utils.SessionUtils;

public abstract class DatabaseTableTabComposite<T extends ITableRow<T>> extends Composite {

	private FindingList<T> findingList;
	private BasePropertiesComposite<T> propertiesComposite;
	
	
	public DatabaseTableTabComposite(Composite parent, int style) {
		super(parent, style);
		setLayout();
		createControls();
	}

	private void setLayout() {
		setLayout(new GridLayout(3, false));
	}

	private void createControls() {
		createCompositeList();
		createSeparator();
		createPropertiesComposite();
	}

	private void createCompositeList() {
		findingList = createFindingListItself(this, SWT.NONE);
		findingList.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		findingList.addSelectionListener((event) -> onDataSelection());
	}

	protected abstract FindingList<T> createFindingListItself(Composite parent, int style);

	private boolean onDataSelection() {
		T data = findingList.getSelectedItem();
		if (data == null)
			return false;
		boolean result = propertiesComposite.setData(data);
		return result;
	}

	private void createSeparator() {
		Label separator = new Label(this, SWT.SEPARATOR | SWT.VERTICAL);
		separator.setLayoutData(new GridData(SWT.LEFT, SWT.FILL, false, true, 1, 1));
	}

	private void createPropertiesComposite() {
		propertiesComposite = createPropertiesCompositeItself(this, SWT.NONE);
		propertiesComposite.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		propertiesComposite.addNewListener(this::onNewData);
		propertiesComposite.addSaveListener(this::onSaveData);
		propertiesComposite.addDeleteListener(this::onDeleteData);
	}
	
	protected abstract BasePropertiesComposite<T> createPropertiesCompositeItself(Composite parent, int style);

	private void onNewData() {
		findingList.deselectAll();
	}
	
	private void onSaveData(boolean isNew, T newData) {
		try {
			if (isNew)
				SessionUtils.runInSession((session) -> session.save(newData));
			else
				SessionUtils.runInSession((session) -> session.update(newData));
			findingList.refresh();
			if (isNew)
				findingList.selectId(newData.getId());
			propertiesComposite.setData(newData);
		} catch (DatabaseException e) {
			ErrorMessages.showSaveError(getShell(), getDataName(), e);
		}
	}
	
	private void onDeleteData(T dataToDelete) {
		try {
			SessionUtils.runInSession((session) -> session.delete(dataToDelete));
			findingList.refresh();
		} catch (DatabaseException e) {
			ErrorMessages.showDeleteError(getShell(), getDataName(), e);
		}
	}

	protected abstract String getDataName();
	
	public void refresh() {
		findingList.refresh();
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
}
