<!DOCTYPE html>

<?php
    session_start();

    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
        if (isset($_SESSION["role"])) {
            if ($_SESSION["role"] == "CPSCManager") {
                Header("Location: MangHome.php");
                exit;
            }
            else if ($_SESSION["role"] == "CPSCInvestigator") {
                Header("Location: InvestHome.php");
                exit;
            }
        }
    }
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>CPSC Login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Basic-icons.css">
    <!-- <link rel="stylesheet" href="assets/css/LoginStyles.css"> -->

    <style>
        .error {
            color: red;
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

        footer {
            margin-top: 11px;
        }
    </style>
</head>

<body>
    <?php
        $error = false;
        $email = "";
        $password = "";
        $MSGerr = "<span class='errlabel'>Invalid email or password.</span>";

        date_default_timezone_set("America/New_York");
        $timestamp = date('Y-m-d H:i:s');

        if (isset($_POST["BTNlogin"])) {
            if (isset($_POST["loginEmail"])) $email = $_POST["loginEmail"];
            if (isset($_POST["loginPassword"])) $password = $_POST["loginPassword"];

            require_once("db.php");
            $sql = "SELECT * FROM Users WHERE useremail = '$email'";
            $result = $mydb->query($sql);

            $row=mysqli_fetch_array($result);

            if ($row) {
                if (strcmp($password, $row["password"]) == 0) {
                    $error = false;
                }
                else {
                    $error = true;
                }
            }

            if (empty($email) || empty($password)) {
                $error = true;
            }

            if (!$error) {
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $row["usertype"];

                if (isset($row["usertype"]) && $row["usertype"] != null) {
                    $type = $row["usertype"];
                    if ($type=="CPSCManager") {
                        header("HTTP/1.1 307 Temporary Redirect");
                        header("Location: MangHome.php");
                    } else if ($type=="CPSCInvestigator") {
                        header("HTTP/1.1 307 Temporary Redirect");
                        header("Location: InvestHome.php");
                    } else if ($type=="Seller"){
                        header("HTTP/1.1 307 Temporary Redirect");
                        header("Location: SellerHome.php");
                    }
                    $_SESSION['role'] = $type;
                } else {
                    echo $MSGerr;
                }
            } else {
                echo $MSGerr;
            }
        }
    ?>
    <nav class="navbar navbar-light navbar-expand-md" style="background: #EEEEEE;">
        <div class="container-fluid"><a href="<?php echo $_SERVER['PHP_SELF']; ?>"><img src="Images/CPSClogo.png" alt="CPSC logo" width="80" class="logo"></a><i class="fas fa-flag text-dark"></i>
            <div class="collapse navbar-collapse" id="navcol-1">
                <!-- <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Recalled Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Seller Letters</a></li>
                </ul> -->
            </div>
        </div>
    </nav>
    <section class="py-4 py-xl-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto" style="background: url(&quot;assets/img/banner.jpg&quot;); padding-top: 10px;">
                    <h2 class="text-dark">Log in</h2>
                    <p class="text-white">Please enter your email and password to continue.</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-xl-4">
                    <div class="card mb-5">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="bs-icon-xl bs-icon-circle bs-icon-primary bs-icon my-4" style="background: #CE142B;"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-person">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"></path>
                                </svg></div>
                            <form class="text-center" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                <div class="mb-3" id="Email">
                                    <input class="form-control" type="email" name="loginEmail" id="loginEmail" placeholder="Email">
                                    <?php 
                                        if ($error && empty($email)) {
                                            echo "<div class='error'>Please enter a valid email.</div>";
                                        }
                                    ?>
                                </div>
                                <div class="mb-3" id="Password">
                                    <input class="form-control" type="password" name="loginPassword" id="loginPassword" placeholder="Password">
                                    <?php 
                                        if ($error && empty($password)) {
                                            echo "<div class='error'>Please enter a valid password.</div>";
                                        }
                                    ?>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn d-block w-100" type="submit" name="BTNlogin" style="background: #0E1E45;">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div></div>
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