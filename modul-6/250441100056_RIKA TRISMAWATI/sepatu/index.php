<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            height: 100vh;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 100%; max-width: 400px;">

            <h3 class="text-center mb-4">Login</h3>

            <form method="POST" action="proseslogin.php">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="username" name="username" class="form-control" placeholder="Masukkan Username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-1">Login</button>
                <a href="register.php" class="btn btn-info w-100">Registrasi</a>

            </form>

        </div>
    </div>

</body>

</html>