<?php

namespace Database\Seeders;

use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Database\Seeder;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $materiData = [
            // Kelas 1: Dasar Pemrograman Web
            'Dasar Pemrograman Web' => [
                [
                    'judul' => 'Pengenalan HTML',
                    'deskripsi' => 'Mempelajari dasar-dasar HTML dan struktur halaman web',
                    'konten' => '<h2>Apa itu HTML?</h2><p>HTML (HyperText Markup Language) adalah bahasa markup standar untuk membuat halaman web. HTML mendeskripsikan struktur halaman web menggunakan elemen-elemen markup.</p><h3>Struktur Dasar HTML</h3><pre><code>&lt;!DOCTYPE html&gt;\n&lt;html&gt;\n&lt;head&gt;\n  &lt;title&gt;Halaman Pertama&lt;/title&gt;\n&lt;/head&gt;\n&lt;body&gt;\n  &lt;h1&gt;Hello World&lt;/h1&gt;\n  &lt;p&gt;Ini adalah paragraf pertama saya.&lt;/p&gt;\n&lt;/body&gt;\n&lt;/html&gt;</code></pre><h3>Elemen HTML Penting</h3><ul><li><strong>Heading</strong>: h1 sampai h6 untuk judul</li><li><strong>Paragraf</strong>: p untuk teks paragraf</li><li><strong>Link</strong>: a untuk hyperlink</li><li><strong>Gambar</strong>: img untuk menampilkan gambar</li><li><strong>List</strong>: ul/ol dan li untuk daftar</li></ul>',
                ],
                [
                    'judul' => 'Dasar CSS',
                    'deskripsi' => 'Memahami CSS untuk styling halaman web',
                    'konten' => '<h2>Apa itu CSS?</h2><p>CSS (Cascading Style Sheets) digunakan untuk mengatur tampilan dan layout halaman web. CSS memisahkan konten (HTML) dari presentasi visual.</p><h3>Cara Menggunakan CSS</h3><p>Ada 3 cara menambahkan CSS:</p><ol><li><strong>Inline</strong>: langsung di atribut style elemen</li><li><strong>Internal</strong>: di dalam tag style pada head</li><li><strong>External</strong>: file .css terpisah (direkomendasikan)</li></ol><h3>Selector CSS</h3><pre><code>/* Selector elemen */\np { color: blue; }\n\n/* Selector class */\n.container { max-width: 1200px; margin: 0 auto; }\n\n/* Selector ID */\n#header { background-color: #333; color: white; }</code></pre><h3>Box Model</h3><p>Setiap elemen HTML dianggap sebagai kotak (box) yang terdiri dari: content, padding, border, dan margin.</p>',
                ],
                [
                    'judul' => 'JavaScript Dasar',
                    'deskripsi' => 'Pengenalan JavaScript untuk interaktivitas web',
                    'konten' => '<h2>Apa itu JavaScript?</h2><p>JavaScript adalah bahasa pemrograman yang membuat halaman web menjadi interaktif. JavaScript berjalan di browser dan dapat memanipulasi konten HTML dan CSS secara dinamis.</p><h3>Variabel</h3><pre><code>let nama = "Budi";\nconst umur = 25;\nvar kota = "Jakarta"; // cara lama</code></pre><h3>Tipe Data</h3><ul><li>String: "Hello World"</li><li>Number: 42, 3.14</li><li>Boolean: true, false</li><li>Array: [1, 2, 3]</li><li>Object: {nama: "Budi", umur: 25}</li></ul><h3>Fungsi</h3><pre><code>function sapa(nama) {\n  return "Halo, " + nama + "!";\n}\n\nconst hasil = sapa("Budi");\nconsole.log(hasil); // "Halo, Budi!"</code></pre>',
                ],
                [
                    'judul' => 'DOM Manipulation',
                    'deskripsi' => 'Memanipulasi Document Object Model dengan JavaScript',
                    'konten' => '<h2>Document Object Model (DOM)</h2><p>DOM adalah representasi terstruktur dari dokumen HTML. JavaScript dapat mengakses dan mengubah semua elemen HTML melalui DOM.</p><h3>Mengakses Elemen</h3><pre><code>// Berdasarkan ID\nconst judul = document.getElementById("judul");\n\n// Berdasarkan class\nconst items = document.getElementsByClassName("item");\n\n// Query selector\nconst btn = document.querySelector(".btn-primary");\nconst allCards = document.querySelectorAll(".card");</code></pre><h3>Mengubah Konten</h3><pre><code>judul.textContent = "Judul Baru";\njudul.innerHTML = "&lt;strong&gt;Judul Tebal&lt;/strong&gt;";\njudul.style.color = "red";</code></pre><h3>Event Listener</h3><pre><code>btn.addEventListener("click", function() {\n  alert("Tombol diklik!");\n});</code></pre>',
                ],
                [
                    'judul' => 'Responsive Web Design',
                    'deskripsi' => 'Membuat website yang responsif di berbagai perangkat',
                    'konten' => '<h2>Responsive Web Design</h2><p>Responsive web design membuat halaman web terlihat baik di semua perangkat, dari desktop hingga smartphone.</p><h3>Viewport Meta Tag</h3><pre><code>&lt;meta name="viewport" content="width=device-width, initial-scale=1.0"&gt;</code></pre><h3>Media Queries</h3><pre><code>/* Desktop */\n.container { width: 1200px; }\n\n/* Tablet */\n@media (max-width: 768px) {\n  .container { width: 100%; padding: 0 20px; }\n}\n\n/* Mobile */\n@media (max-width: 480px) {\n  .nav { flex-direction: column; }\n}</code></pre><h3>Flexbox</h3><pre><code>.flex-container {\n  display: flex;\n  justify-content: space-between;\n  align-items: center;\n  flex-wrap: wrap;\n}</code></pre><h3>CSS Grid</h3><pre><code>.grid-container {\n  display: grid;\n  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));\n  gap: 20px;\n}</code></pre>',
                ],
            ],
            // Kelas 2: Basis Data
            'Basis Data' => [
                [
                    'judul' => 'Pengenalan Basis Data',
                    'deskripsi' => 'Konsep dasar basis data dan sistem manajemen basis data',
                    'konten' => '<h2>Apa itu Basis Data?</h2><p>Basis data (database) adalah kumpulan data yang terorganisir dan saling berhubungan. Sistem Manajemen Basis Data (DBMS) adalah software yang digunakan untuk mengelola basis data.</p><h3>Jenis-jenis DBMS</h3><ul><li><strong>Relasional (RDBMS)</strong>: MySQL, PostgreSQL, Oracle, SQL Server</li><li><strong>NoSQL</strong>: MongoDB, Redis, Cassandra</li><li><strong>In-Memory</strong>: Redis, Memcached</li></ul><h3>Konsep Dasar</h3><ul><li><strong>Tabel</strong>: Kumpulan data dalam baris dan kolom</li><li><strong>Record/Baris</strong>: Satu entri data</li><li><strong>Field/Kolom</strong>: Atribut dari data</li><li><strong>Primary Key</strong>: Identitas unik setiap record</li><li><strong>Foreign Key</strong>: Referensi ke tabel lain</li></ul>',
                ],
                [
                    'judul' => 'SQL Dasar - DDL',
                    'deskripsi' => 'Data Definition Language untuk membuat dan mengubah struktur tabel',
                    'konten' => '<h2>Data Definition Language (DDL)</h2><p>DDL digunakan untuk mendefinisikan struktur basis data seperti membuat, mengubah, dan menghapus tabel.</p><h3>CREATE TABLE</h3><pre><code>CREATE TABLE mahasiswa (\n  id INT PRIMARY KEY AUTO_INCREMENT,\n  nim VARCHAR(20) UNIQUE NOT NULL,\n  nama VARCHAR(100) NOT NULL,\n  jurusan VARCHAR(50),\n  angkatan INT,\n  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n);</code></pre><h3>ALTER TABLE</h3><pre><code>ALTER TABLE mahasiswa ADD COLUMN email VARCHAR(100);\nALTER TABLE mahasiswa MODIFY COLUMN nama VARCHAR(150);\nALTER TABLE mahasiswa DROP COLUMN angkatan;</code></pre><h3>DROP TABLE</h3><pre><code>DROP TABLE IF EXISTS mahasiswa;</code></pre>',
                ],
                [
                    'judul' => 'SQL Dasar - DML',
                    'deskripsi' => 'Data Manipulation Language untuk mengelola data dalam tabel',
                    'konten' => '<h2>Data Manipulation Language (DML)</h2><p>DML digunakan untuk memanipulasi data dalam tabel: insert, select, update, delete.</p><h3>INSERT</h3><pre><code>INSERT INTO mahasiswa (nim, nama, jurusan, angkatan)\nVALUES (\'2021001\', \'Budi Santoso\', \'Informatika\', 2021);\n\nINSERT INTO mahasiswa (nim, nama, jurusan, angkatan) VALUES\n(\'2021002\', \'Siti Aminah\', \'Sistem Informasi\', 2021),\n(\'2021003\', \'Andi Wijaya\', \'Informatika\', 2021);</code></pre><h3>SELECT</h3><pre><code>SELECT * FROM mahasiswa;\nSELECT nama, jurusan FROM mahasiswa WHERE angkatan = 2021;\nSELECT * FROM mahasiswa ORDER BY nama ASC LIMIT 10;</code></pre><h3>UPDATE</h3><pre><code>UPDATE mahasiswa SET jurusan = \'Teknik Informatika\' WHERE nim = \'2021001\';</code></pre><h3>DELETE</h3><pre><code>DELETE FROM mahasiswa WHERE nim = \'2021003\';</code></pre>',
                ],
                [
                    'judul' => 'SQL Lanjutan - JOIN',
                    'deskripsi' => 'Menggabungkan data dari beberapa tabel menggunakan JOIN',
                    'konten' => '<h2>SQL JOIN</h2><p>JOIN digunakan untuk menggabungkan baris dari dua atau lebih tabel berdasarkan kolom yang berhubungan.</p><h3>INNER JOIN</h3><pre><code>SELECT m.nama, n.mata_kuliah, n.nilai\nFROM mahasiswa m\nINNER JOIN nilai n ON m.id = n.mahasiswa_id;</code></pre><h3>LEFT JOIN</h3><pre><code>SELECT m.nama, n.mata_kuliah, n.nilai\nFROM mahasiswa m\nLEFT JOIN nilai n ON m.id = n.mahasiswa_id;</code></pre><h3>RIGHT JOIN</h3><pre><code>SELECT m.nama, n.mata_kuliah\nFROM mahasiswa m\nRIGHT JOIN nilai n ON m.id = n.mahasiswa_id;</code></pre><h3>Aggregate Functions</h3><pre><code>SELECT jurusan, COUNT(*) as jumlah, AVG(ipk) as rata_ipk\nFROM mahasiswa\nGROUP BY jurusan\nHAVING COUNT(*) > 5\nORDER BY rata_ipk DESC;</code></pre>',
                ],
            ],
            // Kelas 3: Jaringan Komputer
            'Jaringan Komputer' => [
                [
                    'judul' => 'Pengenalan Jaringan Komputer',
                    'deskripsi' => 'Konsep dasar jaringan komputer dan komunikasi data',
                    'konten' => '<h2>Jaringan Komputer</h2><p>Jaringan komputer adalah kumpulan komputer dan perangkat yang saling terhubung untuk berbagi sumber daya dan informasi.</p><h3>Jenis Jaringan</h3><ul><li><strong>LAN</strong> (Local Area Network): Jaringan lokal, misal dalam satu gedung</li><li><strong>MAN</strong> (Metropolitan Area Network): Jaringan dalam satu kota</li><li><strong>WAN</strong> (Wide Area Network): Jaringan luas, antar kota/negara</li><li><strong>Internet</strong>: Jaringan global</li></ul><h3>Topologi Jaringan</h3><ul><li><strong>Star</strong>: Semua node terhubung ke satu hub/switch</li><li><strong>Bus</strong>: Semua node terhubung ke satu kabel utama</li><li><strong>Ring</strong>: Node terhubung membentuk lingkaran</li><li><strong>Mesh</strong>: Setiap node terhubung ke semua node lain</li></ul>',
                ],
                [
                    'judul' => 'Model OSI Layer',
                    'deskripsi' => 'Memahami 7 lapisan model OSI dalam komunikasi jaringan',
                    'konten' => '<h2>Model OSI (Open Systems Interconnection)</h2><p>Model OSI adalah kerangka konseptual yang menjelaskan bagaimana data dikirim melalui jaringan dalam 7 lapisan.</p><h3>7 Lapisan OSI</h3><ol><li><strong>Physical Layer</strong>: Kabel, sinyal listrik/optik</li><li><strong>Data Link Layer</strong>: MAC address, switch, frame</li><li><strong>Network Layer</strong>: IP address, routing, router</li><li><strong>Transport Layer</strong>: TCP/UDP, port, segmentasi</li><li><strong>Session Layer</strong>: Manajemen sesi komunikasi</li><li><strong>Presentation Layer</strong>: Enkripsi, kompresi, format data</li><li><strong>Application Layer</strong>: HTTP, FTP, SMTP, DNS</li></ol><h3>Enkapsulasi Data</h3><p>Saat data dikirim, setiap layer menambahkan header-nya sendiri. Proses ini disebut enkapsulasi. Di sisi penerima, header dilepas satu per satu (de-enkapsulasi).</p>',
                ],
                [
                    'judul' => 'Protokol TCP/IP',
                    'deskripsi' => 'Memahami protokol TCP/IP sebagai fondasi internet',
                    'konten' => '<h2>Protokol TCP/IP</h2><p>TCP/IP (Transmission Control Protocol/Internet Protocol) adalah kumpulan protokol komunikasi yang menjadi fondasi internet.</p><h3>Layer TCP/IP</h3><ol><li><strong>Network Access</strong>: Ethernet, Wi-Fi</li><li><strong>Internet</strong>: IP, ICMP, ARP</li><li><strong>Transport</strong>: TCP (reliable), UDP (fast)</li><li><strong>Application</strong>: HTTP, DNS, FTP, SMTP</li></ol><h3>IP Address</h3><p>IPv4: 32-bit, format desimal bertitik (192.168.1.1)<br>IPv6: 128-bit, format heksadesimal (2001:0db8::1)</p><h3>Subnetting</h3><pre><code>IP Address: 192.168.1.0\nSubnet Mask: 255.255.255.0 (/24)\nNetwork: 192.168.1.0\nBroadcast: 192.168.1.255\nHost Range: 192.168.1.1 - 192.168.1.254\nJumlah Host: 254</code></pre>',
                ],
                [
                    'judul' => 'Keamanan Jaringan Dasar',
                    'deskripsi' => 'Pengenalan konsep keamanan dalam jaringan komputer',
                    'konten' => '<h2>Keamanan Jaringan</h2><p>Keamanan jaringan melibatkan kebijakan dan praktik untuk mencegah akses tidak sah, penyalahgunaan, atau modifikasi jaringan.</p><h3>Ancaman Keamanan</h3><ul><li><strong>Malware</strong>: Virus, worm, trojan, ransomware</li><li><strong>Phishing</strong>: Penipuan untuk mencuri data</li><li><strong>DDoS</strong>: Serangan membanjiri server dengan traffic</li><li><strong>Man-in-the-Middle</strong>: Menyadap komunikasi</li></ul><h3>Mekanisme Keamanan</h3><ul><li><strong>Firewall</strong>: Menyaring traffic masuk dan keluar</li><li><strong>Enkripsi</strong>: SSL/TLS untuk mengamankan data dalam transit</li><li><strong>VPN</strong>: Virtual Private Network untuk koneksi aman</li><li><strong>IDS/IPS</strong>: Intrusion Detection/Prevention System</li></ul><h3>Best Practice</h3><ul><li>Update software secara berkala</li><li>Gunakan password yang kuat</li><li>Aktifkan two-factor authentication</li><li>Backup data secara rutin</li></ul>',
                ],
            ],
            // Kelas 4: Pemrograman Java
            'Pemrograman Java' => [
                [
                    'judul' => 'Pengenalan Java',
                    'deskripsi' => 'Dasar-dasar bahasa pemrograman Java dan lingkungan pengembangan',
                    'konten' => '<h2>Bahasa Pemrograman Java</h2><p>Java adalah bahasa pemrograman berorientasi objek yang dikembangkan oleh Sun Microsystems. Java mengikuti prinsip "Write Once, Run Anywhere" (WORA).</p><h3>Instalasi JDK</h3><p>Untuk memulai pemrograman Java, Anda memerlukan Java Development Kit (JDK) yang dapat diunduh dari Oracle atau menggunakan OpenJDK.</p><h3>Program Java Pertama</h3><pre><code>public class HelloWorld {\n    public static void main(String[] args) {\n        System.out.println("Hello, World!");\n    }\n}</code></pre><h3>Tipe Data Primitif</h3><ul><li><strong>byte</strong>: 8-bit (-128 to 127)</li><li><strong>int</strong>: 32-bit integer</li><li><strong>long</strong>: 64-bit integer</li><li><strong>float</strong>: 32-bit floating point</li><li><strong>double</strong>: 64-bit floating point</li><li><strong>boolean</strong>: true/false</li><li><strong>char</strong>: karakter Unicode</li></ul>',
                ],
                [
                    'judul' => 'OOP di Java',
                    'deskripsi' => 'Konsep Object-Oriented Programming dalam Java',
                    'konten' => '<h2>Object-Oriented Programming</h2><p>OOP adalah paradigma pemrograman yang mengorganisir software dalam bentuk objek yang memiliki data (atribut) dan perilaku (method).</p><h3>4 Pilar OOP</h3><ol><li><strong>Encapsulation</strong>: Menyembunyi detail implementasi</li><li><strong>Inheritance</strong>: Pewarisan sifat dari kelas induk</li><li><strong>Polymorphism</strong>: Satu interface, banyak implementasi</li><li><strong>Abstraction</strong>: Menyederhanakan kompleksitas</li></ol><h3>Contoh Class dan Object</h3><pre><code>public class Mahasiswa {\n    private String nama;\n    private String nim;\n    private double ipk;\n\n    public Mahasiswa(String nama, String nim) {\n        this.nama = nama;\n        this.nim = nim;\n    }\n\n    public String getNama() {\n        return nama;\n    }\n\n    public void setIpk(double ipk) {\n        this.ipk = ipk;\n    }\n}</code></pre>',
                ],
                [
                    'judul' => 'Exception Handling',
                    'deskripsi' => 'Penanganan error dan exception di Java',
                    'konten' => '<h2>Exception Handling di Java</h2><p>Exception handling adalah mekanisme untuk menangani error yang terjadi saat program berjalan (runtime error).</p><h3>Try-Catch-Finally</h3><pre><code>try {\n    int hasil = 10 / 0;\n} catch (ArithmeticException e) {\n    System.out.println("Error: " + e.getMessage());\n} finally {\n    System.out.println("Block ini selalu dijalankan");\n}</code></pre><h3>Jenis Exception</h3><ul><li><strong>Checked Exception</strong>: IOException, SQLException (harus di-handle)</li><li><strong>Unchecked Exception</strong>: NullPointerException, ArrayIndexOutOfBoundsException</li><li><strong>Error</strong>: OutOfMemoryError, StackOverflowError</li></ul><h3>Custom Exception</h3><pre><code>public class SaldoTidakCukupException extends Exception {\n    public SaldoTidakCukupException(String message) {\n        super(message);\n    }\n}</code></pre>',
                ],
                [
                    'judul' => 'Collection Framework',
                    'deskripsi' => 'Struktur data Collection di Java: List, Set, Map',
                    'konten' => '<h2>Java Collection Framework</h2><p>Collection Framework menyediakan arsitektur untuk menyimpan dan memanipulasi kumpulan objek.</p><h3>List</h3><pre><code>List&lt;String&gt; daftar = new ArrayList&lt;&gt;();\ndaftar.add("Java");\ndaftar.add("Python");\ndaftar.add("Go");\n\nfor (String bahasa : daftar) {\n    System.out.println(bahasa);\n}</code></pre><h3>Set</h3><pre><code>Set&lt;Integer&gt; angka = new HashSet&lt;&gt;();\nangka.add(1);\nangka.add(2);\nangka.add(1); // diabaikan, tidak ada duplikasi</code></pre><h3>Map</h3><pre><code>Map&lt;String, Integer&gt; nilai = new HashMap&lt;&gt;();\nnilai.put("Matematika", 90);\nnilai.put("Fisika", 85);\n\nint mathScore = nilai.get("Matematika"); // 90</code></pre>',
                ],
            ],
            // Kelas 5: Desain UI/UX
            'Desain UI/UX' => [
                [
                    'judul' => 'Pengenalan UI/UX Design',
                    'deskripsi' => 'Memahami perbedaan dan pentingnya UI dan UX dalam desain digital',
                    'konten' => '<h2>UI vs UX</h2><p><strong>UI (User Interface)</strong> adalah tampilan visual yang dilihat dan diinteraksikan pengguna. <strong>UX (User Experience)</strong> adalah keseluruhan pengalaman pengguna saat menggunakan produk.</p><h3>Prinsip Desain UI</h3><ul><li><strong>Konsistensi</strong>: Elemen serupa harus terlihat dan berfungsi sama</li><li><strong>Hierarchy</strong>: Elemen penting harus lebih menonjol</li><li><strong>Feedback</strong>: Sistem harus memberikan respons atas aksi pengguna</li><li><strong>Simplicity</strong>: Jaga kesederhanaan desain</li></ul><h3>Prinsip Desain UX</h3><ul><li><strong>User-Centered Design</strong>: Fokus pada kebutuhan pengguna</li><li><strong>Accessibility</strong>: Dapat diakses semua pengguna</li><li><strong>Usability</strong>: Mudah digunakan dan dipelajari</li><li><strong>Desirability</strong>: Menarik dan menyenangkan</li></ul>',
                ],
                [
                    'judul' => 'Wireframing dan Prototyping',
                    'deskripsi' => 'Teknik membuat wireframe dan prototype untuk desain aplikasi',
                    'konten' => '<h2>Wireframing</h2><p>Wireframe adalah kerangka visual sederhana yang menunjukkan layout dan struktur halaman tanpa detail visual.</p><h3>Jenis Wireframe</h3><ul><li><strong>Low-fidelity</strong>: Sketsa tangan, blok sederhana</li><li><strong>Mid-fidelity</strong>: Digital, lebih detail tapi tanpa warna</li><li><strong>High-fidelity</strong>: Detail lengkap mendekati desain final</li></ul><h3>Tools Wireframing</h3><ul><li>Figma (gratis dan populer)</li><li>Adobe XD</li><li>Sketch (Mac only)</li><li>Balsamiq (low-fidelity)</li></ul><h3>Prototyping</h3><p>Prototype adalah model interaktif dari produk yang memungkinkan pengujian alur dan fungsionalitas sebelum development.</p><ul><li><strong>Clickable prototype</strong>: Navigasi antar halaman</li><li><strong>Interactive prototype</strong>: Animasi dan transisi</li><li><strong>Functional prototype</strong>: Logika dan data dummy</li></ul>',
                ],
                [
                    'judul' => 'Teori Warna dan Tipografi',
                    'deskripsi' => 'Penerapan teori warna dan pemilihan tipografi yang tepat',
                    'konten' => '<h2>Teori Warna</h2><p>Warna mempengaruhi emosi dan persepsi pengguna terhadap produk digital.</p><h3>Color Wheel</h3><ul><li><strong>Primary</strong>: Merah, Biru, Kuning</li><li><strong>Secondary</strong>: Hijau, Orange, Ungu</li><li><strong>Tertiary</strong>: Campuran primary + secondary</li></ul><h3>Skema Warna</h3><ul><li><strong>Complementary</strong>: Warna berseberangan</li><li><strong>Analogous</strong>: Warna bersebelahan</li><li><strong>Triadic</strong>: 3 warna berjarak sama</li><li><strong>Monochromatic</strong>: Variasi satu warna</li></ul><h3>Tipografi</h3><ul><li><strong>Serif</strong>: Times New Roman, Georgia (formal, tradisional)</li><li><strong>Sans-serif</strong>: Arial, Helvetica, Inter (modern, bersih)</li><li><strong>Monospace</strong>: Courier, Fira Code (kode/teknikal)</li></ul><p><strong>Aturan tipografi</strong>: Maksimal 2-3 font dalam satu desain. Gunakan ukuran yang kontras untuk hierarchy.</p>',
                ],
            ],
            // Kelas 6: Algoritma dan Struktur Data
            'Algoritma dan Struktur Data' => [
                [
                    'judul' => 'Pengenalan Algoritma',
                    'deskripsi' => 'Memahami konsep algoritma, pseudocode, dan flowchart',
                    'konten' => '<h2>Apa itu Algoritma?</h2><p>Algoritma adalah sekumpulan langkah-langkah logis dan sistematis untuk menyelesaikan suatu masalah.</p><h3>Karakteristik Algoritma</h3><ul><li><strong>Input</strong>: Memiliki nol atau lebih masukan</li><li><strong>Output</strong>: Memiliki satu atau lebih keluaran</li><li><strong>Definiteness</strong>: Langkah-langkah jelas dan tidak ambigu</li><li><strong>Finiteness</strong>: Harus berakhir setelah sejumlah langkah</li><li><strong>Effectiveness</strong>: Setiap langkah harus bisa dilaksanakan</li></ul><h3>Pseudocode</h3><pre><code>ALGORITMA CariNilaiMaksimum\nINPUT: array A[1..n]\nOUTPUT: nilai maksimum\n\nmaks ← A[1]\nFOR i ← 2 TO n DO\n    IF A[i] > maks THEN\n        maks ← A[i]\n    ENDIF\nENDFOR\nRETURN maks</code></pre><h3>Kompleksitas Algoritma (Big-O)</h3><ul><li>O(1) - Constant</li><li>O(log n) - Logarithmic</li><li>O(n) - Linear</li><li>O(n log n) - Linearithmic</li><li>O(n²) - Quadratic</li></ul>',
                ],
                [
                    'judul' => 'Array dan Linked List',
                    'deskripsi' => 'Struktur data linear: array, linked list, dan perbandingannya',
                    'konten' => '<h2>Array</h2><p>Array adalah struktur data yang menyimpan elemen-elemen dengan tipe yang sama secara berurutan di memori.</p><h3>Operasi Array</h3><ul><li><strong>Akses</strong>: O(1) - langsung via indeks</li><li><strong>Pencarian</strong>: O(n) - linear search</li><li><strong>Insersi</strong>: O(n) - perlu menggeser elemen</li><li><strong>Penghapusan</strong>: O(n) - perlu menggeser elemen</li></ul><h2>Linked List</h2><p>Linked List menyimpan data dalam node yang saling terhubung melalui pointer.</p><h3>Jenis Linked List</h3><ul><li><strong>Singly Linked List</strong>: Node menunjuk ke node berikutnya</li><li><strong>Doubly Linked List</strong>: Node menunjuk ke depan dan belakang</li><li><strong>Circular Linked List</strong>: Node terakhir menunjuk ke node pertama</li></ul><h3>Perbandingan</h3><table><tr><th>Operasi</th><th>Array</th><th>Linked List</th></tr><tr><td>Akses</td><td>O(1)</td><td>O(n)</td></tr><tr><td>Insersi awal</td><td>O(n)</td><td>O(1)</td></tr><tr><td>Hapus awal</td><td>O(n)</td><td>O(1)</td></tr></table>',
                ],
                [
                    'judul' => 'Stack dan Queue',
                    'deskripsi' => 'Memahami struktur data stack (LIFO) dan queue (FIFO)',
                    'konten' => '<h2>Stack</h2><p>Stack adalah struktur data LIFO (Last In, First Out). Elemen terakhir yang dimasukkan akan pertama kali dikeluarkan.</p><h3>Operasi Stack</h3><ul><li><strong>push(x)</strong>: Menambah elemen ke atas stack</li><li><strong>pop()</strong>: Menghapus elemen teratas</li><li><strong>peek()</strong>: Melihat elemen teratas tanpa menghapus</li><li><strong>isEmpty()</strong>: Cek apakah stack kosong</li></ul><h3>Contoh Penggunaan Stack</h3><ul><li>Undo/Redo pada text editor</li><li>Call stack pada eksekusi program</li><li>Validasi tanda kurung: {[()]}</li></ul><h2>Queue</h2><p>Queue adalah struktur data FIFO (First In, First Out). Elemen pertama yang dimasukkan akan pertama kali dikeluarkan.</p><h3>Operasi Queue</h3><ul><li><strong>enqueue(x)</strong>: Menambah elemen ke belakang</li><li><strong>dequeue()</strong>: Menghapus elemen terdepan</li><li><strong>front()</strong>: Melihat elemen terdepan</li></ul><h3>Contoh Penggunaan Queue</h3><ul><li>Antrian printer</li><li>BFS (Breadth-First Search)</li><li>Task scheduling</li></ul>',
                ],
                [
                    'judul' => 'Sorting Algorithms',
                    'deskripsi' => 'Algoritma pengurutan: bubble sort, selection sort, merge sort, quick sort',
                    'konten' => '<h2>Algoritma Sorting</h2><p>Sorting adalah proses mengurutkan elemen-elemen data berdasarkan kriteria tertentu.</p><h3>Bubble Sort - O(n²)</h3><pre><code>for i = 0 to n-1:\n    for j = 0 to n-i-2:\n        if arr[j] > arr[j+1]:\n            swap(arr[j], arr[j+1])</code></pre><h3>Selection Sort - O(n²)</h3><pre><code>for i = 0 to n-1:\n    minIdx = i\n    for j = i+1 to n-1:\n        if arr[j] < arr[minIdx]:\n            minIdx = j\n    swap(arr[i], arr[minIdx])</code></pre><h3>Merge Sort - O(n log n)</h3><p>Menggunakan strategi divide and conquer. Membagi array menjadi dua bagian, mengurutkan masing-masing, lalu menggabungkannya.</p><h3>Quick Sort - O(n log n) average</h3><p>Memilih pivot, mempartisi array menjadi elemen lebih kecil dan lebih besar dari pivot, kemudian mengurutkan masing-masing partisi secara rekursif.</p><h3>Perbandingan</h3><table><tr><th>Algoritma</th><th>Best</th><th>Average</th><th>Worst</th><th>Stable</th></tr><tr><td>Bubble Sort</td><td>O(n)</td><td>O(n²)</td><td>O(n²)</td><td>Ya</td></tr><tr><td>Quick Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n²)</td><td>Tidak</td></tr><tr><td>Merge Sort</td><td>O(n log n)</td><td>O(n log n)</td><td>O(n log n)</td><td>Ya</td></tr></table>',
                ],
            ],
            // Kelas 7: Sistem Operasi
            'Sistem Operasi' => [
                [
                    'judul' => 'Pengenalan Sistem Operasi',
                    'deskripsi' => 'Konsep dasar sistem operasi dan fungsinya',
                    'konten' => '<h2>Apa itu Sistem Operasi?</h2><p>Sistem Operasi (OS) adalah perangkat lunak yang mengelola sumber daya hardware dan menyediakan layanan untuk program aplikasi.</p><h3>Fungsi Utama OS</h3><ul><li><strong>Manajemen Proses</strong>: Membuat, menjadwalkan, dan menghentikan proses</li><li><strong>Manajemen Memori</strong>: Alokasi dan dealokasi memori</li><li><strong>Manajemen File</strong>: Organisasi dan akses file di storage</li><li><strong>Manajemen I/O</strong>: Mengelola perangkat input/output</li><li><strong>Keamanan</strong>: Autentikasi dan otorisasi pengguna</li></ul><h3>Jenis Sistem Operasi</h3><ul><li><strong>Desktop</strong>: Windows, macOS, Linux</li><li><strong>Server</strong>: Ubuntu Server, CentOS, Windows Server</li><li><strong>Mobile</strong>: Android, iOS</li><li><strong>Embedded</strong>: RTOS, FreeRTOS</li></ul>',
                ],
                [
                    'judul' => 'Manajemen Proses',
                    'deskripsi' => 'Process scheduling, states, dan inter-process communication',
                    'konten' => '<h2>Proses dan Thread</h2><p>Proses adalah program yang sedang dieksekusi. Thread adalah unit terkecil dari eksekusi dalam sebuah proses.</p><h3>Status Proses</h3><ul><li><strong>New</strong>: Proses baru dibuat</li><li><strong>Ready</strong>: Siap dieksekusi, menunggu CPU</li><li><strong>Running</strong>: Sedang dieksekusi oleh CPU</li><li><strong>Waiting</strong>: Menunggu event (I/O, dll)</li><li><strong>Terminated</strong>: Selesai dieksekusi</li></ul><h3>Algoritma Scheduling</h3><ul><li><strong>FCFS</strong> (First Come, First Served)</li><li><strong>SJF</strong> (Shortest Job First)</li><li><strong>Round Robin</strong>: Setiap proses mendapat waktu eksekusi yang sama</li><li><strong>Priority Scheduling</strong>: Berdasarkan prioritas proses</li></ul><h3>Context Switching</h3><p>Context switching adalah proses menyimpan state proses yang sedang berjalan dan memuat state proses lain. Ini terjadi saat CPU berpindah dari satu proses ke proses lain.</p>',
                ],
                [
                    'judul' => 'Manajemen Memori',
                    'deskripsi' => 'Teknik manajemen memori: paging, segmentation, virtual memory',
                    'konten' => '<h2>Manajemen Memori</h2><p>Manajemen memori bertanggung jawab atas alokasi dan dealokasi ruang memori untuk proses.</p><h3>Partisi Memori</h3><ul><li><strong>Contiguous Allocation</strong>: Setiap proses mendapat blok memori berurutan</li><li><strong>Non-contiguous</strong>: Proses dapat tersebar di memori</li></ul><h3>Paging</h3><p>Membagi memori fisik menjadi frame dan memori logis menjadi page dengan ukuran sama. Page table memetakan page ke frame.</p><h3>Virtual Memory</h3><p>Virtual memory memungkinkan eksekusi proses yang tidak sepenuhnya berada di memori fisik.</p><ul><li><strong>Demand Paging</strong>: Page dimuat hanya saat dibutuhkan</li><li><strong>Page Fault</strong>: Terjadi saat page yang dibutuhkan tidak ada di memori</li><li><strong>Page Replacement</strong>: FIFO, LRU, Optimal</li></ul><h3>Thrashing</h3><p>Thrashing terjadi ketika sistem menghabiskan lebih banyak waktu untuk page swapping daripada eksekusi proses.</p>',
                ],
            ],
            // Kelas 8: Pemrograman Python
            'Pemrograman Python' => [
                [
                    'judul' => 'Pengenalan Python',
                    'deskripsi' => 'Dasar-dasar Python: syntax, variabel, tipe data',
                    'konten' => '<h2>Bahasa Python</h2><p>Python adalah bahasa pemrograman tingkat tinggi yang mudah dipelajari dengan syntax yang bersih dan readable.</p><h3>HelloWorld</h3><pre><code>print("Hello, World!")</code></pre><h3>Variabel dan Tipe Data</h3><pre><code># String\nnama = "Budi"\n\n# Integer\numur = 25\n\n# Float\ntinggi = 175.5\n\n# Boolean\naktif = True\n\n# List\nhobi = ["membaca", "coding", "gaming"]\n\n# Dictionary\nmahasiswa = {"nama": "Budi", "nim": "2021001"}\n\n# Tuple\nkoordinat = (3, 5)</code></pre><h3>Operator</h3><pre><code># Aritmatika\nhasil = 10 + 3    # 13\nhasil = 10 ** 2   # 100 (pangkat)\nhasil = 10 // 3   # 3 (floor division)\nhasil = 10 % 3    # 1 (modulo)</code></pre>',
                ],
                [
                    'judul' => 'Kontrol Alur dan Fungsi',
                    'deskripsi' => 'If-else, loop, dan fungsi di Python',
                    'konten' => '<h2>Kontrol Alur</h2><h3>If-Else</h3><pre><code>nilai = 85\n\nif nilai >= 80:\n    grade = "A"\nelif nilai >= 70:\n    grade = "B"\nelif nilai >= 60:\n    grade = "C"\nelse:\n    grade = "D"\n\nprint(f"Grade: {grade}")</code></pre><h3>Loop</h3><pre><code># For loop\nfor i in range(5):\n    print(i)  # 0, 1, 2, 3, 4\n\n# While loop\ncount = 0\nwhile count < 5:\n    print(count)\n    count += 1\n\n# List comprehension\nkuadrat = [x**2 for x in range(10)]</code></pre><h3>Fungsi</h3><pre><code>def hitung_luas(panjang, lebar):\n    """Menghitung luas persegi panjang"""\n    return panjang * lebar\n\nluas = hitung_luas(10, 5)\nprint(f"Luas: {luas}")  # 50\n\n# Lambda\nkuadrat = lambda x: x ** 2\nprint(kuadrat(4))  # 16</code></pre>',
                ],
                [
                    'judul' => 'OOP di Python',
                    'deskripsi' => 'Pemrograman berorientasi objek dengan Python',
                    'konten' => '<h2>OOP di Python</h2><h3>Class dan Object</h3><pre><code>class Mahasiswa:\n    def __init__(self, nama, nim):\n        self.nama = nama\n        self.nim = nim\n        self.nilai = []\n    \n    def tambah_nilai(self, nilai):\n        self.nilai.append(nilai)\n    \n    def rata_rata(self):\n        if not self.nilai:\n            return 0\n        return sum(self.nilai) / len(self.nilai)\n    \n    def __str__(self):\n        return f"{self.nama} ({self.nim})"\n\n# Membuat objek\nmhs = Mahasiswa("Budi", "2021001")\nmhs.tambah_nilai(85)\nmhs.tambah_nilai(90)\nprint(mhs.rata_rata())  # 87.5</code></pre><h3>Inheritance</h3><pre><code>class MahasiswaBeasiswa(Mahasiswa):\n    def __init__(self, nama, nim, jenis_beasiswa):\n        super().__init__(nama, nim)\n        self.jenis_beasiswa = jenis_beasiswa\n    \n    def info(self):\n        return f"{self.nama} - Beasiswa {self.jenis_beasiswa}"</code></pre>',
                ],
                [
                    'judul' => 'Module dan Package',
                    'deskripsi' => 'Penggunaan module, package, dan pip di Python',
                    'konten' => '<h2>Module dan Package</h2><h3>Import Module</h3><pre><code># Import seluruh module\nimport math\nprint(math.sqrt(16))  # 4.0\n\n# Import spesifik\nfrom datetime import datetime\nprint(datetime.now())\n\n# Import dengan alias\nimport numpy as np\narr = np.array([1, 2, 3])</code></pre><h3>Membuat Module</h3><pre><code># file: utils.py\ndef hitung_diskon(harga, persen):\n    return harga * (1 - persen/100)\n\ndef format_rupiah(nominal):\n    return f"Rp {nominal:,.0f}"\n\n# file: main.py\nfrom utils import hitung_diskon, format_rupiah\nharga = hitung_diskon(100000, 20)\nprint(format_rupiah(harga))  # Rp 80,000</code></pre><h3>Pip (Package Manager)</h3><pre><code># Install package\npip install requests flask pandas\n\n# Install dari requirements.txt\npip install -r requirements.txt\n\n# Freeze dependencies\npip freeze > requirements.txt</code></pre><h3>Virtual Environment</h3><pre><code>python -m venv myenv\nmyenv\\Scripts\\activate  # Windows\nsource myenv/bin/activate  # Linux/Mac</code></pre>',
                ],
            ],
            // Kelas 9: Keamanan Siber
            'Keamanan Siber' => [
                [
                    'judul' => 'Pengenalan Keamanan Siber',
                    'deskripsi' => 'Konsep dasar cybersecurity dan CIA Triad',
                    'konten' => '<h2>Keamanan Siber (Cybersecurity)</h2><p>Keamanan siber adalah praktik melindungi sistem, jaringan, dan program dari serangan digital.</p><h3>CIA Triad</h3><ul><li><strong>Confidentiality</strong> (Kerahasiaan): Memastikan data hanya diakses oleh pihak yang berwenang</li><li><strong>Integrity</strong> (Integritas): Memastikan data tidak diubah tanpa otorisasi</li><li><strong>Availability</strong> (Ketersediaan): Memastikan sistem dan data tersedia saat dibutuhkan</li></ul><h3>Jenis Ancaman</h3><ul><li><strong>Malware</strong>: Virus, worm, trojan horse, ransomware, spyware</li><li><strong>Social Engineering</strong>: Phishing, baiting, pretexting</li><li><strong>Injection Attacks</strong>: SQL injection, XSS, command injection</li><li><strong>DoS/DDoS</strong>: Membanjiri server dengan request berlebihan</li><li><strong>Insider Threat</strong>: Ancaman dari dalam organisasi</li></ul>',
                ],
                [
                    'judul' => 'Kriptografi',
                    'deskripsi' => 'Dasar kriptografi: enkripsi, hashing, dan digital signature',
                    'konten' => '<h2>Kriptografi</h2><p>Kriptografi adalah ilmu dan seni mengamankan komunikasi dan data dari pihak yang tidak berwenang.</p><h3>Enkripsi Simetris</h3><p>Menggunakan satu kunci untuk enkripsi dan dekripsi.</p><ul><li><strong>AES</strong> (Advanced Encryption Standard): Standar enkripsi modern</li><li><strong>DES</strong>: Sudah usang, digantikan AES</li><li><strong>3DES</strong>: DES tiga kali, lebih aman tapi lambat</li></ul><h3>Enkripsi Asimetris</h3><p>Menggunakan pasangan kunci publik dan privat.</p><ul><li><strong>RSA</strong>: Enkripsi asimetris paling populer</li><li><strong>ECC</strong>: Lebih efisien dari RSA</li></ul><h3>Hashing</h3><p>Hashing mengubah data menjadi string dengan panjang tetap (one-way function).</p><ul><li><strong>MD5</strong>: 128-bit (tidak aman lagi)</li><li><strong>SHA-256</strong>: 256-bit (standar saat ini)</li><li><strong>bcrypt</strong>: Khusus untuk password</li></ul><h3>Digital Signature</h3><p>Menggabungkan hashing dan enkripsi asimetris untuk memverifikasi keaslian dan integritas dokumen.</p>',
                ],
                [
                    'judul' => 'Web Application Security',
                    'deskripsi' => 'Keamanan aplikasi web: OWASP Top 10 dan best practices',
                    'konten' => '<h2>Keamanan Aplikasi Web</h2><h3>OWASP Top 10</h3><ol><li><strong>Injection</strong>: SQL injection, NoSQL injection</li><li><strong>Broken Authentication</strong>: Kelemahan autentikasi</li><li><strong>Sensitive Data Exposure</strong>: Data sensitif tidak terenkripsi</li><li><strong>XML External Entities (XXE)</strong>: Eksploitasi parser XML</li><li><strong>Broken Access Control</strong>: Kontrol akses tidak tepat</li><li><strong>Security Misconfiguration</strong>: Konfigurasi tidak aman</li><li><strong>Cross-Site Scripting (XSS)</strong>: Injeksi script berbahaya</li><li><strong>Insecure Deserialization</strong>: Deserialisasi tidak aman</li><li><strong>Using Known Vulnerabilities</strong>: Komponen dengan kerentanan</li><li><strong>Insufficient Logging</strong>: Logging dan monitoring kurang</li></ol><h3>Pencegahan SQL Injection</h3><pre><code>// Buruk (vulnerable)\n$query = "SELECT * FROM users WHERE email = \'$email\'";\n\n// Baik (parameterized query)\n$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");\n$stmt->execute([$email]);</code></pre>',
                ],
            ],
            // Kelas 10: Cloud Computing
            'Cloud Computing' => [
                [
                    'judul' => 'Pengenalan Cloud Computing',
                    'deskripsi' => 'Konsep dasar cloud computing dan model layanan',
                    'konten' => '<h2>Cloud Computing</h2><p>Cloud computing adalah penyediaan sumber daya komputasi (server, storage, database, networking, software) melalui internet.</p><h3>Model Layanan</h3><ul><li><strong>IaaS</strong> (Infrastructure as a Service): VM, storage, networking. Contoh: AWS EC2, Google Compute Engine</li><li><strong>PaaS</strong> (Platform as a Service): Platform untuk develop dan deploy. Contoh: Heroku, Google App Engine</li><li><strong>SaaS</strong> (Software as a Service): Aplikasi siap pakai. Contoh: Gmail, Office 365, Salesforce</li></ul><h3>Model Deployment</h3><ul><li><strong>Public Cloud</strong>: Infrastruktur milik provider, diakses via internet</li><li><strong>Private Cloud</strong>: Infrastruktur milik organisasi</li><li><strong>Hybrid Cloud</strong>: Kombinasi public dan private</li><li><strong>Multi-Cloud</strong>: Menggunakan lebih dari satu provider</li></ul><h3>Keuntungan Cloud</h3><ul><li>Skalabilitas otomatis</li><li>Bayar sesuai penggunaan (pay-as-you-go)</li><li>Tidak perlu investasi hardware</li><li>Aksesibilitas global</li></ul>',
                ],
                [
                    'judul' => 'Virtualisasi dan Container',
                    'deskripsi' => 'Memahami virtualisasi, VM, Docker, dan Kubernetes',
                    'konten' => '<h2>Virtualisasi</h2><p>Virtualisasi memungkinkan menjalankan beberapa sistem operasi pada satu mesin fisik.</p><h3>Virtual Machine (VM)</h3><ul><li>Menjalankan OS lengkap di atas hypervisor</li><li>Isolasi penuh antar VM</li><li>Overhead besar (GB per VM)</li><li>Tools: VMware, VirtualBox, Hyper-V</li></ul><h3>Container</h3><ul><li>Menjalankan aplikasi dalam lingkungan terisolasi</li><li>Berbagi kernel OS host</li><li>Ringan (MB per container)</li><li>Startup cepat (detik vs menit)</li></ul><h3>Docker</h3><pre><code># Dockerfile\nFROM node:18-alpine\nWORKDIR /app\nCOPY package*.json ./\nRUN npm install\nCOPY . .\nEXPOSE 3000\nCMD ["npm", "start"]</code></pre><pre><code># Docker commands\ndocker build -t myapp .\ndocker run -p 3000:3000 myapp\ndocker-compose up -d</code></pre><h3>Kubernetes (K8s)</h3><p>Kubernetes adalah platform orchestration untuk mengelola container dalam skala besar: auto-scaling, self-healing, load balancing.</p>',
                ],
                [
                    'judul' => 'Cloud Services dan Deployment',
                    'deskripsi' => 'Layanan cloud populer dan cara deployment aplikasi',
                    'konten' => '<h2>Cloud Providers</h2><h3>Amazon Web Services (AWS)</h3><ul><li><strong>EC2</strong>: Virtual server</li><li><strong>S3</strong>: Object storage</li><li><strong>RDS</strong>: Managed database</li><li><strong>Lambda</strong>: Serverless function</li><li><strong>CloudFront</strong>: CDN</li></ul><h3>Google Cloud Platform (GCP)</h3><ul><li><strong>Compute Engine</strong>: Virtual server</li><li><strong>Cloud Storage</strong>: Object storage</li><li><strong>Cloud SQL</strong>: Managed database</li><li><strong>Cloud Functions</strong>: Serverless function</li></ul><h3>CI/CD Pipeline</h3><pre><code># .github/workflows/deploy.yml\nname: Deploy\non:\n  push:\n    branches: [main]\njobs:\n  deploy:\n    runs-on: ubuntu-latest\n    steps:\n      - uses: actions/checkout@v3\n      - name: Build\n        run: npm run build\n      - name: Deploy\n        run: ./deploy.sh</code></pre><h3>Best Practices</h3><ul><li>Infrastructure as Code (Terraform, CloudFormation)</li><li>Environment variables untuk konfigurasi</li><li>Blue-green deployment untuk zero downtime</li><li>Monitoring dan logging terpusat</li></ul>',
                ],
            ],
        ];

        foreach ($materiData as $kelasNama => $materiList) {
            $kelas = Kelas::where('nama', $kelasNama)->first();
            if (!$kelas)
                continue;

            foreach ($materiList as $index => $materi) {
                Materi::firstOrCreate(
                    ['kelas_id' => $kelas->id, 'judul' => $materi['judul']],
                    [
                        'deskripsi' => $materi['deskripsi'],
                        'konten' => $materi['konten'],
                        'urutan' => $index + 1,
                    ]
                );
            }
        }
    }
}
