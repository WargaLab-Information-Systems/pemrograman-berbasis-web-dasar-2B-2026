<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Turnamen Free Fire</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ff: {
                            red: '#E50914',
                            dark: '#1A1A1A',
                            gold: '#FFB800',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="font-sans" style="background: url('https://image.ggwp.id/post/20250618/upload_2b615818dab1597038925d8d78c5d9dd_6595afe4-57e6-4b42-bc2b-ec3871e0a1b6.jpg') no-repeat center center fixed; background-size: cover; background-attachment: fixed;">
    <!-- Header -->
    <header class="bg-ff-dark/90 text-white py-6 shadow-lg backdrop-blur-sm">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="flex items-center mb-4 md:mb-0">
                    <i class="fa fa-fire text-ff-red text-4xl mr-3"></i>
                    <div>
                        <h1 class="text-[clamp(1.5rem,3vw,2.2rem)] font-bold">TURNAMEN FREE FIRE</h1>
                        <p class="text-gray-300">Sistem Pendaftaran Resmi</p>
                    </div>
                </div>
                <nav>
                    <ul class="flex gap-6">
                        <li><a href="#info" class="hover:text-ff-gold transition">Informasi</a></li>
                        <li><a href="#daftar" class="hover:text-ff-gold transition">Daftar Sekarang</a></li>
                        <li><a href="#peserta" class="hover:text-ff-gold transition">Daftar Tim</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Notifikasi Pesan -->
    <?php if (isset($_GET['pesan'])): ?>
    <div class="container mx-auto px-4 mt-4">
        <?php if ($_GET['pesan'] == 'berhasil'): ?>
        <div class="bg-green-100/90 border border-green-400 text-green-700 px-4 py-3 rounded text-center backdrop-blur-sm">
            ✅ Pendaftaran Berhasil! Terima kasih sudah mendaftar.
        </div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-ff-dark/80 to-gray-800/80 text-white py-16 backdrop-blur-[2px]">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-[clamp(1.8rem,4vw,3rem)] font-bold mb-4">BERTANDING JADI JUARA!</h2>
            <p class="text-lg mb-8 max-w-2xl mx-auto">Ikuti turnamen Free Fire terbesar di wilayahmu. Raih gelar juara dan hadiah menarik senilai jutaan rupiah!</p>
            <a href="#daftar" class="bg-ff-red hover:bg-ff-red/90 text-white font-bold py-3 px-8 rounded-full transition transform hover:scale-105 shadow-lg">
                DAFTAR SEKARANG
            </a>
        </div>
    </section>

    <!-- Informasi Turnamen -->
    <section id="info" class="py-16 bg-white/80 backdrop-blur-sm">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-ff-dark">INFORMASI TURNAMEN</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gray-50/90 p-6 rounded-lg shadow-md text-center hover:shadow-lg transition backdrop-blur-sm">
                    <i class="fa fa-calendar text-ff-red text-4xl mb-3"></i>
                    <h3 class="font-bold text-xl mb-2">Waktu Pelaksanaan</h3>
                    <p>20 - 25 Mei 2026<br>Jam 19.00 WIB - Selesai</p>
                </div>
                <div class="bg-gray-50/90 p-6 rounded-lg shadow-md text-center hover:shadow-lg transition backdrop-blur-sm">
                    <i class="fa fa-trophy text-ff-gold text-4xl mb-3"></i>
                    <h3 class="font-bold text-xl mb-2">Hadiah Utama</h3>
                    <p>Juara 1: Rp 3.000.000<br>Juara 2: Rp 1.500.000<br>Juara 3: Rp 750.000</p>
                </div>
                <div class="bg-gray-50/90 p-6 rounded-lg shadow-md text-center hover:shadow-lg transition backdrop-blur-sm">
                    <i class="fa fa-users text-blue-500 text-4xl mb-3"></i>
                    <h3 class="font-bold text-xl mb-2">Sistem Pertandingan</h3>
                    <p>Mode: Squad (4 Orang + 1 Cadangan)<br>Slot Terbatas: 32 Tim Saja</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Pendaftaran (Hanya untuk Pengunjung) -->
    <section id="daftar" class="py-16 bg-gray-900/40 backdrop-blur-[2px]">
        <div class="container mx-auto px-4 max-w-2xl">
            <h2 class="text-3xl font-bold text-center mb-8 text-white drop-shadow-lg">FORM PENDAFTARAN TIM</h2>
            <div class="bg-white/90 p-8 rounded-lg shadow-lg backdrop-blur-sm">
                <form method="POST" action="proses_daftar.php"> <!-- Arahkan ke proses khusus daftar -->
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nama Tim</label>
                        <input type="text" name="nama_tim" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ff-red bg-white/80" placeholder="Contoh: EVOS Esports" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nama Lengkap Kapten Tim</label>
                        <input type="text" name="nama_kapten" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ff-red bg-white/80" placeholder="Nama sesuai ID Game" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nomor WhatsApp Aktif</label>
                        <input type="tel" name="no_hp" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ff-red bg-white/80" placeholder="0812xxxxxx" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">ID Free Fire Kapten</label>
                        <input type="text" name="id_ff" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ff-red bg-white/80" placeholder="Contoh: 123456789" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Daftar Anggota Tim (Nama & ID)</label>
                        <textarea name="anggota" rows="4" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-ff-red bg-white/80" placeholder="Anggota 1: Nama | ID&#10;Anggota 2: Nama | ID&#10;Anggota 3: Nama | ID&#10;Anggota 4: Nama | ID" required></textarea>
                    </div>

                    <button type="submit" class="w-full bg-ff-red hover:bg-ff-red/90 text-white font-bold py-3 px-4 rounded-lg transition shadow-md hover:shadow-lg">
                        ✅ DAFTAR SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Daftar Tim Terdaftar (Hanya Lihat Saja) -->
    <section id="peserta" class="py-16 bg-white/80 backdrop-blur-sm">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-8 text-ff-dark">DAFTAR TIM YANG SUDAH MENDAFTAR</h2>
            <div class="overflow-x-auto bg-white/90 rounded-lg shadow-lg backdrop-blur-sm">
                <table class="w-full text-left">
                    <thead class="bg-ff-dark/90 text-white">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Nama Tim</th>
                            <th class="px-4 py-3">Nama Kapten</th>
                            <th class="px-4 py-3">Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        $ambilSemua = mysqli_query($koneksi, "SELECT id, nama_tim, nama_kapten, tanggal_daftar FROM tim ORDER BY tanggal_daftar DESC");
                        $no = 1;
                        if (mysqli_num_rows($ambilSemua) > 0):
                            while ($data = mysqli_fetch_assoc($ambilSemua)):
                        ?>
                        <tr class="hover:bg-gray-100/70 transition">
                            <td class="px-4 py-3"><?= $no++ ?></td>
                            <td class="px-4 py-3 font-semibold"><?= $data['nama_tim'] ?></td>
                            <td class="px-4 py-3"><?= $data['nama_kapten'] ?></td>
                            <td class="px-4 py-3"><?= date('d-m-Y H:i', strtotime($data['tanggal_daftar'])) ?></td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">Belum ada tim yang mendaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Footer + Link Admin -->
    <footer class="bg-ff-dark/90 text-white py-6 text-center backdrop-blur-sm">
        <p>© 2026 Turnamen Free Fire - Semua Hak Dilindungi</p>
        <p class="mt-2">
            <a href="login.php" class="text-sm text-gray-400 hover:text-ff-gold transition">🔐 Login Admin</a>
        </p>
    </footer>

</body>
</html>