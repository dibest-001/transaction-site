<?php
    session_start();

    if(!isset($_SESSION['user'])){
        header('Location: ./login.php');
        exit;
    }

    $user = $_SESSION['user'];
    $message = '';

    if($_POST){
        $to_account_number = $_POST ['account_number'];
        $amount = $_POST['amount'];

        $get_database_file = file_get_contents('./database.json');
        $database = json_decode($get_database_file, true);

        $is_the_user_found = false;
        foreach($database['users'] as &$reciever){
            if($reciever['account_number'] == $to_account_number){
                $is_the_user_found = true;
                $debited = false;
                if($user['balance'] >= $amount){
                    foreach($database['users'] as &$sender){
                        if($sender['email'] == $user['email']){
                            $sender['balance'] = $sender['balance'] - $amount;
                            $debited = true;
                        }
                    }
                }else{
                    $message = 'Insuffient Funds';
                }
                if($debited == true){
                    $reciever['balance'] = $reciever['balance'] - $amount;
                    $message = 'Transfer successful';
                }
            }
        }
        if($is_the_user_found == false){
            $message = 'No user with that account number';
        }
        $encode_database = json_encode($database);
        file_put_contents('./database.json', $encode_database);

        foreach($database['users'] as $updated_user){
            if($updated_user['email'] == $user['email']){
                $_SESSION['user'] = $updated_user;
            }
        }
    }
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
        <form method="post">
            <label style="text-align: center;"><?php echo $message ?></label>
            <label>Account Number</label>
            <input type="text" name= "account_number"/>
            <label>Amount</label>
            <input type="text" name="amount"/>
            <button>Send</button>
        </form>
    </main>
    
    <footer></footer>
</body>
</html>