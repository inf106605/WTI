package wti.manager.gui.dialogs.edittags;

import java.util.Collection;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.tablecombo.TableCombo;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;

public class TagCombo extends TableCombo<Tag> {

	public TagCombo(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected Collection<Tag> getItemsFromDatabase() throws DatabaseException {
		return SessionUtils.getInSession(Tag::getAll);
	}

}
