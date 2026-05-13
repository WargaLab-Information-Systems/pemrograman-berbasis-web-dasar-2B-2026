<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #36b9cc, #4e73df);
            height: 100vh;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width:100%; max-width:400px;">

            <h3 class="text-center mb-3">Register</h3>

            <form method="POST" action="prosesregister.php">

                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Username</label>
                    <input type="username" name="username" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Role</label>
                    <select name="role" class="form-control">
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success w-100">Daftar</button>

                <div class="text-center mt-3">
                    <a href="index.php">Sudah punya akun? Login</a>
                </div>

            </form>

        </div>
    </div>

</body>

</html>