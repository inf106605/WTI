package wti.manager.database;

import java.net.URL;

import org.hibernate.SessionFactory;
import org.hibernate.cfg.Configuration;

import wti.manager.database.tables.Category;
import wti.manager.database.tables.Producer;
import wti.manager.database.tables.Product;
import wti.manager.database.tables.Tag;

public class ShopDatabase {
	
	private static final String URL_PROPERTY_NAME = "hibernate.connection.url";
	private static final String USERNAME_PROPERTY_NAME = "hibernate.connection.username";
	private static final String PASSWORD_PROPERTY_NAME = "hibernate.connection.password";
	
	private static URL configurationFile = getConfigurationFile();
	private static Configuration configuration = createConfiguration();
	private static String address = "";
	private static String databaseName = "";
	private static SessionFactory sessionFactory;
	private static RuntimeException creatingSessionFactoryException;

	
	public static Configuration createConfiguration() {
		Configuration configuration = new Configuration().configure(configurationFile);
		configuration.addAnnotatedClass(Tag.class);
		configuration.addAnnotatedClass(Category.class);
		configuration.addAnnotatedClass(Producer.class);
		configuration.addAnnotatedClass(Product.class);
		return configuration;
	}
	
	public static void setAddress(String address) {
		if (address == null)
			throw new NullPointerException();
		ShopDatabase.address = address;
		setConnectionString();
	}
	
	public static void setDatabaseName(String databaseName) {
		if (databaseName == null)
			throw new NullPointerException();
		ShopDatabase.databaseName = databaseName;
		setConnectionString();
	}
	
	private static void setConnectionString() {
		String connectionString = generateConnctionString(address, databaseName);
		configuration.setProperty(URL_PROPERTY_NAME, connectionString);
	}
	
	public static void setUsername(String username) {
		if (username == null)
			throw new NullPointerException();
		configuration.setProperty(USERNAME_PROPERTY_NAME, username);
	}
	
	public static void setPassword(String password) {
		if (password == null)
			throw new NullPointerException();
		configuration.setProperty(PASSWORD_PROPERTY_NAME, password);
	}
	
	public static synchronized SessionFactory getSessionFactory() {
		if (sessionFactory == null)
			intelligentlyCreateSessionFactory();
		return sessionFactory;
	}
	
	public static synchronized SessionFactory tryToGetSessionFactory() {
		if (sessionFactory == null)
			createSessionFactory();
		return sessionFactory;
	}
	
	private static void intelligentlyCreateSessionFactory() {
		if (creatingSessionFactoryException == null)
			createSessionFactory();
		else
			throw creatingSessionFactoryException;
	}
	
	private static void createSessionFactory() {
		try {
			sessionFactory = configuration.buildSessionFactory();
		} catch (RuntimeException e) {
			creatingSessionFactoryException = e;
			throw e;
		}
	}
	
	private static URL getConfigurationFile() {
		URL configuretionFile = ShopDatabase.class.getResource("shopDatabase.cfg.xml");
		return configuretionFile;
	}
	
	public static synchronized void close() {
		if (sessionFactory == null)
			return;
		sessionFactory.close();
		sessionFactory = null;
	}
	
	public static String generateConnctionString(String address, String databaseName) {
		String connectionString = "jdbc:mysql://"+address+"/"+databaseName;
		return connectionString;
	}
	
}
