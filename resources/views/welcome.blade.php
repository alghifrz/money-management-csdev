<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Money Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 0;
            color: #333;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .welcome-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
        }

        .welcome-card {
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .welcome-header {
            background: linear-gradient(135deg, #3279d0, #1e5799);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .welcome-header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
            position: relative;
            z-index: 2;
        }

        .welcome-header p {
            opacity: 0.9;
            margin-bottom: 0;
            position: relative;
            z-index: 2;
        }

        .welcome-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
        }

        .welcome-body {
            padding: 2.5rem 2rem;
        }

        .form-control {
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            font-size: 1.1rem;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(50, 121, 208, 0.25);
            border-color: #3279d0;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3279d0, #1e5799);
            border: none;
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s;
            width: 100%;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e5799, #3279d0);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(50, 121, 208, 0.3);
        }

        label {
            font-weight: 500;
            margin-bottom: 0.5rem;
            display: block;
        }

        .welcome-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: white;
            position: relative;
            z-index: 2;
        }

        .error-text {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.2rem;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <div class="welcome-card">
            <div class="welcome-header">
                <i class="fas fa-wallet welcome-icon"></i>
                <h1>Money Management</h1>
                <p>Aplikasi untuk mengelola keuangan pribadi Anda</p>
            </div>
            <div class="welcome-body">
                <form action="{{ route('welcome.save') }}" method="POST">
                    @csrf

                    <label for="username">Masukkan Nama Anda</label>
                    <input
                        type="text"
                        class="form-control @error('username') is-invalid @enderror"
                        id="username"
                        name="username"
                        placeholder="Contoh: John Doe"
                        value="{{ old('username', $profile->username ?? '') }}"
                        autofocus
                        required
                    >
                    @error('username')
                        <div class="error-text">{{ $message }}</div>
                    @enderror

                    <p class="text-muted mt-3 mb-4">
                        Nama Anda akan ditampilkan di aplikasi untuk personalisasi pengalaman.
                    </p>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-arrow-right me-2"></i> Mulai Gunakan Aplikasi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
