<?php
session_start();
// Proteksi halaman: Jika bukan user, kembalikan ke login
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
            position: relative; 
            z-index: 1050; 
        }
        
        .hero-section { 
            background: rgba(255, 255, 255, 0.95); 
            border-radius: 20px; 
            padding: 40px 30px; 
            margin-top: 40px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.08); 
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            position: relative; 
            z-index: 1; 
        }
        
        /* Card Form & Tiket */
        .content-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            padding: 30px;
            height: 100%;
            position: relative;
            z-index: 1;
        }

        /* Desain Tiket Spesial */
        .ticket-box {
            background: linear-gradient(135deg, #198754, #146c43);
            border-radius: 15px;
            color: white;
            padding: 30px;
            text-align: center;
            box-shadow: 0 15px 25px rgba(25, 135, 84, 0.3);
            position: relative;
            overflow: hidden;
            display: none; /* Disembunyikan sebelum form diisi */
        }
        
        /* Hiasan bulat pada tiket */
        .ticket-box::before, .ticket-box::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30px;
            height: 30px;
            background: #fff;
            border-radius: 50%;
            transform: translateY(-50%);
        }
        .ticket-box::before { left: -15px; }
        .ticket-box::after { right: -15px; }

        .nomor-antrian {
            font-size: 4.5rem;
            font-weight: 700;
            line-height: 1;
            margin: 15px 0;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        /* Animasi masuk perlahan */
        .fade-up { animation: fadeUp 0.8s ease-out; }
        @keyframes fadeUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
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
                <div class="hero-section mb-4 text-center">
                    <h1 class="fw-bold text-success mb-2">Selamat Datang, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                    <p class="text-muted fs-5 mb-0">Silakan isi formulir di bawah ini untuk mengambil nomor antrian Anda.</p>
                </div>
            </div>
        </div>

        <div class="row justify-content-center g-4">
            <div class="col-md-6">
                <div class="content-card">
                    <h4 class="fw-bold text-dark mb-4"><i class="bi bi-pencil-square text-success me-2"></i>Form Pendaftaran</h4>
                    
                    <form id="formAntrian" onsubmit="ambilAntrian(event)">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pasien</label>
                            <input type="text" id="inputNama" class="form-control form-control-lg bg-light" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal Kunjungan</label>
                            <input type="date" id="inputTanggal" class="form-control form-control-lg bg-light" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Pilih Poliklinik</label>
                            <select id="inputPoli" class="form-select form-select-lg bg-light" required>
                                <option value="" disabled selected>-- Pilih Poli --</option>
                                <option value="Poli Umum">Poli Umum</option>
                                <option value="Poli Gigi">Poli Gigi</option>
                                <option value="Poli Anak">Poli Anak</option>
                                <option value="Poli THT">Poli THT</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold rounded-pill shadow-sm">
                            <i class="bi bi-ticket-detailed me-2"></i>Ambil Nomor Antrian
                        </button>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="content-card d-flex flex-column justify-content-center align-items-center text-center">
                    <h4 class="fw-bold text-dark mb-4 w-100 border-bottom pb-2"><i class="bi bi-display text-success me-2"></i>Status Antrian</h4>
                    
                    <div id="statusKosong">
                        <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                        <h5 class="text-muted mt-3">Belum ada antrian.</h5>
                        <p class="small text-muted mb-0">Silakan isi form untuk mendapatkan nomor.</p>
                    </div>

                    <div id="tiketAktif" class="ticket-box w-100 fade-up">
                        <p class="mb-0 text-white-50 fw-semibold text-uppercase">Nomor Antrian Anda</p>
                        <div id="tampilNomor" class="nomor-antrian">A-01</div>
                        <div class="bg-white text-success rounded-3 p-2 mt-3 text-start">
                            <div class="small fw-bold">Atas Nama: <span id="tampilNama" class="text-dark fw-normal float-end">Ilham</span></div>
                            <div class="small fw-bold">Poliklinik: <span id="tampilPoli" class="text-dark fw-normal float-end">Poli Gigi</span></div>
                            <div class="small fw-bold">Tanggal: <span id="tampilTanggal" class="text-dark fw-normal float-end">20-10-2023</span></div>
                        </div>
                        <p class="mt-3 mb-0 small opacity-75"><i class="bi bi-info-circle me-1"></i>Tunjukkan layar ini kepada petugas.</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-5 mb-3 text-muted small fade-up">
        <i class="bi bi-laptop me-1"></i> Dibuat untuk Sistem Antrian Klinik.
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Simulasi Counter Nomor Antrian
        let counter = Math.floor(Math.random() * 20) + 1; // Angka acak 1-20 untuk testing

        function ambilAntrian(event) {
            event.preventDefault(); // Mencegah halaman ke-refresh

            // 1. Ambil data dari form
            let nama = document.getElementById("inputNama").value;
            let tanggal = document.getElementById("inputTanggal").value;
            let poli = document.getElementById("inputPoli").value;

            // 2. Format nomor antrian (Contoh: P-05)
            let kodePoli = poli.charAt(5).toUpperCase(); // Mengambil huruf pertama setelah kata "Poli "
            let nomorStr = kodePoli + "-" + (counter < 10 ? "0" + counter : counter);
            counter++;

            // 3. Masukkan data ke dalam tiket visual
            document.getElementById("tampilNomor").innerText = nomorStr;
            document.getElementById("tampilNama").innerText = nama;
            document.getElementById("tampilPoli").innerText = poli;
            document.getElementById("tampilTanggal").innerText = tanggal;

            // 4. Sembunyikan status kosong, tampilkan tiket
            document.getElementById("statusKosong").style.display = "none";
            document.getElementById("tiketAktif").style.display = "block";
        }
    </script>
</body>
</html>