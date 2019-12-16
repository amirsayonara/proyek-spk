<?php include './includes/api.php'; include './includes/header.php';?>
<h5>Halaman Awal</h5><hr>
<p>Sistem ini dibuat sebagai proyek akhir mata kuliah Sistem Pendukung Keputusan menggunakan metode hybrid AHP-SAW.</p>
<p>Hak akses pengguna:</p>
<ol>
    <li>Publik</li>
    <ul>
        <li><span class="fas fa-table"></span> Data Alternatif (Perangkingan)</li>
    </ul>
    <li>Admin</li>
    <ul>
        <li><span class="fas fa-users-cog"></span> Manajemen Pengguna</li>
        <li><span class="fas fa-table"></span> Data Alternatif (Perangkingan)</li>
    </ul>
    <li>Petugas</li>
    <ul>
        <li><span class="fas fa-table"></span> Data Kriteria</li>
        <li><span class="fas fa-upload"></span> Upload Data Alternatif</li>
        <li><span class="fas fa-table"></span> Data Alternatif (Perangkingan)</li>
    </ul>
    <li>Pakar/Ahli</li>
    <ul>
        <li><span class="fas fa-sliders-h"></span> Perbandingan Kriteria</li>
        <li><span class="fas fa-table"></span> Data Alternatif (Perangkingan)</li>
    </ul>
</ol>
<?php include './includes/footer.php';?>