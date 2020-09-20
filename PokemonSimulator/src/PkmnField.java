
import java.awt.Graphics;
import java.awt.Graphics2D;
import java.awt.RenderingHints;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.InputStream;
import java.util.Random;
import java.util.Scanner;
import javax.swing.JFrame;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import sun.audio.AudioPlayer;
import sun.audio.AudioStream;

public class PkmnField extends JPanel {

    PkmnBackg background = new PkmnBackg(this);
    PkmnCharacter you = new PkmnCharacter(this);
    PkmnTPoints enemy = new PkmnTPoints(this);
    Scanner scan = new Scanner(System.in);
    Random rand = new Random();
    Player p = new Player(); //initiate player
    int pointerA = 0;
    int pointerB = 0;
    int[] teamA = new int[3]; //pokeStore for teamA
    int[] teamB = new int[3]; //pokeStore for teamB
    double dmgMultiplier; //default damage multiplier

    public PkmnField() {
        addKeyListener(new KeyListener() {
            @Override
            public void keyPressed(KeyEvent e) {
                you.keyPressed(e);
            }

            @Override
            public void keyReleased(KeyEvent e) {
                you.keyReleased(e);
            }

            @Override
            public void keyTyped(KeyEvent e) {
            }
        });
        setFocusable(true);
    }

    public void move() {
        you.move();
    }

    public static void playMusic(String filepath) {
        InputStream music;
        try {
            music = new FileInputStream(new File(filepath));
            AudioStream audio = new AudioStream(music);
            AudioPlayer.player.start(audio);
        } catch (Exception e) {
            JOptionPane.showMessageDialog(null, "Error");
        }
    }

    public void paint(Graphics g) {
        super.paint(g);
        Graphics2D g2d = (Graphics2D) g;
        g2d.setRenderingHint(RenderingHints.KEY_ANTIALIASING, RenderingHints.VALUE_ANTIALIAS_ON);
        background.paint(g2d);
        you.paint(g2d);
        enemy.paint(g2d);
    }

