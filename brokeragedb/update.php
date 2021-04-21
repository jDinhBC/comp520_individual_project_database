<?php
require_once '../includes/header.php';
?>

<!DOCTYPE html>
<div>
    <h1>Update Information in table.</h1>
    <form action = "" method="POST" id="tableselect">
        <p>CLIENT ID AND STOCK ID WILL REMAIN THE SAME</p>
        <p>* is REQUIRED (if not entered page will reload and will not update data)</p>
        CLIENT ID*: <input type="text" name="client_id" placeholder="Client ID"><br>
        STOCK ID*: <input type="text" name="stock_id" placeholder="Stock ID"><br><br>
        <label for="table">Choose Which Table To Update and Insert ALL Data Accordingly:</label>
        <select name="table" id="table" form="tableselect">
            <option value="Client">Client</option>
            <option value="Stock">Stock</option>
        </select><br>
        <p>Client</p>
        First Name: <input type="text" name="first_name" placeholder="First Name"><br>
        Last Name: <input type="text" name="last_name" placeholder="Last Name"><br>
        Email Address: <input type="text" name="email_address" placeholder="Email Address"><br>
        Account Type: <input type="text" name="acc_type" placeholder="Account Type"><br>
        Extra Notes: <input type="text" name="extra" placeholder="Extra Notes"><br>
        <br>
        <p>Stock</p>
        Ticker: <input type="text" name="ticker" placeholder="Ticker Symbol 'AMZN' "><br>
        Shares: <input type="text" name="shares" placeholder="Number of Shares"><br>
        Purchased Value: <input type="text" name="purchased_value" placeholder="Purchased Value"><br>
        Purchased Date: <input type="text" name="purchased_date" placeholder="Date ex:'05/10/2021' "><br><br>
        <button type="submit">Update</button>
    </form>
</div>
<?php
require '../includes/database.php';
if (isset($_POST["table"])) {
    //CHECK IF CLIENT ID WAS PASSED IN
    if (empty($_POST["client_id"]) || empty($_POST["stock_id"])) {
        header("Location: update.php?error=emptyfields");
        exit();
    } else {
        $clientid = $_POST["client_id"];
        $stockid = $_POST["stock_id"];
    }
    //IF SELECTED CLIENT
    if ($_POST["table"] == "Client") {
        //CHECK IF DATA WAS INPUTTED
        if (empty($_POST["first_name"]) || empty($_POST["last_name"])
         || empty($_POST["email_address"]) || empty($_POST["acc_type"])) {
            header("Location: update.php?error=emptyfields");
            exit();
        } else {
            //SET VARIABLES 
            $fname = $_POST["first_name"];
            $lname = $_POST["last_name"];
            $email = $_POST["email_address"];
            $acctype = $_POST["acc_type"];
        }
        //SET EXTRA IF EXISTS
        if (!empty($_POST["extra"])) {
            $extra = $_POST["extra"];
        }
        //UPDATING CLIENT DATA
        $updatesql = "UPDATE client SET first_name = '$fname', last_name = '$lname',
        email_address = '$email', account_type = '$acctype', extra = '$extra'
        WHERE id = '$clientid'";
        if (mysqli_query($conn, $updatesql)) {
            echo "Client Record Updated Successfully!<br>";
        } else {
            echo "<br>ERROR: " . mysqli_error($conn);
        }
    } else {
        //CHECKING IF STOCK DATA WAS INPUTTED
        if (empty($_POST["ticker"]) || empty($_POST["shares"]) 
        || empty($_POST["purchased_value"]) || empty($_POST["purchased_date"])) {
            echo "<br>PLEASE INSERT ALL DATA REQUIRED<br>";
            header("Location: update.php?error=emptyfields");
            exit();
        } else {
            //SETTING VARIABLES
            $stockid = $_POST["stock_id"];
            $ticker = $_POST["ticker"];
            $shares = $_POST["shares"];
            $pvalue = $_POST["purchased_value"];
            $pdate = $_POST["purchased_date"];
        }
        //UPDATING STOCK DATA
        $updatesql = "UPDATE stock SET ticker = '$ticker', shares = '$shares',
        purchased_value = '$pvalue', purchased_date = '$pdate'
        WHERE stock_id = $stockid";
        if (mysqli_query($conn, $updatesql)) {
            echo "Client Record Updated Successfully!<br>";
        } else {
            echo "<br>ERROR: " . mysqli_error($conn);
        }
    }
}
?>

<?php
require_once '../includes/footer.php';
?>