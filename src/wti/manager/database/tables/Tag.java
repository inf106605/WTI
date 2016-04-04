package wti.manager.database.tables;

import java.util.List;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.Id;
import javax.persistence.Table;

import org.hibernate.Criteria;
import org.hibernate.Session;

@Entity
@Table(name = "tag")
public class Tag {

	@Id
	@Column(name = "id_tag")
	private int id;
	
	@Column(name = "name_tag", nullable = false)
	private String name;

	
	Tag() {
	}
	
	public Tag(String name) {
		this.name = name;
	}
	
	public int getId() {
		return id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getName() {
		return name;
	}

	public void setName(String name) {
		this.name = name;
	}
	
	public static List<Tag> getAll(Session session) {
		Criteria criteria = session.createCriteria(Tag.class);
		@SuppressWarnings("unchecked")
		List<Tag> tags = criteria.list();
		return tags;
	}
	
}
