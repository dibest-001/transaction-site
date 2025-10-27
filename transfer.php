<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Page</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <header>
         <img src="./logo.png" width="100" height="100" alt="Mylogo"/>
    <nav>
         <ul>
            <li><a href="./index.php">Home</a></li>
            
            <?php
            if(isset($_SESSION['user'])){
                echo '<li><a href="./dashboard.php">Dashboard</a></li>
                     <li><a href="./transfer.php">Transfer</a></li>';
            }else{
                echo '<li><a href="./login.php">Login</a></li>
                     <li><a href="./signup.php">Sign Up</a></li>';
            }
            ?>
        </ul>
    </nav>
    </header> 

    <main>
        <h1>Transfer To Account</h1>
        <form>
            <label>Account Number</label>
            <input type="text"/>
            <button>Transfer</button>
        </form>
    </main>
    
    <footer></footer>
</body>
</html>