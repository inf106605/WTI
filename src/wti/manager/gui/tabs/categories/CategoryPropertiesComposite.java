package wti.manager.gui.tabs.categories;

import org.eclipse.swt.widgets.Composite;

import wti.manager.database.tables.Category;
import wti.manager.gui.widgets.properties.AbstractPropertiesComposite;

public class CategoryPropertiesComposite extends AbstractPropertiesComposite<Category> {
	
	public CategoryPropertiesComposite(Composite parent, int style) {
		super(parent, style, new Category());
	}

	@Override
	protected void createCompositeProperties() {
		super.createCompositeProperties();
		Composite compositeProperties = createCompositePropertiesItself();
		createTextColumnControls(compositeProperties, "Nazwa", false, false, Category::getName, Category::setName);
		createTextColumnControls(compositeProperties, "Opis", true, false, Category::getDescription, Category::setDescription);
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
