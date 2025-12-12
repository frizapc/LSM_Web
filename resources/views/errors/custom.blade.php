<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Error' }} | {{ $code ?? '' }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="{{ asset('icons/bootstrap-icons.min.css') }}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }
        .error-container {
            background: linear-gradient(145deg, var(--purple-dark), var(--purple-primary));
            padding: 3rem 2rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 450px;
        }
        .error-code {
            font-size: 5rem;
            font-weight: 800;
            color: #fff;
        }
        .error-message {
            margin-top: 0.5rem;
            margin-bottom: 2rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #f5f5f5;
        }
        .btn-home {
            background-color: var(--purple-secondary);
            border: none;
            color: #fff;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .btn-home:hover {
            background-color: var(--purple-dark);
            transform: translateY(-2px);
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-code">{{ $code ?? 'Error' }}</div>
        <div class="error-message">{{ $message ?? 'Unexpected Error' }}</div>
        <a href="{{ url('/login') }}" class="btn-home">← Kembali</a>
    </div>
</body>
</html>

<!-- Buat url fallback agar dapat menyesuaikan user berada pada situasi tertentu seperti harus login atau kembali ke beranda -->