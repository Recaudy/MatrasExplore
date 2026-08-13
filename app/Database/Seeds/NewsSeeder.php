<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $newsData = [
            [
                'title' => 'Festival Budaya Pesisir Matras Berhasil Tarik Ribuan Pengunjung',
                'slug' => 'festival-budaya-pesisir-matras-berhasil-tarik-ribuan-pengunjung',
                'content' => '<p><strong>Desa Wisata Matras</strong> kembali sukses menggelar acara tahunannya, <em>Festival Budaya Pesisir Matras</em>. Acara yang berlangsung selama tiga hari berturut-turut ini menampilkan berbagai kesenian lokal khas pesisir Bangka, termasuk tari campak, pertunjukan dambus, dan kompetisi perahu hias.</p>
                <p>Kepala Desa Matras menyampaikan rasa bangganya atas antusiasme pengunjung. "Kami menargetkan sekitar 2.000 pengunjung, namun ternyata yang hadir mencapai hampir 5.000 orang dari berbagai daerah. Ini adalah pencapaian luar biasa untuk pariwisata kita," ungkapnya.</p>
                <ul>
                    <li>Pertunjukan Kesenian Lokal</li>
                    <li>Bazar Kuliner Seafood</li>
                    <li>Lomba Fotografi Pantai</li>
                </ul>
                <p>Diharapkan acara ini bisa menjadi agenda rutin berskala nasional di tahun-tahun mendatang untuk meningkatkan kesejahteraan UMKM lokal.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 days')),
            ],
            [
                'title' => 'Upaya Pelestarian Terumbu Karang di Pantai Turun Aban Diapresiasi Pemerintah',
                'slug' => 'upaya-pelestarian-terumbu-karang-di-pantai-turun-aban-diapresiasi-pemerintah',
                'content' => '<p>Kelompok Sadar Wisata (Pokdarwis) Pantai Turun Aban menerima penghargaan tingkat provinsi atas dedikasi mereka dalam melestarikan ekosistem bawah laut, khususnya program transplantasi terumbu karang yang telah berjalan selama dua tahun terakhir.</p>
                <p>Program ini berhasil mengembalikan warna-warni biota laut yang sempat memudar akibat penangkapan ikan ilegal di masa lalu. Kini, <strong>Pantai Turun Aban</strong> kembali menjadi spot snorkeling favorit wisatawan berkat keindahan terumbu karangnya.</p>
                <p>Wisatawan dihimbau untuk selalu mematuhi aturan saat snorkeling, antara lain:</p>
                <ol>
                    <li>Tidak menginjak atau menyentuh terumbu karang.</li>
                    <li>Menggunakan tabir surya (sunblock) yang ramah lingkungan.</li>
                    <li>Tidak membuang sampah sembarangan di area pantai dan laut.</li>
                </ol>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title' => 'Peresmian Fasilitas Baru di Kawasan Pantai Matras: Gazebo Nyaman untuk Keluarga',
                'slug' => 'peresmian-fasilitas-baru-di-kawasan-pantai-matras-gazebo-nyaman-untuk-keluarga',
                'content' => '<p>Kabar gembira bagi para wisatawan yang gemar menghabiskan waktu bersama keluarga di <strong>Pantai Matras</strong>! Hari ini, pengelola wisata secara resmi membuka area rekreasi keluarga yang dilengkapi dengan 15 unit gazebo kayu berdesain modern tropis.</p>
                <p>Gazebo ini dirancang agar pengunjung dapat bersantai sambil menikmati angin sepoi-sepoi dan pemandangan laut lepas tanpa khawatir terpapar terik matahari secara langsung.</p>
                <blockquote>"Kami ingin memberikan kenyamanan maksimal bagi rombongan keluarga. Gazebo ini bisa disewa seharian penuh dengan harga yang sangat terjangkau," ujar pengelola.</blockquote>
                <p>Selain gazebo, pemerintah daerah juga telah memperbaiki jalur pedestrian di sepanjang bibir pantai untuk memudahkan pengunjung yang ingin *jogging* atau sekadar berjalan santai di pagi dan sore hari.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'title' => 'Tips Aman dan Seru Berkemah (Camping) di Pantai Jambosag',
                'slug' => 'tips-aman-dan-seru-berkemah-camping-di-pantai-jambosag',
                'content' => '<p><strong>Pantai Jambosag</strong> kini semakin populer sebagai destinasi <em>camping</em> bagi anak muda dan pecinta alam. Dengan hamparan pasir yang bersih dan rimbunnya pepohonan cemara laut, pantai ini menawarkan suasana kemah yang asri dan tenang.</p>
                <p>Bagi Anda yang berencana untuk mendirikan tenda di akhir pekan, berikut beberapa tips agar kegiatan berkemah Anda berjalan lancar:</p>
                <ul>
                    <li><strong>Bawa kantong sampah sendiri:</strong> Pastikan Anda membawa pulang seluruh sampah Anda (leave no trace).</li>
                    <li><strong>Perhatikan batas pasang air laut:</strong> Jangan mendirikan tenda terlalu dekat dengan bibir pantai.</li>
                    <li><strong>Lapor ke petugas:</strong> Selalu informasikan kehadiran Anda ke pos penjagaan demi alasan keamanan.</li>
                </ul>
                <p>Jadikan pengalaman menyatu dengan alam ini sebagai momen untuk melepas penat dari hiruk-pikuk kota!</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-4 days')),
            ],
            [
                'title' => 'Kuliner Wajib Coba: Rujak Batu-Batu Khas Desa Wisata Matras',
                'slug' => 'kuliner-wajib-coba-rujak-batu-batu-khas-desa-wisata-matras',
                'content' => '<p>Liburan ke Desa Wisata Matras tidak akan lengkap tanpa mencicipi kuliner khasnya. Salah satu yang paling diburu wisatawan adalah <strong>Rujak Batu-Batu</strong>.</p>
                <p>Berbeda dengan rujak buah pada umumnya, Rujak Batu-Batu terbuat dari buah-buahan lokal Bangka yang teksturnya renyah, disiram dengan kuah cuka terasi yang pedas, manis, dan asam. Rasanya sangat menyegarkan, terutama bila disantap di siang hari saat matahari sedang terik.</p>
                <p>Anda bisa dengan mudah menemukan para pedagang rujak ini berjejer di area pintu masuk Pantai Matras. Harganya pun sangat bersahabat, mulai dari Rp10.000 saja per porsi. Pastikan kuliner ini masuk ke dalam daftar wajib coba Anda saat berkunjung ke sini!</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'title' => 'Galang Dana Bencana, Komunitas Pemuda Matras Gelar Konser Amal di Pinggir Pantai',
                'slug' => 'galang-dana-bencana-komunitas-pemuda-matras-gelar-konser-amal-di-pinggir-pantai',
                'content' => '<p>Sebagai bentuk kepedulian sosial, puluhan pemuda yang tergabung dalam <strong>Komunitas Pemuda Peduli Matras</strong> menggelar aksi konser amal kecil-kecilan di area pesisir pada Sabtu sore kemarin.</p>
                <p>Acara ini diselenggarakan untuk menggalang dana bantuan bagi saudara-saudara kita yang tertimpa musibah angin puting beliung di desa tetangga minggu lalu.</p>
                <p>Meski sederhana, acara ini berhasil menarik perhatian banyak pengunjung pantai. Alunan musik akustik dengan latar belakang ombak laut dan senja yang merona membuat suasana menjadi sangat syahdu dan menyentuh hati. Total dana yang terkumpul mencapai lebih dari sepuluh juta rupiah dalam waktu dua jam saja.</p>
                <p><em>"Kami berterima kasih kepada seluruh wisatawan yang telah menyisihkan rezekinya. Ini membuktikan bahwa wisata tidak hanya tentang bersenang-senang, tapi juga tentang berbagi kebaikan,"</em> tutup ketua panitia acara.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-6 days')),
            ]
        ];

        // Insert News
        $this->db->table('news')->insertBatch($newsData);

        // Get inserted IDs
        $insertedNews = $this->db->table('news')->orderBy('id', 'DESC')->limit(6)->get()->getResultArray();
        
        $imagesData = [];
        $dummyImages = [
            'assets/images/destinations/matras.jpg',
            'assets/images/destinations/turun-aban.jpg',
            'assets/images/destinations/jambosag.jpg',
            'assets/images/placeholder.jpg',
            'assets/images/destinations/matras.jpg',
            'assets/images/destinations/turun-aban.jpg',
        ];

        // Sort descending so the order matches
        $insertedNews = array_reverse($insertedNews);

        foreach ($insertedNews as $index => $news) {
            $imagesData[] = [
                'news_id' => $news['id'],
                'image_path' => $dummyImages[$index],
                'is_main' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ];
            // Add a second dummy image just to show slider works for some
            if ($index % 2 == 0) {
                $imagesData[] = [
                    'news_id' => $news['id'],
                    'image_path' => 'assets/images/placeholder.jpg',
                    'is_main' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                ];
            }
        }

        // Insert Images
        $this->db->table('news_images')->insertBatch($imagesData);
    }
}
