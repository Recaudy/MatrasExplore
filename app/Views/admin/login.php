<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wisata Matras</title>
    <link rel="icon" type="image/png" href="<?= base_url('uploads/favicon/MatrasExplore.png') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary: #065f46; /* Dark teal matching the screenshot */
            --primary-hover: #047857;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --border-color: #cbd5e1;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #e6f3f0; /* Light greenish-cyan background */
            background-image: radial-gradient(#cbd5e1 1.5px, transparent 1.5px);
            background-size: 32px 32px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 10px 40px -10px rgba(0,0,0,0.05);
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 1.25rem;
        }

        .logo {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }

        .title {
            text-align: center;
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .subtitle {
            text-align: center;
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            color: #94a3b8;
            width: 18px;
            height: 18px;
            pointer-events: none;
            transition: color 0.2s;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px 12px 42px;
            font-size: 0.95rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-dark);
            font-family: inherit;
            transition: border-color 0.2s;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }

        .form-control:focus + .input-icon {
            color: var(--primary);
        }

        .eye-icon {
            position: absolute;
            right: 14px;
            color: #94a3b8;
            cursor: pointer;
            width: 18px;
            height: 18px;
            transition: color 0.2s;
        }
        
        .eye-icon:hover {
            color: var(--text-dark);
        }


        .btn-login {
            width: 100%;
            padding: 14px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 1rem;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 1rem;
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            background-color: var(--primary-hover);
        }

        .back-link {
            text-align: center;
        }

        .back-link a {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--text-dark);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            transition: opacity 0.2s;
        }

        .back-link a:hover {
            opacity: 0.8;
        }

        .alert {
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: center;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #b91c1c;
            border: 1px solid #fca5a5;
        }

        .alert-success {
            background-color: #d1fae5;
            color: #047857;
            border: 1px solid #6ee7b7;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-container">
            <img src="<?= base_url('uploads/favicon/MatrasExplore.png') ?>" alt="Logo Wisata Matras" class="logo">
        </div>
        
        <h2 class="title">Admin Login</h2>
        <p class="subtitle">Portal Pengelola Wisata Matras</p>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('auth/attempt-login') ?>" method="POST">
            <div class="form-group">
                <label class="form-label">Alamat Email</label>
                <div class="input-group">
                    <input type="email" name="email" class="form-control" required placeholder="admin@pantai.com" value="<?= old('email') ?>">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" required placeholder="Masukkan password">
                    <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    
                    <svg class="eye-icon" id="togglePassword" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                </div>
            </div>


            <button type="submit" class="btn-login">
                Masuk
            </button>
        </form>

        <div class="back-link">
            <a href="<?= base_url() ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            if(type === 'password') {
                this.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
            } else {
                this.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
            }
        });
    </script>
</body>
</html>
