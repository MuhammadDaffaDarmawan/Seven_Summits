<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];

require_once '../conn.php';

// Mendapatkan data use dari database
$query = $conn->prepare("SELECT * FROM user WHERE username = :username");
$query->execute(['username' => $username]);
$user = $query->fetch(PDO::FETCH_ASSOC);

// Proses form jika ada data yang dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    // Update Profile
    if (isset($_POST['update_profile'])) {
        $new_username = isset($_POST['new_username']) ? $_POST['new_username'] : '';
        $profile_pic = isset($_FILES['profile_pic']) ? $_FILES['profile_pic'] : null;

        // Validasi username
        if (empty($new_username)) {
            $errors[] = "Username tidak boleh kosong.";
        }

        // Upload foto profil jika ada
        if ($profile_pic && $profile_pic['error'] === UPLOAD_ERR_OK) {
            $target_dir = "image/profile/";
            $target_file = $target_dir . basename($profile_pic["name"]);
            move_uploaded_file($profile_pic["tmp_name"], $target_file);
        } else {
            $target_file = $user['profile_pic']; // Gunakan foto profil lama jika tidak ada yang diunggah
        }

        // Jika tidak ada error, update data di database
        if (empty($errors)) {
            $stmt = $conn->prepare("UPDATE user SET username = :new_username, profile_pic = :profile_pic WHERE username = :current_username");
            $params = [
                'new_username' => $new_username,
                'profile_pic' => $target_file,
                'current_username' => $username
            ];

            if ($stmt->execute($params)) {
                $_SESSION['username'] = $new_username;
                header("Location: profile.php?success=1");
                exit();
            } else {
                $errors[] = "Gagal memperbarui profil.";
            }
        }
    }

    // Change Password
    if (isset($_POST['change_password'])) {
        $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
        $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

        if ($new_password !== $confirm_password) {
            $errors[] = "Konfirmasi password tidak cocok.";
        } else {
            $stmt = $conn->prepare("UPDATE user SET password = :new_password WHERE username = :current_username");
            $params = [
                'new_password' => password_hash($new_password, PASSWORD_BCRYPT),
                'current_username' => $username
            ];

            if ($stmt->execute($params)) {
                header("Location: profile.php?success=1");
                exit();
            } else {
                $errors[] = "Gagal memperbarui password.";
            }
        }
    }
}

include "template/header.php";
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Profile</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?php echo htmlspecialchars($error); ?></p>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <p>Perubahan berhasil disimpan!</p>
        </div>
    <?php endif; ?>

    <div class="row">
        <!-- Foto Profil -->
        <div class="col-sm-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mt-2"><i class="fa fa-user"></i> Foto Pengguna</h5>
                </div>
                <div class="card-body">
                    <img src="<?php echo htmlspecialchars($user['profile_pic']); ?>" alt="#" class="img-fluid w-100" />
                </div>
                <div class="card-footer">
                    <form method="POST" action="profile.php" enctype="multipart/form-data">
                        <input type="file" accept="image/*" name="profile_pic">
                        <input type="hidden" value="<?php echo htmlspecialchars($user['profile_pic']); ?>"
                            name="profile_pic_old">
                        <br><br>
                        <button type="submit" name="update_profile" class="btn btn-primary btn-md" value="Tambah">
                            <i class="fas fa-edit mr-1"></i> Ganti Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Profil -->
        <div class="col-sm-5">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mt-2"><i class="fa fa-user"></i> Kelola Pengguna</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="profile.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="new_username">Username</label>
                            <input type="text" class="form-control" id="new_username" name="new_username"
                                value="<?php echo htmlspecialchars($user['username']); ?>" required>
                        </div>
                        <button type="submit" name="update_profile" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Ubah Profil
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Ganti Password -->
        <div class="col-sm-4">
            <div class="card card-primary">
                <div class="card-header">
                    <h5 class="mt-2"><i class="fa fa-lock"></i> Ganti Password</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="profile.php">
                        <div class="form-group">
                            <label for="new_password">Password Baru</label>
                            <input type="password" class="form-control" id="new_password" name="new_password"
                                placeholder="Enter Your New Password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                                placeholder="Confirm Your New Password" required>
                        </div>
                        <button type="submit" name="change_password" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Ubah Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<?php
include "template/footer.php";
?>