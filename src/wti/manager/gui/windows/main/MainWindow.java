package wti.manager.gui.windows.main;

import org.eclipse.swt.SWT;
import org.eclipse.swt.layout.GridData;
import org.eclipse.swt.layout.GridLayout;
import org.eclipse.swt.widgets.Composite;
import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Shell;
import org.eclipse.swt.widgets.TabFolder;
import org.eclipse.swt.widgets.TabItem;

import wti.manager.gui.images.Images;
import wti.manager.gui.images.Images.IMAGES;
import wti.manager.gui.tabs.products.ProductsComposite;
import wti.manager.gui.tabs.tags.TagsComposite;

public class MainWindow {

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
		TabFolder tabFolder = createTabFolderItself(parent);
		createTabs(tabFolder);
	}

	private TabFolder createTabFolderItself(Composite parent) {
		TabFolder tabFolder = new TabFolder(parent, SWT.NONE);
		tabFolder.setLayoutData(new GridData(SWT.FILL, SWT.FILL, true, true, 1, 1));
		return tabFolder;
	}

	private void createTabs(TabFolder tabFolder) {
		createTabTags(tabFolder);
		createTabProducts(tabFolder);
	}

	private void createTabTags(TabFolder tabFolder) {
		TabItem tbtmTags = new TabItem(tabFolder, SWT.NONE);
		tbtmTags.setText("Tagi");
		TagsComposite tagsComposite = new TagsComposite(tabFolder, SWT.NONE);
		tbtmTags.setControl(tagsComposite);
	}

	private void createTabProducts(TabFolder tabFolder) {
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
