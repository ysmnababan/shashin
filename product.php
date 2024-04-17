<?php
include "koneksi.php";

session_start();
if (isset($_SESSION['fname'])) {
    echo $_SESSION['fname'];
    // echo $_SESSION['lname'];
    echo "<script> console.log('here');</script>";
    // echo "<script>alert('new session started');</script>";
    // session_unset();
} else {
    echo "wowowo";
}
?>

<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <!-- <script src="../assets/js/color-modes.js"></script> -->

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Product</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sticky-footer-navbar/"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3"> -->

    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css" />
    <script src="./asset/js/bootstrap.bundle.min.js"></script>


    <!-- Custom styles for this template -->
    <!-- <link href="sticky-footer-navbar.css" rel="stylesheet" /> -->

</head>

<body class="d-flex flex-column h-100">


    <header data-bs-theme="dark">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand text-warning" style="font-size: 30px;" href="./index.php">SHASHIN</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./try_luck.php">Try Your Luck</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./galery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./contact_us.php">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./about_us.php">About Us</a>
                        </li>
                    </ul>
                    <?php if (!isset($_SESSION['fname'])) {
                        echo "
                            <ul class='navbar-nav me-3 mb-2 mb-md-0'>
                                <li class='nav-item'>
                                <a class='nav-link' href='./login.php'>Login</a>
                                </li>
                                <li class='nav-item'>
                                <a class='nav-link' href='./register.php'>Register</a>
                                </li>
                            </ul>";
                    }

                    ?>

                    <?php if (isset($_SESSION['fname'])) {
                        echo '
                            <ul class="navbar-nav me-5 mb-2 mb-md-0 mt-2">
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-warning" href="#" data-bs-toggle="dropdown" aria-expanded="false">Hello, ' . $_SESSION["fname"] . '</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Update Profile</a></li>
                                    <li><a class="dropdown-item" href="#">Transaksi</a></li>
                                    <li><a class="dropdown-item" href="./logout.php">Log Out</a></li>
                                </ul>
                                </li>
                            </ul>
                            ';
                    }
                    ?>
                    <form class="d-flex mt-2" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success" type="submit">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0 h-75">
        <div class="container">
            <h1 class="mt-5">Sticky footer with fixed navbar</h1>
            <p class="lead">
                Pin a footer to the bottom of the viewport in desktop browsers with
                this custom HTML and CSS. A fixed navbar has been added with
                <code class="small">padding-top: 60px;</code> on the
                <code class="small">main &gt; .container</code>.
            </p>
            <p class="mb-5">
                Back to
                <a href="../examples/sticky-footer/">the default sticky footer</a>
                minus the navbar.
            </p>
        </div>
    </main>



    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
        </symbol>
    </svg>


    <div class="b-example-divider"></div>

    <!-- FOOTER -->
    <div class="container-fluid px-0" data-bs-theme="dark">
        <footer class="p-5 bg-dark">
            <div class="row ml-5">
                <div class="col-6 col-md-3 mb-3">
                    <h5 class="border-bottom pb-3 text-body-emphasis">ABOUT US</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="./about_us.php" class="nav-link p-0 text-body-secondary">About SHASHIN</a></li>
                        <li class="nav-item mb-2"><a href="./about_us.php" class="nav-link p-0 text-body-secondary">Why Shop at SHASHIN</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Direction</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Gallery</a></li>
                    </ul>
                </div>


                <div class="col-6 col-md-3 mb-3">
                    <h5 class="border-bottom pb-3 text-body-emphasis">GET IN TOUCH WITH US</h5>
                    <p class="text-body-secondary">
                        Jl. Jalan Santai No 19, Jakarta Pusat
                        <br>
                        (021)0809-89999
                        <br>
                    </p>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2 text-body-secondary"><span class='opacity-50'> Monday-Friday:</span> 08.00 - 19.00</li>
                        <li class="nav-item mb-2 text-body-secondary"><span class='opacity-50'> Saturday-Sunday:</span> 08.00 - 18.00</li>
                        <li class="nav-item mb-2 mt-2 text-body-secondary">Whatsapp:</li>
                        <li class="nav-item mb-2 text-body-secondary">08036871321</li>
                        <li class="nav-item mb-2 text-body-emphasis"><span>Now the shop open on Public Holiday too</span></li>
                    </ul>
                </div>

                <div class="col-md-5 offset-md-1 mb-3">
                    <form>
                        <h5 class="border-bottom pb-3 text-body-emphasis">Subscribe to our newsletter</h5>
                        <p class="text-body-emphasis">Monthly digest of what's new and exciting from us.</p>
                        <div class="d-flex flex-column flex-sm-row w-100 gap-2">
                            <label for="newsletter1" class="visually-hidden">Email address</label>
                            <input id="newsletter1" type="text" class="form-control" placeholder="Email address">
                            <button class="btn btn-primary" type="button">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
                <p class="text-body-emphasis">&copy; 2024 SHASHIN, Inc. All rights reserved.</p>
                <ul class="list-unstyled d-flex">
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg fill="#fff" class="bi" width="24" height="24">
                                <use xlink:href="#twitter" />
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg fill="#fff" class="bi" width="24" height="24">
                                <use xlink:href="#instagram" />
                            </svg></a></li>
                    <li class="ms-3"><a class="link-body-emphasis" href="#"><svg fill="#fff" class="bi" width="24" height="24">
                                <use xlink:href="#facebook" />
                            </svg></a></li>
                </ul>
            </div>
        </footer>
    </div>

</body>

</html>