<!DOCTYPE html>

<?php
    session_start();
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Investigator Landing Page</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/CPSC-Nav.css">
    <script src="jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md" style="background: #EEEEEE;">
        <div class="container-fluid"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="<?php echo $_SERVER['PHP_SELF']; ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="Recalls.php">Recalled Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="Listings.php">Listings</a></li>
                    <li class="nav-item"><a class="nav-link" href="Reports.php">Reports</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" href="SellerLetters.php" id="sell">Seller Letters</a></li> -->
                    <li class="nav-item"><a href="logout.php"><button class="btn" type="button" style="text-align: center;margin-right: 15px; background: #FDB022; color: white; margin-left: 5px;">Log Out</button></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div>
        <section class="py-4 py-xl-5">
            <div class="container h-100">
                <div class="row h-100">
                    <div class="col-md-10 col-xl-8 text-center d-flex d-sm-flex d-md-flex justify-content-center align-items-center mx-auto justify-content-md-start align-items-md-center justify-content-xl-center">
                        <div>
                            <h2 class="text-uppercase fw-bold mb-3">welcome cpsc investigator</h2>
                            <p class="mb-4">Investigators input recalled items into their appropriate tab, they input the necessary information and keep track of these products.</p>
                            <!-- <img src="assets/img/investigator.jpg"> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="row" align=center style="margin:40px;">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="assets/img/investigator.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Recalled Products</h5>
                    <p class="card-text">View a list of all current recalled products.</p>
                    <a href="Recalls.php" class="btn" style="background: #FDB022;">Recalls&nbsp;&nbsp;<i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="assets/img/investigator.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">View Listings</h5>
                    <p class="card-text">View a listed view of all the Seller's listings.</p>
                    <a href="Listings.php" class="btn" style="background: #FDB022;">Listings&nbsp;&nbsp;<i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="assets/img/investigator.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">View Reports</h5>
                    <p class="card-text">View reports regarding each recalled product and their listings.</p>
                    <a href="Reports.php" class="btn" style="background: #FDB022;">Reports&nbsp;&nbsp;<i class="fas fa-chevron-circle-right"></i></a>
                </div>
            </div>
        </div>
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