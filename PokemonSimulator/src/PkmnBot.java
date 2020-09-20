
import java.util.Random;
import java.util.Scanner;

public class PkmnBot {

    Scanner s = new Scanner(System.in);
    Random r = new Random();

    public void choosePokemon() {
        String name;
        int counter = 0;
        int count = 0;
        String[] pokemon = new String[12];
        pokemon[0] = "Bulbasaur";
        pokemon[1] = "Charmander";
        pokemon[2] = "Squirtle";
        pokemon[3] = "Chikorita";
        pokemon[4] = "Cyndaquil";
        pokemon[5] = "Totodile";
        pokemon[6] = "Turtwig";
        pokemon[7] = "Chimchar";
        pokemon[8] = "Piplup";
        pokemon[9] = "Snivy";
        pokemon[10] = "Tepig";
        pokemon[11] = "Oshawott";
        for (int j = 0; j >= 0; j++) {
            System.out.print("Player picked :");
            boolean found = false;
            name = s.next();
            for (int a = 0; a < pokemon.length; a++) {
                if (pokemon[a].equals(name)) {
                    found = true;
                    pokemon[a] = "choosed";
                    count++;
                    continue;
                }
            }
            if (found == false) {
                System.out.println("Pokemon you entered is invalid.Please try again");
                continue;
            }
            if (count == 3) {
                break;
            }
        }
        for (int i = 0; i < pokemon.length; i++) {
            for (int j = 0; j >= 0; j++) {
                int random = (int) (Math.random() * 12);
                pokemon[i] = pokemon[random];
                if (!pokemon[i].equals("choosed")) {
                    System.out.println("Bot picked :" + pokemon[i]);
                    pokemon[i] = "choosed";
                    counter++;
                }
                if (counter == 3) {
                    break;
                }
            }
            if (counter == 3) {
                break;
            }
        }
    }

    public void chooseSkill(int accumulator) {
        String[] skill = new String[4];
        for (int i = 0; i >= 0; i++) {
            if (accumulator >= 100) {
                int random = (int) (Math.random() * 4);
                System.out.println("Bot chooses :" + skill[random]);
                accumulator -= 100;
            }
        }
    }
}
