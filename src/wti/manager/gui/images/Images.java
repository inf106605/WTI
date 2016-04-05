package wti.manager.gui.images;

import java.io.IOException;
import java.net.URL;
import java.util.EnumMap;

import org.eclipse.swt.graphics.Image;
import org.eclipse.swt.widgets.Display;

public final class Images {

	public static enum IMAGES {
		ICON ("icon.png");
		
		final String fileName;
		
		private IMAGES(String fileName) {
			this.fileName = fileName;
		}
	}
	
	
	private static EnumMap<IMAGES, Image> cache = new EnumMap<IMAGES, Image>(IMAGES.class);
	
	
	public static synchronized Image getImage(final IMAGES imageId) throws IOException {
		if (cache.containsKey(imageId))
			return cache.get(imageId);
		else {
			URL url = Images.class.getResource(imageId.fileName);
			Image image = new Image(Display.getDefault(), url.openStream());
			cache.put(imageId, image);
			return image;
		}
	}
	
}
