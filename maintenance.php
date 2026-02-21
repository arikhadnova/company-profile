<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeliharaan Sistem - Go Circular Solutions Indonesia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --glass: rgba(255, 255, 255, 0.7);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f0f4f8;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: var(--text-main);
        }

        /* Animated Mesh Gradient Background */
        .bg-gradient {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.15) 0, transparent 50%),
                radial-gradient(at 50% 0%, rgba(139, 92, 246, 0.15) 0, transparent 50%),
                radial-gradient(at 100% 0%, rgba(236, 72, 153, 0.15) 0, transparent 50%),
                radial-gradient(at 50% 50%, rgba(59, 130, 246, 0.1) 0, transparent 50%),
                radial-gradient(at 0% 100%, rgba(139, 92, 246, 0.15) 0, transparent 50%),
                radial-gradient(at 100% 100%, rgba(59, 130, 246, 0.15) 0, transparent 50%);
            animation: gradient-move 15s ease infinite alternate;
        }

        @keyframes gradient-move {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 540px;
            padding: 3rem;
            background: var(--glass);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .illustration {
            width: 180px;
            height: 180px;
            margin: 0 auto 2rem;
            animation: float 4s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.025em;
            color: #0f172a;
        }

        p {
            font-size: 1.1rem;
            line-height: 1.6;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            background: rgba(59, 130, 246, 0.1);
            color: var(--primary);
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            background: var(--primary);
            border-radius: 50%;
            margin-right: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }

        .footer {
            margin-top: 1rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .footer a:hover {
            color: var(--primary-dark);
        }

        .shapes div {
            position: absolute;
            background: linear-gradient(45deg, var(--primary), #8b5cf6);
            border-radius: 50%;
            z-index: -1;
            filter: blur(60px);
            opacity: 0.2;
        }

        .shape-1 { width: 300px; height: 300px; top: -100px; right: -50px; }
        .shape-2 { width: 250px; height: 250px; bottom: -50px; left: -50px; }

        @media (max-width: 640px) {
            .container { padding: 2rem 1.5rem; }
            h1 { font-size: 1.5rem; }
            p { font-size: 1rem; }
            .illustration { width: 140px; height: 140px; }
        }
    </style>
</head>
<body>
    <div class="bg-gradient"></div>
    <div class="shapes">
        <div class="shape-1"></div>
        <div class="shape-2"></div>
    </div>

    <div class="container">
        <div class="status-badge">
            <span class="status-dot"></span>
            Sedang Pemeliharaan
        </div>
        
        <div class="illustration">
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <circle cx="100" cy="100" r="80" fill="#3b82f6" fill-opacity="0.1"/>
                <path d="M100 40V60M100 140V160M160 100H140M60 100H40" stroke="#3b82f6" stroke-width="4" stroke-linecap="round"/>
                <rect x="70" y="70" width="60" height="60" rx="12" fill="none" stroke="#3b82f6" stroke-width="6"/>
                <path d="M85 90L100 105L115 90" fill="none" stroke="#3b82f6" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M70 130C70 130 85 115 100 115C115 115 130 130 130 130" stroke="#3b82f6" stroke-width="4" stroke-linecap="round"/>
            </svg>
        </div>

        <h1>Sedang Dalam Pemeliharaan</h1>
        <p>Mohon maaf atas ketidaknyamanannya. Kami sedang memperbarui sistem kami untuk memberikan pengalaman yang lebih luar biasa bagi Anda.</p>
        
        <div class="footer">
            &copy; <?= date('Y'); ?> <a href="#">Go Circular Solutions Indonesia</a>
        </div>
    </div>
</body>
</html>
