package wti.manager.database.tables;

import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;

@Entity
@Table(name = "products")
public class Product {

	@Id
	@Column(name = "id_product")
	private int id;
	
	@Column(name = "name_product", nullable = false)
	private String name;
	
	@Column(name = "descriptions", nullable = false)
	private String descrition;

	
	Product() {
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
		return descrition;
	}
	
	public void setDescription(String description) {
		this.descrition = description;
	}
	
	public static List<Product> getAll(Session session) {
		Criteria criteria = session.createCriteria(Product.class);
		@SuppressWarnings("unchecked")
		List<Product> products = criteria.list();
		return products;
	}
	
	@Override
	public String toString() {
		return "Product(\""+name+"\")";
	}
	
}
