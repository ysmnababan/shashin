<?php
include "koneksi.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_conf = $_POST['password_conf'];

    // check if email exists

    $sql = "SELECT * FROM user_login WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<script>document.getElementById("email_error").style.display = "inline";</script>';
        $emailError = true;
    } else {
        // email does not exist, proceed to registration

        // check validity of password 
        if ($password !== $password_conf) {
            // echo "<script>alert('password is not correct');</script>";
            echo '<script>document.getElementById("pwd_error").style.display = "inline";</script>';
            $pwdError = true;
        } else {

            // start session
            session_start();
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO user_login (fname, lname, email, password) VALUES ('$fname', '$lname', '$email', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                // set session variables
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['email'] = $email;

                // set id session by query select from database first
                $sqlid = "SELECT id from user_login WHERE email='$email'";
                $result = $conn->query($sqlid);
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row['id'];

                //redirect to home page
                header("Location: index.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <style>
        .bd {
            border: 1px solid red;
        }

        .error_msg {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5 vh-100" style="background-color: #ddd;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11 ">
                    <div class="card border-dark-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 overflow-hidden">
                                <img class="rounded-start object-fit-cover" style="height: 925px;" loading="lazy" src="./asset/images/side_register.webp" alt="Register">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="border-bottom w-100 text-center mb-4 text-warning " style="font-size:70px;">
                                                        <img src="./asset/images/shashin_icon.png" alt="Logo" width="60" class="mb-3">
                                                        <strong>SHASHIN</strong>
                                                    </div>
                                                    <h5 class="text-center">Create an account. It's free and only takes a minute.</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <form method="POST" id="myForm">

                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="form-floating mb-2 col-6">
                                                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : '' ?>" placeholder="First Name" required>
                                                            <label for="fname" class="form-label ps-4">First Name</label>
                                                        </div>
                                                        <div class="form-floating mb-2 col-6">
                                                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : '' ?>" placeholder="Last Name" required>
                                                            <label for="lname" class="form-label ps-4">Last Name</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-2">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" placeholder="Email" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        <div class="error_msg" id="email_error" style="display: <?php echo isset($emailError) && $emailError ? 'inline' : 'none'; ?>">Email already used!</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-2">
                                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" minlength='3' required>
                                                        <label for="password" class="form-label">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-2">
                                                        <input type="password" class="form-control" name="password_conf" id="password_conf" value="" placeholder="Confirm Password" required>
                                                        <label for="password_conf" class="form-label">Confirm Password</label>
                                                        <div class="error_msg" id="pwd_error" style="display: <?php echo isset($pwdError) && $pwdError ? 'inline' : 'none'; ?>">Password does not match!</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me" required>
                                                        <label class="form-check-label text-secondary" for="remember_me">
                                                            I accept the Terms of Use & Privacy Policy.
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-warning btn-lg" type="submit" name="register">Register</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-1">
                                                    <a href="./login.php" class="link-secondary text-decoration-none">Already have and account?</a>
                                                    <!-- <a href="#!" class="link-secondary text-decoration-none">Forgot password</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById("email").addEventListener("input", function(event) {
            document.getElementById("email_error").style.display = 'none';
        });
    </script>
</body>

</html>