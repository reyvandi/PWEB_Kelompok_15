@extends('layouts.app')

@section('title', 'Materi Belajar')

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

    .article-card {
        border-left: 4px solid var(--accent-green);
        background: white;
        border-radius: 0 10px 10px 0;
        transition: all 0.3s ease;
        margin-bottom: 20px;
        padding: 20px;
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
        margin-bottom: 15px;
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

    .badge-custom {
        background: linear-gradient(45deg, var(--accent-green), var(--pale-green));
        color: white;
        border-radius: 15px;
        padding: 5px 12px;
        font-size: 0.8rem;
    }

    .nav-pills .nav-link.active {
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
    }

    .progress-indicator {
        height: 4px;
        background: var(--pale-green);
        border-radius: 2px;
        overflow: hidden;
        margin: 10px 0;
    }

    .progress-bar-custom {
        height: 100%;
        background: linear-gradient(45deg, var(--primary-green), var(--secondary-green));
        border-radius: 2px;
    }

    .sidebar-card {
        background: linear-gradient(45deg, var(--pale-green), var(--accent-green));
        color: white;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <h2 class="mb-4 text-capitalize">
                @if($materi == 'pemilihan-varietas')
                    <i class="fas fa-dna me-2"></i>Pemilihan Varietas Unggul
                @elseif($materi == 'manajemen-nutrisi')
                    <i class="fas fa-leaf me-2"></i>Manajemen Nutrisi Tanaman
                @else
                    {{ ucwords(str_replace('-', ' ', $materi)) }}
                @endif
            </h2>

            <ul class="nav nav-pills mb-4" id="materiTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="artikel-tab" data-bs-toggle="pill" data-bs-target="#artikel" type="button">
                        <i class="fas fa-newspaper me-2"></i>Artikel
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="video-tab" data-bs-toggle="pill" data-bs-target="#video" type="button">
                        <i class="fas fa-video me-2"></i>Video
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="materiTabContent">
                <!-- Artikel Tab -->
                <div class="tab-pane fade show active" id="artikel">
                    @forelse($articles as $article)
                        <div class="article-card">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <h5>{{ $article->title }}</h5>
                                <span class="badge badge-custom">{{ $article->read_time }} min read</span>
                            </div>
                            <p class="text-muted">{{ Str::limit($article->excerpt, 200) }}</p>
                            <div class="progress-indicator">
                                <div class="progress-bar-custom" style="width: {{ auth()->check() && auth()->user()->hasRead($article->id) ? '100%' : '0%' }}"></div>
                            </div>
                            <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-sm"
                               style="background: linear-gradient(45deg, var(--primary-green), var(--secondary-green)); color: white;">
                                @if(auth()->check() && auth()->user()->hasRead($article->id))
                                    <i class="fas fa-check me-2"></i>Baca Ulang
                                @else
                                    <i class="fas fa-book-open me-2"></i>Baca Artikel
                                @endif
                            </a>
                        </div>
                    @empty
                        <div class="alert alert-info">
                            Tidak ada artikel tersedia untuk materi ini.
                        </div>
                    @endforelse
                </div>

                <!-- Video Tab -->
                <div class="tab-pane fade" id="video">
                    @forelse($videos as $video)
                        <div class="video-thumbnail">
                            <img src="{{ $video->thumbnail ? asset('storage/'.$video->thumbnail) : asset('images/default-video-thumbnail.jpg') }}"
                                 class="img-fluid" alt="{{ $video->title }}">
                            <div class="play-button" onclick="window.location='{{ route('articles.show', $video->slug) }}'">
                                <i class="fas fa-play"></i>
                            </div>
                        </div>
                        <h5>{{ $video->title }}</h5>
                        <p class="text-muted small">
                            <i class="fas fa-clock me-2"></i>Durasi: {{ $video->duration }} menit
                        </p>
                        <a href="{{ route('articles.show', $video->slug) }}" class="btn btn-sm mb-4"
                           style="background: linear-gradient(45deg, var(--primary-green), var(--secondary-green)); color: white;">
                            <i class="fas fa-play me-2"></i>Tonton Video
                        </a>
                    @empty
                        <div class="alert alert-info">
                            Tidak ada video tersedia untuk materi ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="sidebar-card">
                <h5><i class="fas fa-lightbulb me-2"></i>Poin Penting</h5>
                <ul class="list-unstyled">
                    @if($materi == 'pemilihan-varietas')
                        <li><i class="fas fa-check me-2"></i>Sesuaikan dengan kondisi iklim</li>
                        <li><i class="fas fa-check me-2"></i>Pertimbangkan jenis tanah</li>
                        <li><i class="fas fa-check me-2"></i>Pilih varietas tahan hama</li>
                        <li><i class="fas fa-check me-2"></i>Uji daya kecambah benih</li>
                    @elseif($materi == 'manajemen-nutrisi')
                        <li><i class="fas fa-check me-2"></i>Analisis tanah terlebih dahulu</li>
                        <li><i class="fas fa-check me-2"></i>Gunakan pupuk berimbang</li>
                        <li><i class="fas fa-check me-2"></i>Perhatikan fase pertumbuhan</li>
                        <li><i class="fas fa-check me-2"></i>Hindari pemupukan berlebihan</li>
                    @else
                        <li><i class="fas fa-check me-2"></i>Pelajari materi dengan seksama</li>
                        <li><i class="fas fa-check me-2"></i>Praktikkan di lapangan</li>
                        <li><i class="fas fa-check me-2"></i>Catat perkembangan</li>
                        <li><i class="fas fa-check me-2"></i>Diskusikan dengan petani lain</li>
                    @endif
                </ul>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5><i class="fas fa-chart-line me-2"></i>Progress Belajar</h5>
                    {{-- <div class="progress mb-3" style="height: 20px;">
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: {{ auth()->check() ? auth()->user()->learningProgress($materi) : '0' }}%">
                            {{ auth()->check() ? auth()->user()->learningProgress($materi) : '0' }}%
                        </div>
                    </div>
                    <p class="small text-muted">
                        Anda telah menyelesaikan {{ auth()->check() ? auth()->user()->completedItems($materi) : '0' }} dari
                        {{ $articles->count() + $videos->count() }} materi.
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<script>
    // Track reading progress
    document.addEventListener('DOMContentLoaded', function() {
        // In a real implementation, you would track scroll position or video watch time
        // and update the progress bars accordingly via AJAX

        // Example for article read tracking
        const articleLinks = document.querySelectorAll('#artikel a');
        articleLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                // In a real app, you would send an AJAX request to mark as read
                const progressBar = this.closest('.article-card').querySelector('.progress-bar-custom');
                progressBar.style.width = '100%';
                this.innerHTML = '<i class="fas fa-check me-2"></i>Baca Ulang';
            });
        });
    });
</script>
@endsection
