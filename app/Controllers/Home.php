<?php

namespace App\Controllers;

use App\Models\DestinationModel;
use App\Models\DestinationUserGalleryModel;
use App\Models\GalleryModel;

class Home extends BaseController
{
    public function index(): string
    {
        $destModel = new DestinationModel();
        $galleryModel = new GalleryModel();

        // 1. Get all active destinations and attach facilities + cover image + rating
        $destinations = $destModel->where('status', 'active')->findAll();
        foreach ($destinations as &$dest) {
            $dest['facilities'] = $destModel->getFacilities($dest['id']);
            
            $reviewModel = new \App\Models\ReviewModel();
            $ratingStats = $reviewModel->getDestinationRatingStats($dest['id']);
            $dest['rating'] = $ratingStats['total_reviews'] > 0 ? number_format($ratingStats['avg_rating'], 1) : '0.0';
            
            // Retain seasons logic
            if ($dest['slug'] === 'pantai-matras') {
                $dest['season'] = 'May — September';
            } elseif ($dest['slug'] === 'pantai-jambosag') {
                $dest['season'] = 'April — October';
            } elseif ($dest['slug'] === 'pantai-turun-aban') {
                $dest['season'] = 'June — August';
            } else {
                $dest['season'] = 'May — September';
            }
            
            // Get cover image
            $images = $destModel->getImages($dest['id']);
            $dest['image'] = !empty($images) ? $images[0]['image'] : 'assets/images/destinations/matras.jpg';
        }

        // 2. Fetch gallery items for visual journal grid collage (up to 40 for load more)
        $officialGallery = $galleryModel->where('show_on_dashboard', 1)->orderBy('id', 'ASC')->findAll(40);
        $userGalleryModel = new \App\Models\DestinationUserGalleryModel();
        $userGallery = $userGalleryModel->where('show_on_dashboard', 1)->orderBy('created_at', 'ASC')->findAll(40);

        $gallery = [];
        foreach ($officialGallery as $item) {
            $gallery[] = [
                'id' => 'official_' . $item['id'],
                'image' => $item['image'],
                'title' => $item['title'],
                'description' => $item['description'],
                'author' => null
            ];
        }
        foreach ($userGallery as $item) {
            $gallery[] = [
                'id' => 'user_' . $item['id'],
                'image' => $item['image_path'],
                'title' => $item['title'],
                'description' => $item['description'] . ' (Foto kiriman dari ' . $item['name'] . ')',
                'author' => $item['name']
            ];
        }

        // Limit to 40 total
        $gallery = array_slice($gallery, 0, 40);

        // Fetch Information
        $infoModel = new \App\Models\InformationModel();
        $information = $infoModel->orderBy('id', 'DESC')->findAll(8);

        // Fetch Shorts
        $shortModel = new \App\Models\ShortModel();
        $shorts = $shortModel->orderBy('id', 'DESC')->findAll(4);

        $settingModel = new \App\Models\SettingModel();
        $settings = $settingModel->getAllSettingsAsMap();

        $data = [
            'title' => 'Explore Bangka Beaches - Tourism Information System',
            'meta_description' => 'Discover the beauty of Bangka\'s best beaches. Explore white sand beaches, crystal-clear waters, local culture, and travel routes all in one place.',
            'destinations' => $destinations,
            'gallery' => $gallery,
            'information' => $information,
            'shorts' => $shorts,
            'settings' => $settings,
            'pageStyles' => ['home.css', 'map.css', 'gallery.css', 'shorts.css'],
            'pageScripts' => ['gallery.js', 'slider.js', 'map.js']
        ];

        return view('home/index', $data);
    }
}
