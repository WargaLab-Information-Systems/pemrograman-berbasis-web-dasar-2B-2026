<?php
include 'config.php';
include 'auth.php';

$query = "SELECT * FROM data_mancing";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mancing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode:'class',
            theme: {
                extend: {
                    colors:{
                        1:'#011f4b',
                        2:'#03396c',
                        3:'#005b96',
                        4:'#6497b1',
                        5:'#b3cde0',
                    }
                },
            },
        }
    </script>
</head>
<body class="bg-gray-50">
    <nav class="top-0 bg-3 p-4 flex justify-between">
        <h1 class="text-2xl text-white font-semibold">FishLog System</h1>
        <div class="flex items-center justify-center gap-4">
            <p class="text-white text-lg">Halo,<?php echo htmlspecialchars($_SESSION['username']) ?><span class="bg-4 rounded-full text-white text-sm p-1 ml-2"><?php echo $_SESSION['role'] ?></span></p>
            <a href="logout.php" class="bg-red-500 p-2 rounded-lg text-white font-semibold">Log Out</a>
        </div>
    </nav>
    <div class="container mx-auto mt-10 p-5 bg-white rounded-md shadow">
        <div class="flex items-center justify-between mb-5">
            <h2 class="text-2xl">Data Hasil Mancing 🎣</h2>
            <a href="add.php" class="bg-green-500 text-white px-4 py-2 rounded-lg">+ Tambah Data</a>
        </div>
        <table class="w-full border-collapse">
            <thead class="">
                <tr class="bg-gray-200 text-left">
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <th class="p-3">ID</th>
                    <?php endif; ?>
                    <th class="p-3">Spesies</th>
                    <th class="p-3">Berat (kg)</th>
                    <th class="p-3">Lokasi</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3">Catatan</th>
                    <th class="p-3">Aksi</th>
                </tr>            
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr class="border-b">
                    <?php if($_SESSION['role'] == 'admin'): ?>
                    <td class="p-3"><?= htmlspecialchars($row['id']) ?></td>
                    <?php endif; ?>
                    <td class="p-3"><?= htmlspecialchars($row['spesies']) ?></td>
                    <td class="p-3"><?= htmlspecialchars($row['berat']) ?></td>
                    <td class="p-3"><?= htmlspecialchars($row['lokasi']) ?></td>
                    <td class="p-3"><?= htmlspecialchars($row['tgl_tangkap']) ?></td>
                    <td class="p-3 text-sm italic"><?= htmlspecialchars($row['catatan']) ?></td>
                    <td class="p-3">
                        <?php if($_SESSION['role'] == 'admin'): ?>
                            <a href="edit.php?id=<?= $row['id'] ?>" class="text-blue-500">Edit</a> |
                            <a href="delete.php?id=<?= $row['id'] ?>" class="text-red-500" onclick="return confirm('Hapus data?')">Hapus</a>
                        <?php else: ?>
                            <span class="text-gray-400 text-sm">No Access</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
