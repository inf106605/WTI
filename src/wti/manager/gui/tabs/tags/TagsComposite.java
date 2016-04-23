package wti.manager.gui.tabs.tags;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.tabs.DatabaseTableTabComposite;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.gui.widgets.properties.BasePropertiesComposite;

public class TagsComposite extends DatabaseTableTabComposite<Tag> {

	public TagsComposite(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected FindingList<Tag> createFindingListItself(Composite parent, int style) {
		return new TagFindingList(parent, style);
	}

	@Override
	protected BasePropertiesComposite<Tag> createPropertiesCompositeItself(Composite parent, int style) {
		return new TagPropertiesComposite(parent, style);
	}

	@Override
	protected String getDataName() {
		return "tagu";
	}
	
}
