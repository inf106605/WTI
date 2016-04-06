package wti.manager.gui.tabs.products;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Product;
import wti.manager.gui.widgets.properties.PropertiesComposite;

public class ProductPropertiesComposite extends PropertiesComposite<Product> {

	public ProductPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Product());
	}

	@Override
	protected void createCompositeProperties() {
		// TODO Auto-generated method stub

	}

	@Override
	protected String getDataName() {
		return "Produkt";
	}

	@Override
	protected void clearProperties() {
		// TODO Auto-generated method stub

	}

	@Override
	protected void refreshProperties() {
		// TODO Auto-generated method stub

	}

	@Override
	protected void setEditable(boolean editable) {
		// TODO Auto-generated method stub

	}

}
