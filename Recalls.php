<!DOCTYPE html>
<html lang="en">

<!-- Disable Investigator ability to delete a recall(s). -->
<!-- <?php
    session_start();
    if (isset($_SESSION["role"]) && $_SESSION["role"] == "CPSCInvestigator") {
    ?>
    <style type="text/css">
        .recallDEL{
            display:none;
        }
    </style>
    <?php
    }
?> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CPSC Recalls</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <!-- <link rel="stylesheet" href="assets/css/RecallsStyles.css"> -->
    <link rel="stylesheet" href="styles.css">
    <script src="jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>

    <?php 
        if (isset($_POST["delete"])) {
            if (isset($_POST["recallid"])) {
                require_once("db.php");
                $sql = "DELETE FROM Recalls WHERE recallID = ".$_POST['recallid'];
                $result = $mydb->query($sql);
            }
        }
        $search = "";
    ?>

</head>

<body style="height: 650px;text-align: center;background: white;">
    <nav class="navbar navbar-light navbar-expand-md" style="background: #EEEEEE;">
        <div class="container-fluid"><a href="<?php if (isset($_SESSION["role"])) {if ($_SESSION["role"] == "CPSCManager") {echo "MangHome.php";} if ($_SESSION["role"] == "CPSCInvestigator") {echo "InvestHome.php";}}  ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?php if (isset($_SESSION["role"])) {if ($_SESSION["role"] == "CPSCManager") {echo "MangHome.php";} if ($_SESSION["role"] == "CPSCInvestigator") {echo "InvestHome.php";}}  ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $_SERVER['PHP_SELF']; ?>">Recalled Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="Listings.php">Listings</a></li>
                    <li class="nav-item"><a class="nav-link" href="Reports.php">Reports</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="SellerLetters.php">Seller Letters</a></li> -->
                    <li class="nav-item"><a href="logout.php"><button class="btn" type="button" style="text-align: center;margin-right: 15px; background: #FDB022; color: white; margin-left: 5px;">Log Out</button></a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="wrapper">
        <section class="py-4 py-xl-5">
            <div class="container h-100">
                <div class="text-white border rounded border-0 p-4 py-5" style="background: #0E1E45;">
                    <div class="row h-100">
                        <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                            <div>
                                <h1 class="text-uppercase fw-bold text-white mb-3">Recalled Products</h1>
                                <p class="mb-4">Look through our list of recalled products of the CPSC. Search below to get started.</p>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="search" name="search" placeholder="Search recall product(s)..." style="margin: 0px;width: 300px;" >
                        <button name="BTNsrch" type="submit" style="background: #FDB022; border-style:none; border-radius: 4px; color: white;"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <caption>
        <h2 style="margin-top: 30px; color: #0E1E45;">Recalls</h2>
    </caption>

    <div class="container" style="width: auto;">
        <div align="right" style="margin-bottom: 20px;">
            <button type="button" class="btn" name="add" id="add" data-bs-toggle="modal" data-bs-target="#add_data_Modal" style="background: #FDB022;">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>
    </div>

    <!-- ADD MODAL -->
    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Recall</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="insert_form">
                        <label for="recallnum">Recall Number: </label>
                        <input type="text" name="recallnum" id="recallnum" class="form-control" placeholder="23-080"/>
                        <label for="heading">Recall Heading: </label>
                        <input type="text" name="heading" id="heading" class="form-control" />
                        <label for="desc">Recall Description: </label>
                        <input type="text" name="desc" id="desc" class="form-control" />
                        <label for="hazard">Hazard Description: </label>
                        <input type="text" name="hazard" id="hazard" class="form-control" />
                        <select name="remtype" id="remtype" class="form-control" style="margin-top:10px;">
                            <option value="">Select Remedy Type...</option>
                            <option value="Refund">Refund</option>
                            <option value="Replace">Replace</option>
                            <option value="Repair">Repair</option>
                            <option value="New Instructions">New Instructions</option>
                        </select>
                        <label for="remedy" style="margin-top:10px;">Remedy: </label>
                        <textarea name="remedy" id="remedy" class="form-control"></textarea>
                        <label for="affectedunits">Affected Units: </label>
                        <input type="number" name="affectedunits" id="affectedunits" class="form-control" placeholder="0"/>
                        <input type="submit" name="insert" id="insert" value="Add" class="btn btn-default" style="background: #FDB022; margin-top: 15px;" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        $error = false;
        $recallnum = '';
        $heading = '';
        $desc = '';
        $hazard = '';
        $remtype = '';
        $remedy = '';
        $affunits = '';
        date_default_timezone_set("America/New_York");
        $timestamp = date('Y-m-d'); 

        if (isset($_POST["insert"])) {
            if (isset($_POST["recallnum"])) $recallnum = $_POST["recallnum"];
            if (isset($_POST["heading"])) $heading = $_POST["heading"];
            if (isset($_POST["desc"])) $desc = $_POST["desc"];
            if (isset($_POST["hazard"])) $hazard = $_POST["hazard"];
            if (isset($_POST["remtype"])) $remtype = $_POST["remtype"];
            if (isset($_POST["remedy"])) $remedy = $_POST["remedy"];
            if (isset($_POST["affectedunits"])) $affunits = $_POST["affectedunits"];
                    
            require_once("db.php");
                    
            if (empty($recallnum) || empty($heading) || empty($desc) || empty($hazard) || empty($remtype) || empty($remedy) || empty($affunits)) {
                $error = true;
            }
                    
            if (!$error) {
                $query = "  INSERT INTO Recalls(recallnumber, recalldate, recallheading, recalldesc, hazarddesc, remedytype, remedydesc, affectedunits, userID) 
                            VALUES ('$recallnum', '$timestamp', '$heading', '$desc', '$hazard', '$remtype', '$remedy', $affunits, 1)";
                $result = $mydb->query($query);
                
                header("HTTP/1.1 307 Temporary Redirect");
                header("Location: Recalls.php");
            }
        }
    ?>
    <!-- ADD MODAL -->

    <div id="contentArea">
        <?php
            $search = "";
            require_once("db.php");
            if (isset($_POST["BTNsrch"]))  {
                if (isset($_POST["search"])) $search = $_POST["search"];
                // $query = "  SELECT * FROM Violations v
                //             JOIN Listings l ON
                //             v.listingID = l.listingID
                //             JOIN Recalls r ON
                //             v.recallID = r.recallID
                //             WHERE l.productname LIKE '%$search%'";
                $query = "  SELECT * FROM Recalls
                            WHERE recallheading LIKE '%$search%'";
            } else {
                // $query = "  SELECT * FROM Violations v
                //             JOIN Listings l ON
                //             v.listingID = l.listingID
                //             JOIN Recalls r ON
                //             v.recallID = r.recallID";
                $query = "  SELECT * FROM Recalls";
            }
            $result = $mydb->query($query);

            while ($row = mysqli_fetch_array($result)) {
                echo "<form method='post' action='Recalls.php' class='container'>
                    <div class='list-container'>
                        <div class='re-col'>
                            <div class='recallItem'>
                                <div class='recall-info'>
                                    <input type='hidden' name='recallid' value='".$row['recallID']."'/>
                                    <p style='margin-bottom: 0px;'><b>Recall ID: </b>".$row['recallID']."</p>
                                    <p style='margin-bottom: 0px;'><b>Recall Date: </b>" .$row['recalldate']. "</p>
                                    <p style='margin-bottom: 0px;'><b>Recall Heading: </b>".$row['recallheading']."</p>
                                    <p style='margin-bottom: 0px;'><b>Hazard Description: </b>".$row['hazarddesc']."</p>
                                    <p style='margin-bottom: 0px;'><b>Remedy Type: </b>".$row['remedytype']."</p>
                                    <p style='margin-bottom: 0px;'><b>Remedy: </b>".$row['remedydesc']."</p>
                                    <p style='margin-bottom: 0px;'><b>Affected Units: </b>".$row['affectedunits']."</p>
                                    <div class='recallDEL' align='center'>
                                        <button class='btn' name='delete' type='submit' style='background: #FDB022'><i class='fas fa-trash'></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>";
            }
        ?>
    </div>

    <!-- Temporary location for olf form -->
                <!-- <form method='post' action='Recalls.php' class='container' style='margin-bottom: 14px;border-style: solid;border-radius: 7px;border-color: #0E1E45;'>
                    <div class='row'>
                        <div class='col-lg-11' style='text-align: left; padding-top: 6px; padding-bottom: 6px;'>
                            <input type='hidden' name='recallid' value='".$row['recallID']."'/>
                            <p style='margin-bottom: 0px;'><b>Recall ID: </b>".$row['recallID']."</p>
                            <p style='margin-bottom: 0px;'><b>Recall Date: </b>" .$row['recalldate']. "</p>
                            <p style='margin-bottom: 0px;'><b>Recall Heading: </b>".$row['recallheading']."</p>
                            <p style='margin-bottom: 0px;'><b>Hazard Description: </b>".$row['hazarddesc']."</p>
                            <p style='margin-bottom: 0px;'><b>Remedy Type: </b>".$row['remedytype']."</p>
                            <p style='margin-bottom: 0px;'><b>Remedy: </b>".$row['remedydesc']."</p>
                            <p style='margin-bottom: 0px;'><b>Affected Units: </b>".$row['affectedunits']."</p>
                        </div>
                        <div class='col d-lg-flex justify-content-end align-items-lg-center'>
                            <button class='btn' name='delete' type='submit' style='background: #FDB022'><i class='fas fa-trash'></i></button>
                        </div>
                    </div>
                </form> -->

    <footer class="text-center" style="background: #0E1E45;">
        <div class="container text-muted py-4 py-lg-5">
            <ul class="list-inline text-light">
                <li class="list-inline-item text-light me-4"><a class="link-light" href="https://www.cpsc.gov/About-CPSC" target="_blank" rel="noopener noreferrer">About CPSC</a></li>
                <li class="list-inline-item text-light me-4"><a class="link-light" href="https://www.cpsc.gov/About-CPSC/Contact-Information" target="_blank" rel="noopener noreferrer">Contact Us</a></li>
            </ul>
            <ul class="list-inline">
                <li class="list-inline-item me-4">
                    <a href="https://www.facebook.com/USCPSC/" target="_blank" rel="noopener noreferrer">
                        <i class='fab fa-facebook' style="font-size: 18px;"></i>
                    </a>
                </li>
                <li class="list-inline-item me-4">
                    <a href="https://twitter.com/USCPSC" target="_blank" rel="noopener noreferrer">
                        <i class='fab fa-twitter' style="font-size: 18px;"></i>
                    </a>
                </li>
                <li class="list-inline-item">
                    <a href="https://www.instagram.com/uscpsc/" target="_blank" rel="noopener noreferrer">
                        <i class='fab fa-instagram' style="font-size: 18px;"></i>
                    </a>
                </li>
            </ul>
            <p class="mb-0">Copyright &copy; 2023 CPSC Group 2</p>
        </div>
    </footer>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>