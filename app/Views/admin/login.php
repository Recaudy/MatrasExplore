<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Panel - Wisata Matras</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        :root {
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.5);
        }
        
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: var(--font-sans);
            background-color: #0f172a;
            background-image: 
                radial-gradient(at 40% 20%, hsla(180,100%,25%,0.3) 0px, transparent 50%),
                radial-gradient(at 80% 0%, hsla(189,100%,35%,0.3) 0px, transparent 50%),
                radial-gradient(at 0% 50%, hsla(210,100%,20%,0.3) 0px, transparent 50%),
                radial-gradient(at 80% 50%, hsla(180,100%,20%,0.3) 0px, transparent 50%),
                radial-gradient(at 0% 100%, hsla(180,100%,15%,0.3) 0px, transparent 50%),
                radial-gradient(at 80% 100%, hsla(210,100%,15%,0.3) 0px, transparent 50%),
                radial-gradient(at 0% 0%, hsla(180,100%,10%,0.3) 0px, transparent 50%);
            background-attachment: fixed;
            color: #f8fafc;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-shape {
            position: absolute;
            filter: blur(80px);
            z-index: -1;
            border-radius: 50%;
            animation: float 15s infinite ease-in-out alternate;
        }
        .shape-1 {
            width: 400px;
            height: 400px;
            background: rgba(10, 168, 167, 0.2);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        .shape-2 {
            width: 500px;
            height: 500px;
            background: rgba(15, 23, 42, 0.8);
            bottom: -200px;
            right: -100px;
            animation-delay: -5s;
        }
        .shape-3 {
            width: 300px;
            height: 300px;
            background: rgba(13, 148, 136, 0.2);
            top: 40%;
            left: 50%;
            animation-delay: -10s;
        }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(50px, 30px) scale(1.1); }
            100% { transform: translate(-30px, 50px) scale(0.9); }
        }

        .login-container {
            width: 100%;
            max-width: 460px;
            position: relative;
            z-index: 10;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: var(--glass-shadow), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            padding: 3rem 2.5rem;
            position: relative;
            overflow: hidden;
        }

        /* Subtle glowing edge */
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(10, 168, 167, 0.5), transparent);
            opacity: 0.8;
        }

        .logo-box {
            width: 64px;
            height: 64px;
            background: linear-gradient(135deg, var(--color-primary), #0d9488);
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            box-shadow: 0 10px 25px -5px rgba(10, 168, 167, 0.4), inset 0 1px 0 rgba(255,255,255,0.2);
        }

        .logo-box svg {
            width: 32px;
            height: 32px;
            stroke-width: 2;
        }

        .title {
            font-family: var(--font-heading);
            font-size: 2rem;
            font-weight: 800;
            color: #ffffff;
            margin: 0 0 8px;
            text-align: center;
            letter-spacing: -0.02em;
        }

        .subtitle {
            color: #94a3b8;
            font-size: 1rem;
            margin: 0 0 2.5rem;
            text-align: center;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #cbd5e1;
            margin-bottom: 8px;
            letter-spacing: 0.02em;
            text-transform: uppercase;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 44px;
            background: rgba(15, 23, 42, 0.6);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 1rem;
            color: #ffffff;
            outline: none;
            transition: all 0.3s ease;
            font-family: var(--font-sans);
        }
        
        .form-control::placeholder {
            color: #64748b;
        }

        .form-control:focus {
            background: rgba(15, 23, 42, 0.8);
            border-color: var(--color-primary);
            box-shadow: 0 0 0 4px rgba(10, 168, 167, 0.15);
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 39px;
            color: #64748b;
            transition: color 0.3s ease;
        }

        .form-control:focus + .input-icon,
        .form-control:not(:placeholder-shown) + .input-icon {
            color: var(--color-primary);
        }

        .btn-login {
            width: 100%;
            padding: 16px;
            font-size: 1.05rem;
            font-weight: 700;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--color-primary), #0d9488);
            color: white;
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 25px -5px rgba(10, 168, 167, 0.4), inset 0 1px 0 rgba(255,255,255,0.2);
            transition: all 0.3s ease;
            font-family: var(--font-sans);
            position: relative;
            overflow: hidden;
            margin-top: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -5px rgba(10, 168, 167, 0.5), inset 0 1px 0 rgba(255,255,255,0.2);
        }
        
        .btn-login:active {
            transform: translateY(1px);
        }

        .alert {
            padding: 1rem 1.25rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            font-size: 0.9rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: slideIn 0.4s ease-out forwards;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #fca5a5;
        }

        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #6ee7b7;
        }

        .back-link {
            margin-top: 2.5rem;
            text-align: center;
        }

        .back-link a {
            color: #94a3b8;
            font-weight: 600;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.95rem;
            transition: color 0.3s ease;
        }

        .back-link a:hover {
            color: #ffffff;
        }
        
        .back-link a svg {
            transition: transform 0.3s ease;
        }
        
        .back-link a:hover svg {
            transform: translateX(-4px);
        }
    </style>
</head>
<body>
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

    <div class="login-container">
        <div class="glass-card">
            <div class="logo-box">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
                    <path d="M2 17l10 5 10-5"></path>
                    <path d="M2 12l10 5 10-5"></path>
                </svg>
            </div>
            <h2 class="title">Admin Portal</h2>
            <p class="subtitle">Wisata Matras Bangka Island</p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                    <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/attempt-login') ?>" method="POST">
                <div class="form-group">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" required placeholder="admin@wisatamatras.com">
                    <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                </div>

                <div class="form-group">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control" required placeholder="••••••••">
                    <svg class="input-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                </div>

                <button type="submit" class="btn-login">
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="back-link">
                <a href="<?= base_url() ?>">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>
