<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: ../auth/login.php");
    exit;
}

require "../config/koneksi.php";

$user_id = $_SESSION["user_id"];

if (isset($_POST["simpan"])) {

    $judul = $_POST["judul"];
    $deskripsi = $_POST["deskripsi"];
    $deadline = $_POST["deadline"];
    $status = $_POST["status"];

    $query = mysqli_query($konek, "INSERT INTO tasks (user_id, judul, deskripsi, deadline, STATUS) VALUES
    ('$user_id','$judul','$deskripsi', '$deadline', '$status')");

    if ($query) {
        header("Location: ../dashboard.php");
        exit;
    } else {
        echo "Data gagal ditambahkan";
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
    <body class=" bg-slate-100"> 
        <div class="w-full md:w-2/3 md:mx-auto flex justify-center items-center p-10 h-screen">
            <div class="bg-white w-full md:w-1/2 p-8 rounded-lg shadow-lg">
                <h1 class="text-center font-bold text-xl text-sky-500 mb-5">TAMBAHKAN TUGAS</h1>
                <form method="POST" action="">
                    <label for="judul" class="block mb-2 text-slate-600 font-semibold">Nama Judul:</label>
                    <input type="text" name="judul" placeholder="Judul" class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5" required>
                            
                    <label for="judul" class="block mb-2 text-slate-600 font-semibold">Deskripsi:</label>
                    <input type="text" name="deskripsi" placeholder="Masukan deskripsi" class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5" required>

                    <label for="deadline" class="block mb-2 text-slate-600 font-semibold">Deadline:</label>
                    <input type="date" name="deadline" placeholder="Masukan deadline" class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5" required>

                    <select name="status" id="status" class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-sky-500 mb-5"
                    required>
                        <option>Pilih:</option>
                        <option value="belum">Belum</option>
                        <option value="selesai">Selesai</option>
                    </select>
                    <button type="submit" name="simpan" class="w-full block mt-5 bg-sky-500 p-3 rounded-full font-bold text-lg text-white">Simpan Data</button>
                </form>
            </div>
        </div>
    </body>
</html>