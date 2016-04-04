package wti.manager.utils;

import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.hibernate.Transaction;

import wti.manager.database.ShopDatabase;

public final class Utils {
	
	public static interface SessionAction {
		void run(Session session);
	}
	
	public static void runInSession(SessionAction sessionAction) throws DatabaseException {
		SessionFactory sessionFactory = ShopDatabase.getSessionFactory();
		try(Session session = sessionFactory.openSession()) {
			Transaction transaction = session.beginTransaction();
			sessionAction.run(session);
			transaction.commit();
		} catch (Exception e) {
			throw new DatabaseException("Nie mo¿na wykonaæ operacji w bazie danych!", e);
		}
	}
	
	public static interface SessionGetter <T> {
		T get(Session session);
	}
	
	public static <T> T getInSession(SessionGetter<T> sessionGetter) throws DatabaseException {
		SessionFactory sessionFactory = ShopDatabase.getSessionFactory();
		try(Session session = sessionFactory.openSession()) {
			T result = sessionGetter.get(session);
			return result;
		} catch (Exception e) {
			throw new DatabaseException("Nie mo¿na pobraæ informacji z bazy danych!", e);
		}
	}
	
}
