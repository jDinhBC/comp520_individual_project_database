<?php
require_once '../includes/header.php';
?>

<!DOCTYPE html>
<div>
<h1>Client/Stock Database Entry</h1>
<p>Client Entry</p>
<p>* is required (if not entered page will reload and will not create data)</p>
<form action="" method="POST">
    First Name*: <input type="text" name="f_name" placeholder="First Name"><br>
    Last Name*: <input type="text" name="l_name" placeholder="Last Name"><br>
    Email Address*: <input type="text" name="email_address" placeholder="E-Mail"><br>
    Account Type*: <input type="text" name="acc_type" placeholder="Enter 'Margin' or 'Cash'"><br>
    Extra Notes: <input type="text" name="extra" placeholder="Extra Notes"><br><br>
    <button type="submit" value="client" name="client">SUBMIT</button>
</form>
<p> Be sure to check client id on READ page before adding in stocks!</p>
<p>Stock Entry</p>
<form action="" method="POST">
    Client ID*: <input type="text" name="client_id" placeholder="Client id"><br>
    Ticker Symbol*: <input type="text" name="ticker" placeholder="Ticker Symbol 'AMZN' "><br>
    Shares*: <input type="text" name="shares" placeholder="Amount of Shares"><br>
    Purchased Value*: <input type="text" name="value" placeholder="Value"><br>
    Purchased Date*: <input type="text" name="date" placeholder="Date ex:'05/10/2021' "><br><br>
    <button type="submit" value="stock" name="stock">SUBMIT</button>
</form>
<br>
<br>
</div>

<?php

if (isset($_POST['client']) || isset($_POST['stock'])) {
    //Add database connection
    require '../includes/database.php';
    
    if ( isset($_POST['client'])) {
        //SETTING VARIABLES
        $first_name = $_POST['f_name'];
        $last_name = $_POST['l_name'];
        $email_address = $_POST['email_address'];
        $acc_type = $_POST['acc_type'];
        $extra = $_POST['extra'];
        if ( empty($first_name) || empty($last_name) || empty($email_address) || empty($acc_type)) {
            // MAKING SURE THEY INPUTTED INFORMATION
            header("Location: create.php?error=emptyfields");
            exit();
        } else {
            //SETTING VARIABLES
            $csql = "INSERT INTO client (first_name, last_name, email_address, account_type, extra)
            VALUES ('$first_name', '$last_name', '$email_address', '$acc_type', '$extra')";
            $query = "SELECT id FROM client WHERE email_address='$email_address'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                //IF EMAIL ADDRESS IS ALREADY IN DATABASE
                header("Location: create.php?error=emailaddressalreadyused");
                exit();
            } else {
                //INSERT DATA INTO CLIENT TABLE
                if ($conn->query($csql)=== TRUE) {
                    echo "CLIENT DATA SUCCESSFULLY RECORDED";
                } else {
                    echo "ERROR: " . $csql . "<br>" . $conn->error;
                }
            }
        }
    } elseif (isset($_POST['stock'])) {
        //SETTING VARIABLES
        $client_id = $_POST['client_id'];
        $ticker = $_POST['ticker'];
        $shares = $_POST['shares'];
        $value = $_POST['value'];
        $date = $_POST['date'];
        if (empty($client_id) || empty($ticker) || empty($shares) || empty($value) || empty($date)) {
            //MAKING SURE THEY INPUTTED INFORMATION
            header("Location: create.php?error=emptyfields");
            exit();
        } else {
            //INSERT DATA INTO STOCK TABLE
            $ssql = "INSERT INTO stock (client_id, ticker, shares, purchased_value, purchased_date) 
            VALUES ('$client_id', '$ticker', '$shares', '$value', '$date')";
            if ($conn->query($ssql)=== TRUE) {
                echo "STOCK DATA SUCCESSFULLY RECORDED";
            } else {
                echo "ERROR: " . $ssql . "<br>" . $conn->error;
            }
        }
    }
}
mysqli_close($conn);
?>

<?php
require_once '../includes/footer.php';
?>