package wti.manager.gui.tabs.products;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Product;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.Utils;

public class ProductFindingList extends FindingList<Product> {

	public ProductFindingList(Composite parent, int style) {
		super(parent, style);
		try {
			List<Product> products = Utils.getInSession(Product::getAll);
			setInput(products);
		} catch (DatabaseException e) {
			//TODO
		}
	}

	@Override
	protected String getHint() {
		return "Szukaj produktu";
	}

	@Override
	protected String getName(Product product) {
		return product.getName();
	}

}
