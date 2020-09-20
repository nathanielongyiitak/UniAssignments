
import java.util.*;
import java.io.*;

public class Main {

    public static void main(String[] args) throws IOException {
        BufferedReader br = new BufferedReader(new InputStreamReader(System.in));
        notGit newGit = new notGit();
        String s;

        System.out.println("Enter \"not-git\" to initialise the program:");
        do {
            s = br.readLine();
            if (!"not-git".equals(s)) {
                System.out.println("Please enter the instructed command:");
            } else {
                newGit.check(s);
            }
        } while (!"not-git".equals(s));

        newGit.displayCommands();

        while ((s = br.readLine()) != null) {

            if ("not-git".equals(s)) {
                newGit = new notGit();
            }
            newGit.check(s);
            newGit.displayCommands();
        }
    }
}
