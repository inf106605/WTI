package wti.manager.gui.tabs.producers;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Producer;
import wti.manager.gui.tabs.DatabaseTableTabComposite;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.gui.widgets.properties.BasePropertiesComposite;

public class ProducersComposite extends DatabaseTableTabComposite<Producer> {

	public ProducersComposite(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected FindingList<Producer> createFindingListItself(Composite parent, int style) {
		return new ProducerFindingList(parent, style);
	}

	@Override
	protected BasePropertiesComposite<Producer> createPropertiesCompositeItself(Composite parent, int style) {
		return new ProducerPropertiesComposite(parent, style);
	}

	@Override
	protected String getDataName() {
		return "producentów";
	}
	
}
