package wti.manager.inteligenttags;

import static java.lang.System.out;

import java.io.IOException;
import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;

import org.eclipse.swt.SWT;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;

import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;
import wti.manager.gui.dialogs.edittags.EditTagsDialog;
import wti.manager.gui.dialogs.edittags.ProposedTag;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;
import wti.manager.utils.Utils;

public class InteligentTags {

	public static void refreshTags(Product product) {
		String description = product.getReadableDescription();
		List<String> ListOfTags = new ArrayList<String>();
        
		description = description.replaceAll("[,.]", ""); //usuniêcie zbêdnych znaków
		String []wyrazyPrzed = description.split(" ");
	
		ListOfTags = findTags(deleteStopwords(wyrazyPrzed));
	
	//	ListOfTags.
		/*
		//Example code to get all tags
		List<Tag> tags = SessionUtils.runInSession(Tag::getAll);
		*/
		
		//Example code to show tag dialog
		
		List<ProposedTag> proposedTags = new LinkedList<ProposedTag>();
		
		for(String el : ListOfTags)
		{
			proposedTags.add(new ProposedTag(el, null, false));
		}
		//proposedTags.add(new ProposedTag("omg", new Tag(), false));
		//proposedTags.add(new ProposedTag("wow", null, true));
		//proposedTags.add(new ProposedTag("humf", new Tag(), true));
		
		EditTagsDialog editTagsDialog = new EditTagsDialog(Utils.getShell(), SWT.DIALOG_TRIM | SWT.APPLICATION_MODAL, proposedTags);
		if (!editTagsDialog.open())
			return; //Cancel
		
		//OK
		for(ProposedTag item : proposedTags)
		{
			if (item.isSelected() && !item.isExists())
			{
				
				try {
					Tag addTag = createNewTagsFromNames(item.getName());
					product.getTags().add(addTag);
				} catch (DatabaseException e) {
					// TODO Auto-generated catch block
					e.printStackTrace();
				}
			}
		}
	}
	
	private static List<String> deleteStopwords(String[] wordsBefore)
	{
		Document doc = null;
		
		try 
		{
			doc = Jsoup.connect("https://pl.wikipedia.org/wiki/Wikipedia:Stopwords").get();
		} catch (IOException e) 
		{
			e.printStackTrace();
		}
		String stopwords = doc.select("p").get(1).text();
		List<String> wyrazy = new ArrayList<String>();
		for(String wyr : wordsBefore)
		{
			if(!stopwords.contains(wyr.toLowerCase()))
			{
				wyrazy.add(wyr.toLowerCase());
			}
		}
		return wyrazy; 
	}
	
	private static List<String> findTags(List<String> wyrazy)
	{
		Document doc = null;
		List<String> ListOfTags = new ArrayList<String>();
		
		for (String wyr : wyrazy) 
		{
			try 
			{
				doc = Jsoup.connect("http://sjp.pl/" + wyr).get();
			} catch (IOException e) 
				{
				e.printStackTrace();
			}
			
			Elements elems = doc.select("th[colspan]");
			if(!elems.isEmpty()) //jeœli nie ma takiego s³owa
			{
				String elem = elems.first().text();
				//Wiki
				//okreœlenie czêœci mowy wyrazu
				ListOfTags.addAll(findInWiki(elem, wyr));
			}
			else
			{
				ListOfTags.add(wyr);
			}
		}
		
		return ListOfTags;
	}
	
	private static List<String> findInWiki(String elem, String wyr)
	{
		Document doc = null;
		List<String> ListOfTags = new ArrayList<String>();
		
		try 
		{
			doc = Jsoup.connect("https://pl.wiktionary.org/wiki/" + elem).get();
			
			//Elements elem2 = doc.select("body p dfn i");
			Elements elem2 = doc.select("div > p > dfn > i");
			
			String str2 = elem2.text();
			if (str2.contains("rzeczownik"))
			{
				ListOfTags.add(elem);
			}
			
		} catch (IOException e) 
		{
			ListOfTags.add(wyr);
			//e.printStackTrace(); 
		}
		
		return ListOfTags;
	}
	
	private static List<Tag> createNewTagsFromNames(Iterable<String> newTagNames) throws DatabaseException {
		List<Tag> newTags = new LinkedList<Tag>();
		for (String newTagName : newTagNames) {
			Tag newTag = new Tag();
			newTag.setName(newTagName);
			newTags.add(newTag);
		}
		createNewTags(newTags);
		return newTags;
	}
	
	private static Tag createNewTagsFromNames(String newTagName) throws DatabaseException {
		Tag newTag = new Tag();
		newTag.setName(newTagName);
		
		createNewTags(newTag);
		return newTag;
	}
	
	private static void createNewTags(Iterable<Tag> newTags) throws DatabaseException {
		SessionUtils.runInSession((session) -> {
			for (Tag newTag : newTags) {
				session.save(newTag);
			}
		});
	}
	
	private static void createNewTags(Tag newTag) throws DatabaseException {
		SessionUtils.runInSession((session) -> {
				session.save(newTag);
		});
	}
}
