<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    //retrieve from data
    $email = $_POST['email'];
    $password = $_POST['password'];

    //check email exist or not
    $sql = "SELECT * FROM user_login WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // print_r($row);
        // echo $row['password'];


        // verify inputted password match or not
        if (password_verify($password, $row['password'])) {
            session_start();

            // set session variable
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id']    = $row['id'] ;

            // redirect to home page after login
            header("Location: index.php");
        } else {
            // echo "wrong pwd";
            $pwd_error = TRUE;
        }
    } else {
        // email does not exist, proceed to register
        $email_error = TRUE;
        // echo "<script>document.getElementById('email_login').style.display = 'inline';</script>";
        // echo "email doesn't exist, please register";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <!-- <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./asset/css/bootstrap.min.css">
    <link rel="stylesheet" href="./asset/css/style.css">
</head>

<body>
    <section class="p-3 p-md-4 p-xl-5 vh-100" style="background-color: #ddd;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xxl-11 ">
                    <div class="card border-dark-subtle shadow-sm">
                        <div class="row g-0">
                            <div class="col-12 col-md-6 overflow-hidden">
                                <img class="rounded-start object-fit-cover" style="height: 925px;" loading="lazy" src="./asset/images/side_login.webp" alt="Welcome back you've been missed!">
                            </div>
                            <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                                <div class="col-12 col-lg-11 col-xl-10">
                                    <div class="card-body p-3 p-md-4 p-xl-5">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-5">
                                                    <div class="border-bottom w-100 text-center mb-4 text-warning " style="font-size:70px;">
                                                        <img src="./asset/images/shashin_icon.png" alt="Logo" width="60" class="mb-3">
                                                        <strong>SHASHIN</strong>
                                                    </div>
                                                    <h4 class="text-center">Welcome back you've been missed!</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-3 flex-column">
                                                    <a href="#!" class="btn btn-lg btn-outline-dark">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                                                            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                                                        </svg>
                                                        <span class="ms-2 fs-6">Log in with Google</span>
                                                    </a>
                                                </div>
                                                <p class="text-center mt-4 mb-5">Or sign in with</p>
                                            </div>
                                        </div>
                                        <form method="POST" action="login.php" class="">
                                            <div class="row gy-3 overflow-hidden">
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>" placeholder="name@example.com" required>
                                                        <label for="email" class="form-label">Email</label>
                                                        <div class="error_msg" id=email_login style="display : <?php echo isset($email_error) && $email_error ? 'inline' : 'none' ?>">Email or password incorrect!</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>
                                                        <label for="password" class="form-label">Password</label>
                                                        <div class="error_msg" id="pwd_login" style="display : <?php echo isset($pwd_error) && $pwd_error ? 'inline' : 'none' ?>">Email or password incorrect!</div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                                                        <label class="form-check-label text-secondary" for="remember_me">
                                                            Keep me logged in
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="d-grid">
                                                        <button class="btn btn-warning btn-lg" type="submit">Log in now</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-center mt-2">
                                                    <a href="./register.php" class="link-secondary text-decoration-none">Register</a>
                                                    <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
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
        //if email form value modified, unhide the error message
        document.getElementById("email").addEventListener("input", function(event) {
            document.getElementById("email_login").style.display = 'none';
        })

        document.getElementById("password").addEventListener("input", function(event) {
            document.getElementById("pwd_login").style.display = 'none';
        });
    </script>
</body>

</html>