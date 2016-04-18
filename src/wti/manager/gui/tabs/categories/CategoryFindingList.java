package wti.manager.gui.tabs.categories;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Category;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;

public class CategoryFindingList extends FindingList<Category> {

	public CategoryFindingList(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected List<Category> getDataFromDatabase() throws DatabaseException {
		List<Category> tags = SessionUtils.getInSession(Category::getAll);
		return tags;
	}

	@Override
	protected String getDataName() {
		return "kategorii";
	}

	@Override
	protected String getHint() {
		return "Szukaj kategorii";
	}

	@Override
	protected String getName(Category category) {
		return category.getName();
	}

}
