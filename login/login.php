<?php
session_start();
include '../tools/koneksi.php'; // Pastikan koneksi database ada

// Jika sudah login, langsung ke halaman admin
if (isset($_SESSION['admin_username'])) {
    header("location: ../admin/admin.php");
    exit();
}

$username = "";
$err = "";

// Jika tombol login ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validasi input kosong
    if (empty($username) || empty($password)) {
        $err .= "<li>Silahkan masukkan username dan password</li>";
    } else {
        // Gunakan prepared statement untuk keamanan
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        // Verifikasi password jika user ditemukan
        if ($user && password_verify($password, $user['password'])) {
            // Simpan sesi login
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_logged_in'] = true;

            // Redirect ke halaman admin
            header("location: ../admin/admin.php");
            exit();
        } else {
            $err .= "<li>Username atau password salah</li>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../tools/css/login.css">
</head>
<body>
    <div class="input">
        <?php if (!empty($err)) { echo "<ul>$err</ul>"; } ?>
        <form action="" method="POST">
            <h1>LOGIN</h1>
            <div class="box-input">
                <i class="fas fa-user"></i>
                <input type="text" value="<?php echo htmlspecialchars($username); ?>" name="username" placeholder="Username" required>
            </div> <br>
            <div class="box-input">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Password" required>
            </div><br>

            <div class="box-input">
                <input type="submit" name="login" value="Login" class="btn-input">
            </div>
        </form>
    </div>
</body>
</html>
