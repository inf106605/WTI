package wti.manager.gui.dialogs.edittags;

import wti.manager.database.tables.Tag;

public class ProposedTag {

	private final String name;
	private final Tag tag;
	private boolean selected;
	
	
	public ProposedTag(String name, Tag tag, boolean selected) {
		this.name = name;
		this.tag = tag;
		this.selected = selected;
	}
	
	public String getName() {
		return name;
	}
	
	public Tag getTag() {
		return tag;
	}
	
	public boolean isExists() {
		return tag != null;
	}
	
	public boolean isSelected() {
		return selected;
	}
	
	public void setSelected(boolean selected) {
		this.selected = selected;
	}
	
	@Override
	public String toString() {
		return "ProposedTag("+(isExists() ? "" : "*")+name+", "+selected+")";
	}
	
}
