<?php
require_once __DIR__ . '/../database/database_conn.php';

class User
{
    private $database;

    public function __construct()
    {
        $this->database = new Database(); 
    }

    public function registerUser($username, $email, $password)
    {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $connection = $this->database->getConnection(); // Retrieve the database connection here
            $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");

            if (!$stmt) {
                $errorInfo = $connection->errorInfo(); // errors
                throw new Exception("Error: " . $errorInfo[2]);
            }

            $stmt->bindParam(1, $username, PDO::PARAM_STR);
            $stmt->bindParam(2, $email, PDO::PARAM_STR);
            $stmt->bindParam(3, $hashedPassword, PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                $errorInfo = $stmt->errorInfo(); // Correct way to handle errors
                throw new Exception("Error: " . $errorInfo[2]);
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
            return false;
        }
    }


    public function loginUser($email, $password)
    {
        try {
            $connection = $this->database->getConnection(); // Connect to the database
            $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");

            if (!$stmt) {
                $errorInfo = $connection->errorInfo(); // Get the error information as an array
                throw new Exception("Error: " . $errorInfo[2]); // Throw an exception with the specific error message
            }

            $stmt->bindParam(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetchAll(); // Fetch all rows

            if (count($result) == 1) {
                $user = $result[0];
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    return true;
                } else {
                    return false; // Invalid password combination
                }
            } else {
                return false; // User not found
            }
        } catch (Exception $e) {
            // Handle the exception appropriately or log it for debugging
            return false;
        }
    }

    public function isLoggedIn()
{
    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    } catch (Exception $e) {
        return false;
    }
}

public function getUsername()
{
    try {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['username']) ? $_SESSION['username'] : '';
    } catch (Exception $e) {
        return '';
    }
}
}
