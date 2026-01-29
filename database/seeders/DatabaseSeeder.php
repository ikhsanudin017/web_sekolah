<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Teacher;
use App\Models\SchoolSetting;
use App\Models\PpdbRegistration;
use App\Models\HeroSlide;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = fake('id_ID');

        $localHeroImages = [
            'image/carousle/54d57d87f7fd99d604ab0fb6fb5485d1.jpg',
            'image/carousle/52ded6c4ada62753d85842452d261e2d.jpg',
            'image/carousle/4ae2d1b582605aeaf5e70edaf78f714d.jpg',
        ];

        $localPostImages = [
            'image/berita sekolah/juara loomba.jpg',
            'image/berita sekolah/murid baru.jpg',
            'image/berita sekolah/poersiapan UN.jpg',
            'image/berita sekolah/wisuda.jpg',
        ];

        $localGalleryImages = [
            'image/galeri sekolah/18f7e7fb14dc7df8a2d659d6942ce3a1.jpg',
            'image/galeri sekolah/1d1d9547cb9b041531def1c36672ae5c.jpg',
            'image/galeri sekolah/5a0cb997b4c4515cd66268a0950e6670.jpg',
            'image/galeri sekolah/8ed5288f66ec2d3665757c1d99dfe087.jpg',
            'image/galeri sekolah/984d7b5981ad2c1b7501ac45ab7c66ef.jpg',
            'image/galeri sekolah/a06af96f4e23ac25ee1829be978092e7.jpg',
            'image/galeri sekolah/d14f51476c74f59d5d34a682e22c9d04.jpg',
            'image/galeri sekolah/e5b40d0e4c902b505cbb1eac0846925c.jpg',
        ];

        $localTeacherImages = [
            'image/profile guru/014f6d0313bc5e8a9770823c9278f78b.jpg',
            'image/profile guru/1c9dfa273d3c347716aa25a51e6b37d5.jpg',
            'image/profile guru/2d0b7516d79dcdc10f811294574792ae.jpg',
            'image/profile guru/396c741c3d37ad0199ac220d16169e3e.jpg',
            'image/profile guru/60897dd68264f3220d1a128a00fec39b.jpg',
            'image/profile guru/7a7868d0a50534f9759244b98d3f6535.jpg',
            'image/profile guru/8244f61037a522a4911692b991d52890.jpg',
            'image/profile guru/8711dd2abf3ed1f4fe7cbf6bb7ad3d00.jpg',
            'image/profile guru/9b2d9c3dc2c1d8d9edd7b8e65d876032.jpg',
            'image/profile guru/c24d0d7542ee6be66bf4270123c15df4.jpg',
            'image/profile guru/d5efa4fc259e2af0ef4dd9ceb30637d2.jpg',
            'image/profile guru/ddd48f1b5d91bb92553439ba28ebbecc.jpg',
            'image/profile guru/ee174e22e4bc502ff6f40de9e21cc5fe.jpg',
        ];

        // Create Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@sekolah.com'],
            [
                'name' => 'Admin Sekolah',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '081234567890',
            ]
        );

        // Create Guru Users
        if (User::where('role', 'guru')->count() < 8) {
            $guruProfiles = [
                ['name' => 'Dra. Siti Nurhayati, M.Pd.', 'email' => 'siti.nurhayati@sekolah.com'],
                ['name' => 'Ahmad Pratama, S.Pd.', 'email' => 'ahmad.pratama@sekolah.com'],
                ['name' => 'Rina Wulandari, S.Pd.', 'email' => 'rina.wulandari@sekolah.com'],
                ['name' => 'Budi Santoso, M.Pd.', 'email' => 'budi.santoso@sekolah.com'],
                ['name' => 'Yuni Maharani, S.Pd.', 'email' => 'yuni.maharani@sekolah.com'],
                ['name' => 'Fajar Hidayat, S.Pd.', 'email' => 'fajar.hidayat@sekolah.com'],
                ['name' => 'Dewi Lestari, S.Pd.', 'email' => 'dewi.lestari@sekolah.com'],
                ['name' => 'Rizky Kurniawan, S.Pd.', 'email' => 'rizky.kurniawan@sekolah.com'],
            ];

            foreach ($guruProfiles as $profile) {
                User::firstOrCreate(
                    ['email' => $profile['email']],
                    [
                        'name' => $profile['name'],
                        'password' => Hash::make('password'),
                        'role' => 'guru',
                        'phone' => $faker->numerify('08##########'),
                    ]
                );
            }
        }

        // Create Siswa Users
        $targetSiswa = 60;
        $currentSiswa = User::where('role', 'siswa')->count();
        if ($currentSiswa < $targetSiswa) {
            User::factory($targetSiswa - $currentSiswa)->create([
                'role' => 'siswa',
            ]);
        }

        // Create Categories
        $categories = [
            ['name' => 'Berita Sekolah', 'slug' => 'berita-sekolah', 'description' => 'Berita dan informasi seputar kegiatan sekolah'],
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'description' => 'Prestasi dan pencapaian siswa dan sekolah'],
            ['name' => 'Kegiatan', 'slug' => 'kegiatan', 'description' => 'Kegiatan dan acara sekolah'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman', 'description' => 'Pengumuman penting dari sekolah'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'description' => 'Artikel dan informasi seputar pendidikan'],
            ['name' => 'Agenda', 'slug' => 'agenda', 'description' => 'Agenda akademik dan kegiatan terjadwal'],
            ['name' => 'Beasiswa', 'slug' => 'beasiswa', 'description' => 'Informasi beasiswa dan program dukungan belajar'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }

        // Create Posts (curated, professional)
        $categoryBySlug = Category::query()->get()->keyBy('slug');
        $guruIds = User::where('role', 'guru')->pluck('id');
        $authorPool = $guruIds->isNotEmpty() ? $guruIds->all() : [$admin->id];

        $curatedPosts = [
            [
                'title' => 'Kick Off Tahun Ajaran Baru: Fokus Karakter, Prestasi, dan Literasi Digital',
                'category' => 'berita-sekolah',
                'excerpt' => 'Memulai tahun ajaran baru dengan program penguatan karakter, pembiasaan literasi, serta pemanfaatan teknologi untuk pembelajaran yang lebih relevan.',
                'content' => "Tahun ajaran baru menjadi momentum untuk menyatukan langkah seluruh warga sekolah.\n\nPada pekan orientasi, siswa mengikuti sesi pengenalan budaya sekolah, tata tertib, serta pembiasaan literasi 15 menit sebelum pelajaran.\n\nSekolah juga memperkuat literasi digital melalui praktik keamanan berinternet, etika bermedia sosial, dan penggunaan platform pembelajaran.\n\nKami mengajak orang tua/wali untuk mendampingi anak belajar di rumah dan menjaga komunikasi yang baik dengan wali kelas.",
            ],
            [
                'title' => 'Jadwal Asesmen Sumatif Semester: Panduan dan Tata Tertib',
                'category' => 'pengumuman',
                'excerpt' => 'Informasi jadwal, ketentuan, dan hal-hal yang perlu dipersiapkan siswa menjelang asesmen sumatif semester.',
                'content' => "Asesmen sumatif semester akan dilaksanakan sesuai kalender akademik.\n\nHal yang perlu diperhatikan:\n- Datang 15 menit lebih awal\n- Membawa kartu peserta dan alat tulis\n- Menjaga ketertiban dan fokus selama ujian\n\nApabila berhalangan hadir karena alasan yang dapat dipertanggungjawabkan, segera lapor kepada wali kelas.",
            ],
            [
                'title' => 'Prestasi Membanggakan: Tim Olimpiade Sains Raih Medali Tingkat Provinsi',
                'category' => 'prestasi',
                'excerpt' => 'Tim olimpiade sains meraih medali pada ajang tingkat provinsi berkat latihan rutin, pendampingan guru, dan dukungan orang tua.',
                'content' => "Selamat kepada peserta didik yang berhasil meraih medali pada ajang olimpiade sains tingkat provinsi.\n\nPrestasi ini merupakan hasil dari:\n- Program pembinaan intensif setiap pekan\n- Try out dan evaluasi berkala\n- Pendampingan guru pembina dan alumni\n\nSekolah terus membuka ruang bagi siswa untuk mengembangkan minat dan bakat akademik maupun non-akademik.",
            ],
            [
                'title' => 'Program Gerakan Literasi Sekolah: Membaca, Menulis, dan Berbagi',
                'category' => 'pendidikan',
                'excerpt' => 'Gerakan literasi sekolah mendorong kebiasaan membaca dan menulis melalui aktivitas ringan namun konsisten.',
                'content' => "Gerakan Literasi Sekolah (GLS) dilaksanakan melalui pembiasaan membaca sebelum pelajaran, pojok baca kelas, dan kegiatan resensi.\n\nSetiap bulan, siswa diminta menulis ringkasan bacaan dan mempresentasikan temuan menarik di kelas.\n\nTujuan utama GLS adalah membangun kemampuan memahami informasi, menyusun argumen, dan berkomunikasi secara santun.",
            ],
            [
                'title' => 'Workshop Parenting: Pendampingan Belajar Efektif di Rumah',
                'category' => 'kegiatan',
                'excerpt' => 'Sekolah mengadakan workshop parenting untuk membangun pola pendampingan belajar yang sehat, konsisten, dan suportif.',
                'content' => "Workshop ini membahas cara membangun rutinitas belajar, mengelola penggunaan gawai, serta komunikasi yang efektif antara orang tua dan anak.\n\nNarasumber juga menekankan pentingnya menyeimbangkan target akademik dengan kesehatan mental.\n\nKegiatan ini menjadi bagian dari komitmen sekolah membangun ekosistem belajar yang kolaboratif.",
            ],
            [
                'title' => 'Agenda Bulanan: Kegiatan Akademik dan Ekstrakurikuler',
                'category' => 'agenda',
                'excerpt' => 'Rangkuman agenda bulanan agar siswa dan orang tua dapat mempersiapkan diri lebih baik.',
                'content' => "Agenda bulan ini meliputi:\n- Pembinaan OSN dan lomba debat\n- Latihan bersama ekstrakurikuler\n- Kegiatan kebersihan lingkungan sekolah\n- Pelaksanaan ulangan harian terjadwal\n\nSilakan pantau pengumuman wali kelas untuk perubahan jadwal.",
            ],
            [
                'title' => 'Informasi Beasiswa Prestasi dan KIP: Syarat dan Alur Pendaftaran',
                'category' => 'beasiswa',
                'excerpt' => 'Panduan ringkas mengenai syarat administrasi, tahapan seleksi, dan jadwal pendaftaran program beasiswa.',
                'content' => "Sekolah membuka pendampingan pendaftaran beasiswa prestasi dan KIP.\n\nSyarat umum:\n- Mengisi formulir\n- Melampirkan rapor dan surat keterangan\n- Berkas pendukung sesuai ketentuan program\n\nTim kesiswaan siap membantu verifikasi berkas agar proses pendaftaran lebih tertib dan tepat waktu.",
            ],
        ];

        foreach ($curatedPosts as $index => $post) {
            $title = $post['title'];
            $slug = Str::slug($title);
            $categoryId = $categoryBySlug[$post['category']]->id ?? $categoryBySlug->first()->id;

            $imagePath = $this->importLocalImage(
                $localPostImages[$index % count($localPostImages)],
                "images/posts/curated-{$index}.jpg"
            );

            Post::updateOrCreate(
                ['slug' => $slug],
                [
                    'user_id' => $authorPool[$index % count($authorPool)],
                    'category_id' => $categoryId,
                    'title' => $title,
                    'excerpt' => $post['excerpt'],
                    'content' => $post['content'],
                    'image' => $imagePath,
                    'is_published' => true,
                    'views' => $faker->numberBetween(120, 2400),
                ]
            );
        }

        // Add extra posts if needed for pagination/demo
        $targetPosts = 24;
        $currentPosts = Post::count();
        if ($currentPosts < $targetPosts) {
            $remaining = $targetPosts - $currentPosts;
            $categoryIds = Category::pluck('id');

            for ($i = 0; $i < $remaining; $i++) {
                $seedIndex = $currentPosts + $i;
                $imagePath = $this->importLocalImage(
                    $localPostImages[$seedIndex % count($localPostImages)],
                    "images/posts/post-{$seedIndex}.jpg"
                );

                $title = $faker->sentence(6);
                Post::create([
                    'user_id' => $authorPool[$seedIndex % count($authorPool)],
                    'category_id' => $categoryIds->random(),
                    'title' => $title,
                    'slug' => Str::slug($title) . '-' . Str::lower(Str::random(6)),
                    'excerpt' => $faker->paragraph(),
                    'content' => $faker->paragraphs(6, true),
                    'image' => $imagePath,
                    'is_published' => $faker->boolean(85),
                    'views' => $faker->numberBetween(0, 1800),
                ]);
            }
        }

        // Create Teachers
        $teacherPositions = [
            'Kepala Sekolah',
            'Wakil Kepala Sekolah',
            'Guru Matematika',
            'Guru Bahasa Indonesia',
            'Guru Bahasa Inggris',
            'Guru IPA',
            'Guru IPS',
            'Guru Agama',
            'Guru Olahraga',
            'Guru Seni Budaya',
            'Guru Wali Kelas',
            'Guru BK',
        ];

        $bios = [
            'Mengajar dengan pendekatan aktif dan membangun karakter siswa melalui contoh nyata.',
            'Fokus pada pembelajaran kolaboratif agar siswa terbiasa bekerja dalam tim.',
            'Mengintegrasikan teknologi dalam setiap sesi kelas untuk pengalaman belajar yang menyenangkan.',
            'Percaya bahwa setiap siswa unik dan perlu pendampingan sesuai potensi masing-masing.',
            'Mendorong siswa untuk berpikir kritis dan kreatif dalam memecahkan masalah.',
            'Membangun suasana kelas yang disiplin namun tetap hangat dan suportif.',
        ];

        foreach ($teacherPositions as $index => $position) {
            $photoStoragePath = "photos/teachers/human-{$index}.jpg";
            Storage::disk('public')->delete($photoStoragePath);

            $photoPath = $this->importLocalImage(
                $localTeacherImages[$index % count($localTeacherImages)],
                $photoStoragePath
            );

            Teacher::updateOrCreate([
                'position' => $position,
            ], [
                'name' => $faker->name(),
                'nip' => $faker->unique()->numerify('##########'),
                'position' => $position,
                'photo' => $photoPath,
                'bio' => $bios[$index % count($bios)],
                'email' => $faker->unique()->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'order' => $index,
                'is_active' => true,
                'media_sosial_json' => [
                    'facebook' => $faker->optional()->url(),
                    'instagram' => $faker->optional()->userName(),
                ],
            ]);
        }

        // Create School Settings (professional dummy profile)
        $setting = SchoolSetting::firstOrCreate([]);
        $schoolProfile = [
            'nama_sekolah' => 'SMA Cendekia Nusantara Bandung',
            'description' => 'SMA Cendekia Nusantara Bandung adalah sekolah menengah atas yang berfokus pada penguatan karakter, literasi, dan sains melalui pembelajaran berbasis proyek. Kami menerapkan Kurikulum Merdeka dengan dukungan program bimbingan prestasi, layanan konseling, serta kolaborasi aktif bersama orang tua dan alumni.',
            'visi_misi' => "Visi:\nMenjadi sekolah unggul yang berkarakter, berprestasi, dan adaptif terhadap perkembangan teknologi.\n\nMisi:\n1. Menyelenggarakan pembelajaran bermutu yang aman, inklusif, dan berpusat pada peserta didik.\n2. Mengembangkan budaya literasi, numerasi, dan riset sederhana dalam kegiatan belajar.\n3. Memfasilitasi pengembangan minat-bakat melalui ekstrakurikuler dan program prestasi.\n4. Memperkuat pendidikan karakter: disiplin, integritas, gotong royong, dan kepedulian sosial.\n5. Membangun kemitraan strategis dengan orang tua, alumni, dunia usaha, dan perguruan tinggi.",
            'alamat' => 'Jl. Ir. H. Juanda No. 45, Dago, Kota Bandung, Jawa Barat 40135',
            'email_kontak' => 'info@smacendekianusantara.sch.id',
            'phone' => '(022) 2550 123',
            'website' => 'https://smacendekianusantara.sch.id',
            'map_url' => 'https://www.google.com/maps?q=-6.8855,107.6130&z=15&output=embed',
            'primary_color' => '#0ea5e9',
        ];

        $setting->fill([
            'nama_sekolah' => $schoolProfile['nama_sekolah'],
            'visi_misi' => $schoolProfile['visi_misi'],
            'alamat' => $schoolProfile['alamat'],
            'email_kontak' => $schoolProfile['email_kontak'],
            'phone' => $schoolProfile['phone'],
            'website' => $schoolProfile['website'],
            'map_url' => $schoolProfile['map_url'],
            'description' => $schoolProfile['description'],
            'primary_color' => $schoolProfile['primary_color'],
        ])->save();

        // Create Hero Slides
        $heroSlides = [
            [
                'title' => 'Selamat Datang di ' . ($setting->nama_sekolah ?? 'Website Sekolah'),
                'subtitle' => 'Portal informasi sekolah: akademik, kegiatan, prestasi, dan layanan PPDB dalam satu tempat.',
                'image' => $this->importLocalImage($localHeroImages[0], 'images/hero/hero-1.jpg'),
                'order' => 1,
            ],
            [
                'title' => 'Pembelajaran Berbasis Proyek & Literasi Digital',
                'subtitle' => 'Mendorong kreativitas, kolaborasi, dan pemecahan masalah melalui kegiatan nyata.',
                'image' => $this->importLocalImage($localHeroImages[1], 'images/hero/hero-2.jpg'),
                'order' => 2,
            ],
            [
                'title' => 'Prestasi, Ekstrakurikuler, dan Pembinaan Karakter',
                'subtitle' => 'Wadah berkembang untuk akademik dan non-akademik: OSN, olahraga, seni, organisasi, dan kepemimpinan.',
                'image' => $this->importLocalImage($localHeroImages[2], 'images/hero/hero-3.jpg'),
                'order' => 3,
            ],
        ];

        foreach ($heroSlides as $slide) {
            HeroSlide::updateOrCreate(
                ['order' => $slide['order']],
                [
                    'title' => $slide['title'],
                    'subtitle' => $slide['subtitle'],
                    'image' => $slide['image'],
                    'is_active' => true,
                ]
            );
        }

        HeroSlide::query()
            ->whereNotIn('order', collect($heroSlides)->pluck('order')->all())
            ->update(['is_active' => false]);

        // Create PPDB Registrations
        $targetPpdb = 18;
        $currentPpdb = PpdbRegistration::count();
        if ($currentPpdb < $targetPpdb) {
            for ($i = 0; $i < ($targetPpdb - $currentPpdb); $i++) {
                PpdbRegistration::create([
                    'nama_lengkap' => $faker->name(),
                    'nisn' => $faker->unique()->numerify('##########'),
                    'asal_sekolah' => 'SMP ' . $faker->city() . ' ' . $faker->randomElement(['1', '2', '3', '4', '5']),
                    'email' => $faker->unique()->safeEmail(),
                    'no_hp' => $faker->numerify('08##########'),
                    'status' => $faker->randomElement(['pending', 'proses', 'diterima']),
                    'notes' => [
                        'tempat_lahir' => $faker->city(),
                        'tanggal_lahir' => $faker->dateTimeBetween('-18 years', '-14 years')->format('Y-m-d'),
                        'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                        'alamat' => $faker->address(),
                        'alamat_sekolah' => $faker->address(),
                        'tahun_lulus' => (int) now()->format('Y'),
                    ],
                ]);
            }
        }

        // Create Galleries
        $galleryItems = [
            ['title' => 'Upacara Bendera', 'category' => 'kegiatan'],
            ['title' => 'Fasilitas Laboratorium', 'category' => 'fasilitas'],
            ['title' => 'Prestasi Olimpiade', 'category' => 'prestasi'],
            ['title' => 'Kegiatan Pramuka', 'category' => 'kegiatan'],
            ['title' => 'Perpustakaan Sekolah', 'category' => 'fasilitas'],
            ['title' => 'Ekstrakurikuler Basket', 'category' => 'kegiatan'],
        ];

        foreach ($galleryItems as $index => $item) {
            \App\Models\Gallery::updateOrCreate(
                ['title' => $item['title']],
                [
                    'description' => $faker->sentence(),
                    'image' => $this->importLocalImage(
                        $localGalleryImages[$index % count($localGalleryImages)],
                        "images/gallery/gallery-{$index}.jpg"
                    ),
                    'category' => $item['category'],
                    'is_published' => true,
                    'order' => $index,
                ]
            );
        }

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin Login: admin@sekolah.com / password');
    }

    /**
     * Create a reusable placeholder image in the public storage disk.
     */
    protected function createPlaceholderImage(string $path, ?string $url = null): string
    {
        if (!Storage::disk('public')->exists($path)) {
            if ($url) {
                $response = Http::timeout(10)->get($url);
                if ($response->successful()) {
                    Storage::disk('public')->put($path, $response->body());
                    return $path;
                }
            }

            // 600x400 png, light gray background with simple pixel data
            $placeholder = base64_decode(
                'iVBORw0KGgoAAAANSUhEUgAAAlgAAAEgCAIAAABbgVa0AAAACXBIWXMAAAsTAAALEwEAmpwYAAAK' .
                'T2lDQ1BJQ0MgUHJvZmlsZQAASImVlwdUU8kWx/+1l112gZJsgIQkIQhCHdIUQQoAEJJJgQUJACQQ' .
                'SQpCRBOCCGJClAQERERQRQhFb2/3vt3Xvvtm9mZ6bP7szuzL7zrnnHvvef8zs7fOuefe73XPOb9d' .
                'OROAbANxJsmLc6QaYAIAEUa0XhYIHxAEqlJyJmWFkX8DcCClR05uNJPcx2u+VCuQwBRSF9H/5f8H' .
                'M6npq0x2ePZjB0cwv0cAwNvYVJ7SW/7j5R4S5tQG6hM7MCu4xgBtB1q+Xn/7mcOyvd4JcDbyP35f' .
                'VPnFfkMBvd1u52p9BfHfV7rsOFXymBVd5UqDm+grGJShuF++sB/1b7+T6Tvr6RJA8P3SwWwGQiaR' .
                'CrgLwii1ciIrgAMH/7Hz/d3fbfVasOwF+gLsrgSkA6oOg94Ghv0BnwAFVoD6GAS9ANUOg/4PqkbQ' .
                'C1QG0BtoB+gawBaz68H1qcB/Kzv9cs7gNl4f8sB2O9Y7Ht+fU61NuwVAAAAAlwSFlzAAAOxAAADs' .
                'QBlSsOGwAAABl0RVh0Q3JlYXRpb24gVGltZQAwMi8xMC8xOqM2vqkAAAAcdEVYdFNvZnR3YXJlAF' .
                'BhaW50Lk5FVCB2My41LjExRHCNugAAACF0RVh0RGVzY3JpcHRpb24AU2ltcGxlIGdyYXkgcGxhY2' .
                'Vob2xkZXKpguTeAAACiUlEQVR42u3VMQ0AAAgDINc/9K3hHKAg4K0mEDMPAPCz7fcDK/dX1XVd1X' .
                '1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XV' .
                'd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X' .
                '1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XV' .
                'd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X' .
                '1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XV' .
                'd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X' .
                '1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XV' .
                'd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X1XVd1X' .
                '1XUdAD0RWnoAfx0NsAAAAASUVORK5CYII='
            );

            Storage::disk('public')->put($path, $placeholder);
        }

        return $path;
    }

    protected function importLocalImage(string $publicPath, string $storagePath): string
    {
        $source = public_path($publicPath);

        if (is_file($source)) {
            Storage::disk('public')->put($storagePath, file_get_contents($source));
            return $storagePath;
        }

        return $this->createPlaceholderImage($storagePath);
    }

    protected function fetchRandomUserPortraits(int $count, string $nat = 'id'): array
    {
        if ($count <= 0) return [];

        try {
            $response = Http::timeout(15)
                ->retry(2, 200)
                ->get('https://randomuser.me/api/', [
                    'results' => $count,
                    'nat' => $nat,
                    'inc' => 'picture',
                    'noinfo' => '1',
                ]);

            if (!$response->successful()) return [];

            $results = $response->json('results');
            if (!is_array($results)) return [];

            $urls = [];
            foreach ($results as $result) {
                $url = $result['picture']['large'] ?? $result['picture']['medium'] ?? null;
                if (is_string($url) && $url !== '') {
                    $urls[] = $url;
                }
            }

            return $urls;
        } catch (\Throwable $e) {
            return [];
        }
    }
}


