<?php
    $search = "";

    require_once("db.php");

    if (isset($_GET["search"])) $search = $GET["search"];

    if ($search == "") {
        $sql = "SELECT * FROM Violations v
                JOIN Listings l ON
                v.listingID = l.listingID
                JOIN Recalls r ON
                v.recallID = r.recallID";
    }
    else {
        $sql = "SELECT * FROM Violations v
                JOIN Listings l ON
                v.listingID = l.listingID
                JOIN Recalls r ON
                v.recallID = r.recallID
                WHERE l.productname LIKE '%$search%'";
    }

    $result = $mydb->query($sql);

    while ($row = mysqli_fetch_array($result)) {
        echo "<form method='post' action='Recalls.php' class='container' style='margin-bottom: 14px;border-style: solid;border-radius: 7px;border-color: #0E1E45;'>
        <div class='row'>
            <div class='col-lg-10' style='text-align: left; padding-top: 6px; padding-bottom: 6px;'>
                <p style='margin-bottom: 0px;'><b>Recall ID: </b>".$row['recallID']."</p>
                <p style='margin-bottom: 0px;'><b>Recall Date: </b>" .$row['recalldate']. "</p>
                <p style='margin-bottom: 0px;'><b>Product Name: </b>".$row['productname']."</p>
                <p style='margin-bottom: 0px;'><b>Hazard Description: </b>".$row['hazarddesc']."</p>
                <p style='margin-bottom: 0px;'><b>Remedy Type: </b>".$row['remedytype']."</p>
                <p style='margin-bottom: 0px;'><b>Remedy: </b>".$row['remedydesc']."</p>
            </div>
            <div class='col d-lg-flex justify-content-end align-items-lg-center'>
                <button class='btn' name='delete' type='submit' style='background: #FDB022'><i class='fas fa-trash'></i></button>
            </div>
        </div>
        </form>";
    }
?>