<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CPSC Recalls</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <!-- <link rel="stylesheet" href="assets/css/RecallsStyles.css"> -->
    <script src="jquery-3.1.1.min.js"></script>

    <style>
        #wrapper {
            max-width: 991px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn {
            max-width: 991px;
            margin-left: auto;
            margin-right: auto;
        }

        .logo {
            margin: 10px;
        }

        .fab {
            color: white;
        }

        .fab:hover {
            color: #FDB022;
            transition: 0.2s;
        }

        #listurl {
            display: inline-block;
            width: 95%;
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
            vertical-align: bottom;
        }
    </style>

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
        <div class="container-fluid"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
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
                                <p class="mb-4">View listings that are found in violation of existing recalls.</p>
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
                        <label for="url" style="margin-top:10px;">URL: </label>
                        <textarea name="url" id="url" class="form-control"></textarea>
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
                        <input type="submit" name="insert" id="insert" value="Add" class="btn btn-default" style="background: #FDB022; margin-top: 15px;" />
                    </form>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" style="background: #FDB022;" data-bs-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>

    <?php
        $error = false;
        $name = '';
        $url = '';
        $seller = '';
        date_default_timezone_set("America/New_York");
        $timestamp = date('Y-m-d'); 

        if (isset($_POST["insert"])) {
            if (isset($_POST["name"])) $name = $_POST["name"];
            if (isset($_POST["url"])) $url = $_POST["url"];
            if (isset($_POST["seller"])) $seller = $_POST["seller"];
                    
            require_once("db.php");
                    
            if (empty($name) || empty($url) || empty($seller)) {
                $error = true;
            }
                    
            if (!$error) {
                $query = "  INSERT INTO Listings(listingdate, listingURL, productname, userID) 
                            VALUES ('$timestamp', '$url', '$name', '$seller')";
                $result = $mydb->query($query);
                    
                header("HTTP/1.1 307 Temporary Redirect");
                header("Location: Listings.php");
            }
        }
    ?>

    <!-- <script>
        $(document).ready(function() {
            $('#insert_form').on("submit", function(event) {
                event.preventDefault();
                if ($('#name').val()=='') {
                    alert("Product name is required.");
                }
                else if ($('#url').val()=='') {
                    alert("Product URL is required.");
                }
                else if ($('#seller').val()=='') {
                    alert("Associated Seller is required.");
                }
                else {
                    $.ajax({
                        url: "insert.php",
                        method: "POST",
                        data: $('#insert_form').serialize(),
                        beforeSend:function(){
                            $('#insert').val("Inserting");
                        },
                        success:function(data){
                            $('#insert_form')[0].reset();
                            $('#add-data-Modal').modal('hide');
                        }
                    })
                }
            })
        })
    </script> -->

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
                echo "<form method='post' action='Listings.php' class='container' style='margin-bottom: 14px;border-style: solid;border-radius: 7px;border-color: #0E1E45;'>
                    <div class='row'>
                        <div class='col-lg-9' style='text-align: left; padding-top: 6px; padding-bottom: 6px; overflow-wrap: break-word; word-wrap: break-word;'>
                            <input type='hidden' name='listingid' value='".$row['listingID']."'/>
                            <p style='margin-bottom: 0px;'><b>Listing ID: </b>".$row['listingID']."</p>
                            <p style='margin-bottom: 0px;'><b>Listing Date: </b>" .$row['listingdate']. "</p>
                            <p style='margin-bottom: 0px;'><b>Product Name: </b>".$row['productname']."</p>
                            <p style='margin-bottom: 0px;'><b>URL: </b><a id='listurl' href='".$row['listingURL']."' target='_blank' rel='noopener noreferrer'>".$row['listingURL']."</a></p>
                        </div>
                        <div class='col d-lg-flex justify-content-center align-items-lg-center'>
                            <label for='priority'>Priority?
                                <input type='checkbox' id='priority' name='priority' <?php if (".$row['listingpriority']." == 1) echo checked='checked'; ?>
                            </label>
                        </div>
                        <div class='col d-lg-flex justify-content-end align-items-lg-center'>
                            <button class='btn' name='delete' type='submit' style='background: #FDB022'><i class='fas fa-trash'></i></button>
                        </div>
                    </div>
                </form>";
            }
        ?>
    </div>

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