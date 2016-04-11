package wti.manager.gui.dialogs.edittags;

import java.util.Collection;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Dialog;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.Table;
import org.eclipse.swt.widgets.TableItem;

import wti.manager.database.tables.Tag;
import wti.manager.gui.images.Images;
import wti.manager.gui.images.Images.IMAGES;

public class EditTagsDialog extends Dialog {

	private Collection<ProposedTag> proposedTags;
	private boolean result;
	
	private Shell shell;
	private TagCombo comboAdd;
	private Button btnAddTag;
	private Table table;
	private Button btnOk;
	private Button btnCancel;


	public EditTagsDialog(Shell parent, int style, Collection<ProposedTag> proposedTags) {
		super(parent, style);
		this.proposedTags = proposedTags;
		setText("Edycja tagów");
	}

	public boolean open() {
		createContents();
		shell.open();
		shell.layout();
		try {
			shell.setImage(Images.getImage(IMAGES.ICON));
		} catch (Exception e) {
			e.printStackTrace();
		}
		Display display = getParent().getDisplay();
		while (!shell.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
		return result;
	}

	private void createContents() {
		createShell();
		createAddControls();
		createTable();
		createCompositeButtons();
	}

	private void createShell() {
		shell = new Shell(getParent(), getStyle());
		shell.setSize(450, 300);
		shell.setText(getText());
		shell.setLayout(new GridLayout(2, false));
	}
	
	private void createAddControls() {
		createComboAdd();
		createButtonAdd();
	}

	private void createComboAdd() {
		comboAdd = new TagCombo(shell, SWT.NONE);
		comboAdd.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		comboAdd.addModifyListener((event) -> onAddModify());
	}
	
	private void onAddModify() {
		String text = comboAdd.getText();
		btnAddTag.setEnabled(!text.isEmpty());
	}

	private void createButtonAdd() {
		btnAddTag = new Button(shell, SWT.NONE);
		btnAddTag.setText("Dodaj tag");
		btnAddTag.setEnabled(false);
		btnAddTag.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				onAdd();
			}
		});
	}
	
	private void onAdd() {
		if (!comboAdd.getText().isEmpty()) {
			Tag tag = comboAdd.getSelectedItem();
			if (tag != null)
				proposedTags.add(new ProposedTag(tag.getName(), tag, true));
			else
				proposedTags.add(new ProposedTag(comboAdd.getText(), null, true));
			comboAdd.select(-1);
			comboAdd.setText("");
			fillTable();
		}
	}

	private void createTable() {
		createTableItself();
		fillTable();
	}

	private void createTableItself() {
		table = new Table(shell, SWT.BORDER | SWT.CHECK | SWT.FULL_SELECTION);
		table.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 2, 1));
		table.setLinesVisible(true);
		table.addSelectionListener(new SelectionAdapter() {
			@Override
			public void widgetSelected(SelectionEvent event) {
				if (event.detail == SWT.CHECK)
					onCheck((TableItem) event.item);
			}
		});
	}
	
	private void onCheck(TableItem tableItem) {
		ProposedTag proposedTag = (ProposedTag) tableItem.getData();
		boolean isSelected = tableItem.getChecked();
		proposedTag.setSelected(isSelected);
	}
	
	private void fillTable() {
		table.removeAll();
		for (ProposedTag proposedTag : proposedTags) {
			TableItem tableItem = new TableItem(table, SWT.NONE);
			String text = proposedTag.isExists() ? proposedTag.getName() : "*"+proposedTag.getName();
			tableItem.setText(text);
			tableItem.setChecked(proposedTag.isSelected());
			tableItem.setData(proposedTag);
		}
	}

	private void createCompositeButtons() {
		Composite compositeButtons = createCompositeButtonsItself();
		createButtonOK(compositeButtons);
		createButtonCancel(compositeButtons);
	}

	private Composite createCompositeButtonsItself() {
		Composite compositeButtons = new Composite(shell, SWT.NONE);
		compositeButtons.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 2, 1));
		compositeButtons.setLayout(new GridLayout(2, true));
		return compositeButtons;
	}

	private void createButtonOK(Composite compositeButtons) {
		btnOk = new Button(compositeButtons, SWT.NONE);
		btnOk.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 1, 1));
		btnOk.setText("OK");
		btnOk.addSelectionListener(new SelectionAdapter(){
			@Override
			public void widgetSelected(SelectionEvent event) {
				closeDialog(true);
			}
		});
	}

	private void createButtonCancel(Composite compositeButtons) {
		btnCancel = new Button(compositeButtons, SWT.NONE);
		btnCancel.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, false, false, 1, 1));
		btnCancel.setText("Anuluj");
		btnCancel.addSelectionListener(new SelectionAdapter(){
			@Override
			public void widgetSelected(SelectionEvent event) {
				closeDialog(false);
			}
		});
	}
	
	private void closeDialog(boolean saveChanges) {
		result = saveChanges;
		shell.close();
	}
	
}
