@extends('layouts.app')

@section('title', 'Modul Belajar Cerdas Pertanian')

@section('content')
<style>
    :root {
        --primary-green: #2d6a4f;
        --secondary-green: #40916c;
        --light-green: #52b788;
        --accent-green: #74c69d;
        --pale-green: #95d5b2;
        --light-bg: #f8f9fa;
    }

    .hero {
        background: linear-gradient(135deg, #6fbb73, #6fbb73); /* Ganti dengan warna gradien yang diinginkan */
        position: relative;
        overflow: hidden;
    }

    /* Make the video tab scrollable */
    #varietas-video {
        max-height: 400px; /* Set your desired height */
        overflow-y: auto; /* Enable vertical scrolling */
    }

    .video-thumbnail {
        margin-bottom: 15px; /* Optional: Space between video thumbnails */
    }

    .video-thumbnail img {
        max-width: 100%;
        height: auto;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 30px;
        color: white;
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
        padding: 10px;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="25" cy="25" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1.5" fill="rgba(255,255,255,0.08)"/><circle cx="50" cy="10" r="1" fill="rgba(255,255,255,0.06)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .custom-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
        background: white;
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.1);
    }

    .custom-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(45, 106, 79, 0.2);
    }

    .card-header-custom {
        background: linear-gradient(45deg, var(--accent-green), var(--pale-green));
        color: white;
        border: none;
        padding: 1rem;
    }

    .btn-green {
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
        border: none;
        color: white;
        border-radius: 25px;
        padding: 10px 25px;
        transition: all 0.3s ease;
    }

    .btn-green:hover {
        background: linear-gradient(45deg, var(--secondary-green), var(--light-green));
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3);
    }

    .modal-content {
        border-radius: 15px;
        border: none;
        overflow: hidden;
    }

    .modal-header {
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
        color: white;
        border: none;
    }

    .nav-pills .nav-link {
        background-color: var(--primary-green); /* Warna latar belakang tombol */
        color: white; /* Warna teks tombol */
        border: 2px solid transparent; /* Border transparan untuk menjaga ukuran */
        border-radius: 30px; /* Sudut melengkung lebih besar untuk tampilan yang lebih halus */
        padding: 12px 25px; /* Padding untuk tombol */
        transition: background-color 0.3s, border-color 0.3s, transform 0.3s; /* Transisi halus */
        opacity: 0.9; /* Menambahkan sedikit transparansi agar tombol terlihat */
        font-weight: bold; /* Menebalkan teks tombol */
        text-align: center; /* Memastikan teks berada di tengah */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Menambahkan bayangan halus */
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green)); /* Warna latar belakang untuk tombol aktif */
        color: white;
        border-color: var(--primary-green);
        box-shadow: 0 4px 12px rgba(45, 106, 79, 0.3); /* Bayangan lebih dalam untuk tombol aktif */
    }

    .nav-pills .nav-link:hover:not(.active) {
        color: var(--secondary-green);
        border-color: var(--secondary-green);
        background: rgba(116, 198, 157, 0.7); /* Mengubah warna latar belakang saat hover */
        transform: translateY(-2px) scale(1.02); /* Efek hover yang lebih halus */
    }


    .nav-pills .nav-link {
        font-weight: bold; /* Menebalkan teks tombol */
        text-align: center; /* Memastikan teks berada di tengah */
    }

    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(45deg, var(--accent-green), var(--pale-green));
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        transition: all 0.3s ease;
    }

    .custom-card:hover .category-icon {
        transform: scale(1.1);
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
    }

    .article-card {
        border-left: 4px solid var(--accent-green);
        background: white;
        border-radius: 0 10px 10px 0;
        transition: all 0.3s ease;
    }

    .article-card:hover {
        border-left-color: var(--primary-green);
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(45, 106, 79, 0.15);
    }

    .video-thumbnail {
        position: relative;
        border-radius: 10px;
        overflow: hidden;
    }

    .play-button {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(45, 106, 79, 0.9);
        color: white;
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .play-button:hover {
        background: var(--primary-green);
        transform: translate(-50%, -50%) scale(1.1);
    }

    .progress-indicator {
        height: 4px;
        background: var(--pale-green);
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
        border-radius: 2px;
    }

    .badge-custom {
        background: linear-gradient(45deg, var(--accent-green), var(--pale-green));
        color: white;
        border-radius: 15px;
        padding: 5px 12px;
        font-size: 0.8rem;
    }

    .custom-tab {
        color: #495057 !important;
        background-color: #f8f9fa !important;
        border: 1px solid #dee2e6 !important;
        border-bottom: none !important;
        margin-right: 2px;
        border-radius: 0.375rem 0.375rem 0 0 !important;
    }
    .custom-tab:hover {
        color: #0056b3 !important;
        background-color: #e9ecef !important;
        border-color: #dee2e6 !important;
    }
    .custom-tab.active {
        color: #0056b3 !important;
        background-color: #ffffff !important;
        border-color: #dee2e6 #dee2e6 #ffffff !important;
        font-weight: 600;
    }


</style>

<!-- Hero Section -->
<section class="hero text-white py-5 mb-5">
    <div class="container text-center position-relative">
        <h1 class="display-4 mb-3"><i class="fas fa-seedling me-3"></i>Modul Belajar Cerdas Pertanian</h1>
        <p class="lead mb-4">Kuasai teknik pertanian modern dengan pembelajaran interaktif berbasis artikel dan video</p>
        <a href="#learn" class="btn btn-light btn-lg px-4 py-2">
            <i class="fas fa-play me-2"></i>Mulai Belajar Sekarang
        </a>
    </div>
</section>


<!-- Navigation Tabs -->
<div class="container mb-4">
    <ul class="nav nav-pills justify-content-center" id="learningTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="teknik-tab" data-bs-toggle="pill" data-bs-target="#teknik" type="button" role="tab">
                <i class="fas fa-tools me-2"></i>Teknik Pertanian Cerdas
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="teknologi-tab" data-bs-toggle="pill" data-bs-target="#teknologi" type="button" role="tab">
                <i class="fas fa-microchip me-2"></i>Teknologi Agro
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pascapanen-tab" data-bs-toggle="pill" data-bs-target="#pascapanen" type="button" role="tab">
                <i class="fas fa-warehouse me-2"></i>Manajemen Pascapanen
            </button>
        </li>
    </ul>
</div>

<!-- Main Content -->
<section id="learn" class="pb-5">
    <div class="container">
        <div class="tab-content" id="learningTabContent">

            <!-- Teknik Pertanian Cerdas -->
            <div class="tab-pane fade show active" id="teknik" role="tabpanel">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="mb-3">Teknik Pertanian Cerdas</h2>
                        <p class="text-muted">Pelajari berbagai teknik modern untuk meningkatkan produktivitas pertanian</p>
                    </div>
                </div>

                <div class="row">
                    <!-- Pemilihan Varietas Unggul -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-dna text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Pemilihan Varietas Unggul</h5>
                                <p class="card-text text-muted">Panduan memilih varietas tanaman terbaik untuk kondisi lahan Anda</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">5 Artikel</span>
                                    <span class="badge badge-custom">3 Video</span>
                                </div>
                                <a href="{{ route('belajar.show', ['materi' => 'pemilihan-varietas-unggul']) }}" class="btn btn-green">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Manajemen Nutrisi Tanaman -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-leaf text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Manajemen Nutrisi Tanaman</h5>
                                <p class="card-text text-muted">Teknik pemupukan dan pengelolaan nutrisi untuk pertumbuhan optimal</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">6 Artikel</span>
                                    <span class="badge badge-custom">4 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#nutrisiModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pengendalian Hama Terpadu -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-shield-alt text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Pengendalian Hama Terpadu</h5>
                                <p class="card-text text-muted">Strategi ramah lingkungan untuk mengendalikan hama dan penyakit</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">7 Artikel</span>
                                    <span class="badge badge-custom">5 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#hamaModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Penggunaan Pupuk Efisien -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-flask text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Penggunaan Pupuk Efisien</h5>
                                <p class="card-text text-muted">Optimalisasi penggunaan pupuk untuk hasil maksimal dan ramah lingkungan</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">4 Artikel</span>
                                    <span class="badge badge-custom">3 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#pupukModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Irigasi Cerdas -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-tint text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Sistem Irigasi Cerdas</h5>
                                <p class="card-text text-muted">Pengelolaan air yang efisien dengan teknologi irigasi modern</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">5 Artikel</span>
                                    <span class="badge badge-custom">4 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#irigasiModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Rotasi Tanaman -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-sync-alt text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Rotasi Tanaman</h5>
                                <p class="card-text text-muted">Teknik rotasi untuk menjaga kesuburan tanah dan mencegah hama</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">4 Artikel</span>
                                    <span class="badge badge-custom">2 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#rotasiModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Teknologi Agro -->
            <div class="tab-pane fade" id="teknologi" role="tabpanel">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="mb-3">Teknologi Agro Modern</h2>
                        <p class="text-muted">Kenali dan manfaatkan teknologi terdepan dalam bidang pertanian</p>
                    </div>
                </div>

                <div class="row">
                    <!-- IoT Pertanian -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-wifi text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Internet of Things (IoT)</h5>
                                <p class="card-text text-muted">Penerapan sensor cerdas dan monitoring otomatis di lahan pertanian</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">6 Artikel</span>
                                    <span class="badge badge-custom">4 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#iotModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Drone Pertanian -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-helicopter text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Drone Pertanian</h5>
                                <p class="card-text text-muted">Penggunaan drone untuk monitoring, penyemprotan, dan pemetaan lahan</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">5 Artikel</span>
                                    <span class="badge badge-custom">6 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#droneModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Artificial Intelligence -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-brain text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">AI dalam Pertanian</h5>
                                <p class="card-text text-muted">Kecerdasan buatan untuk prediksi cuaca, analisis tanah, dan deteksi penyakit</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">4 Artikel</span>
                                    <span class="badge badge-custom">3 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#aiModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Manajemen Pascapanen -->
            <div class="tab-pane fade" id="pascapanen" role="tabpanel">
                <div class="row mb-4">
                    <div class="col-12 text-center">
                        <h2 class="mb-3">Manajemen Pascapanen</h2>
                        <p class="text-muted">Optimalkan nilai hasil panen dengan teknik penanganan dan penyimpanan yang tepat</p>
                    </div>
                </div>

                <div class="row">
                    <!-- Penanganan Pascapanen -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-hand-holding text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Penanganan Pascapanen</h5>
                                <p class="card-text text-muted">Teknik penanganan hasil panen untuk meminimalkan kehilangan dan kerusakan</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">5 Artikel</span>
                                    <span class="badge badge-custom">4 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#penangananModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Penyimpanan dan Pengawetan -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-archive text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Penyimpanan & Pengawetan</h5>
                                <p class="card-text text-muted">Metode penyimpanan optimal untuk mempertahankan kualitas produk</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">6 Artikel</span>
                                    <span class="badge badge-custom">3 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#penyimpananModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Pemasaran Digital -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card custom-card h-100">
                            <div class="card-body text-center p-4">
                                <div class="category-icon">
                                    <i class="fas fa-shopping-cart text-white fs-4"></i>
                                </div>
                                <h5 class="card-title">Pemasaran Digital</h5>
                                <p class="card-text text-muted">Strategi pemasaran online untuk meningkatkan nilai jual produk pertanian</p>
                                <div class="mb-3">
                                    <span class="badge badge-custom me-2">4 Artikel</span>
                                    <span class="badge badge-custom">5 Video</span>
                                </div>
                                <button class="btn btn-green" data-bs-toggle="modal" data-bs-target="#pemasaranModal">
                                    <i class="fas fa-play me-2"></i>Mulai Belajar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Template - Pemilihan Varietas Unggul -->
<div class="modal fade" id="varietasModal" tabindex="-1" aria-labelledby="varietasLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varietasLabel">
                    <i class="fas fa-dna me-2"></i>Pemilihan Varietas Unggul
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-8">
                    <!-- Tabs untuk Artikel dan Video -->
                    <ul class="nav nav-tabs mb-3" id="varietasTabs" role="tablist" style="border-bottom: 2px solid #dee2e6;">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active custom-tab" id="varietas-artikel-tab" data-bs-toggle="tab" data-bs-target="#varietas-artikel" type="button">
                                <i class="fas fa-newspaper me-2"></i>Artikel
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link custom-tab" id="varietas-video-tab" data-bs-toggle="tab" data-bs-target="#varietas-video" type="button">
                                <i class="fas fa-video me-2"></i>Video
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="varietasTabContent">
                        <!-- Tab Artikel -->
                        <div class="tab-pane fade show active" id="varietas-artikel">
                            <h5>Article</h5> <!-- Title for the article section -->

                            <div class="article-card p-3 mb-3">
                                <h6><i class="fas fa-file-alt me-2"></i>Panduan Memilih Varietas Padi Unggul</h6>
                                <p class="text-muted small mb-2">Pelajari kriteria dan karakteristik varietas padi unggul yang sesuai dengan kondisi lahan Indonesia.</p>
                                <div class="progress-indicator mb-2">
                                    <div class="progress-bar-custom" style="width: 0%"></div>
                                </div>
                                <button class="btn btn-sm btn-green">Baca Artikel</button>
                            </div>

                            <div class="article-card p-3 mb-3">
                                <h6><i class="fas fa-file-alt me-2"></i>Varietas Jagung Tahan Kekeringan</h6>
                                <p class="text-muted small mb-2">Kenali jenis-jenis jagung yang dapat bertahan dalam kondisi cuaca ekstrem.</p>
                                <div class="progress-indicator mb-2">
                                    <div class="progress-bar-custom" style="width: 0%"></div>
                                </div>
                                <button class="btn btn-sm btn-green">Baca Artikel</button>
                            </div>

                            <div class="article-card p-3 mb-3">
                                <h6><i class="fas fa-file-alt me-2"></i>Seleksi Benih Berkualitas</h6>
                                <p class="text-muted small mb-2">Teknik memilih dan menguji kualitas benih untuk hasil panen optimal.</p>
                                <div class="progress-indicator mb-2">
                                    <div class="progress-bar-custom" style="width: 0%"></div>
                                </div>
                                <button class="btn btn-sm btn-green">Baca Artikel</button>
                            </div>
                        </div>

                        <!-- Tab Video -->
                        <div class="tab-pane fade" id="varietas-video">
                            <h5>Video</h5> <!-- Title for the video section -->

                            <div class="video-thumbnail mb-3">
                                <img src="{{ asset('images/dashboard.jpg') }}" class="img-fluid" alt="Video">
                                <div class="play-button">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                            <h6>Cara Memilih Varietas Padi Unggul</h6>
                            <p class="text-muted small">Durasi: 15 menit</p>
                            <button class="btn btn-sm btn-green">Lihat Video</button>

                            <div class="video-thumbnail mb-3 mt-4">
                                <img src="{{ asset('images/dashboard.jpg') }}" class="img-fluid" alt="Video">
                                <div class="play-button">
                                    <i class="fas fa-play"></i>
                                </div>
                            </div>
                            <h6>Praktik Seleksi Benih di Lapangan</h6>
                            <p class="text-muted small">Durasi: 20 menit</p>
                            <button class="btn btn-sm btn-green">Lihat Video</button>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0" style="background: linear-gradient(45deg, var(--pale-green), var(--accent-green));">
                        <div class="card-body text-white">
                            <h6><i class="fas fa-lightbulb me-2"></i>Poin Penting</h6>
                            <ul class="list-unstyled small">
                                <li><i class="fas fa-check me-2"></i>Sesuaikan dengan kondisi iklim</li>
                                <li><i class="fas fa-check me-2"></i>Pertimbangkan jenis tanah</li>
                                <li><i class="fas fa-check me-2"></i>Pilih varietas tahan hama</li>
                                <li><i class="fas fa-check me-2"></i>Uji daya kecambah benih</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-green">Tandai Selesai</button>
            </div>
        </div>
    </div>
</div>

<!-- Script Bootstrap 5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Script untuk interaktivitas -->
<script>
    // Progress tracking untuk artikel
    document.querySelectorAll('.article-card button').forEach(button => {
        button.addEventListener('click', function() {
            const progressBar = this.closest('.article-card').querySelector('.progress-bar-custom');
            progressBar.style.width = '100%';
            this.innerHTML = '<i class="fas fa-check me-2"></i>Selesai Dibaca';
            this.classList.remove('btn-green');
            this.classList.add('btn-success');
        });
    });

    // Video play simulation
    document.querySelectorAll('.play-button').forEach(button => {
        button.addEventListener('click', function() {
            alert('Video akan dimulai...');
            // Di implementasi nyata, ini akan membuka video player
        });
    });

    // Smooth scroll untuk hero button
    document.querySelector('a[href="#learn"]').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#learn').scrollIntoView({
            behavior: 'smooth'
        });
    });
</script>

@endsection
