package wti.manager.gui.widgets.properties;

import java.util.LinkedList;
import java.util.List;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.MessageBox;

import wti.manager.utils.ICloneable;

public abstract class PropertiesComposite<T extends ICloneable<T>> extends Composite {

	public static interface ISaveListener<T> {
		public void onSaveChanges(T newData);
	}
	
	
	private T oryginalData;
	protected T data;
	private List<ISaveListener<T>> saveListeners = new LinkedList<ISaveListener<T>>();

	private Button btnSave;
	private Button btnUndo;
	
	
	public PropertiesComposite(Composite parent, int style) {
		super(parent, style);
		setLayout();
		createControls();
		configureComposites();
	}

	private void setLayout() {
		GridLayout gridLayout = new GridLayout(1, false);
		gridLayout.marginWidth = 0;
		gridLayout.marginHeight = 0;
		setLayout(gridLayout);
	}

	private void createControls() {
		createCompositeProperties();
		createCompositeButtons();
	}

	protected abstract void createCompositeProperties();

	private void createCompositeButtons() {
		Composite compositeButtons = createCompositeButtonsItself();
		createButtonSave(compositeButtons);
		createButtonUndo(compositeButtons);
	}

	private Composite createCompositeButtonsItself() {
		Composite compositeButtons = new Composite(this, SWT.NONE);
		GridLayout gl_compositeButtons = new GridLayout(2, true);
		gl_compositeButtons.marginWidth = 0;
		gl_compositeButtons.marginHeight = 0;
		compositeButtons.setLayout(gl_compositeButtons);
		compositeButtons.setLayoutData(new GridData(SWT.CENTER, SWT.CENTER, true, false, 1, 1));
		return compositeButtons;
	}

	private void createButtonSave(Composite compositeButtons) {
		btnSave = new Button(compositeButtons, SWT.NONE);
		btnSave.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 1, 1));
		btnSave.setText("Zapisz");
		btnSave.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				saveChanges();
			}
		});
	}
	
	private void saveChanges() {
		oryginalData = data;
		for (ISaveListener<T> listener : saveListeners)
			listener.onSaveChanges(data);
		setUnchanged();
	}

	private void createButtonUndo(Composite compositeButtons) {
		btnUndo = new Button(compositeButtons, SWT.NONE);
		btnUndo.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 1, 1));
		btnUndo.setText("Wycofaj zmiany");
		btnUndo.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				undoChanges();
			}
		});
	}
	
	private void undoChanges() {
		setDataForReal(oryginalData);
	}
	
	private void configureComposites() {
		setEditable(false);
		setButtonsEnabled(false);
	}
	
	public void addSaveListener(ISaveListener<T> listener) {
		saveListeners.add(listener);
	}
	
	public void removeSaveListener(ISaveListener<T> listener) {
		saveListeners.remove(listener);
	}
	
	public boolean setData(T data) {
		if (oryginalData == null ? data == null : oryginalData.equals(data))
			return true;
		if (oryginalData != null && !this.data.equals(oryginalData))
			if (!askDiscardChanges())
				return false;
		oryginalData = data;
		return setDataForReal(data);
	}

	private boolean setDataForReal(T data) {
		if (data == null) {
			data = null;
			clearProperties();
			setEditable(false);
		} else {
			this.data = data.clone();
			refreshProperties();
			setEditable(true);
		}
		setUnchanged();
		return true;
	}
	
	private boolean askDiscardChanges() {
		MessageBox messageBox = new MessageBox(getShell(), SWT.ICON_QUESTION | SWT.YES | SWT.NO);
		messageBox.setText(getDataName()+" zosta� zmieniony");
		messageBox.setMessage("Czy na pewno chcesz porzuci� zmiany?");
		int answer = messageBox.open();
		return answer == SWT.YES;
	}
	
	protected abstract String getDataName();
	
	protected abstract void clearProperties();
	
	protected abstract void refreshProperties();
	
	protected abstract void setEditable(boolean editable);
	
	protected void setChanged() {
		setButtonsEnabled(true);
	}

	private void setUnchanged() {
		setButtonsEnabled(false);
	}
	
	private void setButtonsEnabled(boolean enabled) {
		btnSave.setEnabled(enabled);
		btnUndo.setEnabled(enabled);
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
}