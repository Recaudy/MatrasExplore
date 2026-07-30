-- Explore Bangka Beaches - Tourism Information System SQL Dump
-- Generated on 2026-07-15 10:34:47

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- Table structure for table `users`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES ('1', 'Admin Explore Bangka', 'admin@explorebangka.com', '$2y$10$ahpB8Y3ohuN0KHsuSKFn/ODEJBA6wFv9fTBG6gt0I4OaVvP31jjUW', 'admin', '2026-07-15 08:34:35');

-- --------------------------------------------------------
-- Table structure for table `destinations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `destinations`;
CREATE TABLE `destinations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `history` text COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `opening_hours` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ticket_price` decimal(10,2) NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'active',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `destinations`
INSERT INTO `destinations` (`id`, `name`, `slug`, `description`, `history`, `location`, `latitude`, `longitude`, `opening_hours`, `ticket_price`, `status`, `created_at`) VALUES ('1', 'Pantai Matras', 'pantai-matras', 'A long, sun-washed shoreline where clear blue water, family moments, and island mornings meet.', 'Pantai Matras is one of the most popular and historical beaches in Bangka. Often referred to as the \"People\'s Beach\", it features soft white sand extending for several kilometers, framed by coconut groves. For decades, it has served as a central hub for local family gatherings, picnics, and beach soccer, while also supporting local fish markets and coastal community life.', 'Sungailiat, Bangka', '-1.82136000', '106.14371000', '24 Hours', '5000.00', 'active', '2026-07-15 08:34:35');
INSERT INTO `destinations` (`id`, `name`, `slug`, `description`, `history`, `location`, `latitude`, `longitude`, `opening_hours`, `ticket_price`, `status`, `created_at`) VALUES ('2', 'Pantai Jambosag', 'pantai-jambosag', 'A quieter pocket of coast for slow days, calm waves, local fishing boats, and unhurried sea air.', 'Pantai Jambosag is a serene and peaceful coastal destination located in northern Bangka near Belinyu. Unlike more touristy shores, Jambosag offers a calm escape with gentle waves, local wooden fishing boats anchoring along the shallow waters, and traditional fisherman huts. It is highly valued for its tranquil atmosphere, making it a perfect spot for meditation, reading, and enjoying fresh sea breeze without the crowds.', 'Belinyu, Bangka', '-1.61208000', '105.78912000', '06:00 - 18:00', '10000.00', 'active', '2026-07-15 08:34:35');
INSERT INTO `destinations` (`id`, `name`, `slug`, `description`, `history`, `location`, `latitude`, `longitude`, `opening_hours`, `ticket_price`, `status`, `created_at`) VALUES ('3', 'Pantai Turun Aban', 'pantai-turun-aban', 'Sculptural granite rocks frame a cinematic coastline made for golden hours and wild camping stories.', 'Pantai Turun Aban is a small, unique cove famous for its towering and dramatically stacked granite rocks. These ancient stone formations have been sculpted by wind and waves over millions of years. Today, Turun Aban is a favorite spot for young adventurers, campers, and landscape photographers. It offers a spectacular, unobstructed view of the sunrise, casting a golden hue over the giant boulders and deep blue sea.', 'Sungailiat, Bangka', '-1.83612000', '106.16041000', '07:00 - 19:00', '5000.00', 'active', '2026-07-15 08:34:35');

-- --------------------------------------------------------
-- Table structure for table `destination_images`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `destination_images`;
CREATE TABLE `destination_images` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` int unsigned NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `caption` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `destination_images_destination_id_foreign` (`destination_id`),
  CONSTRAINT `destination_images_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `destination_images`
INSERT INTO `destination_images` (`id`, `destination_id`, `image`, `caption`) VALUES ('1', '1', 'assets/images/destinations/matras.jpg', 'Scenic view of Pantai Matras shore');
INSERT INTO `destination_images` (`id`, `destination_id`, `image`, `caption`) VALUES ('2', '1', 'assets/images/destinations/matras_2.jpg', 'Sunset at Pantai Matras');
INSERT INTO `destination_images` (`id`, `destination_id`, `image`, `caption`) VALUES ('3', '2', 'assets/images/destinations/jambosag.jpg', 'Crystal waters of Pantai Jambosag');
INSERT INTO `destination_images` (`id`, `destination_id`, `image`, `caption`) VALUES ('4', '3', 'assets/images/destinations/turun_aban.jpg', 'Granite boulders at Pantai Turun Aban');
INSERT INTO `destination_images` (`id`, `destination_id`, `image`, `caption`) VALUES ('5', '3', 'assets/images/destinations/turun_aban_2.jpg', 'Camping spots at Turun Aban');

-- --------------------------------------------------------
-- Table structure for table `gallery`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` int unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gallery_destination_id_foreign` (`destination_id`),
  CONSTRAINT `gallery_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `gallery`
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('1', '1', 'Above the turquoise', 'An aerial view of the sparkling turquoise waters contrasting against the white sand coastline of Bangka.', 'assets/images/gallery/turquoise.jpg', '2026-07-15 08:34:35');
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('2', '1', 'Matras morning', 'Bright golden sunlight lighting up the calm, sweeping sands of Pantai Matras during the early hours.', 'assets/images/gallery/matras_morning.jpg', '2026-07-15 08:34:35');
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('3', '2', 'The quiet side', 'Traditional fishing vessels floating in the calm, shallow tides of Pantai Jambosag.', 'assets/images/gallery/quiet_side.jpg', '2026-07-15 08:34:35');
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('4', '3', 'An island sunset', 'A majestic sunset framing the distant islets and granite rocks of Pantai Turun Aban.', 'assets/images/gallery/island_sunset.jpg', '2026-07-15 08:34:35');
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('5', '3', 'Granite country', 'Towering stacks of smooth granite boulders rising from the soft sands, a signature look of Bangka.', 'assets/images/gallery/granite_country.jpg', '2026-07-15 08:34:35');
INSERT INTO `gallery` (`id`, `destination_id`, `title`, `description`, `image`, `created_at`) VALUES ('6', '3', 'Wave watch', 'Water splashing and flowing gracefully between cracks of ancient coastal boulders during golden hour.', 'assets/images/gallery/wave_watch.jpg', '2026-07-15 08:34:35');

