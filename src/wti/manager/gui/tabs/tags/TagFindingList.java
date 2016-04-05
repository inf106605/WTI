package wti.manager.gui.tabs.tags;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.ErrorMessages;
import wti.manager.utils.SessionUtils;

public class TagFindingList extends FindingList<Tag> {

	public TagFindingList(Composite parent, int style) {
		super(parent, style);
		refresh();
	}

	public void refresh() {
		try {
			List<Tag> tags = SessionUtils.getInSession(Tag::getAll);
			setInput(tags);
			reselectItem();
		} catch (DatabaseException e) {
			ErrorMessages.showListLoadError(getShell(), "tagów", e);
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
