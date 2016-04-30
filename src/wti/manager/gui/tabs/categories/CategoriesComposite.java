package wti.manager.gui.tabs.categories;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Category;
import wti.manager.gui.tabs.DatabaseTableTabComposite;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.gui.widgets.properties.BasePropertiesComposite;

public class CategoriesComposite extends DatabaseTableTabComposite<Category> {

	public CategoriesComposite(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected FindingList<Category> createFindingListItself(Composite parent, int style) {
		return new CategoryFindingList(parent, style);
	}

	@Override
	protected BasePropertiesComposite<Category> createPropertiesCompositeItself(Composite parent, int style) {
		return new CategoryPropertiesComposite(parent, style);
	}

	@Override
	protected String getDataName() {
		return "kategorii";
	}
	
}