-- --------------------------------------------------------
-- Table structure for table `accommodations`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `accommodations`;
CREATE TABLE `accommodations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `destination_id` int unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(11,8) NOT NULL,
  `rating` decimal(2,1) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accommodations_destination_id_foreign` (`destination_id`),
  CONSTRAINT `accommodations_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `accommodations`
INSERT INTO `accommodations` (`id`, `destination_id`, `name`, `description`, `address`, `price`, `phone`, `website`, `latitude`, `longitude`, `rating`, `image`, `created_at`) VALUES ('1', '1', 'Hotel Santika Bangka', 'Enjoy a comfortable stay at Hotel Santika Bangka, situated just a short drive from Pantai Matras. Perfect for both business and leisure travelers, the hotel offers modern amenities, a relaxing outdoor pool, an all-day dining restaurant, and highly attentive local hospitality.', 'Jl. Soekarno Hatta No. 1, Pangkalpinang, Bangka', '850000.00', '+62 717 4256888', 'https://www.mysantika.com', '-2.14652000', '106.12643000', '4.7', 'assets/images/accommodations/santika.jpg', '2026-07-15 08:34:35');
INSERT INTO `accommodations` (`id`, `destination_id`, `name`, `description`, `address`, `price`, `phone`, `website`, `latitude`, `longitude`, `rating`, `image`, `created_at`) VALUES ('2', '1', 'Novilla Boutique Resort', 'Novilla Boutique Resort in Sungailiat provides an elegant resort experience. Surrounded by lush gardens and featuring two large outdoor swimming pools, tennis courts, a fitness center, and a luxury spa, it is the premier choice for relaxing near Pantai Matras.', 'Jl. Kenanga No. 100, Sungailiat, Bangka', '1200000.00', '+62 717 92535', 'https://novillaboutiqueresort.com', '-1.86542000', '106.11542000', '4.7', 'assets/images/accommodations/novilla.jpg', '2026-07-15 08:34:35');
INSERT INTO `accommodations` (`id`, `destination_id`, `name`, `description`, `address`, `price`, `phone`, `website`, `latitude`, `longitude`, `rating`, `image`, `created_at`) VALUES ('3', '2', 'Jambosag Cottage', 'Live steps away from the peaceful sea at Jambosag Cottage. Built with traditional wood materials and modern comforts, these cozy cottages provide the ultimate slow-living experience near the tranquil shores of Pantai Jambosag.', 'Belinyu Beach Coast, North Bangka', '420000.00', '+62 812-3456-7890', 'https://jambosagcottage.com', '-1.61300000', '105.78850000', '4.7', 'assets/images/accommodations/jambosag_cottage.jpg', '2026-07-15 08:34:35');
INSERT INTO `accommodations` (`id`, `destination_id`, `name`, `description`, `address`, `price`, `phone`, `website`, `latitude`, `longitude`, `rating`, `image`, `created_at`) VALUES ('4', '3', 'Turun Aban Resort', 'Overlooking the iconic granite rock formations, Turun Aban Resort offers charming oceanfront chalets. Rise early to watch the gorgeous sunrise over the sea directly from your private balcony, and fall asleep to the gentle sound of waves.', 'Pantai Turun Aban Road, Sungailiat, Bangka', '720000.00', '+62 821-9876-5432', 'https://turunabanresort.com', '-1.83550000', '106.15950000', '4.7', 'assets/images/accommodations/turun_aban_resort.jpg', '2026-07-15 08:34:35');

-- --------------------------------------------------------
-- Table structure for table `facilities`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `facilities`;
CREATE TABLE `facilities` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `icon` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `facilities`
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('1', 'Free Wi-Fi', 'wifi');
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('2', 'Free Parking', 'parking');
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('3', 'Coffee Shop', 'coffee');
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('4', 'Restaurant', 'restaurant');
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('5', 'Swimming Pool', 'pool');
INSERT INTO `facilities` (`id`, `name`, `icon`) VALUES ('6', 'Air Conditioning', 'ac');

-- --------------------------------------------------------
-- Table structure for table `destination_facilities`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `destination_facilities`;
CREATE TABLE `destination_facilities` (
  `destination_id` int unsigned NOT NULL,
  `facility_id` int unsigned NOT NULL,
  PRIMARY KEY (`destination_id`,`facility_id`),
  KEY `destination_facilities_facility_id_foreign` (`facility_id`),
  CONSTRAINT `destination_facilities_destination_id_foreign` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `destination_facilities_facility_id_foreign` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `destination_facilities`
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '1');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('2', '1');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('3', '1');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '2');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('2', '2');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('3', '2');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '3');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('2', '3');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('3', '3');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '4');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('3', '4');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '5');
INSERT INTO `destination_facilities` (`destination_id`, `facility_id`) VALUES ('1', '6');

-- --------------------------------------------------------
-- Table structure for table `contact_messages`
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
