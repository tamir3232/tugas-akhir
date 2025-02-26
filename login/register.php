<?php
@include '../tools/koneksi.php';

$fullname = $_POST["fullname"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

$query_sql = "INSERT INTO users (fullname, username, email, password)
            VALUES ('$fullname', '$username', '$email', '$password')";

if (mysqli_query($conn, @$query_sql)) {
    header("Location: home.php");
} else {
    echo "Pendaftaran Gagal ; " . mysqli_error($conn);
}
?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="../tools/css/login.css">
<title>Register Page</title>

<div class="input">
            <form action="" method="POST">
            <h1>REGISTER</h1>
            <?php 
                if(isset($error)) {
                    foreach($error as $error) {
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?>  
                <div class="box-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="fullname" placeholder="Fullname">
                </div>
                <div class="box-input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Username">
                </div>
                <div class="box-input">
                    <i class="fas fa-envelope-open-text"></i>
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="box-input">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password">
                </div>
                <select class="role" name="user_type">
                    <option value="admin">admin</option>
                    <option value="user">user</option>
                </select>

                <div class="box-input">
					<input type="submit" name="submit" value="Register" class="btn-input">
				</div>
                <div class="bottom">
                    <p> Sudah punya akun?
                        <a href="login.php">Login disini</a>
                    </p>
                </div>
            </form>
        </div>