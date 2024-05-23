<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 50px;
            border-radius: 38px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }


        .login-container h2 {
            color: #333;
        }

        .login-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .captcha-image {
            margin-top: 15px;
        }

        .form-group img {
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #3498db; 
            color: #fff;
            padding: 15px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form class="login-form" action="login.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="captcha_code">Captcha:</label>
                <input type="text" id="captcha_code" name="captcha_code" required>
                <div class="captcha-image">
                    <img src='captcha.php' alt='Captcha'>
                </div>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
        <?php echo "<center>Belum punya akun? <a href=form_user.php><b>Daftar</b></a> </center>";
        echo "<br><br>";

        session_start();
        include "koneksi.php";

        if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha_code'])) {
            $username = $_POST['username'];
            $password = md5($_POST['password']);

            if ($_POST["captcha_code"] == $_SESSION["captcha_code"]) {
            $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $login = mysqli_query($conn, $sql);
            $ketemu = mysqli_num_rows($login);
            $r = mysqli_fetch_array($login);
            
            
            if ($ketemu > 0) {
                $_SESSION['username'] = $r['username'];
                $_SESSION['nama_user'] = $r['nama_user'];
                $_SESSION['role'] = $r['role'];
                // Mengarahkan pengguna ke halaman index.php setelah login berhasil
                header("Location: index.php");
                exit(); 
        
            } else {
                echo "<center>Login gagal! username & password tidak benar<br>";
            }

        } else {
            echo "<center>Login gagal! Kode Captcha tidak benar<br></center>";
        }

    }else{
        echo "";
    }

        mysqli_close($conn);
        ?>
    </div>
</body>

</html>