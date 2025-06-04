<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SahabatLadang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/login.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            max-width: 100%;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 128, 0, 0.1);
            border: none;
        }

        .btn-green {
            background-color: #4CAF50;
            color: white;
        }
        .btn-green:hover {
            background-color: #45a049;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #2e7d32;
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
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-6 col-lg-6 px-3">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <div class="logo">🌱 SahabatLadang</div>
                    <h4 class="mt-2">Masuk ke Akun Anda</h4>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <form method="POST" action="/login">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <div class="password-container">
                            <input type="password" class="form-control" name="password" id="password" required>
                            <i class="bi bi-eye-slash password-toggle" id="togglePassword"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-green w-100">Login</button>
                </form>
                <p class="mt-3 text-center">
                    Belum punya akun? <a href="/register" class="text-success">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>
</html>
