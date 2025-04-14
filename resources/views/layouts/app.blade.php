<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Management</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color: #3279d0;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }

        body {
            background-color: #f5f8fa;
            color: #444;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(135deg, #3279d0, #1e5799) !important;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }

        .navbar-brand {
            font-weight: 600;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
            margin-bottom: 25px;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        .btn {
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-sm {
            padding: 0.25rem 1rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3279d0, #1e5799);
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #1e5799, #3279d0);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(50, 121, 208, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20883b);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #20883b, #28a745);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border: none;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333, #dc3545);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .btn-outline-primary {
            border-color: #3279d0;
            color: #3279d0;
        }

        .btn-outline-primary:hover {
            background-color: #3279d0;
            color: white;
        }

        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }

        .list-group-item {
            border: none;
            padding: 1rem 1.25rem;
            margin-bottom: 8px;
            border-radius: 8px !important;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
        }

        .list-group-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Style untuk menampilkan warna pada dompet */
        .wallet-item {
            border-left-width: 4px;
            border-left-style: solid;
            padding-left: 1rem;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0 8px;
        }

        .table thead th {
            border: none;
            font-weight: 600;
            color: #6c757d;
            padding: 0.75rem 1.25rem;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border-radius: 8px;
            margin-bottom: 8px;
            background-color: white;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            border: none;
            vertical-align: middle;
        }

        .table tbody tr td:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }

        .table tbody tr td:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }

        .text-success {
            color: #28a745 !important;
        }

        .text-danger {
            color: #dc3545 !important;
        }

        .form-control, .form-select {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .form-control:focus, .form-select:focus {
            box-shadow: 0 0 0 3px rgba(50, 121, 208, 0.2);
            border-color: #3279d0;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-bottom: none;
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: none;
            padding: 1.5rem;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        /* Summary card styles */
        .summary-card {
            border-radius: 15px;
            padding: 1.5rem;
            transition: all 0.3s;
            height: 100%;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .summary-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%) skewX(-15deg);
            transition: all 0.5s;
        }

        .summary-card:hover::before {
            transform: translateX(100%) skewX(-15deg);
        }

        .summary-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            opacity: 0.8;
        }

        .summary-card h6 {
            opacity: 0.8;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .summary-card h4 {
            font-weight: 700;
            font-size: 1.75rem;
        }

        .bg-primary-gradient {
            background: linear-gradient(135deg, #3279d0, #1e5799);
        }

        .bg-success-gradient {
            background: linear-gradient(135deg, #28a745, #20883b);
        }

        .bg-danger-gradient {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }

        /* Fix untuk modal */
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
            padding: 0 !important;
        }

        .modal-dialog {
            margin: 2rem auto;
            max-width: 500px;
            padding: 0;
        }

        .modal-content {
            position: relative;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3) !important;
        }

        /* Fixes for nested modals */
        .modal-backdrop + .modal-backdrop {
            z-index: 1041 !important;
        }

        body.modal-open {
            overflow: auto !important;
            padding-right: 0 !important;
        }

        /* Add higher z-index for modals in focus */
        .modal.show {
            opacity: 1;
        }
    </style>
</head>
<body style="font-family: Poppins">
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container justify-content-center">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="fas fa-wallet me-2"></i>Money Management
            </a>
        </div>
    </nav>

    <div class="container mb-5">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($username ?? null)
            <div class="welcome-banner mb-4">
                <h4 class="text-center">
                    <i class="fas fa-user-circle me-2"></i> Hai, selamat datang kembali <span class="fw-bold text-primary">{{ $username }}</span>!
                </h4>
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Enable tooltips
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            });
        });

        // Add animation to numbers
        document.querySelectorAll('.animate-number').forEach(function(el) {
            // Mengambil nilai asli dan menghapus semua karakter non-numerik kecuali angka dan titik (.)
            const originalText = el.innerText;
            // Ekstrak angka dengan mempertahankan titik sebagai pemisah ribuan
            const cleanedText = originalText.replace(/[^\d.]/g, '');
            // Ganti titik dengan string kosong untuk mendapatkan nilai numerik murni
            const numericValue = cleanedText.replace(/\./g, '');
            const finalValue = parseFloat(numericValue);

            const duration = 1500; // animation duration in ms
            const start = 0;
            const increment = finalValue / (duration / 16); // 60fps

            let currentValue = start;
            const format = el.dataset.format || "Rp #";

            function easeOutQuart(x) {
                return 1 - Math.pow(1 - x, 4);
            }

            function animate() {
                const progress = currentValue / finalValue;
                const easedProgress = easeOutQuart(progress);
                const newValue = finalValue * easedProgress;

                if (currentValue < finalValue) {
                    currentValue += increment;
                    el.textContent = format.replace('#', new Intl.NumberFormat('id-ID', {
                        maximumFractionDigits: 0,
                        minimumFractionDigits: 0
                    }).format(Math.round(newValue)));
                    requestAnimationFrame(animate);
                } else {
                    el.textContent = format.replace('#', new Intl.NumberFormat('id-ID', {
                        maximumFractionDigits: 0,
                        minimumFractionDigits: 0
                    }).format(Math.round(finalValue)));
                }
            }

            animate(); // Memanggil fungsi animate untuk memulai animasi
        });
    </script>

    @yield('scripts')
</body>
</html>
