package wti.manager.gui.tabs.products;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Button;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.List;

import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.properties.AbstractPropertiesComposite;
import wti.manager.gui.widgets.readonlylist.ReadOnlyList;
import wti.manager.inteligenttags.InteligentTags;

public class ProductPropertiesComposite extends AbstractPropertiesComposite<Product> {
	
	private List listTags;
	private Button btnEditTags;
	

	public ProductPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Product());
	}

	@Override
	protected void createCompositeProperties() {
		super.createCompositeProperties();
		Composite compositeProperties = createCompositePropertiesItself(3);
		createTextColumnControls(compositeProperties, "Nazwa", false, false, Product::getName, Product::setName);
		createTextColumnControls(compositeProperties, "Opis", true, false, Product::getReadableDescription, Product::setReadableDescription);
		createTextColumnControls(compositeProperties, "Fotografia", false, true, Product::getPhotography, Product::setPhotography);
		createSpinnerColumnControls(compositeProperties, "Cena netto", Product::getPriceNetto, Product::setPriceNetto);
		createSpinnerColumnControls(compositeProperties, "Cena brutto", Product::getPriceBrutto, Product::setPriceBrutto);
		createSpinnerColumnControls(compositeProperties, "Procent vat", Product::getPercentVat, Product::setPercentVat);
		createSpinnerColumnControls(compositeProperties, "Dyskont", Product::getDiscount, Product::setDiscount);
		createSpinnerColumnControls(compositeProperties, "Iloœæ", Product::getAmount, Product::setAmount);
		createTagsControls(compositeProperties);
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
		super.clearProperties();
		listTags.removeAll();
	}

	@Override
	protected void refreshProperties() {
		super.refreshProperties();
		fillListTags();
	}
	
	private void fillListTags() {
		listTags.removeAll();
		for (Tag tag : data.getTags())
			listTags.add(tag.getName());
	}

	@Override
	protected void setEditable(boolean editable) {
		super.setEditable(editable);
		listTags.setEnabled(editable);
		btnEditTags.setEnabled(editable);
	}

}