    public void BattleMode() {
        try {
            int cnt = 0;
            Scanner scan1 = new Scanner(new FileReader("pokemon.txt"));
            while (scan1.hasNextLine()) {
                PkmnSkill[] newSkill = new PkmnSkill[4];
                //initiate skill and assign skill stats from file input
                PkmnStat newPokemon = new PkmnStat(scan1.nextLine(), scan1.nextLine(), Integer.parseInt(scan1.nextLine()), Integer.parseInt(scan1.nextLine()),
                        Integer.parseInt(scan1.nextLine()), Integer.parseInt(scan1.nextLine()), newSkill); //initiate pokemon
                for (int i = 0; i < newSkill.length; i++) {
                    newSkill[i] = new PkmnSkill(scan1.nextLine(), scan1.nextLine(), Integer.parseInt(scan1.nextLine()), Integer.parseInt(scan1.nextLine()));
                }
                scan1.nextLine();
                p.storePokemon(newPokemon);
            }
        } catch (FileNotFoundException e) {
            System.out.println("File not found");
        }
        System.out.println("Select your pokemon:");
        System.out.print("[0]" + p.getPokemon(0).name);
        System.out.print("\t[1]" + p.getPokemon(1).name);
        System.out.println("\t[2]" + p.getPokemon(2).name);
        System.out.print("[3]" + p.getPokemon(3).name);
        System.out.print("\t[4]" + p.getPokemon(4).name);
        System.out.println("\t[5]" + p.getPokemon(5).name);
        System.out.print("[6]" + p.getPokemon(6).name);
        System.out.print("\t[7]" + p.getPokemon(7).name);
        System.out.println("\t[8]" + p.getPokemon(8).name);
        System.out.print("[9]" + p.getPokemon(9).name);
        System.out.print("\t[10]" + p.getPokemon(10).name);
        System.out.println("\t[11]" + p.getPokemon(11).name);
        int[] pokemonChecker = new int[p.pokemonStorage.length]; //prevents same pokemon to be picked
        int cnt = 0;
        int cnt1 = 0;
        while (cnt < 3) { //you generate team
            System.out.print("Enter ID of pokemon: ");
            int num = scan.nextInt();
            if (pokemonChecker[num] > 0) {
                System.out.println("Pokemon is picked already, pick another one.");
            } else if (num >= 0 && num < p.pokemonStorage.length && pokemonChecker[num] <= 0) {
                teamA[cnt] = num;
                pokemonChecker[num]++;
                cnt++;
            } else {
                System.out.println("Please enter within range!");
            }
        }
        while (cnt1 < 3) { //bot generates team
            int num = rand.nextInt(12);
            if (num >= 0 && num < p.pokemonStorage.length && pokemonChecker[num] <= 0) {
                teamB[cnt1] = num;
                pokemonChecker[num]++;
                cnt1++;
            }
        }
        for (int i = 0; i < 3; i++) { //print your picks
            System.out.println("Team A picked " + p.getPokemon(teamA[i]).name);
        }
        for (int i = 0; i < 3; i++) { //print bot's picks
            System.out.println("Team B picked " + p.getPokemon(teamB[i]).name);
        }
        System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp); //info of your current pokemon on battle
        System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp); //info of bot's current pokemon on battle
        int spA = 0;
        int spB = 0;
        int headCount = 0;
        int round = 1;
        while (true) {
            int elapsedHpA = p.getPokemon(teamA[pointerA]).hp;
            int elapsedHpB = p.getPokemon(teamB[pointerB]).hp;
            System.out.println("Round " + round++);
            while (elapsedHpA == p.getPokemon(teamA[pointerA]).hp || elapsedHpB == p.getPokemon(teamB[pointerB]).hp) {
                while (spA < 100 && spB < 100) {
                    spA += p.getPokemon(teamA[pointerA]).speed;
                    spB += p.getPokemon(teamB[pointerB]).speed;
                }
                headCount = 0; //checks number of pokemon that can still battle
                if (spA >= spB) {
                    attackB();
                    spA -= 100;
                    System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp); //info of your current pokemon on battle
                    System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp); //info of bot's current pokemon on battle
                    if (p.getPokemon(teamB[pointerB]).hp < 0) {
//                        attackA();
//                        spB -= 100;
//                        System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp); //info of your current pokemon on battle
//                        System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp); //info of bot's current pokemon on battle
//                        if (p.getPokemon(teamA[pointerA]).hp < 0) {
//                            System.out.println(p.getPokemon(teamA[pointerA]).name + " is fainted.");
//                            teamA[pointerA] = -1;
//                            //auto change pokemon
//                            for (int i = 0; i < teamA.length; i++) {
//                                if (teamA[i] > 0) {
//                                    headCount++;
//                                    pointerA = i;
//                                    break;
//                                }
//                            }
//                            if (headCount == 0) {
//                                System.out.println("Team A is wiped out. Team B wins!");
//                                System.exit(0);
//                            }
//                            System.out.println(p.getPokemon(teamA[pointerA]).name + " comes to battle.");
//                            System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp);
//                            System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp);
//                        }
//                    } else {
                        System.out.println(p.getPokemon(teamB[pointerB]).name + " is fainted.");
                        pointerB++;
                        if (pointerB >= 3) {
                            System.out.println("Team B is wiped out. Team A wins!");
                            System.exit(0);
                        }
                        System.out.println(p.getPokemon(teamB[pointerB]).name + " comes to battle.");
                        System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp);
                        System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp);
                    }
                } else {
                    attackA();
                    spB -= 100;
                    System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp); //info of your current pokemon on battle
                    System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp); //info of bot's current pokemon on battle
                    if (p.getPokemon(teamA[pointerA]).hp < 0) {
//                        attackB();
//                        spA -= 100;
//                        System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp); //info of your current pokemon on battle
//                        System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp); //info of bot's current pokemon on battle
//                        if (p.getPokemon(teamB[pointerB]).hp < 0) {
//                            System.out.println(p.getPokemon(teamB[pointerB]).name + " is fainted.");
//                            teamA[pointerB] = -1;
//                            //auto change pokemon
//                            pointerB++;
//                            if (pointerB >= 3) {
//                                System.out.println("Team B is wiped out. Team A wins!");
//                                System.exit(0);
//                            }
//                            System.out.println(p.getPokemon(teamB[pointerB]).name + " comes to battle.");
//                            System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp);
//                            System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp);
//                        }
//                    } else {
                        System.out.println(p.getPokemon(teamA[pointerA]).name + " is fainted.");
                        teamA[pointerA] = -1;
                        //auto change pokemon
                        for (int i = 0; i < teamA.length; i++) {
                            if (teamA[i] > 0) {
                                pointerA = i;
                                headCount++;
                                break;
                            }
                        }
                        if (headCount == 0) {
                            System.out.println("Team A is wiped out. Team B wins!");
                            System.exit(0);
                        }
                        System.out.println(p.getPokemon(teamA[pointerA]).name + " comes to battle.");
                        System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp);
                        System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp);
                    }
                }
            }
            scan.nextLine();
            System.out.println("Enter 'Y' to switch pokemon, else enter any key.");
            String ans = scan.nextLine();
