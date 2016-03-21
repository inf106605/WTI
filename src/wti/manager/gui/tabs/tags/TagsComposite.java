package wti.manager.gui.tabs.tags;

import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.SWT;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.layout.GridData;

public class TagsComposite extends Composite {

	private TagFindingList compositeTagList;
	
	
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
		compositeTagList = new TagFindingList(this, SWT.NONE);
		compositeTagList.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
	}

	private void createSeparator() {
		Label separator = new Label(this, SWT.SEPARATOR | SWT.VERTICAL);
		separator.setLayoutData(new GridData(SWT.LEFT, SWT.FILL, false, true, 1, 1));
	}

	private void createCompositeEditTag() {
		Composite compositeEditTag = new Composite(this, SWT.NONE);
		compositeEditTag.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}
}
