package wti.manager.gui.tabs.products;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Product;
import wti.manager.gui.widgets.properties.PropertiesComposite;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Text;

public class ProductPropertiesComposite extends PropertiesComposite<Product> {
	private Text textName;
	private Text textDescription;

	public ProductPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Product());
	}

	@Override
	protected void createCompositeProperties() {
		Composite compositeProperties = createCompositePropertiesItself();
		createNameControls(compositeProperties);
		createDescriptionControls(compositeProperties);
	}

	public Composite createCompositePropertiesItself() {
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

	public void createLabelName(Composite compositeProperties) {
		Label lblName = new Label(compositeProperties, SWT.NONE);
		lblName.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblName.setText("Nazwa");
	}

	public void createTextName(Composite compositeProperties) {
		textName = new Text(compositeProperties, SWT.BORDER);
		textName.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, 1, 1));
		textName.addModifyListener((event) -> onModifyName());
	}
	
	private void onModifyName() {
		String name = textName.getText();
		data.setName(name);
		setChanged();
	}

	public void createDescriptionControls(Composite compositeProperties) {
		createLabelDescription(compositeProperties);
		createTextDescription(compositeProperties);
	}

	public void createLabelDescription(Composite compositeProperties) {
		Label lblDescription = new Label(compositeProperties, SWT.NONE);
		lblDescription.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblDescription.setText("Opis");
	}

	public void createTextDescription(Composite compositeProperties) {
		textDescription = new Text(compositeProperties, SWT.BORDER | SWT.WRAP | SWT.V_SCROLL | SWT.MULTI);
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
		return "Produkt";
	}

	@Override
	protected void clearProperties() {
		textName.setText("");
		textDescription.setText("");
	}

	@Override
	protected void refreshProperties() {
		textName.setText(data.getName());
		textDescription.setText(data.getDescryption());
	}

	@Override
	protected void setEditable(boolean editable) {
		textName.setEditable(editable);
		textDescription.setEditable(editable);
	}

}
