<?php require_once 'components/logout.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
    <style>
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .navigation {
            display: flex;
        }

        .navigation a {
            margin-right: 20px;
            text-decoration: none;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="logo">Webshop Logo</div>
        <div class="navigation">
            <a href="#">Home</a>
            <a href="#">Shop</a>
            <a href="login.php">login</a>
            <a href="register.php">register</a>
        </div>
    </div>
</body>

</html>