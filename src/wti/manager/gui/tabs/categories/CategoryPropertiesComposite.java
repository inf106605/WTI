package wti.manager.gui.tabs.categories;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Category;
import wti.manager.gui.widgets.properties.PropertiesComposite;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Text;

public class CategoryPropertiesComposite extends PropertiesComposite<Category> {

	private Text textName;
	private Text textDescription;

	
	public CategoryPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Category());
	}

	@Override
	protected void createCompositeProperties() {
		Composite compositeProperties = createCompositePropertiesItself();
		createNameControls(compositeProperties);
		createDescriptionControls(compositeProperties);
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

	public void createNameControls(Composite compositeProperties) {
		createLabelName(compositeProperties);
		createTextName(compositeProperties);
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

	private void createDescriptionControls(Composite compositeProperties) {
		createLabelDescription(compositeProperties);
		createTextDescription(compositeProperties);
	}

	private void createLabelDescription(Composite compositeProperties) {
		Label lblDescription = new Label(compositeProperties, SWT.NONE);
		lblDescription.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblDescription.setText("Opis");
	}

	private void createTextDescription(Composite compositeProperties) {
		textDescription = new Text(compositeProperties, SWT.BORDER | SWT.V_SCROLL);
		textDescription.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		textDescription.addModifyListener((event) -> onModifyDescription());
	}
	
	private void onModifyDescription() {
		String description = textDescription.getText();
		data.setDescription(description);
		setChanged();
	}

	@Override
	protected String getDataName() {
		return "Kategoria";
	}
	
	@Override
	protected void clearProperties() {
		textName.setText("");
		textDescription.setText("");
	}

	@Override
	protected void refreshProperties() {
		textName.setText(data.getName());
		textDescription.setText(data.getDescription());
	}
	
	@Override
	protected void setEditable(boolean editable) {
		textName.setEditable(editable);
		textDescription.setEditable(editable);
	}
	
}
