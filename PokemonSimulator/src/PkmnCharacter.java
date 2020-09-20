
import java.awt.Graphics2D;
import java.awt.Image;
import java.awt.Rectangle;
import java.awt.event.KeyEvent;
import javax.swing.ImageIcon;

public class PkmnCharacter {

    Image PkmnTrainer;

    PkmnField field;
    int x = 2;
    int xa = 0;
    int y = 2;
    int ya = 0;
    final int DIAMETER = 30;

    PkmnCharacter(PkmnField field) {
        ImageIcon i = new ImageIcon("Untitled.png");
        PkmnTrainer = i.getImage();
        this.field = field;
    }

    Rectangle CharacterMeetsTPoint() {
        return new Rectangle(x, y, DIAMETER, DIAMETER);
    }

    boolean collision1() {
        return field.enemy.TPointsMeetsCharacter1().intersects(CharacterMeetsTPoint());
    }

    boolean collision2() {
        return field.enemy.TPointsMeetsCharacter2().intersects(CharacterMeetsTPoint());
    }

    boolean collision3() {
        return field.enemy.TPointsMeetsCharacter3().intersects(CharacterMeetsTPoint());
    }

    void keyPressed(KeyEvent e) {
        if (e.getKeyCode() == KeyEvent.VK_LEFT) {
            xa = -1;
        }
        if (e.getKeyCode() == KeyEvent.VK_RIGHT) {
            xa = 1;
        }
        if (e.getKeyCode() == KeyEvent.VK_UP) {
            ya = -1;
        }
        if (e.getKeyCode() == KeyEvent.VK_DOWN) {
            ya = 1;
        }
        if (collision1() || collision2() || collision3()) {
            xa = 0;
            ya = 0;
            x = 0;
            y = 0;
            field.BattleMode();
        }
    }

    void keyReleased(KeyEvent e) {
        xa = 0;
        ya = 0;
    }

    void move() {
        if (x + xa > 0 && x + xa < field.getWidth() - 30) {
            x = x + xa;
        }
        if (y + ya > 0 && y + ya < field.getHeight() - 65) {
            y = y + ya;
        }
    }

    void paint(Graphics2D g2d) {
        g2d.drawImage(PkmnTrainer, x, y, DIAMETER, DIAMETER, field);
    }

}
