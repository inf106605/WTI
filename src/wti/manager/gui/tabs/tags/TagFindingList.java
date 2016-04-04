package wti.manager.gui.tabs.tags;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.Utils;

public class TagFindingList extends FindingList<Tag> {

	public TagFindingList(Composite parent, int style) {
		super(parent, style);
		try {
			List<Tag> tags = Utils.getInSession(Tag::getAll);
			setInput(tags);
		} catch (DatabaseException e) {
			//TODO
		}
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
