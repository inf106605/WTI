package wti.manager.gui.widgets.tablecombo;

import java.util.Collection;

import org.eclipse.swt.widgets.Combo;
import org.eclipse.swt.widgets.Composite;

import wti.manager.interfaces.INamedTableRow;
import wti.manager.utils.DatabaseException;

public abstract class TableCombo<T extends INamedTableRow<T>> extends Combo {

	public TableCombo(Composite parent, int style) {
		super(parent, style);
		fill();
	}
	
	private void fill() {
		try {
			Collection<T> items = getItemsFromDatabase();
			for (T item : items) {
				add(item.getName());
				setData(item.getName(), item);
			}
		} catch (DatabaseException e) {
			//TODO
		}
	}
	
	protected abstract Collection<T> getItemsFromDatabase() throws DatabaseException;
	
	public T getSelectedItem() {
		if (getSelectionIndex() == -1)
			return null;
		@SuppressWarnings("unchecked")
		T item = (T) getData(getText());
		return item;
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}

}
