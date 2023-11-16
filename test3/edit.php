<?php
include_once 'config.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Hier kun je de code plaatsen om de gebruiker bij te werken
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
} else {
    // Laad de gegevens van de gebruiker om te bewerken
    if (isset($_GET['id'])) {
        $user->userid = $_GET['id'];
        $user->readOne(); // Lees de gegevens van de gebruiker met het opgegeven ID
    } else {
        echo "Gebruiker-ID ontbreekt.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bewerk Gebruiker</title>
</head>

<body>
    <h1>Bewerk Gebruiker</h1>
    <form method="POST">
        <!-- Toon de huidige gegevens van de gebruiker om te bewerken -->
        <input type="hidden" name="userid" value="<?php echo $user->userid; ?>">
        Voornaam: <input type="text" name="voornaam" value="<?php echo $user->voornaam; ?>"><br>
        Tussenvoegsel: <input type="text" name="tussenvoegsel" value="<?php echo $user->tussenvoegsel; ?>"><br>
        Achternaam: <input type="text" name="achternaam" value="<?php echo $user->achternaam; ?>"><br>
        Adres: <input type="text" name="adres" value="<?php echo $user->adres; ?>"><br>
        Postcode: <input type="text" name="postcode" value="<?php echo $user->postcode; ?>"><br>
        Telefoon: <input type="text" name="telefoon" value="<?php echo $user->telefoon; ?>"><br>
        <input type="submit" name="update" value="Gebruiker bijwerken">
    </form>
</body>

</html>