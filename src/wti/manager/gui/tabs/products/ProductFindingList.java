package wti.manager.gui.tabs.products;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Product;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;

public class ProductFindingList extends FindingList<Product> {

	public ProductFindingList(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected List<Product> getDataFromDatabase() throws DatabaseException {
		List<Product> products = SessionUtils.getInSession(Product::getAll);
		return products;
	}

	@Override
	protected String getDataName() {
		return "produkt�w";
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
