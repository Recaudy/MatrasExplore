<?= view('layouts/header') ?>
<?= view('layouts/navbar') ?>

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .news-detail-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px 20px;
    }
    
    .news-header {
        margin-bottom: 30px;
        text-align: center;
    }

    .news-meta {
        color: var(--color-primary);
        font-weight: 600;
        margin-bottom: 15px;
        font-size: 1rem;
    }

    .news-title {
        font-family: 'Outfit', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.3;
        margin-bottom: 20px;
    }

    .swiper {
        width: 100%;
        height: 450px;
        border-radius: 20px;
        margin-bottom: 40px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .news-content {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #475569;
    }
    
    .news-content p {
        margin-bottom: 20px;
    }



    @media (max-width: 768px) {
        .news-title { font-size: 2rem; }
        .swiper { height: 300px; }
    }
</style>

<div class="news-detail-container" style="padding-top: 100px;">
    
    <div class="news-header">
        <div class="news-meta">
            <?= date('d F Y, H:i', strtotime($news['created_at'])) ?> WIB
        </div>
        <h1 class="news-title"><?= esc($news['title']) ?></h1>
    </div>

    <!-- Image Slider -->
    <?php if (!empty($images)): ?>
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">
            <?php foreach ($images as $img): ?>
                <div class="swiper-slide">
                    <img src="<?= base_url($img['image_path']) ?>" alt="<?= esc($news['title']) ?>" />
                </div>
            <?php endforeach; ?>
        </div>
        <?php if (count($images) > 1): ?>
            <div class="swiper-button-next" style="color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></div>
            <div class="swiper-button-prev" style="color: white; text-shadow: 0 2px 4px rgba(0,0,0,0.5);"></div>
            <div class="swiper-pagination"></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- Content -->
    <div class="news-content">
        <?= $news['content'] ?>
    </div>



</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- Initialize Swiper -->
<script>
  var swiper = new Swiper(".mySwiper", {
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    autoplay: {
        delay: 3500,
        disableOnInteraction: false,
    }
  });
</script>

<?= view('layouts/footer') ?>
<?= view('layouts/scripts') ?>
