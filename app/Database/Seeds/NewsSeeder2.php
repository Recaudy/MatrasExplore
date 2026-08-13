<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NewsSeeder2 extends Seeder
{
    public function run()
    {
        $newsData = [
            [
                'title' => 'Pengembangan Ekowisata Mangrove di Sekitar Pantai Matras Segera Dimulai',
                'slug' => 'pengembangan-ekowisata-mangrove-di-sekitar-pantai-matras-segera-dimulai',
                'content' => '<p>Pemerintah Daerah berencana mengembangkan kawasan hutan mangrove yang berada tidak jauh dari kawasan Pantai Matras menjadi destinasi ekowisata baru. Proyek ini diharapkan dapat menjadi daya tarik tambahan bagi wisatawan yang berkunjung ke Matras.</p>
                <p>Ekowisata mangrove ini nantinya akan dilengkapi dengan <em>boardwalk</em> atau jembatan kayu yang membentang di tengah rimbunnya hutan bakau, spot foto menarik, dan pusat edukasi lingkungan bagi anak-anak dan pelajar.</p>
                <ul>
                    <li>Fasilitas Jembatan Kayu (Boardwalk)</li>
                    <li>Pusat Edukasi Lingkungan</li>
                    <li>Penanaman Bibit Bakau Bersama</li>
                </ul>
                <p>Proses pembangunan akan dimulai awal bulan depan dan ditargetkan selesai dalam waktu enam bulan. Diharapkan partisipasi masyarakat lokal dalam menjaga kelestariannya.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'title' => 'Mengenal Tradisi "Nganggung" yang Masih Lestari di Desa Matras',
                'slug' => 'mengenal-tradisi-nganggung-yang-masih-lestari-di-desa-matras',
                'content' => '<p>Di tengah pesatnya perkembangan zaman, warga Desa Matras masih teguh memegang tradisi luhur warisan nenek moyang, salah satunya adalah tradisi <strong>Nganggung</strong>. Tradisi ini biasanya digelar pada perayaan hari besar agama seperti Idul Fitri, Idul Adha, dan peringatan Maulid Nabi.</p>
                <p>Dalam tradisi Nganggung, masyarakat berbondong-bondong membawa dulang (nampan besar dari kuningan atau kayu) yang ditutup dengan tudung saji (penutup makanan dari daun pandan atau nipah) berisi berbagai macam makanan ke masjid atau balai desa.</p>
                <p>Wisatawan yang berkunjung bertepatan dengan momen ini dapat turut serta menikmati hidangan dan merasakan kehangatan rasa persaudaraan warga lokal.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-8 days')),
            ],
            [
                'title' => 'Wisata Olahraga Air (Water Sports) Kini Hadir di Pantai Turun Aban',
                'slug' => 'wisata-olahraga-air-water-sports-kini-hadir-di-pantai-turun-aban',
                'content' => '<p>Kabar gembira bagi para pecinta adrenalin! Pantai Turun Aban kini menyediakan berbagai fasilitas <em>water sports</em> atau olahraga air yang dikelola oleh koperasi nelayan setempat.</p>
                <p>Beberapa permainan yang bisa Anda coba antara lain:</p>
                <ol>
                    <li><strong>Banana Boat:</strong> Seru-seruan bersama rombongan teman atau keluarga.</li>
                    <li><strong>Jetski:</strong> Mengelilingi kawasan laut lepas dengan kecepatan tinggi.</li>
                    <li><strong>Donut Boat:</strong> Permainan menantang yang siap menguji keseimbangan Anda.</li>
                </ol>
                <p>Seluruh peralatan yang digunakan sudah berstandar keselamatan internasional dan akan didampingi oleh instruktur profesional. Jangan lupa siapkan baju ganti!</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-9 days')),
            ],
            [
                'title' => 'Baksos Pembersihan Pantai Matras Berhasil Kumpulkan 2 Ton Sampah Plastik',
                'slug' => 'baksos-pembersihan-pantai-matras-berhasil-kumpulkan-2-ton-sampah-plastik',
                'content' => '<p>Kegiatan bakti sosial (baksos) pembersihan Pantai Matras yang digelar pada akhir pekan lalu menuai hasil yang luar biasa. Berkat kolaborasi antara relawan lokal, mahasiswa, dan instansi terkait, total <strong>2 ton sampah plastik</strong> berhasil dikumpulkan dalam waktu setengah hari.</p>
                <p>Mayoritas sampah yang ditemukan adalah botol minuman, sedotan plastik, dan bungkus makanan ringan yang tertimbun di pasir atau tersangkut di bebatuan karang.</p>
                <blockquote>"Laut bukanlah tempat sampah kita. Kami mengimbau kepada seluruh pengunjung untuk membuang sampah pada tempatnya atau membawanya kembali jika tidak menemukan tong sampah," tegas koordinator acara baksos.</blockquote>
                <p>Pemerintah desa berjanji akan menambah jumlah tempat sampah di area wisata agar hal serupa tidak terjadi lagi.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-10 days')),
            ],
            [
                'title' => 'Daya Tarik Unik Pantai Jambosag: Bebatuan Granit Raksasa nan Eksotis',
                'slug' => 'daya-tarik-unik-pantai-jambosag-bebatuan-granit-raksasa-nan-eksotis',
                'content' => '<p>Meski garis pantainya tidak sepanjang Pantai Matras, <strong>Pantai Jambosag</strong> memiliki daya tarik tersendiri yang membuatnya sering dikunjungi oleh para fotografer profesional maupun amatir: bebatuan granit raksasa!</p>
                <p>Batuan purba ini berdiri kokoh di sepanjang pesisir, membentuk formasi unik yang sangat *instagramable*, apalagi jika dipadukan dengan latar belakang langit senja. Selain sebagai objek foto, batu-batu ini juga berfungsi sebagai pemecah ombak alami, sehingga air di sekitarnya cenderung lebih tenang.</p>
                <p>Bagi Anda yang berencana ke sana, sangat disarankan mengenakan alas kaki berbahan karet yang tidak licin saat memanjat bebatuan demi keselamatan diri.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-11 days')),
            ],
            [
                'title' => 'Panduan Transportasi Menuju Desa Wisata Matras dari Bandara Depati Amir',
                'slug' => 'panduan-transportasi-menuju-desa-wisata-matras-dari-bandara-depati-amir',
                'content' => '<p>Bagi Anda wisatawan dari luar Pulau Bangka yang baru mendarat di Bandara Depati Amir, Pangkalpinang, menuju Desa Wisata Matras sebenarnya cukup mudah dan memakan waktu sekitar 1 hingga 1,5 jam perjalanan darat.</p>
                <p>Berikut opsi transportasi yang bisa Anda pilih:</p>
                <ul>
                    <li><strong>Taksi Bandara / Taksi Online:</strong> Praktis dan langsung menuju lokasi. Siapkan budget sekitar Rp250.000 hingga Rp350.000.</li>
                    <li><strong>Sewa Kendaraan (Rental Mobil/Motor):</strong> Pilihan paling fleksibel jika Anda berencana mengelilingi seluruh penjuru pulau.</li>
                    <li><strong>Travel / Damri (Jika tersedia):</strong> Tarifnya lebih murah namun Anda mungkin harus transit di pusat kota Sungailiat terlebih dahulu.</li>
                </ul>
                <p>Pemandangan sepanjang perjalanan didominasi oleh perkebunan lada dan kelapa sawit yang memanjakan mata.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-12 days')),
            ],
            [
                'title' => 'Menikmati Kesegaran Kelapa Muda Langsung dari Pohonnya',
                'slug' => 'menikmati-kesegaran-kelapa-muda-langsung-dari-pohonnya',
                'content' => '<p>Udara pantai yang tropis dan paparan sinar matahari paling nikmat diredakan dengan segelas es kelapa muda segar. Di Desa Wisata Matras, Anda tidak akan kesulitan menemukan warung-warung pinggir jalan yang menjajakannya.</p>
                <p>Yang membuatnya istimewa, kelapa-kelapa ini baru dipetik dari perkebunan warga sesaat sebelum disajikan. Airnya sangat manis alami dan daging buahnya lembut (kerok). Anda bisa memilih untuk meminumnya langsung dari batoknya atau dicampur dengan es dan sedikit sirup merah khas Bangka.</p>
                <p>Cukup merogoh kocek Rp15.000, kesegaran hakiki di tengah hari yang panas sudah bisa Anda dapatkan!</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-13 days')),
            ],
            [
                'title' => 'Fasilitas Kamar Mandi Bilas di Area Pantai Kini Makin Bersih dan Banyak',
                'slug' => 'fasilitas-kamar-mandi-bilas-di-area-pantai-kini-makin-bersih-dan-banyak',
                'content' => '<p>Untuk menjawab keluhan wisatawan terkait antrean panjang kamar mandi pada musim liburan, pihak desa telah membangun puluhan unit kamar mandi bilas baru di tiga titik utama kawasan Pantai Matras dan Turun Aban.</p>
                <p>Kamar mandi ini sudah dilengkapi dengan pasokan air tawar yang melimpah, penerangan yang memadai, serta petugas kebersihan yang *standby* setiap harinya. Tarif bilas pun diatur standar oleh pihak desa, yakni Rp3.000 untuk anak-anak dan Rp5.000 untuk orang dewasa.</p>
                <p><em>"Kami pastikan tidak ada lagi pihak yang mematok harga tidak masuk akal untuk fasilitas bilas,"</em> tegas pengelola wisata setempat.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-14 days')),
            ],
            [
                'title' => 'Pengamatan Penyu Bertelur: Pesona Satwa Langka di Malam Hari',
                'slug' => 'pengamatan-penyu-bertelur-pesona-satwa-langka-di-malam-hari',
                'content' => '<p>Tahukah Anda bahwa pesisir Desa Matras masih sering disinggahi oleh kawanan penyu sisik dan penyu hijau untuk bertelur pada musim-musim tertentu? Ini adalah fenomena alam langka yang terus dilindungi oleh warga.</p>
                <p>Pihak desa kini sedang merintis program ekowisata pengamatan penyu bertelur. Wisatawan yang mendaftar akan didampingi oleh <em>ranger</em> terlatih untuk melihat proses penyu bertelur di malam hari dengan jarak yang aman agar tidak mengganggu satwa tersebut.</p>
                <p>Aturan ketat diterapkan dalam tur ini, seperti larangan menyalakan senter secara sembarangan, larangan memotret menggunakan <em>flash</em>, dan pengunjung dilarang bersuara keras.</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-15 days')),
            ],
            [
                'title' => 'Tips Berburu Sunset Sempurna di Pesisir Bangka',
                'slug' => 'tips-berburu-sunset-sempurna-di-pesisir-bangka',
                'content' => '<p>Matahari terbenam (<em>sunset</em>) di kawasan Pantai Turun Aban dan Matras terkenal dengan semburat warna jingga dan ungunya yang sangat memukau. Banyak wisatawan sengaja datang sore hari hanya untuk mengabadikan momen ini.</p>
                <p>Berikut beberapa tips dari fotografer lokal agar hasil jepretan sunset Anda maksimal:</p>
                <ol>
                    <li><strong>Waktu Kedatangan:</strong> Tiba di lokasi selambat-lambatnya pukul 17:00 WIB agar Anda punya waktu mencari spot terbaik.</li>
                    <li><strong>Gunakan Siluet:</strong> Manfaatkan objek seperti perahu nelayan, pohon kelapa, atau bebatuan granit sebagai *foreground* siluet.</li>
                    <li><strong>Atur Exposure:</strong> Jika menggunakan smartphone, turunkan sedikit <em>exposure</em> agar warna langit lebih pekat dan dramatis.</li>
                </ol>
                <p>Jangan terburu-buru pulang setelah matahari tenggelam, karena fenomena *blue hour* (langit berwarna kebiruan) yang terjadi beberapa belas menit setelahnya sering kali menghasilkan foto yang tak kalah indah!</p>',
                'created_at' => date('Y-m-d H:i:s', strtotime('-16 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-16 days')),
            ]
        ];

        // Insert News
        $this->db->table('news')->insertBatch($newsData);

        // Get inserted IDs
        $insertedNews = $this->db->table('news')->orderBy('id', 'DESC')->limit(10)->get()->getResultArray();
        
        $imagesData = [];
        $dummyImages = [
            'assets/images/destinations/matras.jpg',
            'assets/images/destinations/turun-aban.jpg',
            'assets/images/destinations/jambosag.jpg',
            'assets/images/destinations/matras.jpg',
            'assets/images/destinations/turun-aban.jpg',
            'assets/images/destinations/jambosag.jpg',
            'assets/images/destinations/matras.jpg',
            'assets/images/destinations/turun-aban.jpg',
            'assets/images/destinations/jambosag.jpg',
            'assets/images/destinations/matras.jpg',
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
            
            // Add a second dummy image to show slider
            $imagesData[] = [
                'news_id' => $news['id'],
                'image_path' => 'assets/images/placeholder.jpg',
                'is_main' => 0,
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        // Insert Images
        $this->db->table('news_images')->insertBatch($imagesData);
    }
}
