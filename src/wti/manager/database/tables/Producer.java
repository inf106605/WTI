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
@Table(name = "producer")
public class Producer implements INamedTableRow<Producer> {

	@Id
	@Column(name = "id_producer")
	private int id = 0;
	
	@Column(name = "name", nullable = false)
	private String name = "";
	
	@Column(name = "regon", nullable = false)
	private String regon = "";
	
	@Column(name = "nip", nullable = false)
	private String nip = "";
	
	@Column(name = "telephone", nullable = false)
	private String telephone = "";

	
	public Producer() {
	}
	
	public Producer(String name) {
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

	public String getRegon() {
		return regon;
	}

	public void setRegon(String regon) {
		this.regon = regon;
	}

	public String getNip() {
		return nip;
	}

	public void setNip(String nip) {
		this.nip = nip;
	}

	public String getTelephone() {
		return telephone;
	}

	public void setTelephone(String telephone) {
		this.telephone = telephone;
	}
	
	public static List<Producer> getAll(Session session) {
		Criteria criteria = session.createCriteria(Producer.class);
		@SuppressWarnings("unchecked")
		List<Producer> producers = criteria.list();
		return producers;
	}
	
	@Override
	public String toString() {
		return "Producer["+id+"](\""+name+"\")";
	}
	
	public Producer clone() {
		Producer producer = new Producer();
		producer.id = id;
		producer.name = name;
		producer.regon = regon;
		producer.nip = nip;
		producer.telephone = telephone;
		return producer;
	}
	
	@Override
	public boolean equals(Object obj) {
		if (obj == this)
			return true;
		if (!(obj instanceof Producer))
			return false;
		Producer producer = (Producer) obj;
		
		boolean idOk = producer.id == id;
		boolean nameOk = producer.name.equals(name);
		boolean regonOk = producer.regon.equals(regon);
		boolean nipOk = producer.nip.equals(nip);
		boolean telephoneOk = producer.telephone.equals(telephone);
		return Utils.equalsFromBools(idOk, nameOk, regonOk, nipOk, telephoneOk);
	}
	
	@Override
	public int hashCode() {
		int idHash = id;
		int nameHash = name.hashCode();
		int regonHash = regon.hashCode();
		int nipHash = nip.hashCode();
		int telephoneHash = telephone.hashCode();
		return Utils.hashFromInts(idHash, nameHash, regonHash, nipHash, telephoneHash);
	}
	
}
