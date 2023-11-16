<?php
include_once 'config.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);


if ($stmt->execute()) {
    return true;
} else {
    echo "Fout bij het verwijderen: " . $stmt->errorInfo()[2]; // Toon de foutmelding
    return false;
}


if (isset($_GET['id'])) {
    $user->userid = $_GET['id'];

    if ($user->delete()) {
        echo "Gebruiker is verwijderd.";
    } else {
        echo "Er is een probleem opgetreden bij het verwijderen van de gebruiker.";
    }
} else {
    echo "Gebruiker-ID ontbreekt.";
}
?>
