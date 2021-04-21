<?php
require_once '../includes/header.php';
?>
<!DOCTYPE html>
<div>
<h1>Search for Information in Table.</h1>
<p>email input is required for Search button otherwise page will reload and will not list data</p>
<form action = "" method="POST">
    Search Client Data: <input type="text" name="email" placeholder="Email Address"><br><br>
    <button type="submit" value="search" name="search">Search</button>
    <button type="submit" name="allwstocks">List All With Stocks</button>
    <button type="submit" name="all">List All</button>
</form>

<?php
//WHEN SEARCH BUTTON IS PRESSED
if (isset($_POST['search'])) {
    require '../includes/database.php';
    $email = $_POST['email'];

    if (empty($email)) {
        // MAKING SURE THEY INPUTTED INFORMATION
        header("Location: read.php?error=emptyfields");
        exit();
    } else {
        $searchsql = "SELECT * FROM client WHERE email_address='$email'";
        $result = mysqli_query($conn, $searchsql);
        $row = mysqli_fetch_assoc($result);
        $clientid = $row["id"];
        if (mysqli_num_rows($result) > 0) {
            //OUTPUT DATA
            echo "ID: " . $row["id"] . "  |  First Name: " . $row["first_name"] . "  |  Last Name: "
            . $row["last_name"] . "  |  Email Address: " . $row["email_address"] . "  |  Account Type: "
            . $row["account_type"] . "  |  Notes: " . $row["extra"] . "<br>";
        } else {
            echo "0 results found.";
        }
        //OUTPUTTING STOCKS ASSOCIATED WITH THE CLIENT
        $searchstocksql = "SELECT * FROM stock WHERE client_id=$clientid";
        $sresult = mysqli_query($conn, $searchstocksql);
        if (mysqli_num_rows($sresult) > 0) {
            while ($srow = mysqli_fetch_assoc($sresult)) {
                echo "ID: " . $srow["stock_id"] . "  |  Client ID: ". $srow["client_id"] . "  |  Ticker: "
                . $srow["ticker"]. "  |  Shares: ". $srow["shares"]. "  |  Purchased Value: "
                . $srow["purchased_value"]. "  |  Purchased Date: "
                . $srow["purchased_date"]. "<br>";
            }
        } else {
            echo "0 Stocks Associated with Client";
        }
    }
}

if (isset($_POST['allwstocks'])) {
    //JOIN STATEMENT
    $joinsql = "SELECT id, email_address, stock_id, ticker 
    FROM client FULL JOIN stock ON id = client_id";
    $jresult = mysqli_query($conn, $joinsql);
    
    echo '<table border = "1">
    <tr>
    <th> Client ID </th>
    <th> Email Address </th>
    <th> Stock ID </th>
    <th> Stock Ticker </th>

    </tr>';

    while ($jrow = mysqli_fetch_array($jresult)) {
        echo '<tr>';
        echo '<td>' . $jrow['id'] . '</td>';
        echo '<td>' . $jrow['email_address'] . '</td>';
        echo '<td>' . $jrow['stock_id'] . '</td>';
        echo '<td>' . $jrow['ticker'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

if (isset($_POST['all'])) {
    //OUTPUTTING ALL DATA
    $acsql = "SELECT * FROM client";
    $assql = "SELECT * FROM stock";
    $acresult = mysqli_query($conn, $acsql);
    $asresult = mysqli_query($conn, $assql);
    //PRINTING CLIENT TABLE
    echo '<table border = "1">
    <tr>
    <th> Client ID </th>
    <th> First Name </th>
    <th> Last Name </th>
    <th> Email Address </th>
    <th> Account Type </th>
    <th> Extra Notes </th>

    </tr>';

    while ($acrow = mysqli_fetch_array($acresult)) {
        echo '<tr>';
        echo '<td>' . $acrow['id'] . '</td>';
        echo '<td>' . $acrow['first_name'] . '</td>';
        echo '<td>' . $acrow['last_name'] . '</td>';
        echo '<td>' . $acrow['email_address'] . '</td>';
        echo '<td>' . $acrow['account_type'] . '</td>';
        echo '<td>' . $acrow['extra'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    //PRINTING STOCK TABLE
    echo "<br>";
    echo '<table border = "1">
    <tr>
    <th> Stock ID </th>
    <th> Client ID </th>
    <th> Ticker Symbol </th>
    <th> Shares </th>
    <th> Purchased Value </th>
    <th> Purchased Date </th>

    </tr>';

    while ($asrow = mysqli_fetch_array($asresult)) {
        echo '<tr>';
        echo '<td>' . $asrow['stock_id'] . '</td>';
        echo '<td>' . $asrow['client_id'] . '</td>';
        echo '<td>' . $asrow['ticker'] . '</td>';
        echo '<td>' . $asrow['shares'] . '</td>';
        echo '<td>' . $asrow['purchased_value'] . '</td>';
        echo '<td>' . $asrow['purchased_date'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}


mysqli_close($conn);
?>

</div>
<?php
require_once '../includes/footer.php';
?>