//        while (!ans.matches("Y") && !ans.matches("N")) {
//                System.out.println("Please enter only 'Y' or 'N'!");
//                System.out.println("Do you want to switch your pokemon?(Y/N)");
//                ans = scan.nextLine();
//            }
            if (ans.matches("Y")) {
                System.out.println(p.getPokemon(teamA[pointerA]).name + " is switched out.");
                System.out.println("The pokemon(s) left to be switched to is/are: ");
                for (int i = 0; i < teamA.length; i++) {
                    if (teamA[i] > 0 && i != pointerA) {
                        System.out.printf("[%d] %s\t", i, p.getPokemon(teamA[i]).name);
                    }
                }
                System.out.println("");
                System.out.print("Enter ID of pokemon to switch to: ");
                pointerA = scan.nextInt();
                System.out.println("Team A pokemon : " + p.getPokemon(teamA[pointerA]).name + " HP : " + p.getPokemon(teamA[pointerA]).hp);
                System.out.println("Team B pokemon : " + p.getPokemon(teamB[pointerB]).name + " HP : " + p.getPokemon(teamB[pointerB]).hp);
            }

        }
    }

    void attackA() {
        int skillNum = rand.nextInt(4);
        System.out.println(p.getPokemon(teamB[pointerB]).name + " used " + p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].name);
        int randNum = rand.nextInt(101);
        if (randNum > p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].skillAcc) {
            System.out.println("It missed!");
        } else {
            if (p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("grass") && p.getPokemon(teamA[pointerA]).attribute.matches("water")
                    || p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("water") && p.getPokemon(teamA[pointerA]).attribute.matches("fire")
                    || p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("fire") && p.getPokemon(teamA[pointerA]).attribute.matches("grass")) {
                System.out.println("It is super effective!");
                dmgMultiplier = 2;
            } else if (p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("grass") && p.getPokemon(teamA[pointerA]).attribute.matches("fire")
                    || p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("fire") && p.getPokemon(teamA[pointerA]).attribute.matches("water")
                    || p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].attribute.matches("water") && p.getPokemon(teamA[pointerA]).attribute.matches("grass")) {
                System.out.println("It is not effective...");
                dmgMultiplier = 0.5;
            } else {
                System.out.println("Standard damaged dealed.");
                dmgMultiplier = 1;
            }
            p.getPokemon(teamA[pointerA]).hp -= (p.getPokemon(pointerB).attack * p.getPokemon(teamB[pointerB]).pokemonSkillStorage[skillNum].power / p.getPokemon(pointerA).defense / 20 + 2) * dmgMultiplier;
        }
    }

    void attackB() {
        for (int i = 0; i < p.getPokemon(teamA[pointerA]).pokemonSkillStorage.length; i++) {
            System.out.printf("[%d] %s\n", i, p.getPokemon(teamA[pointerA]).pokemonSkillStorage[i].name + " ");
        }
        System.out.print("Which move will " + p.getPokemon(teamA[pointerA]).name + " use? ");
        int skillNum = scan.nextInt();
        while (skillNum >= 4 || skillNum < 0) {
            System.out.println("Please enter within range!");
            System.out.print("Which move will " + p.getPokemon(teamA[pointerA]).name + " use? ");
            skillNum = scan.nextInt();
        }
        System.out.println(p.getPokemon(teamA[pointerA]).name + " is using " + p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].name);
        int randNum = rand.nextInt(101);
        if (randNum > p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].skillAcc) {
            System.out.println("It missed!");
        } else {
            if (p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("grass") && p.getPokemon(teamB[pointerB]).attribute.matches("water")
                    || p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("water") && p.getPokemon(teamB[pointerB]).attribute.matches("fire")
                    || p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("fire") && p.getPokemon(teamB[pointerB]).attribute.matches("grass")) {
                System.out.println("It is super effective!");
                dmgMultiplier = 2;
            } else if (p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("grass") && p.getPokemon(teamB[pointerB]).attribute.matches("fire")
                    || p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("fire") && p.getPokemon(teamB[pointerB]).attribute.matches("water")
                    || p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].attribute.matches("water") && p.getPokemon(teamB[pointerB]).attribute.matches("grass")) {
                System.out.println("It is not effective...");
                dmgMultiplier = 0.5;
            } else {
                System.out.println("Standard damaged dealed.");
                dmgMultiplier = 1;
            }
            p.getPokemon(teamB[pointerB]).hp -= (p.getPokemon(pointerA).attack * p.getPokemon(teamA[pointerA]).pokemonSkillStorage[skillNum].power / p.getPokemon(pointerB).defense / 20 + 2) * dmgMultiplier;
        }
    }

    public static void main(String[] args) throws InterruptedException {
        //window setup
        JFrame frame = new JFrame("Pokemon World Simulator");
        frame.setSize(1000, 1000);
        frame.setResizable(false);
        frame.setLocationRelativeTo(null); //sets window to the mid of screen
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setVisible(true);
        //music
        playMusic("music.wav");
        //initialize map
        PkmnField field = new PkmnField();
        frame.add(field);
        field.setSize(frame.getWidth(), frame.getHeight());
        field.requestFocusInWindow(true);
        while (true) {
            field.move();
            field.repaint();
            Thread.sleep(5);
        }
    }

}
