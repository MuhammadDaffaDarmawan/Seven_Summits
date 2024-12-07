<?php
require "../conn.php";
session_start();

if (isset($_POST['proses'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    // Query untuk memeriksa apakah email dan password sesuai, serta status in_active = 1
    $query = "SELECT * FROM user WHERE email = :email AND password = :password AND is_active = '1'";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    // Memeriksa apakah ada baris yang sesuai
    if ($stmt->rowCount() > 0) {
        // Jika ada, simpan data pengguna ke sesi
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $user['username']; // Asumsikan ada kolom 'username' dalam tabel user
        // Redirect ke halaman dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Email atau password salah atau akun tidak aktif";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - admin</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../sb-admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="h4 text-gray-900 mb-4"><b>Login Admin</b></h4>
                            </div>
                            <?php if (isset($error)): ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php endif; ?>
                            <form class="form-login" method="POST">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="pass"
                                        placeholder="Password">
                                </div>
                                <button class="btn btn-primary btn-block" name="proses" type="submit"><i
                                        class="fa fa-lock"></i> SIGN IN</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="register.php">Create an Account!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="sb-admin/js/sb-admin-2.min.js"></script>
</body>

</html>