<?php
require_once '../includes/header.php';
?>
<!DOCTYPE html>
<div>
<h1>Delete Information in Table.</h1>
<p>Delete Client(Deletes client and all stocks Associated)</p>
<p>Delete Stock(Delete stock associated with client ID)</p>
<p>* is required (if not entered page will reload and will not delete data)</p>
<p>Find Client ID and Stock ID from Read page.
<form action = "" method="POST">
    Client ID*: <input type="text" name="id" placeholder="Client ID"><br>
    Stock ID: <input type="text" name="stock_id" placeholder="Stock ID"><br><br>
    <button type="submit" name="client">Delete Client</button>
    <button type="submit" name="stock">Delete Stock</button>
</form>

<?php
require '../includes/database.php';
$id = "";
$stockid = "";
function deletestocks($cid, $sid, $all) {
    require '../includes/database.php';
    if ($all) {
        //DELETE ALL STOCKS ASSOCIATED WITH CLIENT ID
        $sql = "SELECT stock_id FROM stock WHERE client_id=$cid";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row["stock_id"];
                $dsql = "DELETE FROM stock WHERE stock_id=$id";
                if (mysqli_query($conn, $dsql)) {
                    echo "Stock Record Delete Successfully!<br>";
                } else {
                    echo "ERROR: " . mysqli_error($conn). "<br>";
                }
            }
        }
        //DELETING CLIENT DATA
        $csql = "DELETE FROM client WHERE id=$cid";
        if (mysqli_query($conn, $csql)) {
            echo "Client Record Deleted Successfully!";
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    } else {
        //FINDING SINGULAR STOCK RECORD AND DELETING
        $tsql = "SELECT stock_id FROM stock WHERE stock_id=$sid";
        $tresult = mysqli_query($conn, $tsql);
        $trow = mysqli_fetch_assoc($tresult);
        $tid = $trow["stock_id"];
        $dtsql = "DELETE FROM stock WHERE stock_id=$tid";
        if (mysqli_query($conn, $dtsql)) {
            echo "Stock Record Deleted Successfully!<br>";
        } else {
            echo "ERROR: " . mysqli_error($conn);
        }
    }
    echo "<br>SUCCESS<br>";
}

//set variables if they entered information
if (isset($_POST['client'])) {
    //client button was pressed
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        header("Location: delete.php?error=emptyfields");
        exit();
    }
    deletestocks($id, $stockid, TRUE);
} elseif (isset($_POST['stock'])) {
    //stock button was pressed
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
    } else {
        header("Location: delete.php?error=emptyfields");
        exit();
    }

    if (!empty($_POST['stock_id'])) {
        $stockid = $_POST['stock_id'];
    }
    deletestocks($id, $stockid, FALSE);
}

?>

</div>

<?php
require_once '../includes/footer.php';
?>