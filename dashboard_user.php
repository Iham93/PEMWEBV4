<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pasien - Klinik Ilham</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            /* Background Gambar dengan Overlay Gradasi Putih */
            background: linear-gradient(rgba(240, 244, 241, 0.85), rgba(255, 255, 255, 0.95)), 
                        url("https://rsudibnusina.gresikkab.go.id/web/uploads/igdprofile/igdprofile.jpeg");
            background-size: cover; 
            background-position: center; 
            background-attachment: fixed;
            min-height: 100vh; 
            padding-bottom: 40px; 
        }
        
        .navbar { 
            background: rgba(25, 135, 84, 0.95) !important; 
            backdrop-filter: blur(10px); 
            position: relative; /* Wajib ada untuk z-index */
            z-index: 1050; /* FIX: Memaksa navbar dan dropdown selalu di lapisan paling atas */
        }
        
        .hero-section { 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 20px; 
            padding: 40px 30px; 
            margin-top: 40px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.08); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative; /* Wajib ada untuk z-index */
            z-index: 1; /* FIX: Menjaga kotak ini tetap di bawah dropdown navbar */
        }
        
        .action-card { 
            border: none; 
            border-radius: 20px; 
            transition: all 0.4s ease; 
            cursor: pointer; 
            text-align: center; 
            padding: 30px 20px; 
            background: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            height: 100%;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        /* Animasi garis bawah hijau saat kartu di-hover */
        .action-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #198754;
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }

        .action-card:hover { 
            transform: translateY(-10px); 
            box-shadow: 0 15px 30px rgba(25, 135, 84, 0.15); 
        }
        
        .action-card:hover::after {
            transform: scaleX(1);
        }

        .icon-box { 
            font-size: 3.5rem; 
            color: #198754; 
            margin-bottom: 15px; 
            transition: transform 0.3s ease;
        }
        
        .action-card:hover .icon-box {
            transform: scale(1.1);
        }

        /* Animasi masuk perlahan */
        .fade-up { animation: fadeUp 0.8s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }

        /* Styling Banner Status Antrian */
        .banner-antrian {
            background: linear-gradient(135deg, #198754, #146c43);
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.2);
            transition: transform 0.3s ease;
            position: relative;
            z-index: 1;
        }
        .banner-antrian:hover {
            transform: scale(1.02);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark shadow-sm py-3">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="bi bi-heart-pulse-fill text-light me-2"></i>Klinik Pasien
            </a>
            <div class="dropdown">
                <button class="btn btn-outline-light dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2"></i>Halo, <?php echo htmlspecialchars($_SESSION['username']); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 rounded-3 z-3">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profil Saya</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger fw-bold" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Keluar</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container fade-up">
        <div class="row justify-content-center">
            <div class="col-md-10">
                
                <div class="hero-section mb-5 text-center">
                    <h1 class="fw-bold text-success mb-3">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                    <p class="text-muted fs-5">Kesehatan Anda adalah prioritas kami. Apa yang ingin Anda lakukan hari ini?</p>
                </div>

                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="card action-card">
                            <div class="card-body d-flex flex-column justify-content-between p-0">
                                <div>
                                    <div class="icon-box"><i class="bi bi-file-earmark-medical"></i></div>
                                    <h5 class="fw-bold text-dark">Ambil Antrian</h5>
                                    <p class="small text-muted px-2">Daftar pemeriksaan ke poliklinik secara online tanpa harus antri lama di lokasi.</p>
                                </div>
                                <button class="btn btn-success fw-bold rounded-pill w-100 mt-3 py-2 shadow-sm">Mulai Daftar</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card action-card">
                            <div class="card-body d-flex flex-column justify-content-between p-0">
                                <div>
                                    <div class="icon-box"><i class="bi bi-clock-history"></i></div>
                                    <h5 class="fw-bold text-dark">Riwayat Berobat</h5>
                                    <p class="small text-muted px-2">Lihat kembali catatan kunjungan, diagnosa, dan resep obat dari dokter Anda.</p>
                                </div>
                                <button class="btn btn-outline-success fw-bold rounded-pill w-100 mt-3 py-2">Lihat Riwayat</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card action-card">
                            <div class="card-body d-flex flex-column justify-content-between p-0">
                                <div>
                                    <div class="icon-box"><i class="bi bi-stethoscope"></i></div>
                                    <h5 class="fw-bold text-dark">Jadwal Dokter</h5>
                                    <p class="small text-muted px-2">Cek jadwal praktik dokter spesialis yang bertugas pada minggu ini.</p>
                                </div>
                                <button class="btn btn-outline-success fw-bold rounded-pill w-100 mt-3 py-2">Cek Jadwal</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-5 banner-antrian text-white">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-4">
                            <div class="bg-white text-success rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 70px; height: 70px;">
                                <i class="bi bi-ticket-perforated fs-1"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-1">Status Antrian Hari Ini</h4>
                                <p class="mb-0 text-white-50">Anda belum memiliki nomor antrian aktif.</p>
                            </div>
                        </div>
                        <button class="btn btn-light text-success fw-bold rounded-pill px-4 py-2 shadow-sm">Ambil Nomor Sekarang</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-3 text-muted small fade-up">
        <i class="bi bi-laptop me-1"></i> Dibuat untuk Sistem Antrian Klinik.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>