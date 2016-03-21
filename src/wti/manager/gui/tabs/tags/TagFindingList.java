package wti.manager.gui.tabs.tags;

import java.util.LinkedList;
import java.util.List;

import org.eclipse.swt.widgets.Composite;

import wti.manager.gui.widgets.findinglist.FindingList;

public class TagFindingList extends FindingList<Object> {

	public TagFindingList(Composite parent, int style) {
		super(parent, style);
		List<Object> aaa = new LinkedList<Object>();
		aaa.add("peda³");
		aaa.add("kierownica");
		aaa.add("smar");
		aaa.add("szprycha");
		setInput(aaa);
	}

	@Override
	protected String getHint() {
		return "Szukaj tagu";
	}

	@Override
	protected String getName(Object object) {
		return object.toString();
	}

}
