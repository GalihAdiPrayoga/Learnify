<?php

namespace Database\Seeders;

use App\Models\Materi;
use App\Models\Soal;
use Illuminate\Database\Seeder;

class SoalSeeder extends Seeder
{
    public function run(): void
    {
        $soalData = [
            // ============ Kelas 1: Dasar Pemrograman Web ============
            'Pengenalan HTML' => [
                ['pertanyaan' => 'Apa kepanjangan dari HTML?', 'jawaban_a' => 'Hyper Text Markup Language', 'jawaban_b' => 'High Tech Modern Language', 'jawaban_c' => 'Hyper Transfer Markup Language', 'jawaban_d' => 'Home Tool Markup Language', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Tag HTML mana yang digunakan untuk membuat paragraf?', 'jawaban_a' => '<text>', 'jawaban_b' => '<p>', 'jawaban_c' => '<para>', 'jawaban_d' => '<pg>', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Tag mana yang digunakan untuk heading terbesar?', 'jawaban_a' => '<h6>', 'jawaban_b' => '<heading>', 'jawaban_c' => '<h1>', 'jawaban_d' => '<head>', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Elemen HTML mana yang merupakan root dari dokumen HTML?', 'jawaban_a' => '<body>', 'jawaban_b' => '<head>', 'jawaban_c' => '<title>', 'jawaban_d' => '<html>', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Tag yang benar untuk membuat hyperlink adalah?', 'jawaban_a' => '<a>', 'jawaban_b' => '<link>', 'jawaban_c' => '<href>', 'jawaban_d' => '<url>', 'jawaban_benar' => 'a'],
            ],
            'Dasar CSS' => [
                ['pertanyaan' => 'Apa kepanjangan dari CSS?', 'jawaban_a' => 'Creative Style Sheets', 'jawaban_b' => 'Cascading Style Sheets', 'jawaban_c' => 'Computer Style Sheets', 'jawaban_d' => 'Colorful Style Sheets', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Property CSS mana yang mengubah warna teks?', 'jawaban_a' => 'text-color', 'jawaban_b' => 'font-color', 'jawaban_c' => 'color', 'jawaban_d' => 'text-style', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Cara yang direkomendasikan untuk menambahkan CSS adalah?', 'jawaban_a' => 'Inline CSS', 'jawaban_b' => 'Internal CSS', 'jawaban_c' => 'External CSS', 'jawaban_d' => 'Embedded CSS', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Selector CSS yang memilih elemen berdasarkan ID menggunakan simbol?', 'jawaban_a' => '.', 'jawaban_b' => '#', 'jawaban_c' => '*', 'jawaban_d' => '@', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Box model CSS terdiri dari margin, border, padding, dan?', 'jawaban_a' => 'Width', 'jawaban_b' => 'Height', 'jawaban_c' => 'Content', 'jawaban_d' => 'Display', 'jawaban_benar' => 'c'],
            ],
            'JavaScript Dasar' => [
                ['pertanyaan' => 'Keyword mana yang digunakan untuk mendeklarasikan variabel yang tidak bisa diubah?', 'jawaban_a' => 'var', 'jawaban_b' => 'let', 'jawaban_c' => 'const', 'jawaban_d' => 'static', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Tipe data mana yang BUKAN tipe data primitif di JavaScript?', 'jawaban_a' => 'String', 'jawaban_b' => 'Number', 'jawaban_c' => 'Array', 'jawaban_d' => 'Boolean', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Bagaimana cara menulis komentar satu baris di JavaScript?', 'jawaban_a' => '<!-- komentar -->', 'jawaban_b' => '// komentar', 'jawaban_c' => '/* komentar */', 'jawaban_d' => '# komentar', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Fungsi JavaScript yang menampilkan pesan dialog adalah?', 'jawaban_a' => 'msg()', 'jawaban_b' => 'msgBox()', 'jawaban_c' => 'alert()', 'jawaban_d' => 'prompt()', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Operator === di JavaScript memeriksa?', 'jawaban_a' => 'Nilai saja', 'jawaban_b' => 'Tipe saja', 'jawaban_c' => 'Nilai dan tipe', 'jawaban_d' => 'Referensi memori', 'jawaban_benar' => 'c'],
            ],
            'DOM Manipulation' => [
                ['pertanyaan' => 'Apa kepanjangan dari DOM?', 'jawaban_a' => 'Document Object Model', 'jawaban_b' => 'Data Object Management', 'jawaban_c' => 'Digital Oriented Module', 'jawaban_d' => 'Document Order Method', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Method mana yang memilih elemen berdasarkan ID?', 'jawaban_a' => 'querySelector()', 'jawaban_b' => 'getElementsByClassName()', 'jawaban_c' => 'getElementById()', 'jawaban_d' => 'getElementByName()', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Property mana yang mengubah konten teks sebuah elemen?', 'jawaban_a' => 'innerText', 'jawaban_b' => 'textContent', 'jawaban_c' => 'innerHTML', 'jawaban_d' => 'Semua benar', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Method untuk menambahkan event handler pada elemen adalah?', 'jawaban_a' => 'addEvent()', 'jawaban_b' => 'addEventListener()', 'jawaban_c' => 'attachEvent()', 'jawaban_d' => 'onEvent()', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'querySelectorAll() mengembalikan?', 'jawaban_a' => 'Satu elemen', 'jawaban_b' => 'HTMLCollection', 'jawaban_c' => 'NodeList', 'jawaban_d' => 'Array', 'jawaban_benar' => 'c'],
            ],
            'Responsive Web Design' => [
                ['pertanyaan' => 'Meta tag viewport digunakan untuk?', 'jawaban_a' => 'SEO optimization', 'jawaban_b' => 'Mengatur lebar tampilan di perangkat mobile', 'jawaban_c' => 'Menambahkan favicon', 'jawaban_d' => 'Menghubungkan CSS', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Property CSS mana yang membuat layout flexbox?', 'jawaban_a' => 'display: block', 'jawaban_b' => 'display: inline', 'jawaban_c' => 'display: flex', 'jawaban_d' => 'display: grid', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Media query digunakan untuk?', 'jawaban_a' => 'Menambahkan animasi', 'jawaban_b' => 'Menerapkan style berdasarkan kondisi perangkat', 'jawaban_c' => 'Mengimpor font', 'jawaban_d' => 'Mengoptimasi gambar', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Breakpoint umum untuk tablet adalah?', 'jawaban_a' => '320px', 'jawaban_b' => '480px', 'jawaban_c' => '768px', 'jawaban_d' => '1200px', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'CSS Grid property grid-template-columns mengatur?', 'jawaban_a' => 'Jumlah baris', 'jawaban_b' => 'Jumlah dan ukuran kolom', 'jawaban_c' => 'Gap antar elemen', 'jawaban_d' => 'Posisi elemen', 'jawaban_benar' => 'b'],
            ],

            // ============ Kelas 2: Basis Data ============
            'Pengenalan Basis Data' => [
                ['pertanyaan' => 'DBMS adalah singkatan dari?', 'jawaban_a' => 'Data Base Management System', 'jawaban_b' => 'Database Manipulation Software', 'jawaban_c' => 'Data Basic Modern System', 'jawaban_d' => 'Digital Base Management System', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Manakah yang termasuk RDBMS?', 'jawaban_a' => 'MongoDB', 'jawaban_b' => 'Redis', 'jawaban_c' => 'MySQL', 'jawaban_d' => 'Cassandra', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Primary Key berfungsi sebagai?', 'jawaban_a' => 'Password database', 'jawaban_b' => 'Identitas unik setiap record', 'jawaban_c' => 'Nama tabel', 'jawaban_d' => 'Kunci enkripsi', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Foreign Key digunakan untuk?', 'jawaban_a' => 'Mengunci tabel', 'jawaban_b' => 'Menghapus data', 'jawaban_c' => 'Mereferensikan tabel lain', 'jawaban_d' => 'Membuat index', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Manakah yang termasuk database NoSQL?', 'jawaban_a' => 'PostgreSQL', 'jawaban_b' => 'Oracle', 'jawaban_c' => 'SQL Server', 'jawaban_d' => 'MongoDB', 'jawaban_benar' => 'd'],
            ],
            'SQL Dasar - DDL' => [
                ['pertanyaan' => 'DDL adalah singkatan dari?', 'jawaban_a' => 'Data Definition Language', 'jawaban_b' => 'Data Description Language', 'jawaban_c' => 'Database Design Language', 'jawaban_d' => 'Data Development Library', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Perintah SQL untuk membuat tabel baru adalah?', 'jawaban_a' => 'MAKE TABLE', 'jawaban_b' => 'NEW TABLE', 'jawaban_c' => 'CREATE TABLE', 'jawaban_d' => 'ADD TABLE', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Perintah untuk mengubah struktur tabel adalah?', 'jawaban_a' => 'MODIFY TABLE', 'jawaban_b' => 'ALTER TABLE', 'jawaban_c' => 'CHANGE TABLE', 'jawaban_d' => 'UPDATE TABLE', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'AUTO_INCREMENT pada kolom digunakan untuk?', 'jawaban_a' => 'Menambah ukuran kolom', 'jawaban_b' => 'Menambah nilai otomatis pada setiap record baru', 'jawaban_c' => 'Membuat kolom wajib diisi', 'jawaban_d' => 'Mengoptimasi performa', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Perintah untuk menghapus tabel beserta semua datanya adalah?', 'jawaban_a' => 'DELETE TABLE', 'jawaban_b' => 'REMOVE TABLE', 'jawaban_c' => 'DROP TABLE', 'jawaban_d' => 'TRUNCATE TABLE', 'jawaban_benar' => 'c'],
            ],
            'SQL Dasar - DML' => [
                ['pertanyaan' => 'Perintah SQL untuk menambahkan data ke tabel adalah?', 'jawaban_a' => 'ADD INTO', 'jawaban_b' => 'INSERT INTO', 'jawaban_c' => 'PUT INTO', 'jawaban_d' => 'APPEND INTO', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Klausa WHERE digunakan untuk?', 'jawaban_a' => 'Mengurutkan data', 'jawaban_b' => 'Mengelompokkan data', 'jawaban_c' => 'Memfilter data berdasarkan kondisi', 'jawaban_d' => 'Membatasi jumlah data', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Perintah untuk mengubah data yang sudah ada adalah?', 'jawaban_a' => 'MODIFY', 'jawaban_b' => 'CHANGE', 'jawaban_c' => 'ALTER', 'jawaban_d' => 'UPDATE', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Klausa ORDER BY ASC mengurutkan data secara?', 'jawaban_a' => 'Acak', 'jawaban_b' => 'Menurun (Z-A)', 'jawaban_c' => 'Menaik (A-Z)', 'jawaban_d' => 'Berdasarkan ID', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'SELECT * artinya memilih?', 'jawaban_a' => 'Kolom pertama saja', 'jawaban_b' => 'Semua kolom', 'jawaban_c' => 'Kolom Primary Key', 'jawaban_d' => 'Kolom terakhir', 'jawaban_benar' => 'b'],
            ],
            'SQL Lanjutan - JOIN' => [
                ['pertanyaan' => 'INNER JOIN mengembalikan data yang?', 'jawaban_a' => 'Ada di tabel kiri saja', 'jawaban_b' => 'Ada di tabel kanan saja', 'jawaban_c' => 'Ada di kedua tabel', 'jawaban_d' => 'Tidak ada di kedua tabel', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'LEFT JOIN mengembalikan semua data dari?', 'jawaban_a' => 'Tabel kiri dan yang cocok di tabel kanan', 'jawaban_b' => 'Tabel kanan saja', 'jawaban_c' => 'Kedua tabel tanpa filter', 'jawaban_d' => 'Tabel dengan data paling banyak', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Fungsi COUNT() digunakan untuk?', 'jawaban_a' => 'Menghitung rata-rata', 'jawaban_b' => 'Menghitung jumlah baris', 'jawaban_c' => 'Menghitung nilai minimum', 'jawaban_d' => 'Menghitung total', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Klausa GROUP BY digunakan bersama dengan?', 'jawaban_a' => 'WHERE saja', 'jawaban_b' => 'ORDER BY saja', 'jawaban_c' => 'Fungsi aggregate', 'jawaban_d' => 'LIMIT saja', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'HAVING berbeda dengan WHERE karena HAVING digunakan setelah?', 'jawaban_a' => 'SELECT', 'jawaban_b' => 'FROM', 'jawaban_c' => 'GROUP BY', 'jawaban_d' => 'ORDER BY', 'jawaban_benar' => 'c'],
            ],

            // ============ Kelas 3: Jaringan Komputer ============
            'Pengenalan Jaringan Komputer' => [
                ['pertanyaan' => 'LAN adalah singkatan dari?', 'jawaban_a' => 'Large Area Network', 'jawaban_b' => 'Local Access Network', 'jawaban_c' => 'Local Area Network', 'jawaban_d' => 'Long Area Network', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Topologi dimana semua node terhubung ke satu hub adalah?', 'jawaban_a' => 'Ring', 'jawaban_b' => 'Bus', 'jawaban_c' => 'Mesh', 'jawaban_d' => 'Star', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'WAN mencakup area?', 'jawaban_a' => 'Satu ruangan', 'jawaban_b' => 'Satu gedung', 'jawaban_c' => 'Satu kota', 'jawaban_d' => 'Antar kota/negara', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Perangkat yang menghubungkan beberapa jaringan adalah?', 'jawaban_a' => 'Hub', 'jawaban_b' => 'Switch', 'jawaban_c' => 'Router', 'jawaban_d' => 'Modem', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Topologi mesh memiliki keunggulan?', 'jawaban_a' => 'Biaya murah', 'jawaban_b' => 'Redundansi tinggi', 'jawaban_c' => 'Sedikit kabel', 'jawaban_d' => 'Mudah dipasang', 'jawaban_benar' => 'b'],
            ],
            'Model OSI Layer' => [
                ['pertanyaan' => 'Model OSI memiliki berapa lapisan?', 'jawaban_a' => '4', 'jawaban_b' => '5', 'jawaban_c' => '6', 'jawaban_d' => '7', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Layer mana yang bertanggung jawab atas routing?', 'jawaban_a' => 'Physical', 'jawaban_b' => 'Data Link', 'jawaban_c' => 'Network', 'jawaban_d' => 'Transport', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'MAC address berada di layer?', 'jawaban_a' => 'Physical', 'jawaban_b' => 'Data Link', 'jawaban_c' => 'Network', 'jawaban_d' => 'Transport', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'HTTP berada di layer?', 'jawaban_a' => 'Transport', 'jawaban_b' => 'Session', 'jawaban_c' => 'Presentation', 'jawaban_d' => 'Application', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'Proses penambahan header pada setiap layer disebut?', 'jawaban_a' => 'Dekapsulasi', 'jawaban_b' => 'Enkapsulasi', 'jawaban_c' => 'Enkripsi', 'jawaban_d' => 'Multiplexing', 'jawaban_benar' => 'b'],
            ],
            'Protokol TCP/IP' => [
                ['pertanyaan' => 'Protocol yang reliable dan connection-oriented adalah?', 'jawaban_a' => 'UDP', 'jawaban_b' => 'TCP', 'jawaban_c' => 'ICMP', 'jawaban_d' => 'ARP', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'IPv4 menggunakan berapa bit?', 'jawaban_a' => '16 bit', 'jawaban_b' => '32 bit', 'jawaban_c' => '64 bit', 'jawaban_d' => '128 bit', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Subnet mask /24 sama dengan?', 'jawaban_a' => '255.0.0.0', 'jawaban_b' => '255.255.0.0', 'jawaban_c' => '255.255.255.0', 'jawaban_d' => '255.255.255.255', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Protocol yang digunakan untuk resolusi nama domain adalah?', 'jawaban_a' => 'HTTP', 'jawaban_b' => 'FTP', 'jawaban_c' => 'DNS', 'jawaban_d' => 'SMTP', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'IPv6 menggunakan berapa bit?', 'jawaban_a' => '32 bit', 'jawaban_b' => '64 bit', 'jawaban_c' => '96 bit', 'jawaban_d' => '128 bit', 'jawaban_benar' => 'd'],
            ],
            'Keamanan Jaringan Dasar' => [
                ['pertanyaan' => 'Firewall berfungsi untuk?', 'jawaban_a' => 'Mempercepat koneksi', 'jawaban_b' => 'Menyaring traffic jaringan', 'jawaban_c' => 'Menyimpan data', 'jawaban_d' => 'Mengenkripsi file', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'VPN adalah singkatan dari?', 'jawaban_a' => 'Very Private Network', 'jawaban_b' => 'Virtual Public Network', 'jawaban_c' => 'Virtual Private Network', 'jawaban_d' => 'Verified Private Network', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Serangan yang membanjiri server dengan traffic berlebihan disebut?', 'jawaban_a' => 'Phishing', 'jawaban_b' => 'Ransomware', 'jawaban_c' => 'Man-in-the-Middle', 'jawaban_d' => 'DDoS', 'jawaban_benar' => 'd'],
                ['pertanyaan' => 'SSL/TLS digunakan untuk?', 'jawaban_a' => 'Kompresi data', 'jawaban_b' => 'Enkripsi data dalam transit', 'jawaban_c' => 'Backup data', 'jawaban_d' => 'Routing data', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'IDS adalah singkatan dari?', 'jawaban_a' => 'Internet Data System', 'jawaban_b' => 'Internal Detection Software', 'jawaban_c' => 'Intrusion Detection System', 'jawaban_d' => 'Integrated Defense System', 'jawaban_benar' => 'c'],
            ],

            // ============ Kelas 4: Pemrograman Java ============
            'Pengenalan Java' => [
                ['pertanyaan' => 'Prinsip Java "Write Once, Run Anywhere" dimungkinkan oleh?', 'jawaban_a' => 'Compiler', 'jawaban_b' => 'JVM (Java Virtual Machine)', 'jawaban_c' => 'Text Editor', 'jawaban_d' => 'Operating System', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Method utama program Java adalah?', 'jawaban_a' => 'public static void main(String[] args)', 'jawaban_b' => 'public void start()', 'jawaban_c' => 'static void run()', 'jawaban_d' => 'public main()', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Tipe data untuk bilangan desimal di Java adalah?', 'jawaban_a' => 'int', 'jawaban_b' => 'long', 'jawaban_c' => 'double', 'jawaban_d' => 'byte', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'JDK adalah singkatan dari?', 'jawaban_a' => 'Java Development Kit', 'jawaban_b' => 'Java Data Kit', 'jawaban_c' => 'Java Desktop Kit', 'jawaban_d' => 'Java Design Kit', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Tipe data boolean di Java menyimpan nilai?', 'jawaban_a' => '0 dan 1', 'jawaban_b' => 'true dan false', 'jawaban_c' => 'yes dan no', 'jawaban_d' => 'on dan off', 'jawaban_benar' => 'b'],
            ],
            'OOP di Java' => [
                ['pertanyaan' => 'Berapa pilar utama OOP?', 'jawaban_a' => '2', 'jawaban_b' => '3', 'jawaban_c' => '4', 'jawaban_d' => '5', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Encapsulation dicapai dengan?', 'jawaban_a' => 'Membuat semua variabel public', 'jawaban_b' => 'Menggunakan access modifier private dan getter/setter', 'jawaban_c' => 'Menggunakan inheritance', 'jawaban_d' => 'Membuat abstract class', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keyword Java untuk pewarisan kelas adalah?', 'jawaban_a' => 'inherits', 'jawaban_b' => 'implements', 'jawaban_c' => 'extends', 'jawaban_d' => 'derives', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Polymorphism artinya?', 'jawaban_a' => 'Satu kelas saja', 'jawaban_b' => 'Banyak bentuk dari satu interface', 'jawaban_c' => 'Menyembunyikan data', 'jawaban_d' => 'Mewarisi semua method', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Constructor di Java digunakan untuk?', 'jawaban_a' => 'Menghapus objek', 'jawaban_b' => 'Menginisialisasi objek saat dibuat', 'jawaban_c' => 'Mengubah tipe data', 'jawaban_d' => 'Mengimpor library', 'jawaban_benar' => 'b'],
            ],
            'Exception Handling' => [
                ['pertanyaan' => 'Blok kode yang menangani exception disebut?', 'jawaban_a' => 'try', 'jawaban_b' => 'catch', 'jawaban_c' => 'finally', 'jawaban_d' => 'throw', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Blok finally akan?', 'jawaban_a' => 'Dijalankan hanya saat ada error', 'jawaban_b' => 'Tidak pernah dijalankan', 'jawaban_c' => 'Selalu dijalankan', 'jawaban_d' => 'Dijalankan hanya saat tidak ada error', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'NullPointerException termasuk?', 'jawaban_a' => 'Checked Exception', 'jawaban_b' => 'Unchecked Exception', 'jawaban_c' => 'Error', 'jawaban_d' => 'Warning', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keyword untuk melempar exception secara manual adalah?', 'jawaban_a' => 'catch', 'jawaban_b' => 'try', 'jawaban_c' => 'throw', 'jawaban_d' => 'error', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Custom exception dibuat dengan cara?', 'jawaban_a' => 'Membuat file .exception', 'jawaban_b' => 'Extends class Exception', 'jawaban_c' => 'Implements Throwable', 'jawaban_d' => 'Override main method', 'jawaban_benar' => 'b'],
            ],
            'Collection Framework' => [
                ['pertanyaan' => 'ArrayList termasuk interface?', 'jawaban_a' => 'Set', 'jawaban_b' => 'Map', 'jawaban_c' => 'List', 'jawaban_d' => 'Queue', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'HashSet tidak mengizinkan?', 'jawaban_a' => 'Null value', 'jawaban_b' => 'String value', 'jawaban_c' => 'Elemen duplikat', 'jawaban_d' => 'Integer value', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'HashMap menyimpan data dalam format?', 'jawaban_a' => 'Array', 'jawaban_b' => 'Key-Value pair', 'jawaban_c' => 'Linked list', 'jawaban_d' => 'Stack', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Method untuk menambahkan elemen ke ArrayList adalah?', 'jawaban_a' => 'put()', 'jawaban_b' => 'insert()', 'jawaban_c' => 'add()', 'jawaban_d' => 'append()', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Perbedaan utama ArrayList dan LinkedList adalah?', 'jawaban_a' => 'Ukuran', 'jawaban_b' => 'Tipe data yang disimpan', 'jawaban_c' => 'Implementasi internal dan performa operasi', 'jawaban_d' => 'Tidak ada perbedaan', 'jawaban_benar' => 'c'],
            ],

            // ============ Kelas 5: Desain UI/UX ============
            'Pengenalan UI/UX Design' => [
                ['pertanyaan' => 'UI adalah singkatan dari?', 'jawaban_a' => 'Universal Interface', 'jawaban_b' => 'User Interface', 'jawaban_c' => 'Unique Integration', 'jawaban_d' => 'User Interaction', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'UX lebih fokus pada?', 'jawaban_a' => 'Warna dan font', 'jawaban_b' => 'Keseluruhan pengalaman pengguna', 'jawaban_c' => 'Kode program', 'jawaban_d' => 'Database', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Prinsip desain yang menekankan fokus pada kebutuhan pengguna disebut?', 'jawaban_a' => 'Developer-Centered Design', 'jawaban_b' => 'Business-Centered Design', 'jawaban_c' => 'User-Centered Design', 'jawaban_d' => 'Technology-Centered Design', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Consistency dalam UI design berarti?', 'jawaban_a' => 'Semua warna sama', 'jawaban_b' => 'Elemen serupa terlihat dan berfungsi sama', 'jawaban_c' => 'Tidak ada perubahan', 'jawaban_d' => 'Satu halaman saja', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Accessibility dalam desain artinya?', 'jawaban_a' => 'Hanya untuk pengguna tertentu', 'jawaban_b' => 'Dapat diakses oleh semua pengguna', 'jawaban_c' => 'Gratis untuk semua', 'jawaban_d' => 'Online 24 jam', 'jawaban_benar' => 'b'],
            ],
            'Wireframing dan Prototyping' => [
                ['pertanyaan' => 'Wireframe adalah?', 'jawaban_a' => 'Kode HTML', 'jawaban_b' => 'Kerangka visual layout halaman', 'jawaban_c' => 'Database schema', 'jawaban_d' => 'Image editing', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Low-fidelity wireframe biasanya berupa?', 'jawaban_a' => 'Desain detail dengan warna', 'jawaban_b' => 'Sketsa tangan sederhana', 'jawaban_c' => 'Kode HTML', 'jawaban_d' => 'Aplikasi final', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Tool wireframing yang gratis dan populer adalah?', 'jawaban_a' => 'Photoshop', 'jawaban_b' => 'Illustrator', 'jawaban_c' => 'Figma', 'jawaban_d' => 'AutoCAD', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Prototype berguna untuk?', 'jawaban_a' => 'Menulis kode backend', 'jawaban_b' => 'Menguji alur dan fungsionalitas sebelum development', 'jawaban_c' => 'Mengelola database', 'jawaban_d' => 'Mengoptimasi server', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'High-fidelity wireframe mendekati?', 'jawaban_a' => 'Sketsa awal', 'jawaban_b' => 'Desain final', 'jawaban_c' => 'Kode program', 'jawaban_d' => 'Dokumen teknis', 'jawaban_benar' => 'b'],
            ],
            'Teori Warna dan Tipografi' => [
                ['pertanyaan' => 'Warna primer terdiri dari?', 'jawaban_a' => 'Hijau, Orange, Ungu', 'jawaban_b' => 'Merah, Biru, Kuning', 'jawaban_c' => 'Putih, Hitam, Abu-abu', 'jawaban_d' => 'Cyan, Magenta, Yellow', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Skema warna complementary menggunakan warna yang?', 'jawaban_a' => 'Bersebelahan di color wheel', 'jawaban_b' => 'Berseberangan di color wheel', 'jawaban_c' => 'Sama persis', 'jawaban_d' => 'Acak', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Font sans-serif cocok untuk?', 'jawaban_a' => 'Dokumen formal tradisional', 'jawaban_b' => 'Desain modern dan digital', 'jawaban_c' => 'Kode pemrograman', 'jawaban_d' => 'Tulisan tangan', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Berapa jumlah font maksimal yang direkomendasikan dalam satu desain?', 'jawaban_a' => '1', 'jawaban_b' => '2-3', 'jawaban_c' => '5-6', 'jawaban_d' => 'Tidak terbatas', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Font monospace biasanya digunakan untuk?', 'jawaban_a' => 'Judul artikel', 'jawaban_b' => 'Paragraf panjang', 'jawaban_c' => 'Kode program', 'jawaban_d' => 'Logo', 'jawaban_benar' => 'c'],
            ],

            // ============ Kelas 6: Algoritma dan Struktur Data ============
            'Pengenalan Algoritma' => [
                ['pertanyaan' => 'Algoritma harus memiliki sifat finiteness, artinya?', 'jawaban_a' => 'Tidak terbatas', 'jawaban_b' => 'Harus berakhir setelah sejumlah langkah', 'jawaban_c' => 'Harus cepat', 'jawaban_d' => 'Harus efisien', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Notasi Big-O O(n) menunjukkan kompleksitas?', 'jawaban_a' => 'Constant', 'jawaban_b' => 'Logarithmic', 'jawaban_c' => 'Linear', 'jawaban_d' => 'Quadratic', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Pseudocode adalah?', 'jawaban_a' => 'Bahasa pemrograman', 'jawaban_b' => 'Representasi informal algoritma', 'jawaban_c' => 'Compiler', 'jawaban_d' => 'Framework', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'O(1) berarti waktu eksekusi?', 'jawaban_a' => 'Bertambah seiring input', 'jawaban_b' => 'Konstan tidak bergantung pada input', 'jawaban_c' => 'Eksponensial', 'jawaban_d' => 'Kuadratik', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Flowchart menggunakan bentuk belah ketupat untuk?', 'jawaban_a' => 'Proses', 'jawaban_b' => 'Input/Output', 'jawaban_c' => 'Keputusan/Kondisi', 'jawaban_d' => 'Start/End', 'jawaban_benar' => 'c'],
            ],
            'Array dan Linked List' => [
                ['pertanyaan' => 'Waktu akses elemen array berdasarkan indeks adalah?', 'jawaban_a' => 'O(n)', 'jawaban_b' => 'O(log n)', 'jawaban_c' => 'O(1)', 'jawaban_d' => 'O(n²)', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Singly Linked List memiliki pointer yang menunjuk ke?', 'jawaban_a' => 'Node sebelumnya', 'jawaban_b' => 'Node berikutnya', 'jawaban_c' => 'Node pertama dan terakhir', 'jawaban_d' => 'Semua node', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Kelemahan utama array adalah?', 'jawaban_a' => 'Akses lambat', 'jawaban_b' => 'Ukuran tetap (statis)', 'jawaban_c' => 'Tidak bisa menyimpan angka', 'jawaban_d' => 'Tidak berurutan', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Insersi di awal Linked List memiliki kompleksitas?', 'jawaban_a' => 'O(n)', 'jawaban_b' => 'O(log n)', 'jawaban_c' => 'O(1)', 'jawaban_d' => 'O(n²)', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Doubly Linked List berbeda dari Singly karena?', 'jawaban_a' => 'Memiliki dua head', 'jawaban_b' => 'Node menunjuk ke depan dan belakang', 'jawaban_c' => 'Ukurannya dua kali lipat', 'jawaban_d' => 'Lebih cepat', 'jawaban_benar' => 'b'],
            ],
            'Stack dan Queue' => [
                ['pertanyaan' => 'Stack mengikuti prinsip?', 'jawaban_a' => 'FIFO', 'jawaban_b' => 'LIFO', 'jawaban_c' => 'LILO', 'jawaban_d' => 'Random Access', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Queue mengikuti prinsip?', 'jawaban_a' => 'LIFO', 'jawaban_b' => 'LILO', 'jawaban_c' => 'FIFO', 'jawaban_d' => 'Random Access', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Operasi push pada stack berfungsi untuk?', 'jawaban_a' => 'Menghapus elemen teratas', 'jawaban_b' => 'Menambah elemen ke atas', 'jawaban_c' => 'Melihat elemen teratas', 'jawaban_d' => 'Mengosongkan stack', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Contoh penggunaan stack dalam kehidupan sehari-hari?', 'jawaban_a' => 'Antrian bank', 'jawaban_b' => 'Undo/Redo pada text editor', 'jawaban_c' => 'Printer queue', 'jawaban_d' => 'Playlist musik', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Operasi dequeue pada queue berfungsi untuk?', 'jawaban_a' => 'Menambah elemen ke belakang', 'jawaban_b' => 'Menghapus elemen terdepan', 'jawaban_c' => 'Melihat elemen terakhir', 'jawaban_d' => 'Menghitung ukuran', 'jawaban_benar' => 'b'],
            ],
            'Sorting Algorithms' => [
                ['pertanyaan' => 'Kompleksitas rata-rata Bubble Sort adalah?', 'jawaban_a' => 'O(n)', 'jawaban_b' => 'O(n log n)', 'jawaban_c' => 'O(n²)', 'jawaban_d' => 'O(log n)', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Merge Sort menggunakan strategi?', 'jawaban_a' => 'Brute force', 'jawaban_b' => 'Greedy', 'jawaban_c' => 'Divide and conquer', 'jawaban_d' => 'Dynamic programming', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Sorting algorithm mana yang paling stabil?', 'jawaban_a' => 'Quick Sort', 'jawaban_b' => 'Merge Sort', 'jawaban_c' => 'Selection Sort', 'jawaban_d' => 'Heap Sort', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Worst case Quick Sort adalah?', 'jawaban_a' => 'O(n)', 'jawaban_b' => 'O(n log n)', 'jawaban_c' => 'O(n²)', 'jawaban_d' => 'O(2^n)', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Selection Sort bekerja dengan cara?', 'jawaban_a' => 'Membandingkan elemen bersebelahan', 'jawaban_b' => 'Mencari elemen minimum lalu menempatkannya', 'jawaban_c' => 'Membagi array menjadi dua', 'jawaban_d' => 'Menggunakan pivot', 'jawaban_benar' => 'b'],
            ],

            // ============ Kelas 7: Sistem Operasi ============
            'Pengenalan Sistem Operasi' => [
                ['pertanyaan' => 'Fungsi utama sistem operasi adalah?', 'jawaban_a' => 'Mengedit dokumen', 'jawaban_b' => 'Mengelola sumber daya hardware', 'jawaban_c' => 'Membuat website', 'jawaban_d' => 'Mendesain grafis', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Manakah yang bukan sistem operasi desktop?', 'jawaban_a' => 'Windows', 'jawaban_b' => 'macOS', 'jawaban_c' => 'Android', 'jawaban_d' => 'Linux', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Kernel adalah?', 'jawaban_a' => 'Aplikasi pengguna', 'jawaban_b' => 'Inti dari sistem operasi', 'jawaban_c' => 'Peripheral hardware', 'jawaban_d' => 'Jenis database', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Manajemen memori bertanggung jawab atas?', 'jawaban_a' => 'Menyimpan file', 'jawaban_b' => 'Alokasi dan dealokasi RAM', 'jawaban_c' => 'Menghubungkan jaringan', 'jawaban_d' => 'Menampilkan grafis', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'RTOS digunakan untuk?', 'jawaban_a' => 'Gaming', 'jawaban_b' => 'Sistem embedded real-time', 'jawaban_c' => 'Web server', 'jawaban_d' => 'Office work', 'jawaban_benar' => 'b'],
            ],
            'Manajemen Proses' => [
                ['pertanyaan' => 'Status proses "Ready" berarti?', 'jawaban_a' => 'Sedang dieksekusi', 'jawaban_b' => 'Siap dieksekusi, menunggu CPU', 'jawaban_c' => 'Menunggu I/O', 'jawaban_d' => 'Selesai', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Round Robin scheduling memberikan setiap proses?', 'jawaban_a' => 'Seluruh waktu CPU', 'jawaban_b' => 'Waktu berdasarkan prioritas', 'jawaban_c' => 'Waktu eksekusi yang sama (time quantum)', 'jawaban_d' => 'Waktu tanpa batas', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Thread adalah?', 'jawaban_a' => 'Program lengkap', 'jawaban_b' => 'Unit terkecil dari eksekusi dalam proses', 'jawaban_c' => 'File system', 'jawaban_d' => 'Jenis memori', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Context switching terjadi saat?', 'jawaban_a' => 'Komputer dinyalakan', 'jawaban_b' => 'CPU berpindah dari satu proses ke proses lain', 'jawaban_c' => 'File disimpan', 'jawaban_d' => 'Jaringan terputus', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'SJF scheduling memprioritaskan proses dengan?', 'jawaban_a' => 'Waktu datang paling awal', 'jawaban_b' => 'Burst time terpendek', 'jawaban_c' => 'Prioritas tertinggi', 'jawaban_d' => 'Memori terbesar', 'jawaban_benar' => 'b'],
            ],
            'Manajemen Memori' => [
                ['pertanyaan' => 'Paging membagi memori menjadi?', 'jawaban_a' => 'Segment', 'jawaban_b' => 'Frame dan Page', 'jawaban_c' => 'Block dan Cluster', 'jawaban_d' => 'Sector dan Track', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Virtual memory memungkinkan?', 'jawaban_a' => 'RAM menjadi lebih besar secara fisik', 'jawaban_b' => 'Eksekusi proses yang lebih besar dari memori fisik', 'jawaban_c' => 'Hard disk menjadi lebih cepat', 'jawaban_d' => 'CPU berjalan lebih cepat', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Page fault terjadi saat?', 'jawaban_a' => 'Page ditemukan di memori', 'jawaban_b' => 'Page yang dibutuhkan tidak ada di memori fisik', 'jawaban_c' => 'Memori penuh', 'jawaban_d' => 'CPU error', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Thrashing terjadi ketika?', 'jawaban_a' => 'CPU terlalu cepat', 'jawaban_b' => 'Sistem lebih banyak melakukan page swapping daripada eksekusi', 'jawaban_c' => 'Memori tidak digunakan', 'jawaban_d' => 'Hard disk penuh', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Algoritma page replacement LRU mengganti page yang?', 'jawaban_a' => 'Pertama kali masuk', 'jawaban_b' => 'Paling lama tidak digunakan', 'jawaban_c' => 'Paling sering digunakan', 'jawaban_d' => 'Paling besar ukurannya', 'jawaban_benar' => 'b'],
            ],

            // ============ Kelas 8: Pemrograman Python ============
            'Pengenalan Python' => [
                ['pertanyaan' => 'Python adalah bahasa pemrograman?', 'jawaban_a' => 'Low-level', 'jawaban_b' => 'High-level', 'jawaban_c' => 'Assembly', 'jawaban_d' => 'Machine language', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Operator ** di Python digunakan untuk?', 'jawaban_a' => 'Perkalian', 'jawaban_b' => 'Pembagian', 'jawaban_c' => 'Pemangkatan', 'jawaban_d' => 'Modulo', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Tipe data untuk menyimpan kumpulan data terurut di Python adalah?', 'jawaban_a' => 'Dictionary', 'jawaban_b' => 'Set', 'jawaban_c' => 'List', 'jawaban_d' => 'Tuple', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Operator // di Python menghasilkan?', 'jawaban_a' => 'Komentar', 'jawaban_b' => 'Pembagian biasa', 'jawaban_c' => 'Floor division', 'jawaban_d' => 'Modulo', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Dictionary di Python menyimpan data dalam format?', 'jawaban_a' => 'Index-based', 'jawaban_b' => 'Key-value pair', 'jawaban_c' => 'Stack', 'jawaban_d' => 'Queue', 'jawaban_benar' => 'b'],
            ],
            'Kontrol Alur dan Fungsi' => [
                ['pertanyaan' => 'Keyword Python untuk kondisi selain if dan else adalah?', 'jawaban_a' => 'else if', 'jawaban_b' => 'elif', 'jawaban_c' => 'elseif', 'jawaban_d' => 'elsif', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'range(5) menghasilkan angka?', 'jawaban_a' => '1 sampai 5', 'jawaban_b' => '0 sampai 5', 'jawaban_c' => '0 sampai 4', 'jawaban_d' => '1 sampai 4', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'List comprehension di Python digunakan untuk?', 'jawaban_a' => 'Membuat class', 'jawaban_b' => 'Membuat list secara ringkas', 'jawaban_c' => 'Import module', 'jawaban_d' => 'Exception handling', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Lambda function di Python adalah?', 'jawaban_a' => 'Fungsi yang panjang', 'jawaban_b' => 'Fungsi anonim satu baris', 'jawaban_c' => 'Fungsi built-in', 'jawaban_d' => 'Fungsi rekursif', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keyword def digunakan untuk?', 'jawaban_a' => 'Mendeklarasikan variabel', 'jawaban_b' => 'Mendefinisikan fungsi', 'jawaban_c' => 'Mengimpor module', 'jawaban_d' => 'Membuat class', 'jawaban_benar' => 'b'],
            ],
            'OOP di Python' => [
                ['pertanyaan' => 'Method __init__ di Python berfungsi sebagai?', 'jawaban_a' => 'Destructor', 'jawaban_b' => 'Constructor', 'jawaban_c' => 'Getter', 'jawaban_d' => 'Setter', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Parameter self merujuk pada?', 'jawaban_a' => 'Class itu sendiri', 'jawaban_b' => 'Instance/objek saat ini', 'jawaban_c' => 'Parent class', 'jawaban_d' => 'Global variable', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Inheritance di Python menggunakan syntax?', 'jawaban_a' => 'class Anak extends Induk', 'jawaban_b' => 'class Anak(Induk)', 'jawaban_c' => 'class Anak inherits Induk', 'jawaban_d' => 'class Anak: Induk', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'super() digunakan untuk?', 'jawaban_a' => 'Membuat class baru', 'jawaban_b' => 'Memanggil method dari parent class', 'jawaban_c' => 'Menghapus objek', 'jawaban_d' => 'Mengimpor library', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Method __str__ digunakan untuk?', 'jawaban_a' => 'Membandingkan objek', 'jawaban_b' => 'Representasi string dari objek', 'jawaban_c' => 'Menghapus objek', 'jawaban_d' => 'Menghitung ukuran objek', 'jawaban_benar' => 'b'],
            ],
            'Module dan Package' => [
                ['pertanyaan' => 'Cara mengimpor seluruh module math adalah?', 'jawaban_a' => 'from math import *', 'jawaban_b' => 'import math', 'jawaban_c' => 'include math', 'jawaban_d' => 'require math', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'pip digunakan untuk?', 'jawaban_a' => 'Menjalankan Python', 'jawaban_b' => 'Menginstal package Python', 'jawaban_c' => 'Debugging', 'jawaban_d' => 'Compile code', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Virtual environment berguna untuk?', 'jawaban_a' => 'Menjalankan VM', 'jawaban_b' => 'Isolasi dependensi project', 'jawaban_c' => 'Enkripsi data', 'jawaban_d' => 'Backup database', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'File requirements.txt berisi?', 'jawaban_a' => 'Kode program', 'jawaban_b' => 'Daftar dependensi project', 'jawaban_c' => 'Dokumentasi', 'jawaban_d' => 'Konfigurasi server', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keyword "as" pada import digunakan untuk?', 'jawaban_a' => 'Menghapus module', 'jawaban_b' => 'Memberi alias pada module', 'jawaban_c' => 'Mengeksport module', 'jawaban_d' => 'Menginstall module', 'jawaban_benar' => 'b'],
            ],

            // ============ Kelas 9: Keamanan Siber ============
            'Pengenalan Keamanan Siber' => [
                ['pertanyaan' => 'CIA Triad terdiri dari?', 'jawaban_a' => 'Confidentiality, Integrity, Availability', 'jawaban_b' => 'Control, Integration, Access', 'jawaban_c' => 'Compliance, Identity, Authorization', 'jawaban_d' => 'Communication, Interoperability, Authentication', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'Phishing termasuk jenis serangan?', 'jawaban_a' => 'Malware', 'jawaban_b' => 'Social Engineering', 'jawaban_c' => 'DDoS', 'jawaban_d' => 'Injection', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Ransomware berfungsi untuk?', 'jawaban_a' => 'Mencuri password', 'jawaban_b' => 'Mengenkripsi data dan meminta tebusan', 'jawaban_c' => 'Menghapus file', 'jawaban_d' => 'Membanjiri traffic', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Availability dalam CIA Triad berarti?', 'jawaban_a' => 'Data hanya untuk orang tertentu', 'jawaban_b' => 'Data tidak bisa diubah', 'jawaban_c' => 'Sistem tersedia saat dibutuhkan', 'jawaban_d' => 'Data terenkripsi', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Insider threat adalah ancaman dari?', 'jawaban_a' => 'Hacker luar negeri', 'jawaban_b' => 'Dalam organisasi sendiri', 'jawaban_c' => 'Virus internet', 'jawaban_d' => 'Bencana alam', 'jawaban_benar' => 'b'],
            ],
            'Kriptografi' => [
                ['pertanyaan' => 'Enkripsi simetris menggunakan?', 'jawaban_a' => 'Dua kunci berbeda', 'jawaban_b' => 'Satu kunci yang sama', 'jawaban_c' => 'Tanpa kunci', 'jawaban_d' => 'Tiga kunci', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'AES adalah standar untuk?', 'jawaban_a' => 'Hashing', 'jawaban_b' => 'Enkripsi simetris', 'jawaban_c' => 'Digital signature', 'jawaban_d' => 'Kompresi', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Hashing bersifat?', 'jawaban_a' => 'Reversible (bisa dikembalikan)', 'jawaban_b' => 'One-way function (satu arah)', 'jawaban_c' => 'Dua arah', 'jawaban_d' => 'Acak setiap waktu', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'bcrypt khusus digunakan untuk hashing?', 'jawaban_a' => 'File', 'jawaban_b' => 'Password', 'jawaban_c' => 'Email', 'jawaban_d' => 'Gambar', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'RSA termasuk enkripsi?', 'jawaban_a' => 'Simetris', 'jawaban_b' => 'Asimetris', 'jawaban_c' => 'Hashing', 'jawaban_d' => 'Kompresi', 'jawaban_benar' => 'b'],
            ],
            'Web Application Security' => [
                ['pertanyaan' => 'SQL Injection terjadi karena?', 'jawaban_a' => 'Input user tidak divalidasi/disanitasi', 'jawaban_b' => 'Server terlalu cepat', 'jawaban_c' => 'Database terlalu besar', 'jawaban_d' => 'Browser tidak kompatibel', 'jawaban_benar' => 'a'],
                ['pertanyaan' => 'XSS adalah singkatan dari?', 'jawaban_a' => 'Extra Secure System', 'jawaban_b' => 'Cross-Site Scripting', 'jawaban_c' => 'XML Style Sheets', 'jawaban_d' => 'Extended Security Standard', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Parameterized query mencegah?', 'jawaban_a' => 'DDoS', 'jawaban_b' => 'Phishing', 'jawaban_c' => 'SQL Injection', 'jawaban_d' => 'XSS', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'OWASP Top 10 adalah?', 'jawaban_a' => '10 bahasa pemrograman terbaik', 'jawaban_b' => '10 risiko keamanan web paling kritis', 'jawaban_c' => '10 framework terpopuler', 'jawaban_d' => '10 database tercepat', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'HTTPS berbeda dari HTTP karena?', 'jawaban_a' => 'Lebih cepat', 'jawaban_b' => 'Menggunakan enkripsi SSL/TLS', 'jawaban_c' => 'Tidak memerlukan server', 'jawaban_d' => 'Gratis untuk semua', 'jawaban_benar' => 'b'],
            ],

            // ============ Kelas 10: Cloud Computing ============
            'Pengenalan Cloud Computing' => [
                ['pertanyaan' => 'IaaS adalah singkatan dari?', 'jawaban_a' => 'Internet as a Service', 'jawaban_b' => 'Infrastructure as a Service', 'jawaban_c' => 'Integration as a Service', 'jawaban_d' => 'Information as a Service', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Contoh layanan SaaS adalah?', 'jawaban_a' => 'AWS EC2', 'jawaban_b' => 'Heroku', 'jawaban_c' => 'Gmail', 'jawaban_d' => 'VirtualBox', 'jawaban_benar' => 'c'],
                ['pertanyaan' => 'Model yang menggabungkan public dan private cloud disebut?', 'jawaban_a' => 'Multi-Cloud', 'jawaban_b' => 'Hybrid Cloud', 'jawaban_c' => 'Community Cloud', 'jawaban_d' => 'Distributed Cloud', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Pay-as-you-go artinya?', 'jawaban_a' => 'Bayar di muka', 'jawaban_b' => 'Bayar sesuai penggunaan', 'jawaban_c' => 'Gratis selamanya', 'jawaban_d' => 'Bayar tahunan', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keuntungan utama cloud computing adalah?', 'jawaban_a' => 'Memerlukan hardware sendiri', 'jawaban_b' => 'Skalabilitas dan fleksibilitas', 'jawaban_c' => 'Selalu offline', 'jawaban_d' => 'Tidak memerlukan internet', 'jawaban_benar' => 'b'],
            ],
            'Virtualisasi dan Container' => [
                ['pertanyaan' => 'Docker container berbagi apa dengan host?', 'jawaban_a' => 'Seluruh OS', 'jawaban_b' => 'Kernel OS', 'jawaban_c' => 'Tidak berbagi apa-apa', 'jawaban_d' => 'Hardware langsung', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Keunggulan container dibanding VM adalah?', 'jawaban_a' => 'Lebih besar ukurannya', 'jawaban_b' => 'Lebih ringan dan startup lebih cepat', 'jawaban_c' => 'Isolasi lebih sempurna', 'jawaban_d' => 'Tidak memerlukan OS', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Dockerfile digunakan untuk?', 'jawaban_a' => 'Menulis dokumentasi', 'jawaban_b' => 'Mendefinisikan cara membangun container image', 'jawaban_c' => 'Konfigurasi database', 'jawaban_d' => 'Routing jaringan', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Kubernetes digunakan untuk?', 'jawaban_a' => 'Mengedit kode', 'jawaban_b' => 'Orchestration container dalam skala besar', 'jawaban_c' => 'Membuat virtual machine', 'jawaban_d' => 'Backup database', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Hypervisor berfungsi untuk?', 'jawaban_a' => 'Menjalankan container', 'jawaban_b' => 'Menjalankan virtual machine di atas hardware', 'jawaban_c' => 'Mengompilasi kode', 'jawaban_d' => 'Mengelola database', 'jawaban_benar' => 'b'],
            ],
            'Cloud Services dan Deployment' => [
                ['pertanyaan' => 'AWS S3 digunakan untuk?', 'jawaban_a' => 'Compute/Server', 'jawaban_b' => 'Object Storage', 'jawaban_c' => 'Database', 'jawaban_d' => 'DNS', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'CI/CD adalah singkatan dari?', 'jawaban_a' => 'Code Integration / Code Delivery', 'jawaban_b' => 'Continuous Integration / Continuous Deployment', 'jawaban_c' => 'Cloud Integration / Cloud Deployment', 'jawaban_d' => 'Container Integration / Container Deployment', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Infrastructure as Code (IaC) memungkinkan?', 'jawaban_a' => 'Menulis kode aplikasi', 'jawaban_b' => 'Mengelola infrastruktur melalui kode/konfigurasi', 'jawaban_c' => 'Menghapus cloud service', 'jawaban_d' => 'Mengganti hardware', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'Blue-green deployment berguna untuk?', 'jawaban_a' => 'Menghapus server lama', 'jawaban_b' => 'Zero-downtime deployment', 'jawaban_c' => 'Menghemat biaya', 'jawaban_d' => 'Backup data', 'jawaban_benar' => 'b'],
                ['pertanyaan' => 'AWS Lambda termasuk model?', 'jawaban_a' => 'IaaS', 'jawaban_b' => 'PaaS', 'jawaban_c' => 'Serverless / FaaS', 'jawaban_d' => 'SaaS', 'jawaban_benar' => 'c'],
            ],
        ];

        foreach ($soalData as $materiJudul => $soalList) {
            $materi = Materi::where('judul', $materiJudul)->first();
            if (!$materi)
                continue;

            foreach ($soalList as $soal) {
                Soal::firstOrCreate(
                    ['materi_id' => $materi->id, 'pertanyaan' => $soal['pertanyaan']],
                    [
                        'jawaban_a' => $soal['jawaban_a'],
                        'jawaban_b' => $soal['jawaban_b'],
                        'jawaban_c' => $soal['jawaban_c'],
                        'jawaban_d' => $soal['jawaban_d'],
                        'jawaban_benar' => $soal['jawaban_benar'],
                    ]
                );
            }
        }
    }
}
