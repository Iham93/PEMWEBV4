<?php
session_start();
// Proteksi halaman: Jika bukan admin, kembali ke login
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
    <title>Dashboard Admin - Klinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <style>
        :root { --primary-green: #198754; --light-green: #e8f5e9; }
        body { font-family: 'Poppins', sans-serif; background-color: #f4f7f6; overflow-x: hidden; }
        
        /* Animasi Masuk */
        .fade-in { animation: fadeIn 0.8s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        /* Sidebar Sidebar */
        .sidebar { min-height: 100vh; background: white; border-right: 1px solid #ddd; padding-top: 20px; position: fixed; width: 16.666667%; }
        .nav-link { color: #555; border-radius: 8px; margin: 5px 15px; transition: all 0.3s ease; font-weight: 500; }
        .nav-link:hover, .nav-link.active { background: var(--primary-green); color: white; transform: translateX(5px); }
        
        /* Main Content Offset untuk Sidebar Fixed */
        .main-content { margin-left: 16.666667%; }

        /* Card Statistik */
        .stat-card { border: none; border-left: 5px solid var(--primary-green); border-radius: 12px; transition: 0.3s; background: white; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        
        /* Tabel */
        .table-custom { background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03); }
        .table-custom th { background-color: #f8f9fa; color: #333; font-weight: 600; border-bottom: 2px solid #e9ecef; }
        .table-custom td { vertical-align: middle; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            
            <nav class="col-md-2 d-none d-md-block sidebar shadow-sm">
                <div class="text-center mb-4">
                    <h4 class="fw-bold text-success"><i class="bi bi-hospital-fill me-2"></i>Admin Panel</h4>
                </div>
                <div class="nav flex-column">
                    <a class="nav-link active" href="#"><i class="bi bi-speedometer2 me-2"></i> Dashboard Utama</a>
                    <a class="nav-link" href="#"><i class="bi bi-card-list me-2"></i> Kelola Antrian</a>
                    <a class="nav-link" href="#"><i class="bi bi-building me-2"></i> Data Poliklinik</a>
                    <a class="nav-link" href="#"><i class="bi bi-person-badge me-2"></i> Jadwal Dokter</a>
                    <hr class="mx-3 my-3">
                    <a class="nav-link text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-left me-2"></i> Keluar</a>
                </div>
            </nav>

            <main class="col-md-10 pt-4 px-4 fade-in main-content">
                
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-3 mb-4 border-bottom">
                    <div>
                        <h2 class="fw-bold text-dark mb-0">Dashboard Admin</h2>
                        <span class="text-muted small">Pusat kendali antrian dan data klinik</span>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="bg-white shadow-sm px-4 py-2 rounded-pill border">
                            <i class="bi bi-person-circle text-success me-2"></i> 
                            <span class="fw-bold"><?php echo htmlspecialchars($_SESSION['username']); ?></span> (Admin)
                        </div>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <div class="card stat-card p-3 h-100">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted fw-bold">TOTAL ANTRIAN HARI INI</small>
                                    <h3 class="fw-bold text-dark mt-1">42 Pasien</h3>
                                </div>
                                <i class="bi bi-people fs-1 text-success opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card p-3 h-100 border-warning">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted fw-bold">POLIKLINIK AKTIF</small>
                                    <h3 class="fw-bold text-dark mt-1">6 Poli</h3>
                                </div>
                                <i class="bi bi-building fs-1 text-warning opacity-50"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card stat-card p-3 h-100 border-info">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted fw-bold">DOKTER TERSEDIA</small>
                                    <h3 class="fw-bold text-dark mt-1">12 Dokter</h3>
                                </div>
                                <i class="bi bi-heart-pulse fs-1 text-info opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
                    <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-folder2-open text-success me-2"></i>Manajemen Jadwal Dokter & Poli</h5>
                    <button class="btn btn-sm btn-success rounded-pill px-3 shadow-sm"><i class="bi bi-plus-lg me-1"></i> Tambah Data Baru</button>
                </div>
                <div class="table-custom mb-5 p-3">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Dokter</th>
                                    <th>Poliklinik</th>
                                    <th>Jadwal Praktik</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td class="fw-bold">dr. Budi Santoso, Sp.G</td>
                                    <td><span class="badge bg-success-subtle text-success border border-success">Poli Gigi</span></td>
                                    <td>Senin, Rabu, Jumat (08:00 - 12:00)</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-pencil-square"></i> Ubah</button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td class="fw-bold">dr. Siti Aminah, Sp.A</td>
                                    <td><span class="badge bg-info-subtle text-info border border-info">Poli Anak</span></td>
                                    <td>Selasa, Kamis (09:00 - 14:00)</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-pencil-square"></i> Ubah</button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td class="fw-bold">dr. Andi Wijaya</td>
                                    <td><span class="badge bg-secondary-subtle text-secondary border border-secondary">Poli Umum</span></td>
                                    <td>Setiap Hari (08:00 - 16:00)</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="bi bi-pencil-square"></i> Ubah</button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="bi bi-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-display text-success me-2"></i>Monitoring Antrian Langsung</h5>
                <div class="table-custom mb-5 p-3 border-top border-success border-3">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Nomor Antrian</th>
                                    <th>Nama Pasien</th>
                                    <th>Poliklinik Tujuan</th>
                                    <th>Status Saat Ini</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong class="fs-5 text-success">G-001</strong></td>
                                    <td>Pasien Uji Coba 1</td>
                                    <td>Poli Gigi</td>
                                    <td><span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Sedang Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td><strong class="fs-5 text-success">A-005</strong></td>
                                    <td>Pasien Test 2</td>
                                    <td>Poli Anak</td>
                                    <td><span class="badge bg-info"><i class="bi bi-mic"></i> Diperiksa di Ruangan</span></td>
                                </tr>
                                <tr>
                                    <td><strong class="fs-5 text-success">U-012</strong></td>
                                    <td>User Demo Pasien</td>
                                    <td>Poli Umum</td>
                                    <td><span class="badge bg-success"><i class="bi bi-check-circle"></i> Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>