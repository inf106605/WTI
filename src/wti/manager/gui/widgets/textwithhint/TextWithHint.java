package wti.manager.gui.widgets.textwithhint;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.FocusEvent;
import org.eclipse.swt.events.FocusListener;
import org.eclipse.swt.graphics.Color;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Text;
import org.eclipse.wb.swt.SWTResourceManager;

public class TextWithHint extends Text {

	private static final Color NORMAL_COLOR = SWTResourceManager.getColor(SWT.COLOR_BLACK);
	private static final Color HINT_COLOR = SWTResourceManager.getColor(SWT.COLOR_GRAY);
	
	private String hint = "";
	private boolean wasEmpty = false;
	private boolean hasFocus = false;
	
	
	public TextWithHint(Composite parent, int style) {
		super(parent, style);
		addListeners();
		refreshHint();
	}

	private void addListeners() {
		addModifyListener();
		addFocusListener();
	}

	private void addModifyListener() {
		addModifyListener((event) -> refreshHint());
	}

	private void addFocusListener() {
		addFocusListener(new FocusListener() {
			@Override
			public void focusLost(FocusEvent event) {
				hasFocus = false;
				onChangeFocus();
			}
			@Override
			public void focusGained(FocusEvent event) {
				hasFocus = true;
				onChangeFocus();
			}
		});
	}

	public String getHint() {
		return hint;
	}

	public void setHint(String hint) {
		if (hint == null)
			throw new NullPointerException();
		this.hint = hint;
		wasEmpty = false;
		refreshHint();
	}
	
	private void refreshHint() {
		String text = super.getText();
		boolean isEmpty = text.equals("") || (wasEmpty && text.equals(hint));
		if (isEmpty == wasEmpty)
			return;
		wasEmpty = isEmpty;
		if (isEmpty) {
			setForeground(HINT_COLOR);
			onChangeFocus();
		} else
			setForeground(NORMAL_COLOR);
	}
	
	private void onChangeFocus() {
		if (!wasEmpty)
			return;
		if (hasFocus)
			setText("");
		else
			setText(hint);
	}
	
	@Override
	public String getText() {
		if (wasEmpty)
			return "";
		else
			return super.getText();
	}

	@Override
	protected void checkSubclass() {
		// Disable the check that prevents subclassing of SWT components
	}

}
