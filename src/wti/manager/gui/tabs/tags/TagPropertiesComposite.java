package wti.manager.gui.tabs.tags;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Tag;
import wti.manager.gui.widgets.properties.AbstractPropertiesComposite;

public class TagPropertiesComposite extends AbstractPropertiesComposite<Tag> {
	
	public TagPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Tag());
	}

	@Override
	protected void createCompositeProperties() {
		super.createCompositeProperties();
		Composite compositeProperties = createCompositePropertiesItself();
		createTextColumnControls(compositeProperties, "Nazwa", false, Tag::getName, Tag::setName);
	}

	@Override
	protected String getDataName() {
		return "Tag";
	}
	
	@Override
	protected void clearProperties() {
		super.clearProperties();
	}

	@Override
	protected void refreshProperties() {
		super.refreshProperties();
	}
	
	@Override
	protected void setEditable(boolean editable) {
		super.setEditable(editable);
	}
	
}
