
import java.awt.Graphics2D;
import java.awt.Image;
import javax.swing.ImageIcon;

public class PkmnBackg {

    PkmnField field;
    Image background;

    PkmnBackg(PkmnField field) {
        ImageIcon i = new ImageIcon("map.png");
        background = i.getImage();
        this.field = field;
    }

    void paint(Graphics2D g2d) {
        g2d.drawImage(background, 0, 0, field.getWidth(), field.getWidth(), field);
    }

}
