<?php
include_once 'config.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['create'])) {
        $user->voornaam = $_POST['voornaam'];
        $user->tussenvoegsel = $_POST['tussenvoegsel'];
        $user->achternaam = $_POST['achternaam'];
        $user->adres = $_POST['adres'];
        $user->postcode = $_POST['postcode'];
        $user->telefoon = $_POST['telefoon'];

        if ($user->create()) {
            echo "Gebruiker is toegevoegd.";
        } else {
            echo "Er is een probleem opgetreden bij het toevoegen van de gebruiker.";
        }
    }

    if (isset($_POST['update'])) {
        $user->userid = $_POST['userid'];
        $user->voornaam = $_POST['voornaam'];
        $user->tussenvoegsel = $_POST['tussenvoegsel'];
        $user->achternaam = $_POST['achternaam'];
        $user->adres = $_POST['adres'];
        $user->postcode = $_POST['postcode'];
        $user->telefoon = $_POST['telefoon'];

        if ($user->update()) {
            echo "Gebruiker is bijgewerkt.";
        } else {
            echo "Er is een probleem opgetreden bij het bijwerken van de gebruiker.";
        }
    }

    if (isset($_POST['delete'])) {
        $user->userid = $_POST['userid'];

        if ($user->delete()) {
            echo "Gebruiker is verwijderd.";
        } else {
            echo "Er is een probleem opgetreden bij het verwijderen van de gebruiker.";
        }
    }
    $userid = isset($_POST['userid']) ? $_POST['userid'] : null;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gebruikersbeheer</title>
</head>

<body>
    <h1>Gebruikersbeheer</h1>

    <h2>Gebruiker toevoegen</h2>
    <form method="POST">
        Voornaam: <input type="text" name="voornaam"><br>
        Tussenvoegsel: <input type="text" name="tussenvoegsel"><br>
        Achternaam: <input type="text" name="achternaam"><br>
        Adres: <input type="text" name="adres"><br>
        Postcode: <input type="text" name="postcode"><br>
        Telefoon: <input type="text" name="telefoon"><br>
        <input type="submit" name="create" value="Gebruiker toevoegen">
    </form>

    <h2>Gebruikerslijst</h2>
    <table border="1">
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Adres</th>
            <th>Postcode</th>
            <th>Telefoon</th>
            <th>Actie</th>
        </tr>
        <?php
        $stmt = $user->readAll();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            echo "<tr>";
            echo "<td>{$voornaam}</td>";
            echo "<td>{$tussenvoegsel}</td>";
            echo "<td>{$achternaam}</td>";
            echo "<td>{$adres}</td>";
            echo "<td>{$postcode}</td>";
            echo "<td>{$telefoon}</td>";
            echo "<td>";
            echo "<a href='edit.php?id={$userid}'>Bewerken</a> | ";
            echo "<a href='delete.php?id={$userid}'>Verwijderen</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>

</html>