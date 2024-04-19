<?php
include "koneksi.php";

session_start();
$email = $_SESSION['email'];

$sqlid = "SELECT id from user_login WHERE email='$email'";
$result = $conn->query($sqlid);
$row = $result->fetch_assoc();

echo ($row['id']);

$temp = $row['id'];
$sql_user = "SELECT * from user_profile WHERE user_id='$temp'";
$result_user = $conn->query($sql_user);

if ($result_user->num_rows > 0) {
    // already updated data once, update data
    $d = $result_user->fetch_assoc();
    // print_r($row_result);
    $user_data['username']  = $d['username'];
    $user_data['address']   = $d['address'];
    $user_data['address2']  = $d['address2'];
    $user_data['country']   = $d['country'];
    $user_data['state']     = $d['state'];
    $user_data['zipcode']   = $d['zipcode'];
    $user_data['payment']   = $d['payment'];
    $user_data['namecard']  = $d['namecard'];
    $user_data['cc_no']     = $d['cc_no'];
    $user_data['cc_exp']    = $d['cc_exp'];
    $user_data['cvv']       = $d['cvv'];
    $user_data['voucher']    = $d['voucher'];
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // retrieve form data
    $username = $_POST['username'];
    $address = $_POST['address'];
    $address2 = $_POST['address2'];
    $country = $_POST['country'];
    $state = $_POST['state'];
    $zipcode = $_POST['zip'];
    $payment = $_POST['paymentMethod'];
    $namecard = $_POST['cc-name'];
    $cc_no = $_POST['cc-number'];
    $cc_exp = $_POST['cc-expiration'];
    $cvv = $_POST['cvv'];



    $email = $_SESSION['email'];

    $sqlid = "SELECT id from user_login WHERE email='$email'";
    $result = $conn->query($sqlid);
    $row = $result->fetch_assoc();

    echo ($row['id']);

    $temp = $row['id'];
    $sql_user = "SELECT * from user_profile WHERE user_id='$temp'";
    $result_user = $conn->query($sql_user);

    if ($result_user->num_rows > 0) {
        // already updated data once, update data
        $row_result = $result_user->fetch_assoc();
        // print_r($row_result);

        $sql_update = "UPDATE user_profile SET
        username = '$username',
        address = '$address',
        address2 = '$address2',
        country = '$country',
        state = '$state',
        zipcode = '$zipcode',
        payment = '$payment',
        namecard = '$namecard',
        cc_no = '$cc_no',
        cc_exp = '$cc_exp',
        cvv = '$cvv'
        WHERE user_id = '$temp'
        ";

        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // never update profile, insert data
        // echo "never";
        $sql_insert = "INSERT INTO user_profile (username, address, address2, country, state, zipcode, payment, namecard, cc_no, cc_exp, cvv, user_id) VALUES 
        ('$username', '$address', '$address2', '$country', '$state', '$zipcode', '$payment', '$namecard', '$cc_no', '$cc_exp', '$cvv', '$temp')";
        if ($conn->query($sql_insert) === TRUE) {
            // set session variables
            echo "mantap";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    header("Location: update_profile.php");
}
?>


<!DOCTYPE html>
<html lang="en" class="h-100" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="./asset/css/style.css">
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css" />
    <script src="./asset/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./asset/css/carousel.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
        <symbol id="bootstrap" viewBox="0 0 118 94">
            <title>Bootstrap</title>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z"></path>
        </symbol>
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

    <!-- HEADER -->
    <header data-bs-theme="dark">
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <img src="./asset/images/shashin_icon.png" height="50px" class="me-2"/>
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
                            <a class="nav-link" href="./product.php">Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./try_luck.php">Try Your Luck</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./galery.php">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./contact_us.php">Contact Us</a>
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
                                <li><a class="dropdown-item" href="./update_profile.php">Update Profile</a></li>
                                <li><a class="dropdown-item" href="./transaction.php">Transaction</a></li>
                                <li><a class="dropdown-item" href="./logout.php">Log Out</a></li>
                                </ul>
                                </li>
                            </ul>
                            ';
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN -->
    <main class="container">
        <div class="py-5 text-center">
            <h2>Update Profile</h2>
            <p class="lead">Update your profile for completing transaction</p>
        </div>

        <div class="row g-5">
            <!-- <div class="col-md-5 col-lg-4 order-md-last bd">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Product name</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-body-secondary">Brief description</small>
                        </div>
                        <span class="text-body-secondary">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">−$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
                    </li>
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>
            </div> -->
            <div class="col-lg-12">
                <h4 class="mb-3">Billing address</h4>
                <form method="POST" class="needs-validation" novalidate>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="<?php echo $_SESSION['fname'] ?>" disabled>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="<?php echo $_SESSION['lname'] ?>" disabled>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="username" class="form-label">Username</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">@</span>
                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo isset($user_data['username']) && $user_data['username']!= '' ? $user_data['username'] : '' ?>">
                                <div class="invalid-feedback">
                                    Your username is required.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo $_SESSION['email'] ?>" disabled>
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" value="<?php echo isset($user_data['address']) && $user_data['address']!= '' ? $user_data['address'] : '' ?>">
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="address2" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                            <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite" value="<?php echo isset($user_data['address2']) && $user_data['address2']!= '' ? $user_data['address2'] : '' ?>">
                        </div>

                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" name="country" id="country" required>
                                <option value="">Choose...</option>
                                <option value="Indonesia">Indonesia</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" name="state" id="state">
                                <option value="">Choose...</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Palembang">Palembang</option>
                                <option value="Balikpapan">Balikpapan</option>
                                <option value="Medan">Medan</option>
                                <option value="Bali">Bali</option>
                                <option value="Semarang">Semarang</option>
                                <option value="Makassar">Makassar</option>
                                <option value="Lampung">Lampung</option>
                                <option value="Jayapura">Jayapura</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" name="zip" id="zip" placeholder="" value="<?php echo isset($user_data['zipcode']) && $user_data['zipcode']!= '' ? $user_data['zipcode'] : '' ?>">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="same-address">
                        <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>


                    <hr class="my-4">

                    <h4 class="mb-3">Payment</h4>

                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input">
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                        <div class="form-check">
                            <input id="paypal" name="paymentMethod" type="radio" class="form-check-input">
                            <label class="form-check-label" for="paypal">PayPal</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label for="cc-name" class="form-label">Name on card</label>
                            <input type="text" class="form-control" name="cc-name" id="cc-name" placeholder="" value="<?php echo isset($user_data['namecard']) && $user_data['namecard']!= '' ? $user_data['namecard'] : '' ?>">
                            <small class="text-body-secondary">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="cc-number" class="form-label">Credit card number</label>
                            <input type="text" class="form-control" name="cc-number" id="cc-number" placeholder="" value="<?php echo isset($user_data['cc_no']) && $user_data['cc_no']!= '' ? $user_data['cc_no'] : '' ?>">
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-expiration" class="form-label">Expiration</label>
                            <input type="text" class="form-control" name="cc-expiration" id="cc-expiration" placeholder="" value="<?php echo isset($user_data['cc_exp'])  && $user_data['cc_exp']!= '' ? $user_data['cc_exp'] : '' ?>">
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="cc-cvv" class="form-label">CVV</label>
                            <input type="text" class="form-control" name="cvv" id="cc-cvv" placeholder="" value="<?php echo isset($user_data['cvv']) && $user_data['cvv']!= '' ? $user_data['cvv'] : '' ?>">
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <h4 class="mb-3">Voucher</h4>
                    <?php if (isset($user_data['voucher'])) {
                        echo "<h5 class='mb-5 p-3'>YOUR VOUCHER IS: " . $user_data['voucher']. "</h5>";
                    } else {
                        echo "
                        <p class='mb-5'>You don't have any Voucher yet. <a href='./try_luck_logged.php' class='mb-5'>Try your luck</a></p>";
                    } ?>

                    <button class="w-100 btn btn-warning btn-lg" type="submit">Save profile</button>
                </form>
            </div>
        </div>
    </main>

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
                        <li class="nav-item mb-2"><a href="./galery.php" class="nav-link p-0 text-body-secondary">Gallery</a></li>
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