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
import wti.manager.gui.tabs.categories.CategoriesComposite;
import wti.manager.gui.tabs.producers.ProducersComposite;
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
		refreshSelectedTab();
	}

	private void createTabs() {
		createTab("Tagi", new TagsComposite(tabFolder, SWT.NONE));
		createTab("Kategorie", new CategoriesComposite(tabFolder, SWT.NONE));
		createTab("Producenci", new ProducersComposite(tabFolder, SWT.NONE));
		createTab("Produkty", new ProductsComposite(tabFolder, SWT.NONE));
	}

	private void createTab(String name, Composite tabComposite) {
		TabItem tbtmTags = new TabItem(tabFolder, SWT.NONE);
		tbtmTags.setText(name);
		tbtmTags.setControl(tabComposite);
		if (tabFolder.getItemCount() == 1)
			refreshTab(tabComposite);
	}
	
	private void refreshSelectedTab() {
		TabItem selectedTabItem = tabFolder.getSelection()[0];
		Control selectedTabItemControl = selectedTabItem.getControl();
		if (selectedTabItemControl != null)
			refreshTab(selectedTabItemControl);
	}
	
	private static void refreshTab(Control control) {
		if (control instanceof DatabaseTableTabComposite<?>) {
			((DatabaseTableTabComposite<?>) control).refresh();
		} else {
			throw new RuntimeException("Not supported tab type!");
		}
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
