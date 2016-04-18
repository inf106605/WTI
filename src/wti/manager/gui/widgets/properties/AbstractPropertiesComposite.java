package wti.manager.gui.widgets.properties;

import java.util.LinkedList;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Text;

import wti.manager.interfaces.ICloneable;

public abstract class AbstractPropertiesComposite<T extends ICloneable<T>> extends BasePropertiesComposite<T> {

	protected static interface TextGetter<T> {
		public String getText(T data);
	}
	
	protected static interface TextSetter<T> {
		public void setText(T data, String text);
	}
	
	private static class TextInfo<T> {
		public Text text;
		public TextGetter<T> getter;
		public TextInfo(Text text, TextGetter<T> getter) {
			this.text = text;
			this.getter = getter;
		}
	}
	
	
	private int dataColumns;
	
	private LinkedList<TextInfo<T>> textes;


	public AbstractPropertiesComposite(Composite parent, int style, T emptyData) {
		super(parent, style, emptyData);
	}
	
	@Override
	protected void createCompositeProperties() {
		textes = new LinkedList<TextInfo<T>>();
	}
	
	protected Composite createCompositePropertiesItself() {
		return createCompositePropertiesItself(2);
	}
	
	protected Composite createCompositePropertiesItself(int columns) {
		dataColumns = columns - 1;
		Composite compositeProperties = new Composite(this, SWT.NONE);
		GridLayout gl_compositeProperties = new GridLayout(columns, false);
		gl_compositeProperties.marginWidth = 0;
		gl_compositeProperties.marginHeight = 0;
		compositeProperties.setLayout(gl_compositeProperties);
		compositeProperties.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		return compositeProperties;
	}
	
	protected void createTextColumnControls(Composite compositeProperties, String label, boolean multiline, TextGetter<T> getter, TextSetter<T> setter) {
		createLabel(compositeProperties, label);
		createText(compositeProperties, multiline, getter, setter);
	}

	private void createLabel(Composite compositeProperties, String label) {
		Label lbl = new Label(compositeProperties, SWT.NONE);
		lbl.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lbl.setText(label);
	}

	private void createText(Composite compositeProperties, boolean multiline, TextGetter<T> getter, TextSetter<T> setter) {
		Text text = new Text(compositeProperties, SWT.BORDER | (multiline ? (SWT.WRAP | SWT.V_SCROLL | SWT.MULTI) : 0));
		text.setLayoutData(new GridData(SWT.FILL, multiline ? SWT.FILL : SWT.CENTER, true, multiline, dataColumns, 1));
		text.addModifyListener((event) -> onModifyText(text, setter));
		textes.add(new TextInfo<T>(text, getter));
	}
	
	private void onModifyText(Text text, TextSetter<T> setter) {
		String textContent = text.getText();
		setter.setText(data, textContent);
		setChanged();
	}

	@Override
	protected void clearProperties() {
		for (TextInfo<T> textInfo : textes)
			textInfo.text.setText("");
	}

	@Override
	protected void refreshProperties() {
		for (TextInfo<T> textInfo : textes)
			textInfo.text.setText(textInfo.getter.getText(data));
	}
	
	@Override
	protected void setEditable(boolean editable) {
		for (TextInfo<T> textInfo : textes)
			textInfo.text.setEditable(editable);
	}

}
