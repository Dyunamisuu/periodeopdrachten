<?php
class Product {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getProduct($product_id) {
        if ($this->conn) {
            try {
                $stmt = $this->conn->prepare("SELECT product_name, description, price, image_data FROM products WHERE product_id = :product_id");
                $stmt->bindParam(':product_id', $product_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($result) {
                    echo "<h2>Product Details:</h2>";
                    echo "<p>Product Name: " . $result['product_name'] . "</p>";
                    echo "<p>Description: " . $result['description'] . "</p>";
                    echo "<p>Price: $" . $result['price'] . "</p>";
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($result['image_data']) . '" alt="Product Image" style="max-width: 300px;">';
                } else {
                    echo "Geen product gevonden met dit ID.";
                }
            } catch (PDOException $e) {
                echo "Fout bij het uitvoeren van de query: " . $e->getMessage();
            }
        } else {
            echo "Databaseverbinding is niet geïnitialiseerd.";
        }
    }
}
