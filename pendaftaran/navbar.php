<?php
// Shared navigation bar component
// Detect current active page
$currentPage = basename($_SERVER['PHP_SELF']);
?>
<nav class="navbar">
    <div class="nav-container">
        <a href="index.php" class="brand-logo">
            <div class="brand-icon">🎮</div>
            <div class="brand-text">
                <h1>SIJA GAMEFEST</h1>
                <span>Game Dev Competition 2026</span>
            </div>
        </a>

        <ul class="nav-menu">
            <li>
                <a href="index.php" class="nav-link <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
                    📝 Form Pendaftaran
                </a>
            </li>
            <li>
                <a href="data_peserta.php" class="nav-link <?= ($currentPage == 'data_peserta.php') ? 'active' : '' ?>">
                    👥 Data Pendaftar
                </a>
            </li>
            <li>
                <a href="export_csv.php" class="nav-link btn-secondary" style="padding: 6px 14px; font-size: 0.84rem;">
                    📥 Export CSV
                </a>
            </li>
        </ul>
    </div>
</nav>
