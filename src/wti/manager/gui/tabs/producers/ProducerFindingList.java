package wti.manager.gui.tabs.producers;

import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Producer;
import wti.manager.gui.widgets.findinglist.FindingList;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;

public class ProducerFindingList extends FindingList<Producer> {

	public ProducerFindingList(Composite parent, int style) {
		super(parent, style);
	}

	@Override
	protected List<Producer> getDataFromDatabase() throws DatabaseException {
		List<Producer> producers = SessionUtils.getInSession(Producer::getAll);
		return producers;
	}

	@Override
	protected String getDataName() {
		return "producentów";
	}

	@Override
	protected String getHint() {
		return "Szukaj producenta";
	}

	@Override
	protected String getName(Producer producer) {
		return producer.getName();
	}

}
