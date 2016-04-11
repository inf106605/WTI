package wti.manager.database.tables;

import java.util.HashSet;
import java.util.List;
import java.util.Set;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;

import wti.manager.interfaces.INamedTableRow;
import wti.manager.utils.Utils;

@Entity
@Table(name = "products")
public class Product implements INamedTableRow<Product> {

	@Id
	@Column(name = "id_product")
	private int id;
	
	@Column(name = "name_product", nullable = false)
	private String name = "";
	
	@Column(name = "descriptions", nullable = false)
	private String description = "";
	
	@ManyToMany(fetch = FetchType.EAGER, cascade = CascadeType.ALL)
	@JoinTable(name = "products_has_tag", joinColumns = { 
			@JoinColumn(name = "id_product", nullable = false, updatable = false) }, 
			inverseJoinColumns = { @JoinColumn(name = "id_tag", 
					nullable = false, updatable = false) })
	Set<Tag> tags;
	
	
	public Product() {
	}
	
	public Product(String name) {
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
	
	public String getReadableDescription() {
		String readableDescription = description.replaceAll(" *?<br *?/> *?\\R?", "\r\n");
		return readableDescription;
	}
	
	public void setReadableDescription(String readableDescription) {
		String description = readableDescription.replaceAll("\\R", " <br />\r\n");
		this.description = description;
	}
	
	public Set<Tag> getTags() {
		return tags;
	}
	
	public void setTags(Set<Tag> tags) {
		this.tags = tags;
	}
	
	public static List<Product> getAll(Session session) {
		Criteria criteria = session.createCriteria(Product.class);
		@SuppressWarnings("unchecked")
		List<Product> products = criteria.list();
		return products;
	}
	
	@Override
	public String toString() {
		return "Product["+id+"](\""+name+"\", "+tags.size()+" tags)";
	}
	
	public Product clone() {
		Product product = new Product();
		product.id = id;
		product.name = name;
		product.description = description;
		product.tags = new HashSet<Tag>(tags);
		return product;
	}
	
	@Override
	public boolean equals(Object obj) {
		if (obj == this)
			return true;
		if (!(obj instanceof Product))
			return false;
		Product product = (Product) obj;
		
		boolean idOk = product.id == id;
		boolean nameOk = product.name.equals(name);
		boolean descriptionOk = product.description.equals(description);
		boolean tagsOk = product.tags.equals(tags);
		return Utils.equalsFromBools(idOk, nameOk, descriptionOk, tagsOk);
	}
	
	@Override
	public int hashCode() {
		int idHash = id;
		int nameHash = name.hashCode();
		int descriptionHash = description.hashCode();
		int tagsHash = tags.hashCode();
		return Utils.hashFromInts(idHash, nameHash, descriptionHash, tagsHash);
	}
	
}
