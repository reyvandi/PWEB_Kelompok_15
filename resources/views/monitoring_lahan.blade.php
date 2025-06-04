@extends('layouts.app')

@section('title', 'Monitoring Lahan')

@section('styles')
    <style>
        body {
            background-color: #ffffff;

            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #28a745;
            /* Hijau untuk navbar */
        }

        .navbar-brand,
        .nav-link {
            color: #ffffff !important;
        }

        .hero-section {
            background: url('{{ asset('images/dashboard.jpg') }}') no-repeat center center;

            background-size: cover;
            color: white;
            padding: 80px 0;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 8px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #6da967;
            /* Biru gelap untuk header card */
            color: white;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            padding: 15px 20px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .card-body {
            padding: 25px;
        }

        .info-box {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2em;
            margin-bottom: 15px;
            font-weight: 600;
            color: #333;
        }

        .info-box i {
            margin-right: 10px;
            color: #28a745;
        }

        .form-select {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px 15px;
        }

        .chart-container {
            position: relative;
            height: 400px;
            /* Tinggi default untuk grafik */
            width: 100%;
        }

        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 40px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .text-success-custom {
            color: #28a745;
        }

        .text-info-custom {
            color: #17a2b8;
        }

        .text-warning-custom {
            color: #ffc107;
        }

        .text-danger-custom {
            color: #dc3545;
        }

        .anomaly-text {
            color: #dc3545;
            font-weight: bold;
        }

        #searchResult {
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-height: 200px;
            overflow-y: auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .list-group-item {
            cursor: pointer;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        #searchResult {
            border: 1px solid rgb(255, 0, 0);
        }
    </style>
@endsection

@section('content')
    <div class="hero-section">
        <div class="container">
            <h1>Dashboard Monitoring Lahan Cerdas</h1>
            <p class="lead">Pantau kondisi lahan Anda dengan data yang cerdas dan mudah dipahami.</p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-area me-2"></i>Dashboard Lahan
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="location-input-group">
                                        <label class="form-label fw-bold">
                                            <i class="fas fa-map-marker-alt me-2 text-success"></i>Lokasi Lahan
                                        </label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="searchLocation"
                                                placeholder="Masukkan nama lokasi" style="border-radius: 8px 0 0 8px;"
                                                autocomplete="off">
                                            <button class="btn btn-success" type="button" id="findLocation"
                                                style="border-radius: 0 8px 8px 0;">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                        <div id="searchResult" class="list-group mt-2" style="display:none"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3">Kondisi Lahan Saat Ini (Simulasi Data)</h5>
                        <div class="row text-center mb-4">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-thermometer-half"></i> Suhu Tanah: <span id="suhuTanah">28°C</span>
                                    <p class="mb-0 text-muted" id="suhuStatus"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-tint"></i> Kelembaban Tanah: <span id="kelembabanTanah">75%</span>
                                    <p class="mb-0 text-muted" id="kelembabanStatus"></p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <i class="fas fa-cloud-showers-heavy"></i> Curah Hujan Hari Ini: <span id="curahHujan">5
                                        mm</span>
                                    <p class="mb-0 text-muted" id="curahHujanStatus"></p>
                                </div>
                            </div>
                        </div>

                        <h5 class="mb-3">Kondisi Ideal Rekomendasi (berdasarkan Tanaman)</h5>
                        <div class="row text-center mb-4">
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <i class="fas fa-thermometer-three-quarters text-success-custom"></i> Suhu Ideal: <span
                                        id="idealSuhu">25-30°C</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <i class="fas fa-water text-info-custom"></i> Kelembaban Ideal: <span
                                        id="idealKelembaban">60-80%</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-light">
                                    <i class="fas fa-cloud-rain text-warning-custom"></i> Curah Hujan Ideal: <span
                                        id="idealCurahHujan">100-200 mm/bulan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-history me-2"></i>Riwayat & Tren Data
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Suhu Tanah Historis (Mingguan)</h6>
                                <div class="chart-container">
                                    <canvas id="suhuTanahChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Kelembaban Tanah Historis (Mingguan)</h6>
                                <div class="chart-container">
                                    <canvas id="kelembabanTanahChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h6 class="mb-3">Curah Hujan Historis (Bulanan)</h6>
                                <div class="chart-container">
                                    <canvas id="curahHujanChart"></canvas>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Analisis Anomali Historis</h6>
                                <div class="alert alert-info small">
                                    <p class="mb-1"><i class="fas fa-chart-line me-1"></i> *Suhu Tanah:* Terendah 22°C
                                        (2 minggu lalu), Tertinggi 35°C (3 hari lalu).</p>
                                    <p class="mb-1"><i class="fas fa-water me-1"></i> *Kelembaban Tanah:* Periode kering
                                        terpanjang: 5 hari (bulan lalu).</p>
                                    <p class="mb-0"><i class="fas fa-cloud-showers-heavy me-1"></i> *Curah Hujan:* Hari
                                        tanpa hujan terpanjang: 10 hari (bulan lalu).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@auth
    @if(auth()->user()->kelurahan)
        <div class="alert alert-info mt-3">
            Lokasi lahan Anda:
            {{ auth()->user()->kelurahan }},
            {{ auth()->user()->kecamatan }},
            {{ auth()->user()->kota }},
            {{ auth()->user()->provinsi }}
        </div>
    @endif
@endauth

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).on('click', '.list-group-item', function() {
            var selectedLocation = $(this).text();
            var kelurahan = $(this).data('kelurahan');
            var kecamatan = $(this).data('kecamatan');
            var kota = $(this).data('kota');
            var provinsi = $(this).data('provinsi');

            $('#searchLocation').val(selectedLocation);
            $('#searchResult').hide();

            // Save the location to user's profile
            $.ajax({
                url: '/save-location',
                method: 'POST',
                data: {
                    kelurahan: kelurahan,
                    kecamatan: kecamatan,
                    kota: kota,
                    provinsi: provinsi,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Optionally show a success message
                        console.log('Location saved successfully');
                    }
                },
                error: function() {
                    alert('Error saving location');
                }
            });

            // Continue with weather data fetching
            $.ajax({
                url: '/weather',
                method: 'GET',
                data: { city: kelurahan, region: kecamatan },
                success: function(weatherData) {
                    if (weatherData.error) {
                        alert(weatherData.error);
                    } else {
                        $('#suhuTanah').text(weatherData.current.temperature + '°C');
                        $('#kelembabanTanah').text(weatherData.current.humidity + '%');
                        $('#curahHujan').text(weatherData.current.rain + ' mm');
                        updateCharts(weatherData.history);
                    }
                },
                error: function() {
                    alert('Error fetching weather data');
                }
            });
        });

    function updateCharts(historyData) {
        // Prepare data for charts
        const dates = historyData.map(item => item.date);
        const temperatures = historyData.map(item => item.temperature);
        const humidities = historyData.map(item => item.humidity);
        const rains = historyData.map(item => item.rain);

        // Update or create temperature chart
        updateChart('suhuTanahChart', 'Suhu Tanah (°C)', dates, temperatures, 'rgba(255, 99, 132, 0.7)');

        // Update or create humidity chart
        updateChart('kelembabanTanahChart', 'Kelembaban Tanah (%)', dates, humidities, 'rgba(54, 162, 235, 0.7)');

        // Update or create rain chart
        updateChart('curahHujanChart', 'Curah Hujan (mm)', dates, rains, 'rgba(75, 192, 192, 0.7)');
    }

    function updateChart(chartId, label, labels, data, backgroundColor) {
        const ctx = document.getElementById(chartId).getContext('2d');

        // Destroy existing chart if it exists
        if (window[chartId + 'Instance']) {
            window[chartId + 'Instance'].destroy();
        }

        window[chartId + 'Instance'] = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    backgroundColor: backgroundColor,
                    borderColor: backgroundColor.replace('0.7', '1'),
                    borderWidth: 2,
                    fill: false,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: false
                    }
                }
            }
        });
    }
    </script>
    <script>
        $(document).ready(function() {
            // Set initial default values to "-"
            $('#suhuTanah').text('-');
            $('#kelembabanTanah').text('-');
            $('#curahHujan').text('-');

            // Listen for input in the search box
            $('#searchLocation').on('keyup', function() {
                var query = $(this).val();

                if (query.length > 2) {
                    $.ajax({
                        url: '/monitoring-lahan/search-location',
                        method: 'GET',
                        data: { query: query },
                        success: function(data) {
                            $('#searchResult').html('');
                            if (data.length > 0) {
                                data.forEach(function(location) {
                                    $('#searchResult').append(
                                        '<a href="#" class="list-group-item list-group-item-action" ' +
                                        'data-kelurahan="' + location.kelurahan_nama + '" ' +
                                        'data-kecamatan="' + location.kecamatan_nama + '" ' +
                                        'data-kota="' + location.kota_nama + '" ' +
                                        'data-provinsi="' + location.provinsi_nama + '">' +
                                        location.kelurahan_nama + ', ' + location.kecamatan_nama + ', ' +
                                        location.kota_nama + ', ' + location.provinsi_nama + '</a>'
                                    );
                                });
                                $('#searchResult').show();
                            } else {
                                $('#searchResult').hide();
                            }
                        },
                        error: function() {
                            alert('Error fetching search results');
                        }
                    });
                } else {
                    $('#searchResult').hide();
                    $('#suhuTanah').text('-');
                    $('#kelembabanTanah').text('-');
                    $('#curahHujan').text('-');
                }
            });

            // Handle click event on a suggestion
            $(document).on('click', '.list-group-item', function() {

            });
        });
    </script>




@endsection
