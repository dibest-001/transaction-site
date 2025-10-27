<?php
session_start();
if(!isset($_SESSION['user'])){
    header('Location: login.php');
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <header>
         <img src="./logo.png" width="100" height="100" alt="Mylogo"/>
    <nav>
          <ul>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./dashboard.php">Dashboard</a></li>
            <li><a href="./transfer.php">Transfer</a></li>
            <li><a href="./logout.php">Logout</a></li>
        </ul>
    </nav>
    </header> 
    <main>
        <h1>Welcome to DCH Simple Bank</h1>
        <h1>Account Number</h1>
        <h1><?php echo $user['account_number']?></h1>
        <h1>Account Balance</h1>
        <h1><?php echo number_format ($user['balance'], 2)?></h1>
    </main>
    
    <footer></footer>
</body>
</html>