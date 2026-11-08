<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Hrd;
use App\Models\Pelamar;
use App\Models\ProfilPerusahaan;
use App\Models\Departemen;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use App\Models\Wawancara;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── 1. Profil Perusahaan ──────────────────────────────────────────────
        $profil = ProfilPerusahaan::create([
            'nama_perusahaan' => 'PT. SURVIOUS',
            'logo'            => null,
            'alamat'          => 'Jl. Sudirman No. 88, Jakarta Selatan, DKI Jakarta 12190',
            'deskripsi'       => 'PT. SURVIOUS adalah perusahaan teknologi informasi dan jasa digital yang berfokus pada pembangunan solusi software, aplikasi web, dan layanan transformasi digital untuk berbagai industri. Kami berkomitmen menghadirkan inovasi teknologi yang tepat guna, andal, dan berdampak nyata bagi klien kami di seluruh Indonesia.',
            'email'           => 'info@survious.co.id',
            'telepon'         => '(021) 5555-8888',
            'website'         => 'https://www.survious.co.id',
        ]);

        // ── 2. Admin ──────────────────────────────────────────────────────────
        $admin = Admin::create([
            'nama_admin' => 'Administrator',
            'username'   => 'admin',
            'password'   => Hash::make('admin123'),
            'no_hp'      => '081234567890',
        ]);

        // ── 3. HRD ───────────────────────────────────────────────────────────
        $hrd1 = Hrd::create([
            'id_admin' => $admin->id_admin,
            'nama_hrd' => 'nasrudin sidik',
            'email'    => 'hrd1@surviouss.co.id',
            'password' => Hash::make('hrd12345'),
            'no_hp'    => '081298765432',
            'jabatan'  => 'HR Manager',
        ]);

        $hrd2 = Hrd::create([
            'id_admin' => $admin->id_admin,
            'nama_hrd' => 'Budi Santoso',
            'email'    => 'hrd2@surviouss.co.id',
            'password' => Hash::make('hrd12345'),
            'no_hp'    => '087712345678',
            'jabatan'  => 'HR Staff',
        ]);

        // ── 4. Pelamar ────────────────────────────────────────────────────────
        $pelamar1 = Pelamar::create([
            'nama'       => 'Ahmad Rizki Pratama',
            'email'      => 'ahmad.rizki@gmaail.com',
            'password'   => Hash::make('pelamar123'),
            'no_hp'      => '081312345678',
            'alamat'     => 'Jl. Merpati No. 12, Depok, Jawa Barat',
            'pendidikan' => 'S1',
            'cv'         => null,
        ]);

        $pelamar2 = Pelamar::create([
            'nama'       => 'Dewi Rahayu Kusuma',
            'email'      => 'dewi.rahayu@gmail.com',
            'password'   => Hash::make('pelamar123'),
            'no_hp'      => '089987654321',
            'alamat'     => 'Jl. Flamboyan No. 5, Bandung, Jawa Barat',
            'pendidikan' => 'S1',
            'cv'         => null,
        ]);

        $pelamar3 = Pelamar::create([
            'nama'       => 'Fajar Nugroho Wibowo',
            'email'      => 'fajar.nugroho@yahoo.com',
            'password'   => Hash::make('pelamar123'),
            'no_hp'      => '085611223344',
            'alamat'     => 'Jl. Kenanga No. 20, Jakarta Timur, DKI Jakarta',
            'pendidikan' => 'D3',
            'cv'         => null,
        ]);

        // ── 5. Departemen ─────────────────────────────────────────────────────
        $deptIT = Departemen::create([
            'nama_departemen' => 'IT',
            'deskripsi'       => 'Departemen Teknologi Informasi bertanggung jawab atas pengembangan, pemeliharaan, dan inovasi sistem teknologi perusahaan.',
        ]);

        $deptHR = Departemen::create([
            'nama_departemen' => 'Human Resources',
            'deskripsi'       => 'Departemen Sumber Daya Manusia mengelola rekrutmen, pengembangan karyawan, dan kesejahteraan tenaga kerja.',
        ]);

        $deptMarketing = Departemen::create([
            'nama_departemen' => 'Marketing',
            'deskripsi'       => 'Departemen Pemasaran bertanggung jawab atas strategi pemasaran, branding, dan komunikasi perusahaan.',
        ]);

        $deptFinance = Departemen::create([
            'nama_departemen' => 'Finance',
            'deskripsi'       => 'Departemen Keuangan mengelola anggaran, laporan keuangan, dan perencanaan finansial perusahaan.',
        ]);

        $deptOps = Departemen::create([
            'nama_departemen' => 'Operasional',
            'deskripsi'       => 'Departemen Operasional memastikan kelancaran proses bisnis sehari-hari dan efisiensi operasional perusahaan.',
        ]);

        // ── 6. Lowongan (8 posisi aktif) ──────────────────────────────────────
        $tglTutup = Carbon::now()->addDays(30)->toDateString();

        $low1 = Lowongan::create([
            'id_hrd'        => $hrd1->id_hrd,
            'id_departemen' => $deptIT->id_departemen,
            'judul'         => 'Frontend Developer',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nKami mencari Frontend Developer yang berpengalaman untuk bergabung bersama tim IT kami.\n\n**Tanggung Jawab:**\n- Membangun antarmuka pengguna yang responsif dan menarik menggunakan React.js atau Vue.js\n- Berkolaborasi dengan tim backend untuk integrasi API\n- Mengoptimalkan performa aplikasi web\n- Memastikan kompatibilitas lintas browser\n\n**Kualifikasi:**\n- Pendidikan minimal S1 Teknik Informatika atau bidang terkait\n- Pengalaman minimal 2 tahun sebagai Frontend Developer\n- Menguasai HTML5, CSS3, JavaScript (ES6+)\n- Familiar dengan framework React.js atau Vue.js\n- Memahami konsep RESTful API\n- Mampu bekerja secara tim maupun mandiri",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 8.000.000 - Rp 15.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low2 = Lowongan::create([
            'id_hrd'        => $hrd1->id_hrd,
            'id_departemen' => $deptIT->id_departemen,
            'judul'         => 'Backend Developer Laravel',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nPosisi Backend Developer Laravel untuk membangun dan memelihara sistem backend perusahaan.\n\n**Tanggung Jawab:**\n- Mengembangkan dan memelihara aplikasi backend menggunakan Laravel\n- Merancang dan mengoptimalkan struktur database MySQL\n- Membuat dan mendokumentasikan RESTful API\n- Melakukan code review dan memastikan kualitas kode\n\n**Kualifikasi:**\n- Pendidikan minimal S1 Teknik Informatika\n- Pengalaman minimal 2 tahun menggunakan Laravel\n- Menguasai PHP, MySQL, dan konsep MVC\n- Memahami Git dan version control\n- Pengalaman dengan Redis atau queue system menjadi nilai tambah",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 9.000.000 - Rp 18.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low3 = Lowongan::create([
            'id_hrd'        => $hrd1->id_hrd,
            'id_departemen' => $deptIT->id_departemen,
            'judul'         => 'UI/UX Designer',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nKami membuka posisi UI/UX Designer berbasis kontrak untuk proyek-proyek digital kami.\n\n**Tanggung Jawab:**\n- Merancang wireframe, prototype, dan desain visual aplikasi\n- Melakukan riset pengguna dan usability testing\n- Berkolaborasi dengan tim developer untuk implementasi desain\n- Memastikan konsistensi desain sesuai brand guideline\n\n**Kualifikasi:**\n- Pendidikan minimal D3/S1 Desain Komunikasi Visual atau terkait\n- Pengalaman minimal 1 tahun sebagai UI/UX Designer\n- Menguasai Figma, Adobe XD, atau tools desain sejenis\n- Memiliki portfolio desain yang kuat\n- Memahami prinsip-prinsip UX dan user-centered design",
            'lokasi'        => 'Remote',
            'kategori'      => 'Kontrak',
            'gaji'          => 'Rp 6.000.000 - Rp 12.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low4 = Lowongan::create([
            'id_hrd'        => $hrd2->id_hrd,
            'id_departemen' => $deptIT->id_departemen,
            'judul'         => 'IT Support',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nDibutuhkan IT Support untuk memastikan kelancaran operasional teknologi di kantor.\n\n**Tanggung Jawab:**\n- Memberikan dukungan teknis kepada karyawan\n- Menginstalasi, mengkonfigurasi, dan memelihara perangkat keras dan lunak\n- Mengelola jaringan dan sistem keamanan IT\n- Mendokumentasikan permasalahan dan solusi teknis\n\n**Kualifikasi:**\n- Pendidikan minimal D3 Teknik Informatika atau Sistem Informasi\n- Pengalaman minimal 1 tahun di bidang IT Support\n- Memahami jaringan komputer (LAN, WAN, Wi-Fi)\n- Mampu menangani troubleshooting hardware dan software\n- Sertifikasi CCNA atau CompTIA menjadi nilai tambah",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 5.000.000 - Rp 8.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low5 = Lowongan::create([
            'id_hrd'        => $hrd1->id_hrd,
            'id_departemen' => $deptHR->id_departemen,
            'judul'         => 'Staff Rekrutmen',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nKami mencari Staff Rekrutmen yang berpengalaman untuk memperkuat tim HR kami.\n\n**Tanggung Jawab:**\n- Mengelola proses rekrutmen end-to-end mulai dari posting lowongan hingga onboarding\n- Melakukan screening CV, wawancara awal, dan koordinasi seleksi\n- Membangun database kandidat yang terstruktur\n- Berkoordinasi dengan manajer departemen terkait kebutuhan SDM\n\n**Kualifikasi:**\n- Pendidikan minimal S1 Psikologi, Manajemen SDM, atau bidang terkait\n- Pengalaman minimal 1 tahun di bidang rekrutmen\n- Mampu mengoperasikan ATS (Applicant Tracking System)\n- Komunikatif, teliti, dan mampu bekerja di bawah tekanan\n- Memiliki kemampuan negosiasi yang baik",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 5.500.000 - Rp 9.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low6 = Lowongan::create([
            'id_hrd'        => $hrd2->id_hrd,
            'id_departemen' => $deptMarketing->id_departemen,
            'judul'         => 'Digital Marketing Specialist',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nDibutuhkan Digital Marketing Specialist untuk mengelola strategi pemasaran digital perusahaan.\n\n**Tanggung Jawab:**\n- Merancang dan mengeksekusi kampanye digital marketing (SEO, SEM, Social Media)\n- Menganalisis data kampanye dan membuat laporan performa\n- Mengelola akun media sosial perusahaan\n- Berkoordinasi dengan tim konten untuk pembuatan materi iklan\n\n**Kualifikasi:**\n- Pendidikan minimal S1 Marketing, Komunikasi, atau terkait\n- Pengalaman minimal 2 tahun di bidang digital marketing\n- Menguasai Google Ads, Facebook Ads, dan platform iklan digital\n- Familiar dengan Google Analytics dan tools SEO\n- Memiliki kemampuan analitik yang kuat",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 7.000.000 - Rp 13.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low7 = Lowongan::create([
            'id_hrd'        => $hrd2->id_hrd,
            'id_departemen' => $deptMarketing->id_departemen,
            'judul'         => 'Content Creator',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nProgram magang Content Creator untuk mahasiswa yang ingin belajar di lingkungan profesional.\n\n**Tanggung Jawab:**\n- Membuat konten kreatif untuk media sosial (Instagram, TikTok, LinkedIn)\n- Membantu pembuatan artikel blog dan konten website\n- Mengikuti briefing kreatif dari tim marketing\n- Mendukung kampanye digital perusahaan\n\n**Kualifikasi:**\n- Mahasiswa aktif semester 5-8 jurusan Komunikasi, DKV, atau terkait\n- Memiliki kemampuan desain grafis dasar (Canva, Adobe)\n- Kreatif, proaktif, dan up-to-date dengan tren media sosial\n- Mampu membuat copywriting yang menarik\n- Bersedia magang minimal 3 bulan",
            'lokasi'        => 'Bandung',
            'kategori'      => 'Magang',
            'gaji'          => 'Rp 1.500.000 - Rp 2.500.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        $low8 = Lowongan::create([
            'id_hrd'        => $hrd1->id_hrd,
            'id_departemen' => $deptFinance->id_departemen,
            'judul'         => 'Staff Akuntansi',
            'deskripsi'     => "**Deskripsi Pekerjaan:**\nDibutuhkan Staff Akuntansi untuk mendukung operasional keuangan perusahaan.\n\n**Tanggung Jawab:**\n- Menyusun laporan keuangan bulanan dan tahunan\n- Mengelola siklus akuntansi (jurnal, buku besar, neraca)\n- Memproses invoice, pembayaran, dan rekonsiliasi bank\n- Memastikan kepatuhan perpajakan perusahaan\n\n**Kualifikasi:**\n- Pendidikan minimal S1 Akuntansi\n- Pengalaman minimal 1 tahun di bidang akuntansi\n- Menguasai software akuntansi (MYOB, accurate, atau sejenis)\n- Memahami peraturan perpajakan Indonesia\n- Teliti, detail-oriented, dan mampu bekerja dengan deadline ketat\n- Memiliki sertifikasi Brevet A/B menjadi nilai tambah",
            'lokasi'        => 'Jakarta',
            'kategori'      => 'Full Time',
            'gaji'          => 'Rp 6.000.000 - Rp 10.000.000',
            'tgl_tutup'     => $tglTutup,
            'status'        => 'aktif',
        ]);

        // ── 7. Lamaran (5 contoh dengan status bervariasi) ────────────────────
        $lam1 = Lamaran::create([
            'id_pelamar'     => $pelamar1->id_pelamar,
            'id_lowongan'    => $low1->id_lowongan,
            'tgl_lamar'      => Carbon::now()->subDays(10)->toDateString(),
            'status_lamaran' => 'Wawancara',
            'catatan_hrd'    => 'Kandidat lolos seleksi berkas dan tes teknis. Dijadwalkan wawancara tahap akhir.',
        ]);

        $lam2 = Lamaran::create([
            'id_pelamar'     => $pelamar2->id_pelamar,
            'id_lowongan'    => $low2->id_lowongan,
            'tgl_lamar'      => Carbon::now()->subDays(7)->toDateString(),
            'status_lamaran' => 'Diterima Berkas',
            'catatan_hrd'    => 'Berkas lengkap dan memenuhi kualifikasi dasar.',
        ]);

        $lam3 = Lamaran::create([
            'id_pelamar'     => $pelamar3->id_pelamar,
            'id_lowongan'    => $low4->id_lowongan,
            'tgl_lamar'      => Carbon::now()->subDays(5)->toDateString(),
            'status_lamaran' => 'Seleksi',
            'catatan_hrd'    => 'Berkas diterima, sedang dalam proses seleksi tes kompetensi.',
        ]);

        $lam4 = Lamaran::create([
            'id_pelamar'     => $pelamar1->id_pelamar,
            'id_lowongan'    => $low5->id_lowongan,
            'tgl_lamar'      => Carbon::now()->subDays(3)->toDateString(),
            'status_lamaran' => 'Diterima',
            'catatan_hrd'    => 'Kandidat dinyatakan diterima. Silakan menghubungi HRD untuk proses onboarding.',
        ]);

        $lam5 = Lamaran::create([
            'id_pelamar'     => $pelamar2->id_pelamar,
            'id_lowongan'    => $low6->id_lowongan,
            'tgl_lamar'      => Carbon::now()->subDays(2)->toDateString(),
            'status_lamaran' => 'Menunggu',
            'catatan_hrd'    => null,
        ]);

        // ── 8. Dokumen Lamaran ────────────────────────────────────────────────
        DokumenLamaran::create([
            'id_lamaran'    => $lam1->id_lamaran,
            'jenis_dokumen' => 'CV',
            'nama_file'     => 'CV_Ahmad_Rizki.pdf',
            'path_file'     => 'dokumen/contoh_cv.pdf',
        ]);

        DokumenLamaran::create([
            'id_lamaran'    => $lam1->id_lamaran,
            'jenis_dokumen' => 'Ijazah',
            'nama_file'     => 'Ijazah_Ahmad_Rizki.pdf',
            'path_file'     => 'dokumen/contoh_ijazah.pdf',
        ]);

        DokumenLamaran::create([
            'id_lamaran'    => $lam2->id_lamaran,
            'jenis_dokumen' => 'CV',
            'nama_file'     => 'CV_Dewi_Rahayu.pdf',
            'path_file'     => 'dokumen/contoh_cv2.pdf',
        ]);

        // ── 9. Wawancara (2 jadwal contoh) ───────────────────────────────────
        Wawancara::create([
            'id_lamaran'    => $lam1->id_lamaran,
            'tgl_wawancara' => Carbon::now()->addDays(3)->toDateString(),
            'jam'           => '09:00:00',
            'tempat'        => 'Kantor PT. SURVIOUS - Ruang Meeting Lt. 3, Jl. Sudirman No. 88 Jakarta',
            'hasil'         => null,
        ]);

        Wawancara::create([
            'id_lamaran'    => $lam3->id_lamaran,
            'tgl_wawancara' => Carbon::now()->addDays(5)->toDateString(),
            'jam'           => '13:00:00',
            'tempat'        => 'Kantor PT. SURVIOUS - Ruang Interview Lt. 2, Jl. Sudirman No. 88 Jakarta',
            'hasil'         => null,
        ]);
    }
}
