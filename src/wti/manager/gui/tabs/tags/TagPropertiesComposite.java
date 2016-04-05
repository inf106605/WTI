package wti.manager.gui.tabs.tags;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.properties.PropertiesComposite;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Text;

public class TagPropertiesComposite extends PropertiesComposite<Tag> {
	
	private Text textName;

	
	public TagPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Tag());
	}

	@Override
	protected void createCompositeProperties() {
		Composite compositeProperties = createCompositePropertiesItself();
		createLabelName(compositeProperties);
		createTextName(compositeProperties);
	}

	private Composite createCompositePropertiesItself() {
		Composite compositeProperties = new Composite(this, SWT.NONE);
		GridLayout gl_compositeProperties = new GridLayout(2, false);
		gl_compositeProperties.marginWidth = 0;
		gl_compositeProperties.marginHeight = 0;
		compositeProperties.setLayout(gl_compositeProperties);
		compositeProperties.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		return compositeProperties;
	}

	private void createLabelName(Composite compositeProperties) {
		Label lblName = new Label(compositeProperties, SWT.NONE);
		lblName.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblName.setText("Nazwa");
	}

	private void createTextName(Composite compositeProperties) {
		textName = new Text(compositeProperties, SWT.BORDER);
		textName.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		textName.addModifyListener((event) -> onModifyName());
	}
	
	private void onModifyName() {
		String name = textName.getText();
		data.setName(name);
		setChanged();
	}

	@Override
	protected String getDataName() {
		return "Tag";
	}
	
	@Override
	protected void clearProperties() {
		textName.setText("");
	}

	@Override
	protected void refreshProperties() {
		textName.setText(data.getName());
	}
	
	@Override
	protected void setEditable(boolean editable) {
		textName.setEditable(editable);
	}
	
}
