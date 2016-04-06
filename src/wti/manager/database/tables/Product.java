package wti.manager.database.tables;

import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;

import wti.manager.interfaces.ITableRow;
import wti.manager.utils.Utils;

@Entity
@Table(name = "products")
public class Product implements ITableRow<Product> {

	@Id
	@Column(name = "id_product")
	private int id;
	
	@Column(name = "name_product", nullable = false)
	private String name;
	
	@Column(name = "descriptions", nullable = false)
	private String description;

	
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
	
	public String getDescryption() {
		return description;
	}
	
	public void setDescription(String description) {
		this.description = description;
	}
	
	public static List<Product> getAll(Session session) {
		Criteria criteria = session.createCriteria(Product.class);
		@SuppressWarnings("unchecked")
		List<Product> products = criteria.list();
		return products;
	}
	
	@Override
	public String toString() {
		return "Product["+id+"](\""+name+"\")";
	}
	
	public Product clone() {
		Product product = new Product();
		product.id = id;
		product.name = name;
		product.description = description;
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
