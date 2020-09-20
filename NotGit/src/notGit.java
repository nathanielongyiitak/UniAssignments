
import java.util.*;
import java.io.*;
import java.time.*;
import java.time.format.*;

public class notGit {

    static LinkedList fileTracker;

    static {
        fileTracker = new LinkedList(); //stores every tracked files
    }
    File directory;
    File[] listOfFiles;
    LinkedList currentFiles; //stores files for current commit
    LinkedList timeStampCollector; //stores timestamp

    LinkedList statusScanner; //scan the whole directory when status or not-git is issued
    LinkedList commitCollector; //stores list for each commit
    int commitID; //increases per commit

    LinkedList<String> logger; //saves String from sb and timeKeeper
    StringBuilder sb; //saves activities
    LinkedList<String> timeKeeper; //saves time for commit

    LinkedList versionCollector; //saves version of files per commit
    LinkedList currContentCollector; //collects file contents per commit

    public notGit() { //initialization
        directory = new File("Directory");
        currentFiles = new LinkedList();
        timeStampCollector = new LinkedList();

        statusScanner = new LinkedList();
        commitCollector = new LinkedList();
        commitID = 1;

        logger = new LinkedList<>();
        sb = new StringBuilder();
        timeKeeper = new LinkedList<>();

        versionCollector = new LinkedList();
        currContentCollector = new LinkedList();
    }

