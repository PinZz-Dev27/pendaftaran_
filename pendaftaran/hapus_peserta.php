<?php
/**
 * Skrip Hapus Data Peserta Lomba Game SIJA
 * Database: datadepin | Tabel: sija2
 */
require_once 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $stmt = mysqli_prepare($conn, "DELETE FROM sija2 WHERE NO = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: data_peserta.php?status=deleted");
            exit();
        } else {
            $err = urlencode(mysqli_stmt_error($stmt));
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            header("Location: data_peserta.php?status=delete_error&msg=" . $err);
            exit();
        }
    } else {
        $err = urlencode(mysqli_error($conn));
        mysqli_close($conn);
        header("Location: data_peserta.php?status=delete_error&msg=" . $err);
        exit();
    }
} else {
    header("Location: data_peserta.php");
    exit();
}
?>
