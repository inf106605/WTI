package wti.manager.gui.tabs.producers;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Producer;
import wti.manager.gui.widgets.properties.AbstractPropertiesComposite;

public class ProducerPropertiesComposite extends AbstractPropertiesComposite<Producer> {

	public ProducerPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Producer());
	}

	@Override
	protected void createCompositeProperties() {
		super.createCompositeProperties();
		Composite compositeProperties = createCompositePropertiesItself();
		createTextColumnControls(compositeProperties, "Nazwa", false, false, Producer::getName, Producer::setName);
		createTextColumnControls(compositeProperties, "Regon", false, false, Producer::getRegon, Producer::setRegon);
		createTextColumnControls(compositeProperties, "NIP", false, false, Producer::getNip, Producer::setNip);
		createTextColumnControls(compositeProperties, "Telefon", false, false, Producer::getTelephone, Producer::setTelephone);
	}

	@Override
	protected String getDataName() {
		return "Kategoria";
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
