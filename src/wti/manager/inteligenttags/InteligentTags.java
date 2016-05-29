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

	static AtomicBoolean cancel;
	
	public static void refreshTags(Product product) {
		
		ProgressBarDialog<List<String>> progressBarDialog = new ProgressBarDialog<List<String>>(Utils.getShell(), SWT.TITLE | SWT.BORDER | SWT.APPLICATION_MODAL);
		progressBarDialog.setText("Wyszukiwanie tagów");
		progressBarDialog.setDescription("Automatyczne dopasowywanie tagów na podstawie opisu produktu,\nprzy u¿yciu inteligentnego algorytmu.");
		boolean canceled = progressBarDialog.open((AtomicBoolean closing) -> 
		{
			cancel = closing; 
			String description = product.getReadableDescription();
			description = description.replaceAll("[,.();:]", "");
			description = description.toLowerCase();
			String []wordsbefore = description.split("[ \n]"); 
			List<String> listWithoutShortWords = new ArrayList<String>();
			List<String> ListOfTags2 = new ArrayList<String>();
			
		    for(String wordToCheck : wordsbefore)
		    {
		    	if(wordToCheck.length()>2)
		    	{
		    		listWithoutShortWords.add(wordToCheck);
		    	}
		    }
			
			ListOfTags2 = findTags(deleteStopwords(wordsbefore));
			return ListOfTags2;
		});
		
		if (canceled)
			return;
		List<String> ListOfTagsFromDescription = progressBarDialog.getResult(); //return value from progressBar-code
		if(ListOfTagsFromDescription.isEmpty()) //if canceled inside progressBar code
			return;
		
		String name = product.getName(); //get words from product name
		name = name.toLowerCase();
		String[]TagFromName = name.split(" ");
		for(String record : TagFromName)//add all words from product name
		{
			if(!ListOfTagsFromDescription.contains(record))
			{
				ListOfTagsFromDescription.add(record);
			}	
		}
		
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
			
	}//end refresh tags
	
	
	private static List<String> deleteStopwords(String[] wordsBefore)
	{
		Document doc = null;
		List<String> words = new ArrayList<String>();
		
		try 
		{
			doc = Jsoup.connect("https://pl.wikipedia.org/wiki/Wikipedia:Stopwords").get();
		} catch (IOException e) 
		{//site is not available
			out.println("InteligentTags error: Error with open wikipedia Stopwords. Return default words from input.");
			//e.printStackTrace();
			List<String> listOut = new ArrayList<String>();
			for(String w : wordsBefore)
				{
				if (cancel.get())
					return null;
				
				listOut.add(w);
				}
			return  listOut;
		}
		
		String stopwords = doc.select("p").get(1).text(); 
		for(String wyr : wordsBefore)
		{
			if (cancel.get())
				return null;
			
			if(!stopwords.contains(wyr.toLowerCase()))
				words.add(wyr.toLowerCase()); //return word, when it isn't stopword 
		}
		return words; 
	}
	
	private static List<String> findTags(List<String> words)
	{
		Document doc = null;
		List<String> ListOfTags = new ArrayList<String>();
		
		for (String wordFromDescription : words) 
		{
			if (cancel.get())
				return null;
			
			try 
			{
				doc = Jsoup.connect("http://sjp.pl/" + wordFromDescription).get();
				Elements elems = doc.select("th[colspan]");
				if(!elems.isEmpty()) //word exist in dictionary and has basic form
				{
					String firstWordFromSJP = elems.first().text();  // get only first result
					if(firstWordFromSJP.length()>2) //add word >2 character
					{
						//Wiki
						//get part of speech
						ListOfTags.addAll(findInWiki(firstWordFromSJP, wordFromDescription));
					}
				}
				else//if the word isn't exist in dictionary, e.g. because contain others type : 26" [it is a tag] OR was problem with site
				{
					if(wordFromDescription.length()>2) //>2 character
						ListOfTags.add(wordFromDescription);
				}
			} catch (IOException e) 
			{
				//out.println("InteligentTags error: SJP. Return default words from input: "+wordFromDescription);
				//ListOfTags.addAll(words);
				ListOfTags.add(wordFromDescription);
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
			//out.println("InteligentTags error: Wikipedia step2. Return default words from input: "+wordFromDescription);
			//ListOfTags.add(wordFromDescription);
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
		
		newTag = createNewTags(newTag);
		return newTag;
	}
	
	private static List<Tag> createNewTags(Iterable<Tag> newTags) throws DatabaseException {
		final List<Tag> result = new LinkedList<Tag>();
		SessionUtils.runInSession((session) -> {
			for (Tag newTag : newTags) {
				session.save(newTag);
				Tag createdTag = Tag.getByName(session, newTag.getName());
				result.add(createdTag);
			}
		});
		return result;
	}
	
	private static Tag createNewTags(Tag newTag) throws DatabaseException {
		SessionUtils.runInSession((session) -> {
				session.save(newTag);
			});
		Tag result = SessionUtils.getInSession((session) -> {
				Tag createdTag = Tag.getByName(session, newTag.getName());
				return createdTag;
			});
		return result;
	}
}
