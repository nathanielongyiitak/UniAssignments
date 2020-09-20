
import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.Rectangle;
import java.util.Random;
import javax.swing.ImageIcon;

public class PkmnTPoints {

    Image TPoint1, TPoint2, TPoint3;

    PkmnField field;

    Random rand = new Random();

    final int DIAMETER = 20;
    int x1 = rand.nextInt(1000 - DIAMETER);
    int x2 = rand.nextInt(1000 - DIAMETER);
    int x3 = rand.nextInt(1000 - DIAMETER);
    int y1 = rand.nextInt(1000 - DIAMETER);
    int y2 = rand.nextInt(1000 - DIAMETER);
    int y3 = rand.nextInt(1000 - DIAMETER);

    PkmnTPoints(PkmnField field) {
        ImageIcon i = new ImageIcon("TPoint1.png");
        TPoint1 = i.getImage();
        ImageIcon i1 = new ImageIcon("TPoint2.png");
        TPoint2 = i1.getImage();
        ImageIcon i2 = new ImageIcon("TPoint3.png");
        TPoint3 = i2.getImage();
        this.field = field;
    }

    void paint(Graphics2D g2d) {
        g2d.drawImage(TPoint1, x1, y1, DIAMETER, DIAMETER, field);
        g2d.drawImage(TPoint2, x2, y2, DIAMETER, DIAMETER, field);
        g2d.drawImage(TPoint3, x3, y3, DIAMETER, DIAMETER, field);
    }

    Rectangle TPointsMeetsCharacter1() {
        return new Rectangle(x1, y1, DIAMETER, DIAMETER);
    }

    Rectangle TPointsMeetsCharacter2() {
        return new Rectangle(x2, y2, DIAMETER, DIAMETER);
    }

    Rectangle TPointsMeetsCharacter3() {
        return new Rectangle(x3, y3, DIAMETER, DIAMETER);
    }
}
