<!DOCTYPE html>

<?php
    session_start();
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CPSC Reports</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/CPSC-Nav.css">

    <style>
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
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="background: #EEEEEE;">
        <div class="container-fluid"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Recalls.php">Recalled Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="Listings.php">Listings</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $_SERVER['PHP_SELF']; ?>">Reports</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="SellerLetters.php">Seller Letters</a></li> -->
                    <li class="nav-item"><a href="logout.php"><button class="btn" type="button" style="text-align: center;margin-right: 15px; background: #FDB022; color: white; margin-left: 5px;">Log Out</button></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <section class="py-4 py-xl-5">
            <div class="container h-100" style="margin-bottom: 50px;">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center" style="background: url(&quot;assets/img/bg.jpg&quot;); padding-top: 15px; ">
                        <div>
                            <h2 class="text-uppercase fw-bold text-white mb-3">Reports</h2>
                            <!-- <p class="text-white mb-4">Please select a chart from the drop down below. These generated reports are good visual measures of select recall, seller, or listing information.</p> -->
                            <!-- <div class="dropdown show"><button class="btn dropdown-toggle" aria-expanded="true" data-bs-toggle="dropdown" type="button" style="background: #FDB022; color: black;">Generate Report</button>
                                <div class="dropdown-menu hide" data-bs-popper="none"><a class="dropdown-item" href="#">Pie Chart of Top 10 Products Being Recalled</a><a class="dropdown-item" href="#">Pie Chart to Show Count of Recall Violating by Listing</a><a class="dropdown-item" href="#">Show KPI of Successful Adjudications and if in Goal</a><a class="dropdown-item" href="#">Show Vertical Bar Chart of Average Response Time by Seller</a><a class="dropdown-item" href="#">Show Pie Chart of Average of Given Seller to any CPSC Investigator</a><a class="dropdown-item" href="#">Show Bar Chart of Amount of Recalls Resolved VS Unresolved</a><a class="dropdown-item" href="#">Show KPI of Unresolved Recalls That are Less Than Five</a></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <?php
                    if (isset($_SESSION["role"]) && $_SESSION["role"] == "CPSCManager") {
                        ?>
                        <style type="text/css">
                            #invest{
                                display:none;
                            }
                        </style>
                        <?php
                    }
                    else if (isset($_SESSION["role"]) && $_SESSION["role"] == "CPSCInvestigator") {
                        ?>
                        <style type="text/css">
                            #mang{
                                display:none;
                            }
                        </style>
                        <?php
                    }
                ?>
                <iframe id="mang" title="Report Section" width="1280" height="800" src="https://app.powerbi.com/view?r=eyJrIjoiMmFjYjNiZWEtM2Q2Mi00ZWMwLWI3OGQtOTQ2ZGM4MTY2MjJiIiwidCI6IjYwOTU2ODg0LTEwYWQtNDBmYS04NjNkLTRmMzJjMWUzYTM3YSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>
                <iframe id="invest" title="Sprint3_Investigator_BusinessAnalystV14 (1)" width="1280" height="800" src="https://app.powerbi.com/view?r=eyJrIjoiMWZmZmZmZTEtZGE1MS00YTQxLThlY2ItZWJmNzJiNTEyOWNkIiwidCI6IjYwOTU2ODg0LTEwYWQtNDBmYS04NjNkLTRmMzJjMWUzYTM3YSIsImMiOjF9" frameborder="0" allowFullScreen="true"></iframe>
            </div>
        </section>
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