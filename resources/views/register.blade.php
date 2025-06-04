<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar | SahabatLadang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #ffffff, hsl(108, 40%, 38%));
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: 600;
            color: #2e7d32;
        }
        .btn-green {
            background-color: #43a047;
            color: white;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-green:hover {
            background-color: #2e7d32;
        }
        .left-img {
            background: url('{{ asset('images/register.png') }}') no-repeat center center;
            background-size: cover;
            border-top-left-radius: 1.5rem;
            border-bottom-left-radius: 1.5rem;
        }
        .right-form {
            padding: 3rem;
        }
        @media (max-width: 768px) {
            .left-img {
                display: none;
            }
            .right-form {
                padding: 2rem;
            }
        }
        .password-container {
        position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #666;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="card overflow-hidden">
                <div class="row g-0">
                    <!-- Left image (hidden on mobile) -->
                    <div class="col-md-6 left-img d-none d-md-block"></div>

                    <!-- Right form -->
                    <div class="col-md-6 right-form">
                        <h3 class="mb-4 text-success text-center">Daftar sebagai Sahabat Ladang 🌾</h3>

                        @if(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="/register">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control  " required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kata Sandi</label>
                                <div class="password-container">
                                    <input type="password" name="password" id="password" class="form-control" required>
                                    <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-green">Daftar Sekarang</button>
                            </div>
                        </form>

                        <p class="text-center mt-3">
                            Sudah punya akun? <a href="/login" class="text-success fw-semibold">Login di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
{{-- SCRIPT MATA PADA PASSWORD --}}
<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function () {
        // Toggle type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);

        // Toggle icon
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
</script>
</body>
</body>
</html>
