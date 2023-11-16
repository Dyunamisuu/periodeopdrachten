<?php
class User {
    private $conn;
    private $table_name = "user";

    public $userid;
    public $voornaam;
    public $tussenvoegsel;
    public $achternaam;
    public $adres;
    public $postcode;
    public $telefoon;

    public function __construct($db){
        $this->conn = $db;
    }

    public function create(){
        $query = "INSERT INTO " . $this->table_name . "
            (voornaam, tussenvoegsel, achternaam, adres, postcode, telefoon)
            VALUES (:voornaam, :tussenvoegsel, :achternaam, :adres, :postcode, :telefoon)";

        $stmt = $this->conn->prepare($query);

        $this->voornaam = htmlspecialchars(strip_tags($this->voornaam));
        $this->tussenvoegsel = htmlspecialchars(strip_tags($this->tussenvoegsel));
        $this->achternaam = htmlspecialchars(strip_tags($this->achternaam));
        $this->adres = htmlspecialchars(strip_tags($this->adres));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));
        $this->telefoon = htmlspecialchars(strip_tags($this->telefoon));

        $stmt->bindParam(":voornaam", $this->voornaam);
        $stmt->bindParam(":tussenvoegsel", $this->tussenvoegsel);
        $stmt->bindParam(":achternaam", $this->achternaam);
        $stmt->bindParam(":adres", $this->adres);
        $stmt->bindParam(":postcode", $this->postcode);
        $stmt->bindParam(":telefoon", $this->telefoon);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function readAll(){
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne(){
        $query = "SELECT * FROM " . $this->table_name . " WHERE userid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->voornaam = $row['voornaam'];
        $this->tussenvoegsel = $row['tussenvoegsel'];
        $this->achternaam = $row['achternaam'];
        $this->adres = $row['adres'];
        $this->postcode = $row['postcode'];
        $this->telefoon = $row['telefoon'];
    }

    public function update(){
        $query = "UPDATE " . $this->table_name . "
            SET voornaam = :voornaam,
                tussenvoegsel = :tussenvoegsel,
                achternaam = :achternaam,
                adres = :adres,
                postcode = :postcode,
                telefoon = :telefoon
            WHERE userid = :userid";

        $stmt = $this->conn->prepare($query);

        $this->voornaam = htmlspecialchars(strip_tags($this->voornaam));
        $this->tussenvoegsel = htmlspecialchars(strip_tags($this->tussenvoegsel));
        $this->achternaam = htmlspecialchars(strip_tags($this->achternaam));
        $this->adres = htmlspecialchars(strip_tags($this->adres));
        $this->postcode = htmlspecialchars(strip_tags($this->postcode));
        $this->telefoon = htmlspecialchars(strip_tags($this->telefoon));
        $this->userid = htmlspecialchars(strip_tags($this->userid));

        $stmt->bindParam(":voornaam", $this->voornaam);
        $stmt->bindParam(":tussenvoegsel", $this->tussenvoegsel);
        $stmt->bindParam(":achternaam", $this->achternaam);
        $stmt->bindParam(":adres", $this->adres);
        $stmt->bindParam(":postcode", $this->postcode);
        $stmt->bindParam(":telefoon", $this->telefoon);
        $stmt->bindParam(":userid", $this->userid);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function delete(){
        $query = "DELETE FROM " . $this->table_name . " WHERE userid = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->userid);

        if($stmt->execute()){
            return true;
        }

        return false;
    }
}
