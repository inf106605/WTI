package wti.manager.gui.tabs.products;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Product;
import wti.manager.gui.tabs.DatabaseTableTabComposite;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.gui.widgets.properties.PropertiesComposite;

public class ProductsComposite extends DatabaseTableTabComposite<Product> {

	public ProductsComposite(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected FindingList<Product> createFindingListItself(Composite parent, int style) {
		return new ProductFindingList(parent, style);
	}

	@Override
	protected PropertiesComposite<Product> createPropertiesCompositeItself(Composite parent, int style) {
		return new ProductPropertiesComposite(parent, style);
	}

	@Override
	protected String getDataName() {
		return "produktu";
	}

}
