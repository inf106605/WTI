package wti.manager.utils;

public class DatabaseException extends Exception {
	
	private static final long serialVersionUID = 2646751493280939605L;

	
	public DatabaseException() {
		super();
	}

	public DatabaseException(String message) {
		super(message);
	}

	public DatabaseException(Throwable cause) {
		super(cause);
	}

	public DatabaseException(String message, Throwable cause) {
		super(message, cause);
	}

}
