package wti.manager.inteligenttags;

import java.util.LinkedList;
import java.util.List;

import org.eclipse.swt.SWT;

import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;
import wti.manager.gui.dialogs.edittags.EditTagsDialog;
import wti.manager.gui.dialogs.edittags.ProposedTag;
import wti.manager.utils.SessionUtils;
import wti.manager.utils.Utils;

public class InteligentTags {

	public static void refreshTags(Product product) {
		//TODO
		
		/*
		//Example code to get all tags
		List<Tag> tags = SessionUtils.runInSession(Tag::getAll);
		*/
		
		/*
		//Example code to show tag dialog
		List<ProposedTag> proposedTags = new LinkedList<ProposedTag>();
		proposedTags.add(new ProposedTag("lol", null, false));
		proposedTags.add(new ProposedTag("omg", new Tag(), false));
		proposedTags.add(new ProposedTag("wow", null, true));
		proposedTags.add(new ProposedTag("humf", new Tag(), true));
		EditTagsDialog editTagsDialog = new EditTagsDialog(Utils.getShell(), SWT.DIALOG_TRIM | SWT.APPLICATION_MODAL, proposedTags);
		if (editTagsDialog.open())
			; //OK
		else
			; //Cancel
		*/
	}
	
}
