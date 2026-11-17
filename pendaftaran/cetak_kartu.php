<?php
/**
 * Halaman Cetak Kartu Peserta Resmi Lomba Game SIJA 2026
 * Database: datadepin | Tabel: sija2
 */
require_once 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID Peserta tidak valid.");
}

// Ambil data peserta berdasarkan NO/ID
$stmt = mysqli_prepare($conn, "SELECT * FROM sija2 WHERE NO = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data peserta tidak ditemukan di tabel sija2.");
}

$nama = !empty($data['NAMA']) ? $data['NAMA'] : ($data['nama'] ?? 'Peserta SIJA');
$email = !empty($data['EMAIL']) ? $data['EMAIL'] : ($data['email'] ?? '-');
$gender = !empty($data['GENDER']) ? $data['GENDER'] : ($data['gender'] ?? '-');
$website = !empty($data['WEBSITE']) ? $data['WEBSITE'] : ($data['website'] ?? '-');
$game = parseGameComment($data['COMMENT'] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Peserta Lomba Game SIJA - <?= htmlspecialchars($nama); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style_css/cetak_kartu.css">
</head>
<body>

    <div class="no-print">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
        <a href="data_peserta.php" class="btn-back">⬅️ Kembali ke Data Peserta</a>
        <a href="index.php" class="btn-back">➕ Formulir Baru</a>
    </div>

    <div class="card-container">
        <div class="card-topbar">
            <div class="topbar-left">
                <h2>SIJA GAMEFEST 2026</h2>
                <p>Kartu Tanda Peserta Resmi</p>
            </div>
            <div class="reg-number">
                <span>No. Registrasi</span>
                <strong>#SG-<?= str_pad($id, 4, '0', STR_PAD_LEFT); ?></strong>
            </div>
        </div>

        <div class="card-content">
            <!-- Game Info Block -->
            <div class="game-banner">
                <div class="game-icon-box">🎮</div>
                <div class="game-info-text">
                    <h3><?= htmlspecialchars($game['judul']); ?></h3>
                    <div class="game-badges">
                        <span class="badge badge-purple"><?= htmlspecialchars($game['genre']); ?></span>
                        <span class="badge badge-blue"><?= htmlspecialchars($game['engine']); ?></span>
                        <span class="badge"><?= htmlspecialchars($game['platform']); ?></span>
                    </div>
                </div>
            </div>

            <!-- Participant Info Grid -->
            <div class="details-grid">
                <div class="detail-item">
                    <label>Nama Peserta / Tim</label>
                    <p><?= htmlspecialchars($nama); ?></p>
                </div>
                <div class="detail-item">
                    <label>Kelas SIJA</label>
                    <p><?= htmlspecialchars($game['kelas']); ?></p>
                </div>
                <div class="detail-item">
                    <label>Email Peserta</label>
                    <p><?= htmlspecialchars($email); ?></p>
                </div>
                <div class="detail-item">
                    <label>Jenis Kelamin</label>
                    <p><?= htmlspecialchars($gender); ?></p>
                </div>
                <div class="detail-item" style="grid-column: span 2;">
                    <label>Link Repositori / Demo Game</label>
                    <p style="word-break: break-all; color:#4338ca; font-weight:600;">
                        <?= htmlspecialchars($website); ?>
                    </p>
                </div>
            </div>

            <!-- Footer & Signature Verification -->
            <div class="card-footer">
                <div>
                    <div class="barcode-sim">|||| ||| ||||| |||| || |||</div>
                    <span style="font-size:0.7rem; color:#94a3b8;">VERIFIED SIJA DATABASE</span>
                </div>
                <div class="seal">
                    Status: <strong style="color:#16a34a;">TERDAFTAR & VALID</strong>
                    <span>Panitia Game Dev SIJA 2026</span>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
