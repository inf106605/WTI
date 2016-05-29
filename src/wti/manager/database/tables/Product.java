package wti.manager.database.tables;

import java.util.Calendar;
import java.util.HashSet;
import java.util.List;
import java.util.Objects;
import java.util.Set;

import javax.persistence.CascadeType;
import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.Id;
import javax.persistence.JoinColumn;
import javax.persistence.JoinTable;
import javax.persistence.ManyToMany;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;
import org.hibernate.annotations.Fetch;
import org.hibernate.annotations.FetchMode;

import wti.manager.interfaces.INamedTableRow;
import wti.manager.utils.Utils;

@Entity
@Table(name = "products")
public class Product implements INamedTableRow<Product> {

	@Id
	@Column(name = "id_product")
	private int id;

	@ManyToOne(fetch=FetchType.EAGER)
	@JoinColumn(name="id_category", referencedColumnName="id_category")
	private Category category = null;

	@ManyToOne(fetch=FetchType.EAGER)
	@JoinColumn(name="id_producer", referencedColumnName="id_producer")
	private Producer producer = null;
	
	@Column(name = "name_product", nullable = false)
	private String name = "";
	
	@Column(name = "descriptions", nullable = false)
	private String description = "";

	@Column(name = "photography", nullable = true)
	private String photography = null;

	@Column(name = "price_netto", nullable = true)
	private Integer priceNetto = null;

	@Column(name = "price_brutto", nullable = true)
	private Integer priceBrutto = null;

	@Column(name = "percent_vat", nullable = true)
	private Integer percentVat = null;

	@Column(name = "discount", nullable = true)
	private Integer discount = null;

	@Column(name = "amount", nullable = true)
	private Integer amount = null;

	@Column(name = "date_add_products", nullable = true)
	private Calendar dateAdd = null;
	
	@ManyToMany(fetch = FetchType.EAGER, cascade = CascadeType.ALL)
	@Fetch (FetchMode.SELECT)
	@JoinTable(name = "products_has_tag", joinColumns = { 
			@JoinColumn(name = "id_product", nullable = false, updatable = false) }, 
			inverseJoinColumns = { @JoinColumn(name = "id_tag", 
					nullable = false, updatable = false) })
	private Set<Tag> tags = new HashSet<Tag>();
	
	
	public Product() {
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
		String description = readableDescription.replaceAll("\\R", " <br/>\r\n");
		this.description = description;
	}
	
	public Set<Tag> getTags() {
		return tags;
	}
	
	public void setTags(Set<Tag> tags) {
		this.tags = tags;
	}

	public Category getCategory() {
		return category;
	}

	public void setCategory(Category category) {
		this.category = category;
	}

	public Producer getProducer() {
		return producer;
	}

	public void setProducer(Producer producer) {
		this.producer = producer;
	}

	public String getPhotography() {
		return photography;
	}

	public void setPhotography(String photography) {
		this.photography = photography;
	}

	public Integer getPriceNetto() {
		return priceNetto;
	}

	public void setPriceNetto(Integer price_netto) {
		this.priceNetto = price_netto;
	}

	public Integer getPriceBrutto() {
		return priceBrutto;
	}

	public void setPriceBrutto(Integer price_brutto) {
		this.priceBrutto = price_brutto;
	}

	public Integer getPercentVat() {
		return percentVat;
	}

	public void setPercentVat(Integer percent_vat) {
		this.percentVat = percent_vat;
	}

	public Integer getDiscount() {
		return discount;
	}

	public void setDiscount(Integer discount) {
		this.discount = discount;
	}

	public Integer getAmount() {
		return amount;
	}

	public void setAmount(Integer amount) {
		this.amount = amount;
	}

	public Calendar getDateAdd() {
		return dateAdd;
	}

	public void setDateAdd(Calendar date_add_products) {
		this.dateAdd = date_add_products;
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
		product.category = category;
		product.producer = producer;
		product.name = name;
		product.description = description;
		product.photography = photography;
		product.priceNetto = priceNetto;
		product.priceBrutto = priceBrutto;
		product.percentVat = percentVat;
		product.discount = discount;
		product.amount = amount;
		product.dateAdd = dateAdd == null ? null : (Calendar) dateAdd.clone();
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
		boolean categoryOk = (product.category == null ? 0 : product.category.getId()) == (category == null ? 0 : category.getId());
		boolean producerOk = (product.producer == null ? 0 : product.producer.getId()) == (producer == null ? 0 : producer.getId());
		boolean nameOk = product.name.equals(name);
		boolean descriptionOk = product.description.equals(description);
		boolean photographyOk = Objects.equals(product.photography, photography);
		boolean priceNettoOk = Objects.equals(product.priceNetto, priceNetto);
		boolean priceBruttoOk = Objects.equals(product.priceBrutto, priceBrutto);
		boolean percentVatOk = Objects.equals(product.percentVat, percentVat);
		boolean discountOk = Objects.equals(product.discount, discount);
		boolean amountOk = Objects.equals(product.amount, amount);
		boolean dateAddOk = Objects.equals(product.dateAdd, dateAdd);
		boolean tagsOk = product.tags.equals(tags);
		return Utils.equalsFromBools(idOk, categoryOk, producerOk, nameOk, descriptionOk, photographyOk, priceNettoOk, priceBruttoOk, percentVatOk, discountOk, amountOk, dateAddOk, tagsOk);
	}
	
	@Override
	public int hashCode() {
		int idHash = id;
		int categoryHash = category == null ? 0 : category.getId();
		int producerHash = producer == null ? 0 : producer.getId();
		int nameHash = name.hashCode();
		int descriptionHash = description.hashCode();
		int photographyHash = photography == null ? 0 : photography.hashCode();
		int priceNettoHash = priceNetto;
		int priceBruttoHash = priceBrutto;
		int percentVatHash = percentVat;
		int discountHash = discount;
		int amountHash = amount;
		int dateAddHash = dateAdd == null ? 0 : dateAdd.hashCode();
		int tagsHash = tags.hashCode();
		return Utils.hashFromInts(idHash, categoryHash, producerHash, nameHash, descriptionHash, photographyHash, priceNettoHash, priceBruttoHash, percentVatHash, discountHash, amountHash, dateAddHash, tagsHash);
	}
	
}
