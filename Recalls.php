<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CPSC Recalls</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <!-- <link rel="stylesheet" href="assets/css/RecallsStyles.css"> -->
    <script src="jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="script.js"></script>

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

        /* table {
            margin-top: 30px;
            margin-bottom: 30px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        table thead {
            background-color: lightgray;
        }

        table, tr {
            border: 1px solid;
        } */

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
    </style>

    <script>
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("contentArea").innerHTML="";
                document.getElementById("contentArea").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("contentArea").innerHTML=this.responseText;
                document.getElementById("contentArea").style.border="1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET","utilities2.php?q="+str,true);
            xmlhttp.send();
            }
    </script>
</head>

<body style="height: 650px;text-align: center;background: white;">
    <nav class="navbar navbar-light navbar-expand-md" style="background: #EEEEEE;">
        <div class="container-fluid"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
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

    <!-- ADD BUTTON and MODAL
    <div class='col-lg-10' style="text-align: right; margin-bottom:20px;">
        <button id="addBTN" class="btn" type="button" style="background: #FDB022;"><i class="fas fa-plus-circle"></i></button>
    </div>

    <div id="addModal" class="modal">
        <div class="modal-content animate-top">
            <div class="modal-header">
                <h5 class="modal-title">Add Recall</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="post" id="addFrm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="prodName">Product Name:</label>
                        <input type="text" name="prodName" id="prodName" class="form-control" placeholder="Enter a product name." required="">
                    </div>
                    <div class="form-group">
                        <label for="hazDesc">Hazard Description:</label>
                        <input type="text" name="hazDesc" id="hazDesc" class="form-control" placeholder="Enter a hazard description for the product." required="">
                    </div>
                    <div class="form-group">
                        <label for="url">URL:</label>
                        <input type="text" name="url" id="url" class="form-control" placeholder="Enter the product's URL." required="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn" type="button" style="background: #FDB022; color: black;">Add</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        var addmodal = $('#addModal');
        var editmodal = $('#editModal');
        var addbtn = $("#addBTN");
        var editbtn = $("#editBTN");
        var span = $(".close");
        $(document).ready(function(){
            addbtn.on('click', function() {
                addmodal.show();
            });
            span.on('click', function() {
                addmodal.hide();
                editmodal.hide();
            });
            editbtn.on('click', function() {
                editmodal.show();
            });

        });
        $('body').bind('click', function(e) {
            if($(e.target).hasClass("modal")) {
                addmodal.hide();
                editmodal.hide();
            }
        });
    </script> -->

    <div id="contentArea">
        <?php
            $search = "";
            require_once("db.php");
            if (isset($_POST["BTNsrch"]))  {
                if (isset($_POST["search"])) $search = $_POST["search"];
                $query = "  SELECT * FROM Violations v
                            JOIN Listings l ON
                            v.listingID = l.listingID
                            JOIN Recalls r ON
                            v.recallID = r.recallID
                            WHERE l.productname LIKE '%$search%'";
            } else {
                $query = "  SELECT * FROM Violations v
                            JOIN Listings l ON
                            v.listingID = l.listingID
                            JOIN Recalls r ON
                            v.recallID = r.recallID";
            }
            $result = $mydb->query($query);

            while ($row = mysqli_fetch_array($result)) {
                echo "<form method='post' action='Recalls.php' class='container' style='margin-bottom: 14px;border-style: solid;border-radius: 7px;border-color: #0E1E45;'>
                <div class='row'>
                    <div style='text-align: left; padding-top: 6px; padding-bottom: 6px;'>
                        <p style='margin-bottom: 0px;'><b>Recall ID: </b>".$row['recallID']."</p>
                        <p style='margin-bottom: 0px;'><b>Recall Date: </b>" .$row['recalldate']. "</p>
                        <p style='margin-bottom: 0px;'><b>Product Name: </b>".$row['productname']."</p>
                        <p style='margin-bottom: 0px;'><b>Hazard Description: </b>".$row['hazarddesc']."</p>
                        <p style='margin-bottom: 0px;'><b>Remedy Type: </b>".$row['remedytype']."</p>
                        <p style='margin-bottom: 0px;'><b>Remedy: </b>".$row['remedydesc']."</p>
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