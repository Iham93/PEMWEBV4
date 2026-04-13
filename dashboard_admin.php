<?php
session_start();
// Proteksi halaman: Jika bukan admin, tendang balik ke login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Klinik Ilham</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root { --primary-green: #198754; --light-green: #e8f5e9; }
        body { font-family: 'Poppins', sans-serif; background-color: #f8f9fa; overflow-x: hidden; }
        
        /* Animasi Masuk */
        .fade-in { animation: fadeIn 0.8s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Sidebar */
        .sidebar { min-height: 100vh; background: white; border-right: 1px solid #ddd; padding-top: 20px; }
        .nav-link { color: #333; border-radius: 10px; margin: 5px 15px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background: var(--primary-green); color: white; }
        
        .stat-card { border: none; border-left: 5px solid var(--primary-green); border-radius: 10px; transition: 0.3s; }
        .stat-card:hover { transform: scale(1.02); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block sidebar shadow-sm">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-success"><i class="bi bi-hospital"></i> Klinik Admin</h4>
                </div>
                <div class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
                    <a class="nav-link" href="#"><i class="bi bi-people me-2"></i> Data Pasien</a>
                    <a class="nav-link" href="#"><i class="bi bi-calendar-check me-2"></i> Antrian Hari Ini</a>
                    <hr class="mx-3">
                    <a class="nav-link text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Keluar</a>
                </div>
            </nav>

            <main class="col-md-10 ms-sm-auto px-md-4 pt-4 fade-in">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2 fw-bold text-success">Selamat Datang, Admin!</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <span class="badge bg-success p-2"><i class="bi bi-person-circle"></i> <?php echo $_SESSION['username']; ?></span>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-3">
                            <small class="text-muted">Total Antrian</small>
                            <h3 class="fw-bold text-success">42 Pasien</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-3">
                            <small class="text-muted">Pasien Menunggu</small>
                            <h3 class="fw-bold text-warning">15 Pasien</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card shadow-sm p-3">
                            <small class="text-muted">Pasien Selesai</small>
                            <h3 class="fw-bold text-info">27 Pasien</h3>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body">
                        <h5 class="fw-bold mb-3">Monitoring Antrian Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pasien</th>
                                        <th>Poli</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>A-001</td>
                                        <td>Ilham Eka</td>
                                        <td>Gigi</td>
                                        <td><span class="badge bg-warning">Menunggu</span></td>
                                        <td><button class="btn btn-sm btn-success">Panggil</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>
</html>