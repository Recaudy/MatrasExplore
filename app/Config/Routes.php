<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
// Home / Dashboard
$routes->get('/', 'Home::index');

// Destinations
$routes->get('destinations', 'Destination::index');
$routes->post('destinations/add-review', 'Destination::addReview');
$routes->post('destinations/add-gallery-photo', 'Destination::addGalleryPhoto');
$routes->get('destinations/(:segment)', 'Destination::detail/$1');

// Gallery
$routes->get('gallery', 'Gallery::index');

$routes->get('gallery/(:segment)', 'Gallery::detail/$1');

// Informasi
$routes->get('informasi', 'Information::index');

// Map
$routes->get('map', 'Map::index');

// Contact & Feedback
$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

// Auth / Login Routes
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/attempt-login', 'Auth::attemptLogin');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('admin/login', 'Auth::login');

// Admin Panel Routes
$routes->group('admin', function ($routes) {
    $routes->get('/', 'Admin::index');
    
    // Hero Management
    $routes->get('hero', 'Admin::hero');
    $routes->post('hero/update', 'Admin::updateHero');

    // Destinations Management
    $routes->get('destinations', 'Admin::destinations');
    $routes->get('destinations/create', 'Admin::createDestination');
    $routes->post('destinations/save', 'Admin::saveDestination');
    $routes->get('destinations/edit/(:num)', 'Admin::editDestination/$1');
    $routes->post('destinations/update/(:num)', 'Admin::updateDestination/$1');
    $routes->get('destinations/delete/(:num)', 'Admin::deleteDestination/$1');
    $routes->get('destinations/delete-image/(:num)', 'Admin::deleteDestinationImage/$1');

    // Gallery Journal Management
    $routes->get('gallery', 'Admin::gallery');
    $routes->post('gallery/save', 'Admin::saveGallery');
    $routes->get('gallery/delete/(:num)', 'Admin::deleteGallery/$1');
$routes->post('gallery/bulk-delete', 'Admin::bulkDeleteGallery');
$routes->post('gallery/bulk-update-dashboard', 'Admin::bulkUpdateDashboard');


    // Information Management
    $routes->get('information', 'Admin::information');
    $routes->post('information/save', 'Admin::saveInformation');
    $routes->get('information/delete/(:num)', 'Admin::deleteInformation/$1');

    // Map Management
    $routes->get('map', 'Admin::map');

    // Contact Settings Management
    $routes->get('settings', 'Admin::settings');
    $routes->post('settings/update', 'Admin::updateSettings');

    // Incoming Contacts
    $routes->get('contacts', 'Admin::contacts');
    $routes->get('contacts/delete/(:num)', 'Admin::deleteContact/$1');

    // User Reviews Verification
    $routes->get('reviews', 'Admin::reviews');
    $routes->get('reviews/approve/(:num)', 'Admin::approveReview/$1');
    $routes->get('reviews/reject/(:num)', 'Admin::rejectReview/$1');
    $routes->get('reviews/delete/(:num)', 'Admin::deleteReview/$1');

    // User Contributed Photos Verification
    $routes->get('photos', 'Admin::photos');
    $routes->get('photos/approve/(:num)', 'Admin::approvePhoto/$1');
    $routes->get('photos/reject/(:num)', 'Admin::rejectPhoto/$1');
    $routes->get('photos/delete/(:num)', 'Admin::deletePhoto/$1');

    // Entrance Logs
    $routes->get('entrance', 'Admin::entrance');
    $routes->post('entrance/add', 'Admin::addEntrance');
    $routes->post('entrance/reset', 'Admin::resetEntrance');
});
