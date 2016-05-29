package wti.manager.gui.widgets.properties;

import java.util.LinkedList;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Label;
import org.eclipse.swt.widgets.Spinner;
import org.eclipse.swt.widgets.Text;

import wti.manager.interfaces.ICloneable;

public abstract class AbstractPropertiesComposite<T extends ICloneable<T>> extends BasePropertiesComposite<T> {

	protected static interface TextGetter<T> {
		public String getText(T data);
	}
	
	protected static interface TextSetter<T> {
		public void setText(T data, String text);
	}

	protected static interface NumberGetter<T> {
		public Integer getNumber(T data);
	}
	
	protected static interface NumberSetter<T> {
		public void setNumber(T data, int text);
	}
	
	private static class TextInfo<T> {
		public Text text;
		public TextGetter<T> getter;
		public TextInfo(Text text, TextGetter<T> getter) {
			this.text = text;
			this.getter = getter;
		}
	}
	
	private static class SpinnerInfo<T> {
		public Spinner spinner;
		public NumberGetter<T> getter;
		public SpinnerInfo(Spinner spinner, NumberGetter<T> getter) {
			this.spinner = spinner;
			this.getter = getter;
		}
	}
	
	
	private int dataColumns;

	private LinkedList<TextInfo<T>> textes;
	private LinkedList<SpinnerInfo<T>> spinners;


	public AbstractPropertiesComposite(Composite parent, int style, T emptyData) {
		super(parent, style, emptyData);
	}
	
	@Override
	protected void createCompositeProperties() {
		textes = new LinkedList<TextInfo<T>>();
		spinners = new LinkedList<SpinnerInfo<T>>();
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
	
	protected void createTextColumnControls(Composite compositeProperties, String label, boolean multiline, boolean nullable, TextGetter<T> getter, TextSetter<T> setter) {
		createLabel(compositeProperties, label);
		createText(compositeProperties, multiline, nullable, getter, setter);
	}

	protected void createSpinnerColumnControls(Composite compositeProperties, String label, NumberGetter<T> getter, NumberSetter<T> setter) {
		createLabel(compositeProperties, label);
		createSpinner(compositeProperties, getter, setter);
	}
	
	private void createLabel(Composite compositeProperties, String label) {
		Label lbl = new Label(compositeProperties, SWT.NONE);
		lbl.setLayoutData(new GridData(SWT.RIGHT, SWT.CENTER, false, false, 1, 1));
		lbl.setText(label);
	}

	private void createText(Composite compositeProperties, boolean multiline, boolean nullable, TextGetter<T> getter, TextSetter<T> setter) {
		Text text = new Text(compositeProperties, SWT.BORDER | (multiline ? (SWT.WRAP | SWT.V_SCROLL | SWT.MULTI) : 0));
		text.setLayoutData(new GridData(SWT.FILL, multiline ? SWT.FILL : SWT.CENTER, true, multiline, dataColumns, 1));
		text.addModifyListener((event) -> onModifyText(text, setter, nullable));
		textes.add(new TextInfo<T>(text, getter));
	}
	
	private void onModifyText(Text text, TextSetter<T> setter, boolean nullable) {
		String textContent = text.getText();
		if (nullable && textContent.isEmpty())
			textContent = null;
		setter.setText(data, textContent);
		setChanged();
	}

	private void createSpinner(Composite compositeProperties, NumberGetter<T> getter, NumberSetter<T> setter) {
		Spinner spinner = new Spinner(compositeProperties, SWT.BORDER);
		spinner.setLayoutData(new GridData(SWT.FILL, SWT.CENTER, true, false, dataColumns, 1));
		spinner.addModifyListener((event) -> onModifyNumber(spinner, setter));
		spinners.add(new SpinnerInfo<T>(spinner, getter));
	}
	
	private void onModifyNumber(Spinner spinner, NumberSetter<T> setter) {
		int numberContent = spinner.getSelection();
		setter.setNumber(data, numberContent);
		setChanged();
	}

	@Override
	protected void clearProperties() {
		for (TextInfo<T> textInfo : textes)
			textInfo.text.setText("");
		for (SpinnerInfo<T> spinnerInfo : spinners)
			spinnerInfo.spinner.setSelection(0);
	}

	@Override
	protected void refreshProperties() {
		for (TextInfo<T> textInfo : textes)
		{
			String text = textInfo.getter.getText(data);
			if (text == null)
				text = "";
			textInfo.text.setText(text);
		}
		for (SpinnerInfo<T> spinnerInfo : spinners)
		{
			Integer number = spinnerInfo.getter.getNumber(data);
			if (number == null)
				number = 0;
			spinnerInfo.spinner.setSelection(number);
		}
	}
	
	@Override
	protected void setEditable(boolean editable) {
		for (TextInfo<T> textInfo : textes)
			textInfo.text.setEditable(editable);
		for (SpinnerInfo<T> spinnerInfo : spinners)
			spinnerInfo.spinner.setEnabled(editable);
	}

}
