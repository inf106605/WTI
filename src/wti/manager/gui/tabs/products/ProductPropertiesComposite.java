package wti.manager.gui.tabs.products;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.List;
import org.eclipse.swt.widgets.Text;

import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.properties.PropertiesComposite;
import wti.manager.gui.widgets.readonlylist.ReadOnlyList;
import wti.manager.inteligenttags.InteligentTags;

import org.eclipse.swt.widgets.Button;

public class ProductPropertiesComposite extends PropertiesComposite<Product> {
	
	private Text textName;
	private Text textDescription;
	private List listTags;
	private Button btnEditTags;
	

	public ProductPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Product());
	}

	@Override
	protected void createCompositeProperties() {
		Composite compositeProperties = createCompositePropertiesItself();
		createNameControls(compositeProperties);
		createDescriptionControls(compositeProperties);
		createTagsControls(compositeProperties);
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

	private void createNameControls(Composite compositeProperties) {
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
		textDescription = new Text(compositeProperties, SWT.BORDER | SWT.WRAP | SWT.V_SCROLL | SWT.MULTI);
		textDescription.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		textDescription.addModifyListener((event) -> onModifyDescription());
	}
	
	private void onModifyDescription() {
		String description = textDescription.getText();
		data.setReadableDescription(description);
		setChanged();
	}

	private void createTagsControls(Composite compositeProperties) {
		createLabelTags(compositeProperties);
		createCompositeTags(compositeProperties);
	}

	private void createLabelTags(Composite compositeProperties) {
		Label lblTags = new Label(compositeProperties, SWT.NONE);
		lblTags.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lblTags.setText("Tagi");
	}
	
	private void createCompositeTags(Composite compositeProperties) {
		Composite compositeTags = createCompositeTagsItself(compositeProperties);
		createListTags(compositeTags);
		createButtonEditTags(compositeTags);
	}
	
	private Composite createCompositeTagsItself(Composite compositeProperties) {
		Composite compositeTags = new Composite(compositeProperties, SWT.NONE);
		GridLayout gl_compositeTags = new GridLayout(3, false);
		gl_compositeTags.marginWidth = 0;
		gl_compositeTags.marginHeight = 0;
		compositeTags.setLayout(gl_compositeTags);
		compositeTags.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		return compositeTags;
	}
	
	private void createListTags(Composite compositeTags) {
		listTags = new ReadOnlyList(compositeTags, SWT.BORDER | SWT.V_SCROLL);
		listTags.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
	}
	
	private void createButtonEditTags(Composite compositeTags) {
		btnEditTags = new Button(compositeTags, SWT.NONE);
		btnEditTags.setText("Edytuj tagi");
		btnEditTags.addSelectionListener(new SelectionAdapter(){
			@Override
			public void widgetSelected(SelectionEvent arg0) {
				onEditTags();
			}
		});
	}
	
	private void onEditTags() {
		InteligentTags.refreshTags(data);
		fillListTags();
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
		listTags.removeAll();
	}

	@Override
	protected void refreshProperties() {
		textName.setText(data.getName());
		textDescription.setText(data.getReadableDescription());
		fillListTags();
	}
	
	private void fillListTags() {
		listTags.removeAll();
		for (Tag tag : data.getTags())
			listTags.add(tag.getName());
	}

	@Override
	protected void setEditable(boolean editable) {
		textName.setEditable(editable);
		textDescription.setEditable(editable);
		listTags.setEnabled(editable);
		btnEditTags.setEnabled(editable);
	}

}
