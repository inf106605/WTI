package wti.manager.utils;

import org.eclipse.swt.widgets.Display;
import org.eclipse.swt.widgets.Shell;

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
	
	public static Shell getShell() {
		Display display = Display.getDefault();
		Shell shell = display.getActiveShell();
		return shell;
	}
	
}
