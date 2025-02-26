<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    header("location: ../admin/admin.php");
    exit();
}

include '../tools/koneksi.php';

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username == "" || $password == "") {
        $err .= "<li>Silahkan masukkan username dan password</li>";
    } else {
        // Gunakan prepared statement
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $r1 = $result->fetch_assoc();

        if ($r1 && password_verify($password, $r1['password'])) {
            $_SESSION['admin_username'] = $username;
            header("location: ../admin/admin.php");
            exit();
        } else {
            $err .= "<li>Username atau password salah</li>";
        }
    }
}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../tools/css/login.css">
<title>Login Page</title>

<div class="input">
    <?php if ($err) { echo "<ul>$err</ul>"; } ?>
    <form action="" method="POST">
        <h1>LOGIN</h1>
        <div class="box-input">
            <i class="fas fa-envelope-open-text"></i>
            <input type="text" value="<?php echo htmlspecialchars($username); ?>" name="username" placeholder="Username">
        </div>
        <div class="box-input">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div class="box-input">
            <input type="submit" name="login" value="Login" class="btn-input">
        </div>
        <div class="bottom">
            <p>Belum punya akun? <a href="register.php">Register disini</a></p>
        </div>
    </form>
</div>
