package wti.manager.inteligenttags;

import java.io.IOException;
import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;
import java.util.concurrent.atomic.AtomicBoolean;
import java.util.Set;
import static java.lang.System.*;
import org.eclipse.swt.SWT;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.select.Elements;

import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;
import wti.manager.gui.dialogs.edittags.EditTagsDialog;
import wti.manager.gui.dialogs.edittags.ProposedTag;
import wti.manager.gui.dialogs.progressbar.ProgressBarDialog;
import wti.manager.utils.DatabaseException;
import wti.manager.utils.SessionUtils;
import wti.manager.utils.Utils;

public class InteligentTags {

	public static void refreshTags(Product product) {
		
		ProgressBarDialog<List<String>> progressBarDialog = new ProgressBarDialog<List<String>>(Utils.getShell(), SWT.TITLE | SWT.BORDER | SWT.APPLICATION_MODAL);
		progressBarDialog.setText("Wyszukiwanie tagów");
		progressBarDialog.setDescription("Automatyczne dopasowywanie tagów na podstawie opisu produktu,\nprzy u¿yciu inteligentnego algorytmu.");
		boolean canceled = progressBarDialog.open((AtomicBoolean closing) -> 
		{
			String description = product.getReadableDescription();
			description = description.replaceAll("[,.]", "");
			String []wordsbefore = description.split(" ");
			
			List<String> ListOfTags2 = new ArrayList<String>();
		    
			ListOfTags2 = findTags(deleteStopwords(wordsbefore));
			return ListOfTags2;
		});
		
		if (canceled)
			return;
		
		List<String> ListOfTagsFromDescription = progressBarDialog.getResult(); //return value from progressBar-code
	
		List<ProposedTag> proposedTags = new LinkedList<ProposedTag>();
		Set<Tag> tagFromProductSet = product.getTags();
		List<String> listToDisplay = new ArrayList<>();
		
		for(Tag item : tagFromProductSet) //tag to new list from product 
		{
			listToDisplay.add(item.getName());
			proposedTags.add(new ProposedTag(item.getName(), null, true));
		}
		
		//add only new tag to list
		for(String el : ListOfTagsFromDescription) 
		{
			if(!listToDisplay.contains(el))
			{
				listToDisplay.add(el);
				proposedTags.add(new ProposedTag(el, null, false));
			}
		}
		
		EditTagsDialog editTagsDialog = new EditTagsDialog(Utils.getShell(), SWT.DIALOG_TRIM | SWT.APPLICATION_MODAL, proposedTags);
		if (!editTagsDialog.open())
			return; //Cancel
		
		
		//OK
		for(ProposedTag item : proposedTags)
		{
			if (item.isSelected() && !item.isExists())
			{
					try 
					{
						Tag addTag = createNewTagsFromNames(item.getName());
						product.getTags().add(addTag);
					} catch (DatabaseException e) 
					{	
						e.printStackTrace();
					}
				}
			}
			
	}
	
	
	private static List<String> deleteStopwords(String[] wordsBefore)
	{
		Document doc = null;
		List<String> words = new ArrayList<String>();
		
		try 
		{
			doc = Jsoup.connect("https://pl.wikipedia.org/wiki/Wikipedia:Stopwords").get();
			String stopwords = doc.select("p").get(1).text();
			
			for(String wyr : wordsBefore)
			{
				if(!stopwords.contains(wyr.toLowerCase()))
				{
					words.add(wyr.toLowerCase());
				}
			}
		} catch (IOException e) 
		{
			out.println("InteligenTags error: Wikipedia Stopwords. Return default words from input.");
			//e.printStackTrace();
			List<String> listOut = new ArrayList<String>();
			for(String w : wordsBefore)
				{listOut.add(w);}
			return  listOut;
		}
		
		return words; 
	}
	
	private static List<String> findTags(List<String> words)
	{
		Document doc = null;
		List<String> ListOfTags = new ArrayList<String>();
		
		for (String wordFromDescription : words) 
		{
			try 
			{
				doc = Jsoup.connect("http://sjp.pl/" + wordFromDescription).get();
				Elements elems = doc.select("th[colspan]");
				if(!elems.isEmpty()) //word exist in dictionary and has basic form
				{
					String firstWordFromSJP = elems.first().text();  // get only first result
					//Wiki
					//get part of speech
					ListOfTags.addAll(findInWiki(firstWordFromSJP, wordFromDescription));
				}
				else//if the word isn't exist in dictionary, because contain others type : 26" [it is a tag]
				{
					ListOfTags.add(wordFromDescription);
				}
			} catch (IOException e) 
			{
				out.println("InteligenTags error: SJP. Return default words from input.");
				ListOfTags.addAll(words);
				//e.printStackTrace();
			}
			
			
		}
		
		return ListOfTags;
	}
	
	private static List<String> findInWiki(String firstWordFromSJP, String wordFromDescription)
	{
		Document doc = null;
		List<String> ListOfTags = new ArrayList<String>();
		
		try 
		{
			doc = Jsoup.connect("https://pl.wiktionary.org/wiki/" + firstWordFromSJP).get();
			
			Elements elem2 = doc.select("div > p > dfn > i");
			
			String str2 = elem2.text();
			if (str2.contains("rzeczownik"))
			{
				ListOfTags.add(firstWordFromSJP);
			}
			
		} catch (IOException e) 
		{
			out.println("InteligenTags error: Wikipedia step2. Return default words from input.");
			ListOfTags.add(wordFromDescription);
			//e.printStackTrace(); 
		}
		
		return ListOfTags;
	}
	
	@SuppressWarnings("unused")
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
