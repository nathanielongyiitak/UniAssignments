
import java.util.Random;

public class PkmnBattle {

    Random r = new Random();
    private int dmg;
    private int hp;
    private double dmgMulti;
    private int accuSp1;
    private int accusp2;
    private boolean attack;
    
    public PkmnBattle(){
        
    }

    public boolean speedAccumulator(int sp1, int sp2) {
        while (accuSp1 < 100 && accusp2 < 100) {
            accuSp1 += sp1;
            accusp2 += sp2;
        }
        if (accuSp1 > accusp2) {
            accuSp1 -= 100;

        } else {
            accusp2 -= 100;
            attack = false;
        }
        return attack;
    }

    public boolean missAtk(int skillAcc) {
        if (r.nextInt(101) + 1 > skillAcc) {
            return true;
        } else {
            return false;
        }
    }
    

    public int dmgDealt(int pokeAtk, int skillPow, String skillType, int oppCurrentHp, int oppDef, String oppType) {
        if (skillType == "grass" && oppType == "water") {
            dmgMulti = 2.0;
        } else if (skillType == "grass" && oppType == "fire") {
            dmgMulti = 0.5;
        } else if (skillType == "fire" && oppType == "grass") {
            dmgMulti = 2.0;
        } else if (skillType == "fire" && oppType == "water") {
            dmgMulti = 0.5;
        } else if (skillType == "water" && oppType == "grass") {
            dmgMulti = 2.0;
        } else if (skillType == "water" && oppType == "fire") {
            dmgMulti = 0.5;
        } else {
            dmgMulti = 1.0;
        }
        dmg = (int)((((pokeAtk * skillPow / oppDef) / 20) + 2) * dmgMulti);
        hp = oppCurrentHp - dmg;
        return hp;
    }

}
