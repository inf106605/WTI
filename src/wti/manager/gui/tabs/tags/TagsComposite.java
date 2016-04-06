package wti.manager.gui.tabs.tags;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;

import wti.manager.database.tables.Tag;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.ErrorMessages;
import wti.manager.utils.SessionUtils;

public class TagsComposite extends Composite {

	private TagFindingList tagFindingList;
	private TagPropertiesComposite tagPropertiesComposite;
	
	
	public TagsComposite(Composite parent, int style) {
		super(parent, style);
		setLayout();
		createControls();
	}

	private void setLayout() {
		setLayout(new GridLayout(3, false));
	}

	private void createControls() {
		createCompositeTagList();
		createSeparator();
		createCompositeEditTag();
	}

	private void createCompositeTagList() {
		tagFindingList = new TagFindingList(this, SWT.NONE);
		tagFindingList.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		tagFindingList.addSelectionListener((event) -> onTagSelection());
	}

	private boolean onTagSelection() {
		Tag tag = tagFindingList.getSelectedItem();
		boolean result = tagPropertiesComposite.setData(tag);
		return result;
	}

	private void createSeparator() {
		Label separator = new Label(this, SWT.SEPARATOR | SWT.VERTICAL);
		separator.setLayoutData(new GridData(SWT.LEFT, SWT.FILL, false, true, 1, 1));
	}

	private void createCompositeEditTag() {
		tagPropertiesComposite = new TagPropertiesComposite(this, SWT.NONE);
		tagPropertiesComposite.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		tagPropertiesComposite.addNewListener(this::onNewTag);
		tagPropertiesComposite.addSaveListener(this::onSaveTag);
		tagPropertiesComposite.addDeleteListener(this::onDeleteTag);
	}
	
	private void onNewTag() {
		tagFindingList.deselectAll();
	}
	
	private void onSaveTag(boolean isNew, Tag newTag) {
		try {
			if (isNew)
				SessionUtils.runInSession((session) -> session.save(newTag));
			else
				SessionUtils.runInSession((session) -> session.update(newTag));
			tagFindingList.refresh();
			if (isNew)
				tagFindingList.selectId(newTag.getId());
			tagPropertiesComposite.setData(newTag);
		} catch (DatabaseException e) {
			ErrorMessages.showSaveError(getShell(), "tagu", e);
		}
	}
	
	private void onDeleteTag(Tag tagToDelete) {
		try {
			SessionUtils.runInSession((session) -> session.delete(tagToDelete));
			tagFindingList.refresh();
		} catch (DatabaseException e) {
			ErrorMessages.showDeleteError(getShell(), "tagu", e);
		}
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
}
