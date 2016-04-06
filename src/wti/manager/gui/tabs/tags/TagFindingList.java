package wti.manager.gui.tabs.tags;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;

public class TagFindingList extends FindingList<Tag> {

	public TagFindingList(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected List<Tag> getDataFromDatabase() throws DatabaseException {
		List<Tag> tags = SessionUtils.getInSession(Tag::getAll);
		return tags;
	}

	@Override
	protected String getDataName() {
		return "tagów";
	}

	@Override
	protected String getHint() {
		return "Szukaj tagu";
	}

	@Override
	protected String getName(Tag tag) {
		return tag.getName();
	}

}
