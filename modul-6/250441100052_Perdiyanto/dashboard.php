<?php

session_start();

require "config/koneksi.php";

if (!isset($_SESSION["login"])) {
    header("Location: auth/login.php");
    exit;
}


$user_id = $_SESSION["user_id"];

$query = mysqli_query($konek, 
"SELECT * FROM tasks WHERE user_id = '$user_id'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-slate-100">

    <div class="max-w-5xl mx-auto p-10">

        <div class="bg-white shadow-xl rounded-xl p-6">

            <div class="flex justify-between items-center mb-8">

                <div>
                    <h1 class="text-3xl font-bold text-sky-500">
                        TO DO LIST
                    </h1>

                    <p class="text-slate-500 mt-1">
                        Selamat datang,
                        <?= htmlspecialchars($_SESSION["nama"]); ?>
                    </p>
                </div>

                <a href="auth/logout.php"
                   class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-lg font-semibold">
                    Logout
                </a>

            </div>

            <div class="mb-5">
                <a href="task/tambah.php"
                   class="bg-sky-500 hover:bg-sky-600 text-white px-5 py-2 rounded-lg">
                    + Tambah Task
                </a>
            </div>

            <div class="overflow-x-auto">

                <table class="w-full border-collapse">

                    <thead>
                        <tr class="bg-sky-500 text-white">

                            <th class="p-3 text-left">No</th>
                            <th class="p-3 text-left">Judul</th>
                            <th class="p-3 text-left">Deskripsi</th>
                            <th class="p-3 text-left">Deadline</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-center">Aksi</th>

                        </tr>
                    </thead>

                    <tbody>

                        <?php $no = 1; ?>

                        <?php while ($data = mysqli_fetch_assoc($query)) : ?>

                        <tr class="bg-white border-b border-slate-200">

                            <td class="p-3"><?= $no++; ?></td>

                            <td class="p-3">
                                <?= htmlspecialchars($data["judul"]); ?>
                            </td>

                            <td class="p-3">
                                <?= htmlspecialchars($data["deskripsi"]); ?>
                            </td>

                            <td class="p-3">
                                <?= htmlspecialchars($data["deadline"]); ?>
                            </td>

                            <td class="p-3">

                                <?php if ($data["status"] == "Selesai") : ?>

                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                        <?= htmlspecialchars($data["status"]); ?>
                                    </span>

                                <?php else : ?>

                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                        <?= htmlspecialchars($data["status"]); ?>
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="p-3 text-center">

                                <a href="task/update.php?id=<?= htmlspecialchars($data['id']); ?>"
                                   class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm mx-3">
                                    Edit
                                </a>

                                <a href="task/hapus.php?id=<?= htmlspecialchars($data['id']); ?>"
                                   onclick="return confirm('Yakin ingin menghapus task ini?')"
                                   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                    Hapus
                                </a>

                            </td>

                        </tr>

                        <?php endwhile; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</body>
</html>