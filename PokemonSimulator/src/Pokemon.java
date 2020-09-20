
class Player {

    PkmnField field;
    private int cnt = 0;
    private int cnt1 = 0;
    PkmnStat[] pokemonStorage;

    public Player() {
        pokemonStorage = new PkmnStat[12];
    }

    void storePokemon(PkmnStat newPokemon) { //setter
        pokemonStorage[cnt++] = newPokemon;
    }

    PkmnStat getPokemon(int i) { //disp which pokemon
        return pokemonStorage[i];
    }
}

class PkmnStat {//stats for Pokemon

    String attribute;
    String name;
    int attack;
    int defense;
    int hp;
    int speed;
    PkmnSkill[] pokemonSkillStorage;

    public PkmnStat(String name, String attribute, int attack, int defense, int hp, int speed, PkmnSkill[] pokemonSkillStorage) {
        this.name = name;
        this.attribute = attribute;
        this.attack = attack;
        this.defense = defense;
        this.hp = hp;
        this.speed = speed;
        this.pokemonSkillStorage = pokemonSkillStorage;
    }

    public String getName() {
        return name;
    }
}

class PkmnSkill {//stats for Pokemon skill

    String name;
    String attribute;
    int power;
    int skillAcc;

    public PkmnSkill(String name, String attribute, int power, int skillAcc) {
        this.name = name;
        this.attribute = attribute;
        this.power = power;
        this.skillAcc = skillAcc;
    }
}
