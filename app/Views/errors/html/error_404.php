<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page Not Found - Desa Wisata Matras</title>
    <link rel="icon" type="image/svg+xml" href="/assets/images/logo/waves.svg">
    <link rel="stylesheet" href="/assets/css/style.css">
    
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: var(--color-bg-cool);
            font-family: var(--font-sans);
            padding: 2rem;
            color: var(--color-dark-muted);
        }
        .error-card {
            background-color: var(--color-white);
            border: 1px solid var(--color-light-border);
            border-radius: var(--border-radius-lg);
            padding: 4rem 3rem;
            max-width: 500px;
            width: 100%;
            text-align: center;
            box-shadow: var(--shadow-premium);
        }
        .error-logo {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--color-dark);
            margin-bottom: 2.5rem;
            text-decoration: none;
        }
        .error-logo img {
            width: 36px;
            height: 36px;
        }
        .error-logo .highlight {
            color: var(--color-primary);
        }
        .error-code {
            font-family: var(--font-heading);
            font-size: 7rem;
            font-weight: 800;
            line-height: 1;
            color: var(--color-primary);
            margin-bottom: 1.5rem;
            letter-spacing: -0.05em;
        }
        .error-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1rem;
        }
        .error-text {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 2.5rem;
        }
    </style>
</head>
<body>
    <div class="error-card">
        <a href="/" class="error-logo">
            <img src="/assets/images/logo/waves.svg" alt="Explore Bangka waves logo icon">
            <div>Explore<span class="highlight">Bangka</span></div>
        </a>
        
        <div class="error-code">404</div>
        <h1 class="error-title">Page Not Found</h1>
        
        <p class="error-text">
            <?php if (ENVIRONMENT !== 'production') : ?>
                <?= nl2br(esc($message)) ?>
            <?php else : ?>
                The coastline you are trying to reach does not exist or has been shifted by the tide. Let's get you back to safe shores.
            <?php endif; ?>
        </p>
        
        <a href="/" class="btn btn-dark" style="width: 100%;">
            Return to Dashboard
        </a>
    </div>
</body>
</html>
