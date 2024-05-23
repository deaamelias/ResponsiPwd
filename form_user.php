<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User</title>
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

        .form-container {
            background-color: #fff;
            padding: 90px;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: steelblue;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
            text-align: left;
        }

        input,
        select {
            width: calc(100% - 16px);
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Tambah User</h2>
        <form action="register.php" method="post">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input name='username' type='text' required></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input name='password' type='password' required></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td><input name='nama_user' type='text' required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input name='email' type='text' required></td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        <select name="role">
                            <option value="ADMIN">ADMIN</option>
                            <option value="USER">USER</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan=2><input type='submit' value='SIMPAN'></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>