    void add(File file) {
        boolean check = true;
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            if (n.getName().equals(file.toString())) {
                sb.append("\"added ").append(n.getName()).append("\"\n");
                if (fileTracker.contains(n)) {
                    System.out.printf("\"%s\" is already being tracked\n", n.getName());
                } else {
                    fileTracker.add(n);
                    currentFiles.add(n);
                    timeStampCollector.add(n.lastModified());
                    System.out.printf("\"%s\" is now being tracked\n", n.getName());
                }
                check = false;
                break;
            }
        }
        if (check) {
            System.out.println("File not found.");
        }
    }

    void commit() throws FileNotFoundException {
        listOfFiles = directory.listFiles();
        explore(listOfFiles);
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            try (Scanner input = new Scanner(n)) {
                StringBuilder sb1 = new StringBuilder();
                while (input.hasNextLine()) {
                    sb1.append(input.nextLine()).append(System.getProperty("line.separator"));
                }
                input.close();
                currContentCollector.add(sb1.toString());
            }
        }
        versionCollector.add(currContentCollector.clone());
        currContentCollector.clear();
        DateTimeFormatter dtf = DateTimeFormatter.ofPattern("HH:mm:ss yyyy-MM-dd");
        LocalDateTime now = LocalDateTime.now();
        timeKeeper.add(now.toString());
        if (sb.length() != 0) {
            System.out.println("description: " + sb.toString());
        }
        if (commitID != 1) {
            if (sb.length() != 0) {
                logger.add(sb.toString());
            } else {
                logger.add("No changes.\n");
            }
        }
        sb.delete(0, sb.length());

        Object clone = currentFiles.clone();
        commitCollector.add(clone);
        System.out.println("COMMITTING...");
        for (int j = 0; j < currentFiles.size(); j++) {
            File n = (File) currentFiles.get(j);
            timeStampCollector.remove(j);
            timeStampCollector.add(j, n.lastModified());
            System.out.println("Removed: " + currentFiles.get(j).toString());
        }
        currentFiles.clear();
        System.out.printf("files committed with commit id \"%d\"\n", commitID++);
    }

    void revert(int index) throws FileNotFoundException, IOException {
        listOfFiles = directory.listFiles();
        explore(listOfFiles);
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            try (Scanner input = new Scanner(n)) {
                StringBuilder sb1 = new StringBuilder();
                while (input.hasNextLine()) {
                    sb1.append(input.nextLine()).append(System.getProperty("line.separator"));
                }
                input.close();
                currContentCollector.add(sb1.toString());
            }
        }
        versionCollector.add(currContentCollector.clone());
        currContentCollector.clear();

        LinkedList getControl = (LinkedList) versionCollector.get(index - 1);
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            FileWriter output = new FileWriter(n);
            output.write((String) getControl.get(i));
            output.close();
        }

        DateTimeFormatter dtf = DateTimeFormatter.ofPattern("HH:mm:ss yyyy-MM-dd");
        LocalDateTime now = LocalDateTime.now();
        timeKeeper.add(now.toString());
        if (sb.length() != 0) {
            System.out.println("description: " + sb.toString());
        }
        if (commitID != 1) {
            if (sb.length() != 0) {
                logger.add(sb.toString());
            } else {
                logger.add("No changes.\n");
            }
        }
        sb.delete(0, sb.length());

        Object clone = currentFiles.clone();
        commitCollector.add(clone);
        System.out.println("COMMITTING...");
        for (int j = 0; j < currentFiles.size(); j++) {
            System.out.println("Removed: " + currentFiles.get(j).toString());
        }
        currentFiles.clear();
        LinkedList idk = (LinkedList) (commitCollector.get(index - 1));
        System.out.println("REVRETING...");
        for (int j = 0; j < idk.size(); j++) {
            currentFiles.add(idk.get(j));
            System.out.println("Added: " + idk.get(j).toString());
        }
        System.out.printf("revert to commit-id \"%d\" and committed with commit-id \"%d\"\n", index, commitID++);
    }

    void explore(File[] listOfFiles) {
        for (File listOfFile : listOfFiles) {
            if (listOfFile.isFile() && !statusScanner.contains(listOfFile)) {
                statusScanner.add(listOfFile);
            }
            if (listOfFile.isDirectory()) {
                explore(listOfFile.listFiles());
            }
        }
    }

    void status() {
        listOfFiles = directory.listFiles();
        explore(listOfFiles);
        System.out.println("new files: ");
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            for (int j = 0; j < currentFiles.size(); j++) {
                File m = (File) currentFiles.get(j);
                if (m.getName().equals(n.getName()) && timeStampCollector.contains(m.lastModified())) {
                    System.out.printf("\t%s\n", n.getName());
                }
            }
        }
        System.out.println("modified files: ");
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            for (int j = 0; j < fileTracker.size(); j++) {
                File m = (File) fileTracker.get(j);
                if (m.getName().equals(n.getName())
                        && !timeStampCollector.contains(m.lastModified())) {
                    sb.append("\"edited ").append(n.getName()).append("\"\n");
                    System.out.printf("\t%s\n", n.getName());
                }
            }
        }
        System.out.println("tracked files: ");
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            for (int j = 0; j < fileTracker.size(); j++) {
                File checker = (File) fileTracker.get(j);
                if (n.getName().equals(checker.getName())) {
                    System.out.printf("\t%s\n", n.getName());
                }
            }
        }
        System.out.println("untracked files: ");
        for (int i = 0; i < statusScanner.size(); i++) {
            File n = (File) statusScanner.get(i);
            boolean check = true;
            for (int j = 0; j < fileTracker.size(); j++) {
                File checker = (File) fileTracker.get(j);
                if (n.getName().equals(checker.getName())) {
                    check = false;
                }
            }
            if (check) {
                System.out.printf("\t%s\n", n.getName());
            }
        }
    }

    void log() {
        int cntr = 0;
        for (int i = 1; i <= timeKeeper.size(); i++) {
            System.out.printf("commit \"%d\" - %s\n", i, timeKeeper.get(i - 1));
            if (i == 1) {
                System.out.println("\"initial commit\"");
            } else {
                System.out.print(logger.get(cntr++));
            }
        }
    }

    void displayCommands() {
        System.out.println("Commands available:");
        System.out.println("1. not-git  -  Run the program at the repository folder.");
        System.out.println("2. add \"file_name\" (e.g. add \"file_to_be_added.txt\")  -  Add files to-be-tracked to start tracking the files.");
        System.out.println("3. commit  -  Create a version history of the current state of the working directory.");
        System.out.println("4. revert commit_id (e.g. revert 1)  -  Revert to a previous version.");
        System.out.println("5. commit-id \"commit_id\" (e.g. commit-id \"3\")  -  Perform same function as revert.");
        System.out.println("6. status  -  Scan and classify files.");
        System.out.println("7. log  -  Output the list of commits, along with the respective commit-id, timestamp\n"
                + "and description.");
        System.out.println("");
    }

    void check(String s) throws IOException {
        if ("not-git".equals(s)) {
            System.out.println("Welcome to not-git!");
            listOfFiles = directory.listFiles();
            explore(listOfFiles);
            System.out.println("tracked files: ");
            for (int i = 0; i < statusScanner.size(); i++) {
                File n = (File) statusScanner.get(i);
                for (int j = 0; j < fileTracker.size(); j++) {
                    File checker = (File) fileTracker.get(j);
                    if (n.getName().equals(checker.getName())) {
                        System.out.printf("\t%s\n", n.getName());
                    }
                }
            }
            System.out.println("untracked files: ");
            for (int i = 0; i < statusScanner.size(); i++) {
                File n = (File) statusScanner.get(i);
                boolean check = true;
                for (int j = 0; j < fileTracker.size(); j++) {
                    File checker = (File) fileTracker.get(j);
                    if (n.getName().equals(checker.getName())) {
                        check = false;
                    }
                }
                if (check) {
                    System.out.printf("\t%s\n", n.getName());
                }
            }
        } else if ("status".equals(s)) {
            status();
        } else if (s.startsWith("add") && s.charAt(4) == '\"' && s.endsWith("\"")) {
            String[] arr = s.split("\"");
            File newF = new File(arr[1]);
            add(newF);
        } else if ("commit".equals(s)) {
            commit();
        } else if ((s.length() > 7 && s.startsWith("revert") && Character.isDigit(s.charAt(7)))
                || (s.length() > 12 && s.startsWith("commit-id") && s.charAt(10) == '\"' && s.endsWith("\""))) {
            String[] arr;
            if (s.startsWith("revert")) {
                arr = s.split(" ");
            } else {
                arr = s.split("\"");
            }
            revert(Integer.parseInt(arr[1]));
        } else if ("log".equals(s)) {
            log();
        } else {
            System.out.println("Please enter the correct command: ");
        }
        System.out.println("");
    }
}
