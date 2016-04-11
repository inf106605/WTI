package wti.manager.gui.windows.main;

import org.eclipse.swt.SWT;
import org.eclipse.swt.events.SelectionAdapter;
import org.eclipse.swt.events.SelectionEvent;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Control;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.TabFolder;
import org.eclipse.swt.widgets.TabItem;

import wti.manager.gui.images.Images;
import wti.manager.gui.images.Images.IMAGES;
import wti.manager.gui.tabs.DatabaseTableTabComposite;
import wti.manager.gui.tabs.products.ProductsComposite;
import wti.manager.gui.tabs.tags.TagsComposite;

public class MainWindow {

	private TabFolder tabFolder;
	
	
	/**
	 * @wbp.parser.entryPoint
	 */
	public void open() {
		Shell shell = createShell();
		createControls(shell);
		openShell(shell);
	}

	private Shell createShell() {
		Shell shell = new Shell();
		shell.setSize(800, 600);
		shell.setText("Menad¿er sklepu");
		try {
			shell.setImage(Images.getImage(IMAGES.ICON));
		} catch (Exception e) {
			e.printStackTrace();
		}
		GridLayout gl_shell = new GridLayout(1, false);
		gl_shell.marginHeight = 0;
		gl_shell.marginWidth = 0;
		shell.setLayout(gl_shell);
		return shell;
	}

	private void createControls(Composite parent) {
		createTabFolder(parent);
	}

	private void createTabFolder(Composite parent) {
		createTabFolderItself(parent);
		createTabs();
	}

	private void createTabFolderItself(Composite parent) {
		tabFolder = new TabFolder(parent, SWT.NONE);
		tabFolder.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		tabFolder.addSelectionListener(new SelectionAdapter(){
			@Override
			public void widgetSelected(SelectionEvent arg0) {
				onTabSelection();
			}
		});
	}
	
	private void onTabSelection() {
		TabItem selectedTabItem = tabFolder.getSelection()[0];
		Control selectedTabItemControl = selectedTabItem.getControl();
		if (selectedTabItemControl instanceof DatabaseTableTabComposite<?>) {
			((DatabaseTableTabComposite<?>) selectedTabItemControl).refresh();
		}
	}

	private void createTabs() {
		createTabTags();
		createTabProducts();
	}

	private void createTabTags() {
		TabItem tbtmTags = new TabItem(tabFolder, SWT.NONE);
		tbtmTags.setText("Tagi");
		TagsComposite tagsComposite = new TagsComposite(tabFolder, SWT.NONE);
		tbtmTags.setControl(tagsComposite);
	}

	private void createTabProducts() {
		TabItem tbtmProducts = new TabItem(tabFolder, SWT.NONE);
		tbtmProducts.setText("Produkty");
		ProductsComposite productsComposite = new ProductsComposite(tabFolder, SWT.NONE);
		tbtmProducts.setControl(productsComposite);
	}

	private void openShell(Shell shell) {
		Display display = Display.getDefault();
		shell.open();
		shell.layout();
		while (!shell.isDisposed()) {
			if (!display.readAndDispatch()) {
				display.sleep();
			}
		}
	}
}
