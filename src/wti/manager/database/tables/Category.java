package wti.manager.database.tables;

import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;

import wti.manager.interfaces.INamedTableRow;
import wti.manager.utils.Utils;

@Entity
@Table(name = "category")
public class Category implements INamedTableRow<Category> {

	@Id
	@Column(name = "id_category")
	private int id = 0;
	
	@Column(name = "name", nullable = false)
	private String name = "";
	
	@Column(name = "descriptions", nullable = false)
	private String description = "";

	
	public Category() {
	}
	
	public Category(String name) {
		this.name = name;
	}
	
	public int getId() {
		return id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}

	public String getDescription() {
		return description;
	}

	public void setDescription(String description) {
		this.description = description;
	}
	
	public static List<Category> getAll(Session session) {
		Criteria criteria = session.createCriteria(Category.class);
		@SuppressWarnings("unchecked")
		List<Category> categories = criteria.list();
		return categories;
	}
	
	@Override
	public String toString() {
		return "Categories["+id+"](\""+name+"\")";
	}
	
	public Category clone() {
		Category category = new Category();
		category.id = id;
		category.name = name;
		category.description = description;
		return category;
	}
	
	@Override
	public boolean equals(Object obj) {
		if (obj == this)
			return true;
		if (!(obj instanceof Category))
			return false;
		Category category = (Category) obj;
		
		boolean idOk = category.id == id;
		boolean nameOk = category.name.equals(name);
		boolean descriptionOk = category.description.equals(description);
		return Utils.equalsFromBools(idOk, nameOk, descriptionOk);
	}
	
	@Override
	public int hashCode() {
		int idHash = id;
		int nameHash = name.hashCode();
		int descriptionHash = description.hashCode();
		return Utils.hashFromInts(idHash, nameHash, descriptionHash);
	}
	
}
