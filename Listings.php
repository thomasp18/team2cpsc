<!DOCTYPE html>
<html lang="en">

<!-- Disable Investigator ability to delete a listing(s). -->
<!-- <?php
    session_start();
    if (isset($_SESSION["role"]) && $_SESSION["role"] == "CPSCInvestigator") {
    ?>
    <style type="text/css">
        #delBTN{
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="assets/css/RecallsStyles.css"> -->
    <link rel="stylesheet" href="styles.css">
    <script src="jquery-3.1.1.min.js"></script>

    <?php 
        if (isset($_POST["delete"])) {
            if (isset($_POST["listingid"])) {
                require_once("db.php");
                $sql = "DELETE FROM Listings WHERE listingID = ".$_POST['listingid'];
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
                    <li class="nav-item"><a class="nav-link" href="Recalls.php">Recalled Products</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $_SERVER['PHP_SELF']; ?>">Listings</a></li>
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
                                <h1 class="text-uppercase fw-bold text-white mb-3">Listed Products</h1>
                                <p class="mb-4">View listings that are under investigation for a potential violation of an existing recall.</p>
                            </div>
                        </div>
                    </div>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <input type="search" name="search" placeholder="Search listing(s)..." style="margin: 0px;width: 300px;" >
                        <button name="BTNsrch" type="submit" style="background: #FDB022; border-style:none; border-radius: 4px; color: white;"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <caption>
        <h2 style="margin-top: 30px; color: #0E1E45;">Listings</h2>
    </caption>

    <div class="container" style="width: auto;">
        <div align="right" style="margin-bottom: 20px;">
            <button type="button" class="btn" name="add" id="add" data-bs-toggle="modal" data-bs-target="#add_data_Modal" style="background: #FDB022;">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>
    </div>

    <div id="add_data_Modal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Listing</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="insert_form">
                        <label for="name">Product Name: </label>
                        <input type="text" name="name" id="name" class="form-control" />
                        <label for="listingurl" style="margin-top:10px;">Listing URL: </label>
                        <textarea name="listingurl" id="listingurl" class="form-control"></textarea>
                        
                        <label for="imgurl">Image URL: </label>
                        <textarea name="imgurl" id="imgurl" class="form-control"></textarea>
                        <?php
                            require_once("db.php");
                            $dropquery = "SELECT userID,useremail FROM Users WHERE usertype = 'Seller'";
                            $dropresult = $mydb->query($dropquery);
                        ?>
                        <select name="seller" id="seller" class="form-control" style="margin-top:10px; margin-bottom:10px;">
                            <option value="">Select Associated Seller by ID...</option>
                            <?php
                                if ($dropresult->num_rows > 0) {
                                    while ($row = $dropresult->fetch_assoc()) {
                                        echo '<option value"'.$row['userID'].'">'.$row['userID'].'</option>';
                                    }
                                } else {
                                    echo '<option value="">Sellers not available.</option>';
                                }
                            ?>
                        </select>
                        <select name="priority" id="priority" class="form-control" style="margin-top:10px; margin-bottom:10px;">
                            <option value="">Prioritize listing? (0 = no, 1 = yes)</option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                        <input type="submit" name="insert" id="insert" value="Add" class="btn btn-default" style="background: #FDB022; margin-top: 15px;" />
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
        $error = false;
        
        $listingurl = '';
        $priority = '';
        $imgurl = '';
        $name = '';
        $recallurl = 'https://www.cpsc.gov/Recalls/';
        $seller = '';
        
        date_default_timezone_set("America/New_York");
        $timestamp = date('Y-m-d'); 

        if (isset($_POST["insert"])) {
            if (isset($_POST["listingurl"])) $listingurl = $_POST["listingurl"];
            if (isset($_POST["priority"])) $priority = $_POST["priority"];
            if (isset($_POST["imgurl"])) $imgurl = $_POST["imgurl"];
            if (isset($_POST["name"])) $name = $_POST["name"];
            if (isset($_POST["seller"])) $seller = $_POST["seller"];
                    
            require_once("db.php");
                    
            if (empty($listingurl) || empty($priority) || empty($imgurl) || empty($name) || empty($seller)) {
                $error = true;
            }
                    
            if (!$error) {
                $query = "  INSERT INTO Listings(listingdate, listingURL, listingpriority, listingimg, productname, recallURL, userID) 
                            VALUES ('$timestamp', '$listingurl', '$priority', '$imgurl', '$name', '$recallurl', '$seller')";
                $result = $mydb->query($query);
                    
                header("HTTP/1.1 307 Temporary Redirect");
                header("Location: Listings.php");
            }
        }
    ?>

    <div id="contentArea">
        <?php
            $search = "";
            require_once("db.php");
            if (isset($_POST["BTNsrch"]))  {
                if (isset($_POST["search"])) $search = $_POST["search"];
                $query = "  SELECT * FROM Listings
                            WHERE productname LIKE '%$search%'";
            } else {
                $query = "  SELECT * FROM Listings ORDER BY listingpriority DESC";
            }
            $result = $mydb->query($query);

            while ($row = mysqli_fetch_array($result)) {
                echo "<form method='post' action='Listings.php' class='container'>
                    <div class='list-container'>
                        <div class='left-col'>
                            <div class='listingItem'>
                                <div class='listing-img'>
                                    <img src='".$row['listingimg']."'>
                                    <a class='btn' style='background: #FDB022' href='".$row['listingURL']."' target='_blank' rel='noopener noreferrer'><i class='bi bi-box-arrow-up-right'></i></a>
                                </div>
                                <div class='listing-info'>
                                    <h3>".$row['productname']."</h3>
                                    <input type='hidden' name='listingid' value='".$row['listingID']."'/>
                                    <p><b>Listing ID: </b>".$row['listingID']."</p>
                                    <p><b>Listing Date: </b>" .$row['listingdate']. "</p>
                                    <button id='delBTN' class='btn' name='delete' type='submit' style='background: #FDB022'><i class='fas fa-trash'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>";
            }
        ?>
    </div>

    <!-- Temporary location for old form -->
                <!-- <form method='post' action='Listings.php' class='container' style='margin-bottom: 14px;border-style: solid;border-radius: 7px;border-color: #0E1E45;'>
                    <div class='row'>
                        <div class='col-lg-11' style='text-align: left; padding-top: 6px; padding-bottom: 6px; overflow-wrap: break-word; word-wrap: break-word;'>
                            <input type='hidden' name='listingid' value='".$row['listingID']."'/>
                            <p style='margin-bottom: 0px;'><b>Listing ID: </b>".$row['listingID']."</p>
                            <p style='margin-bottom: 0px;'><b>Listing Date: </b>" .$row['listingdate']. "</p>
                            <p style='margin-bottom: 0px;'><b>Product Name: </b>".$row['productname']."</p>
                            <p style='margin-bottom: 0px;'><b>URL: </b><a id='listurl' href='".$row['listingURL']."' target='_blank' rel='noopener noreferrer'>".$row['listingURL']."</a></p>
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