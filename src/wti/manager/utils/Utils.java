package wti.manager.utils;

public final class Utils {

	public static boolean equalsFromBools(boolean... bools) {
		for (boolean bool : bools)
			if (!bool)
				return false;
		return true;
	}
	
	public static int hashFromInts(int... ints) {
		final int multiplier = 17;
		int result = 0;
		for (int integer : ints)
		{
			result *= multiplier;
			result += integer;
		}
		return result;
	}
	
}
