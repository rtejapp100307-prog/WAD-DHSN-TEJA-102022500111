<?php
include 'koneksi.php';

//tambah data
if (isset($_POST['tambah'])) {
    $id_kurir        = mysqli_real_escape_string($koneksi, $_POST['id_kurir']);
    $nama_kurir      = mysqli_real_escape_string($koneksi, $_POST['nama_kurir']);
    $no_hp           = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $jasa_pengiriman = mysqli_real_escape_string($koneksi, $_POST['jasa_pengiriman']);
    $jenis_layanan   = mysqli_real_escape_string($koneksi, $_POST['jenis_layanan']);

    $query = "INSERT INTO kurir (id_kurir, nama_kurir, no_hp, jasa_pengiriman, jenis_layanan) 
              VALUES ('$id_kurir', '$nama_kurir', '$no_hp', '$jasa_pengiriman', '$jenis_layanan')";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal menambah data: " . mysqli_error($koneksi) . "');</script>";
    }
}

//hapus data
if (isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id_kurir = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    $query = "DELETE FROM kurir WHERE id_kurir = '$id_kurir'";
    
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }
}

//update data
if (isset($_POST['update'])) {
    $id_kurir_lama   = mysqli_real_escape_string($koneksi, $_POST['id_kurir_lama']); 
    $id_kurir_baru   = mysqli_real_escape_string($koneksi, $_POST['id_kurir']);      
    $nama_kurir      = mysqli_real_escape_string($koneksi, $_POST['nama_kurir']);
    $no_hp           = mysqli_real_escape_string($koneksi, $_POST['no_hp']);
    $jasa_pengiriman = mysqli_real_escape_string($koneksi, $_POST['jasa_pengiriman']);
    $jenis_layanan   = mysqli_real_escape_string($koneksi, $_POST['jenis_layanan']);

    
    $query = "UPDATE kurir SET 
                id_kurir = '$id_kurir_baru',
                nama_kurir = '$nama_kurir', 
                no_hp = '$no_hp', 
                jasa_pengiriman = '$jasa_pengiriman',
                jenis_layanan = '$jenis_layanan' 
              WHERE id_kurir = '$id_kurir_lama'";
              
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');</script>";
    }
}
//edit
$edit_data = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id_edit = mysqli_real_escape_string($koneksi, $_GET['id']);
    $res = mysqli_query($koneksi, "SELECT * FROM kurir WHERE id_kurir = '$id_edit'");
    $edit_data = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div>
    <header class="mainHeader">
        <h1>Pengelolaan Data Kurir</h1>
    </header>
</div>
<br>

<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID Kurir</th>
                <th scope="col">Nama Kurir</th>
                <th scope="col">No. HP</th>
                <th scope="col">Jasa Pengiriman</th>
                <th scope="col">Jenis Layanan</th>
                <th scope="col" class="text-center">Edit/Hapus Data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query_tampil = "SELECT * FROM kurir ORDER BY id_kurir ASC";
            $result = mysqli_query($koneksi, $query_tampil);
            $no = 1;

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['id_kurir']); ?></td>
                        <td><?= htmlspecialchars($row['nama_kurir']); ?></td>
                        <td><?= htmlspecialchars($row['no_hp']); ?></td>
                        <td><?= htmlspecialchars($row['jasa_pengiriman']); ?></td>
                        <td>
                            
                            <?php if (($row['jenis_layanan'] ?? '') == 'Express'): ?>
                                <span class="badge bg-danger">Express</span>
                            <?php else: ?>
                                <span class="badge bg-info text-dark">Reguler</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="index.php?action=edit&id=<?= $row['id_kurir']; ?>#form-Data" class="btn-edit me-2">Edit</a> 
                            <a href="index.php?action=konfirmasi_hapus&id=<?= $row['id_kurir']; ?>#hapus-Data" class="btn-hapus">Hapus</a>
                        </td>
                    </tr>
            <?php 
                }
            } else {
            ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">Belum ada data kurir.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<div id="form-Data" class="popup">
    <div class="popup-box">
        <a href="index.php" class="tutup">X</a>
        <br>
        <h2><?= $edit_data ? 'Edit Data Kurir' : 'Tambah Data Kurir'; ?></h2>
        
        <form action="index.php" method="POST">
    
    <input type="hidden" name="id_kurir_lama" value="<?= $edit_data['id_kurir'] ?? ''; ?>">

   
    <label>ID Kurir:</label><br>
    <input type="text" name="id_kurir" value="<?= $edit_data['id_kurir'] ?? ''; ?>" required><br><br>

    <label>Nama Kurir:</label><br>
    <input type="text" name="nama_kurir" value="<?= $edit_data['nama_kurir'] ?? ''; ?>" required><br><br>

    <label>No. HP:</label><br>
    <input type="text" name="no_hp" value="<?= $edit_data['no_hp'] ?? ''; ?>" required><br><br>

    <label>Jasa Pengiriman:</label><br>
    <input type="text" name="jasa_pengiriman" value="<?= $edit_data['jasa_pengiriman'] ?? ''; ?>" required><br><br>

    <label>Jenis Layanan:</label><br>
    <select name="jenis_layanan" required style="width: 100%; padding: 8px;">
        <option value=""> [Pilih Layanan] </option>
        <option value="Reguler" <?= (isset($edit_data['jenis_layanan']) && $edit_data['jenis_layanan'] == 'Reguler') ? 'selected' : ''; ?>>Reguler</option>
        <option value="Express" <?= (isset($edit_data['jenis_layanan']) && $edit_data['jenis_layanan'] == 'Express') ? 'selected' : ''; ?>>Express</option>
    </select><br><br>

    <?php if ($edit_data): ?>
        <button type="submit" name="update">Simpan Perubahan</button>
    <?php else: ?>
        <button type="submit" name="tambah">Tambah Data</button>
    <?php endif; ?>
</form>
    </div>
</div>


<div id="hapus-Data" class="popup">
    <div class="popup-box">
        <a href="index.php" class="tutup">X</a>
        <br>
        <h2>Hapus Data</h2>
        <p>INGIN MENGHAPUS DATA KURIR INI?</p>
        <br>
        <?php if (isset($_GET['id'])): ?>
            <a href="index.php?action=hapus&id=<?= $_GET['id']; ?>" class="btn-tutup" style="background-color: red; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px;">
                Ya, Hapus
            </a>
        <?php endif; ?>
    </div>
</div>
<br> 
<a href="#form-Data" class="btn-tambah">+Tambah Data</a>   

</body>
</html>