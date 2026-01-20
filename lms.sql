-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 20, 2026 at 01:34 AM
-- Server version: 8.0.30
-- PHP Version: 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_ujians`
--

CREATE TABLE `hasil_ujians` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `materi_id` bigint UNSIGNED NOT NULL,
  `jumlah_soal` int NOT NULL DEFAULT '0',
  `jumlah_benar` int NOT NULL DEFAULT '0',
  `nilai` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hasil_ujians`
--

INSERT INTO `hasil_ujians` (`id`, `user_id`, `materi_id`, `jumlah_soal`, `jumlah_benar`, `nilai`, `created_at`, `updated_at`) VALUES
(31, 2, 24, 15, 0, 0, '2026-01-19 18:21:45', '2026-01-19 18:21:45');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban_users`
--

CREATE TABLE `jawaban_users` (
  `id` bigint UNSIGNED NOT NULL,
  `hasil_ujian_id` bigint UNSIGNED NOT NULL,
  `soal_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `jawaban_user` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_benar` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` bigint UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumnail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nama`, `thumnail`, `created_at`, `updated_at`) VALUES
(10, 'Laravel Web', 'kelas/QDZVWJKbliu1rxERwkBpYyHnBeiagHXgQOioOHjv.png', '2026-01-07 07:31:26', '2026-01-19 18:02:10'),
(11, 'React Web Development – Basic', 'kelas/W5Bh2Lf3xBvNj6HBP9AXfkITzkrbK5bUGkk47N62.jpg', '2026-01-19 18:04:19', '2026-01-19 18:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_user`
--

CREATE TABLE `kelas_user` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `completed_materials` json DEFAULT NULL,
  `progress` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas_user`
--

INSERT INTO `kelas_user` (`id`, `kelas_id`, `user_id`, `completed_materials`, `progress`, `created_at`, `updated_at`) VALUES
(12, 10, 2, '[]', 0, '2026-01-13 18:32:08', '2026-01-13 18:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `materis`
--

CREATE TABLE `materis` (
  `id` bigint UNSIGNED NOT NULL,
  `kelas_id` bigint UNSIGNED NOT NULL,
  `judul` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `konten` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `materis`
--

INSERT INTO `materis` (`id`, `kelas_id`, `judul`, `deskripsi`, `konten`, `created_at`, `updated_at`) VALUES
(21, 10, 'Laravel CRUD – Bagian 1: Membangun CRUD Lengkap di Laravel (Create, Read, Update, Delete)', 'Tutorial ini membahas pembuatan fitur CRUD (Create, Read, Update, Delete) menggunakan Laravel secara bertahap dan terstruktur. Materi mencakup pembuatan tiga model utama, lengkap dengan migration, controller, routing, validasi, dan contoh kode implementasi yang siap digunakan dalam proyek nyata.', '<h3><strong>Pendahuluan</strong></h3><p>CRUD&nbsp;adalah&nbsp;fondasi&nbsp;utama&nbsp;dalam&nbsp;hampir&nbsp;semua&nbsp;aplikasi&nbsp;berbasis&nbsp;database.&nbsp;Laravel&nbsp;menyediakan&nbsp;ekosistem&nbsp;lengkap&nbsp;untuk&nbsp;membangun&nbsp;CRUD&nbsp;dengan&nbsp;cepat,&nbsp;aman,&nbsp;dan&nbsp;terstruktur&nbsp;menggunakan&nbsp;MVC&nbsp;(Model–View–Controller).</p><p>Pada&nbsp;tutorial&nbsp;ini,&nbsp;kita&nbsp;akan&nbsp;membuat&nbsp;<strong>3&nbsp;model</strong>:</p><ol><li><strong>Category</strong></li><li><strong>Product</strong></li><li><strong>Order</strong></li></ol><p>Setiap&nbsp;model&nbsp;akan&nbsp;memiliki:</p><ul><li>Migration</li><li>Model</li><li>Controller</li><li>Routing</li><li>Contoh&nbsp;kode&nbsp;utama</li></ul><h2><strong>Model&nbsp;1:&nbsp;Category</strong></h2><h3><strong>Tujuan</strong></h3><p>Mengelola&nbsp;data&nbsp;kategori&nbsp;produk.</p><h3><strong>1.&nbsp;Membuat&nbsp;Model&nbsp;&amp;&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nphp artisan make:model Category -m\n</pre><h3><strong>2.&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nSchema::create(&#39;categories&#39;, function (Blueprint $table) {\n    $table-&gt;id();\n    $table-&gt;string(&#39;name&#39;);\n    $table-&gt;text(&#39;description&#39;)-&gt;nullable();\n    $table-&gt;timestamps();\n});\n</pre><h3><strong>3.&nbsp;Model</strong></h3><pre data-language=\"plain\">\nclass Category extends Model\n{\n    protected $fillable = [&#39;name&#39;, &#39;description&#39;];\n}\n</pre><h3><strong>4.&nbsp;Controller</strong></h3><pre data-language=\"plain\">\nphp artisan make:controller CategoryController --resource\n\nclass CategoryController extends Controller\n{\n    public function index()\n    {\n        return Category::all();\n    }\n\n    public function store(Request $request)\n    {\n        $request-&gt;validate([\n            &#39;name&#39; =&gt; &#39;required&#39;\n        ]);\n\n        return Category::create($request-&gt;all());\n    }\n\n    public function update(Request $request, Category $category)\n    {\n        $category-&gt;update($request-&gt;all());\n        return $category;\n    }\n\n    public function destroy(Category $category)\n    {\n        $category-&gt;delete();\n        return response()-&gt;json([&#39;message&#39; =&gt; &#39;Deleted&#39;]);\n    }\n}\n</pre><h2><strong>Model&nbsp;2:&nbsp;Product</strong></h2><h3><strong>Tujuan</strong></h3><p>Mengelola&nbsp;data&nbsp;produk&nbsp;yang&nbsp;berelasi&nbsp;dengan&nbsp;kategori.</p><h3><strong>1.&nbsp;Membuat&nbsp;Model&nbsp;&amp;&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nphp artisan make:model Product -m\n</pre><h3><strong>2.&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nSchema::create(&#39;products&#39;, function (Blueprint $table) {\n    $table-&gt;id();\n    $table-&gt;foreignId(&#39;category_id&#39;)-&gt;constrained()-&gt;cascadeOnDelete();\n    $table-&gt;string(&#39;name&#39;);\n    $table-&gt;decimal(&#39;price&#39;, 10, 2);\n    $table-&gt;integer(&#39;stock&#39;);\n    $table-&gt;timestamps();\n});\n</pre><h3><strong>3.&nbsp;Model</strong></h3><pre data-language=\"plain\">\nclass Product extends Model\n{\n    protected $fillable = [&#39;category_id&#39;, &#39;name&#39;, &#39;price&#39;, &#39;stock&#39;];\n\n    public function category()\n    {\n        return $this-&gt;belongsTo(Category::class);\n    }\n}\n</pre><h3><strong>4.&nbsp;Controller</strong></h3><pre data-language=\"plain\">\nclass ProductController extends Controller\n{\n    public function index()\n    {\n        return Product::with(&#39;category&#39;)-&gt;get();\n    }\n\n    public function store(Request $request)\n    {\n        $request-&gt;validate([\n            &#39;category_id&#39; =&gt; &#39;required&#39;,\n            &#39;name&#39; =&gt; &#39;required&#39;,\n            &#39;price&#39; =&gt; &#39;required|numeric&#39;,\n            &#39;stock&#39; =&gt; &#39;required|integer&#39;\n        ]);\n\n        return Product::create($request-&gt;all());\n    }\n\n    public function update(Request $request, Product $product)\n    {\n        $product-&gt;update($request-&gt;all());\n        return $product;\n    }\n\n    public function destroy(Product $product)\n    {\n        $product-&gt;delete();\n        return response()-&gt;json([&#39;message&#39; =&gt; &#39;Deleted&#39;]);\n    }\n}\n</pre><h2><strong>Model&nbsp;3:&nbsp;Order</strong></h2><h3><strong>Tujuan</strong></h3><p>Menyimpan&nbsp;transaksi&nbsp;pemesanan&nbsp;produk.</p><h3><strong>1.&nbsp;Membuat&nbsp;Model&nbsp;&amp;&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nphp artisan make:model Order -m\n</pre><h3><strong>2.&nbsp;Migration</strong></h3><pre data-language=\"plain\">\nSchema::create(&#39;orders&#39;, function (Blueprint $table) {\n    $table-&gt;id();\n    $table-&gt;string(&#39;customer_name&#39;);\n    $table-&gt;date(&#39;order_date&#39;);\n    $table-&gt;decimal(&#39;total_price&#39;, 12, 2);\n    $table-&gt;timestamps();\n});\n</pre><h3><strong>3.&nbsp;Model</strong></h3><pre data-language=\"plain\">\nclass Order extends Model\n{\n    protected $fillable = [\n        &#39;customer_name&#39;,\n        &#39;order_date&#39;,\n        &#39;total_price&#39;\n    ];\n}\n</pre><h3><strong>4.&nbsp;Controller</strong></h3><pre data-language=\"plain\">\nclass OrderController extends Controller\n{\n    public function index()\n    {\n        return Order::all();\n    }\n\n    public function store(Request $request)\n    {\n        $request-&gt;validate([\n            &#39;customer_name&#39; =&gt; &#39;required&#39;,\n            &#39;order_date&#39; =&gt; &#39;required|date&#39;,\n            &#39;total_price&#39; =&gt; &#39;required|numeric&#39;\n        ]);\n\n        return Order::create($request-&gt;all());\n    }\n\n    public function update(Request $request, Order $order)\n    {\n        $order-&gt;update($request-&gt;all());\n        return $order;\n    }\n\n    public function destroy(Order $order)\n    {\n        $order-&gt;delete();\n        return response()-&gt;json([&#39;message&#39; =&gt; &#39;Deleted&#39;]);\n    }\n}\n</pre><h2><strong>Routing&nbsp;(API&nbsp;/&nbsp;Web)</strong></h2><pre data-language=\"plain\">\nRoute::apiResource(&#39;categories&#39;, CategoryController::class);\nRoute::apiResource(&#39;products&#39;, ProductController::class);\nRoute::apiResource(&#39;orders&#39;, OrderController::class);\n</pre>', '2026-01-07 08:02:54', '2026-01-07 08:09:05'),
(22, 10, 'Laravel CRUD – Bagian 2: Validasi, Relasi Data, dan Tampilan (Blade)', 'Pada bagian ini, peserta akan mempelajari pengembangan CRUD yang lebih lengkap dengan menambahkan validasi lanjutan, relasi antar model, serta tampilan menggunakan Blade. Fokus utama adalah praktik terbaik (best practice) Laravel agar aplikasi mudah dikembangkan dan terjaga kualitas kodenya.', '<h2><strong>1.&nbsp;Validasi&nbsp;Data&nbsp;yang&nbsp;Lebih&nbsp;Terstruktur</strong></h2><h3><strong>Masalah</strong></h3><p>Jika&nbsp;validasi&nbsp;ditulis&nbsp;langsung&nbsp;di&nbsp;controller,&nbsp;kode&nbsp;akan&nbsp;cepat&nbsp;membesar&nbsp;dan&nbsp;sulit&nbsp;dirawat.</p><h3><strong>Solusi</strong></h3><p>Gunakan&nbsp;<strong>Form&nbsp;Request&nbsp;Validation</strong>.</p><h3><strong>Membuat&nbsp;Request</strong></h3><pre data-language=\"plain\">\nphp artisan make:request StoreProductRequest\n</pre><h3><strong>Isi&nbsp;File&nbsp;Request</strong></h3><pre data-language=\"plain\">\nclass StoreProductRequest extends FormRequest\n{\n    public function authorize()\n    {\n        return true;\n    }\n\n    public function rules()\n    {\n        return [\n            &#39;category_id&#39; =&gt; &#39;required|exists:categories,id&#39;,\n            &#39;name&#39; =&gt; &#39;required|min:3&#39;,\n            &#39;price&#39; =&gt; &#39;required|numeric|min:0&#39;,\n            &#39;stock&#39; =&gt; &#39;required|integer|min:0&#39;,\n        ];\n    }\n}\n</pre><h3><strong>Controller&nbsp;Setelah&nbsp;Refactor</strong></h3><pre data-language=\"plain\">\npublic function store(StoreProductRequest $request)\n{\n    return Product::create($request-&gt;validated());\n}\n</pre><p><strong>Manfaat:</strong></p><ul><li>Controller&nbsp;lebih&nbsp;bersih</li><li>Validasi&nbsp;reusable</li><li>Mudah&nbsp;diuji</li></ul><h2><strong>2.&nbsp;Relasi&nbsp;Data&nbsp;dan&nbsp;Eager&nbsp;Loading</strong></h2><h3><strong>Relasi&nbsp;yang&nbsp;Digunakan</strong></h3><ul><li>Category&nbsp;→&nbsp;hasMany&nbsp;Product</li><li>Product&nbsp;→&nbsp;belongsTo&nbsp;Category</li></ul><h3><strong>Update&nbsp;Model&nbsp;Category</strong></h3><pre data-language=\"plain\">\nclass Category extends Model\n{\n    protected $fillable = [&#39;name&#39;, &#39;description&#39;];\n\n    public function products()\n    {\n        return $this-&gt;hasMany(Product::class);\n    }\n}\n</pre><h3><strong>Mengambil&nbsp;Data&nbsp;dengan&nbsp;Relasi</strong></h3><pre data-language=\"plain\">\n$categories = Category::with(&#39;products&#39;)-&gt;get();\n</pre><h3><strong>Contoh&nbsp;Response</strong></h3><pre data-language=\"plain\">\n{\n  &quot;id&quot;: 1,\n  &quot;name&quot;: &quot;Elektronik&quot;,\n  &quot;products&quot;: [\n    {\n      &quot;name&quot;: &quot;Laptop&quot;,\n      &quot;price&quot;: 15000000\n    }\n  ]\n}\n</pre><h2><strong>3.&nbsp;Menampilkan&nbsp;Data&nbsp;Menggunakan&nbsp;Blade</strong></h2><h3><strong>Struktur&nbsp;Folder</strong></h3><pre data-language=\"plain\">\nresources/views/products/\n├── index.blade.php\n├── create.blade.php\n├── edit.blade.php\n</pre><h3><strong>Halaman&nbsp;Index&nbsp;Produk</strong></h3><pre data-language=\"plain\">\n@extends(&#39;layouts.app&#39;)\n\n@section(&#39;content&#39;)\n&lt;h1&gt;Data Produk&lt;/h1&gt;\n\n&lt;a href=&quot;{{ route(&#39;products.create&#39;) }}&quot;&gt;Tambah Produk&lt;/a&gt;\n\n&lt;table border=&quot;1&quot;&gt;\n    &lt;tr&gt;\n        &lt;th&gt;Nama&lt;/th&gt;\n        &lt;th&gt;Kategori&lt;/th&gt;\n        &lt;th&gt;Harga&lt;/th&gt;\n        &lt;th&gt;Stok&lt;/th&gt;\n        &lt;th&gt;Aksi&lt;/th&gt;\n    &lt;/tr&gt;\n    @foreach ($products as $product)\n    &lt;tr&gt;\n        &lt;td&gt;{{ $product-&gt;name }}&lt;/td&gt;\n        &lt;td&gt;{{ $product-&gt;category-&gt;name }}&lt;/td&gt;\n        &lt;td&gt;{{ number_format($product-&gt;price) }}&lt;/td&gt;\n        &lt;td&gt;{{ $product-&gt;stock }}&lt;/td&gt;\n        &lt;td&gt;\n            &lt;a href=&quot;{{ route(&#39;products.edit&#39;, $product) }}&quot;&gt;Edit&lt;/a&gt;\n            &lt;form method=&quot;POST&quot; action=&quot;{{ route(&#39;products.destroy&#39;, $product) }}&quot;&gt;\n                @csrf\n                @method(&#39;DELETE&#39;)\n                &lt;button type=&quot;submit&quot;&gt;Hapus&lt;/button&gt;\n            &lt;/form&gt;\n        &lt;/td&gt;\n    &lt;/tr&gt;\n    @endforeach\n&lt;/table&gt;\n@endsection\n</pre><h2><strong>4.&nbsp;Form&nbsp;Create&nbsp;&amp;&nbsp;Edit</strong></h2><h3><strong>Create&nbsp;Product</strong></h3><pre data-language=\"plain\">\n&lt;form method=&quot;POST&quot; action=&quot;{{ route(&#39;products.store&#39;) }}&quot;&gt;\n    @csrf\n\n    &lt;input type=&quot;text&quot; name=&quot;name&quot; placeholder=&quot;Nama Produk&quot;&gt;\n\n    &lt;select name=&quot;category_id&quot;&gt;\n        @foreach($categories as $category)\n            &lt;option value=&quot;{{ $category-&gt;id }}&quot;&gt;{{ $category-&gt;name }}&lt;/option&gt;\n        @endforeach\n    &lt;/select&gt;\n\n    &lt;input type=&quot;number&quot; name=&quot;price&quot; placeholder=&quot;Harga&quot;&gt;\n    &lt;input type=&quot;number&quot; name=&quot;stock&quot; placeholder=&quot;Stok&quot;&gt;\n\n    &lt;button type=&quot;submit&quot;&gt;Simpan&lt;/button&gt;\n&lt;/form&gt;\n</pre><h2><strong>5.&nbsp;Pagination&nbsp;dan&nbsp;Search</strong></h2><h3><strong>Pagination</strong></h3><pre data-language=\"plain\">\n$products = Product::with(&#39;category&#39;)-&gt;paginate(10);\n\n{{ $products-&gt;links() }}\n</pre><h3><strong>Search&nbsp;Sederhana</strong></h3><pre data-language=\"plain\">\npublic function index(Request $request)\n{\n    $query = Product::query();\n\n    if ($request-&gt;search) {\n        $query-&gt;where(&#39;name&#39;, &#39;like&#39;, &quot;%{$request-&gt;search}%&quot;);\n    }\n\n    $products = $query-&gt;with(&#39;category&#39;)-&gt;paginate(10);\n\n    return view(&#39;products.index&#39;, compact(&#39;products&#39;));\n}\n</pre><p></p>', '2026-01-07 08:05:47', '2026-01-07 08:05:47'),
(23, 10, 'Laravel CRUD – Bagian 3: Authentication, Authorization, Upload File, dan Soft Delete', 'Pada bagian ini, peserta akan membangun fitur lanjutan yang umum digunakan pada aplikasi nyata, meliputi login & register, pembatasan hak akses (authorization), upload file (gambar produk), serta soft delete. Materi ini memperkenalkan praktik keamanan dan pengelolaan data yang baik di Laravel.', '<h2><strong>1.&nbsp;Authentication&nbsp;(Login&nbsp;&amp;&nbsp;Register)</strong></h2><h3><strong>Menggunakan&nbsp;Laravel&nbsp;Breeze</strong></h3><pre data-language=\"plain\">\ncomposer require laravel/breeze --dev\nphp artisan breeze:install\nnpm install &amp;&amp; npm run build\nphp artisan migrate\n</pre><h3><strong>Hasil</strong></h3><ul><li>Login</li><li>Register</li><li>Logout</li><li>Proteksi&nbsp;session</li></ul><h3><strong>Proteksi&nbsp;Route</strong></h3><pre data-language=\"plain\">\nRoute::middleware([&#39;auth&#39;])-&gt;group(function () {\n    Route::resource(&#39;products&#39;, ProductController::class);\n    Route::resource(&#39;categories&#39;, CategoryController::class);\n    Route::resource(&#39;orders&#39;, OrderController::class);\n});\n</pre><h2><strong>2.&nbsp;Authorization&nbsp;(Policy)</strong></h2><h3><strong>Masalah</strong></h3><p>Tidak&nbsp;semua&nbsp;user&nbsp;boleh&nbsp;menghapus&nbsp;atau&nbsp;mengedit&nbsp;data.</p><h3><strong>Membuat&nbsp;Policy</strong></h3><pre data-language=\"plain\">\nphp artisan make:policy ProductPolicy --model=Product\n</pre><h3><strong>Isi&nbsp;Policy</strong></h3><pre data-language=\"plain\">\nclass ProductPolicy\n{\n    public function update(User $user, Product $product)\n    {\n        return $user-&gt;role === &#39;admin&#39;;\n    }\n\n    public function delete(User $user, Product $product)\n    {\n        return $user-&gt;role === &#39;admin&#39;;\n    }\n}\n</pre><h3><strong>Panggil&nbsp;di&nbsp;Controller</strong></h3><pre data-language=\"plain\">\npublic function update(Request $request, Product $product)\n{\n    $this-&gt;authorize(&#39;update&#39;, $product);\n    $product-&gt;update($request-&gt;all());\n}\n</pre><h3><strong>Blade&nbsp;Authorization</strong></h3><pre data-language=\"plain\">\n@can(&#39;delete&#39;, $product)\n&lt;button&gt;Hapus&lt;/button&gt;\n@endcan\n</pre><h2><strong>3.&nbsp;Upload&nbsp;File&nbsp;(Gambar&nbsp;Produk)</strong></h2><h3><strong>Update&nbsp;Migration</strong></h3><pre data-language=\"plain\">\n$table-&gt;string(&#39;image&#39;)-&gt;nullable();\n\nphp artisan migrate\n</pre><h3><strong>Form&nbsp;Upload</strong></h3><pre data-language=\"plain\">\n&lt;input type=&quot;file&quot; name=&quot;image&quot;&gt;\n\n&lt;form method=&quot;POST&quot; enctype=&quot;multipart/form-data&quot;&gt;\n</pre><h3><strong>Controller</strong></h3><pre data-language=\"plain\">\nif ($request-&gt;hasFile(&#39;image&#39;)) {\n    $path = $request-&gt;file(&#39;image&#39;)-&gt;store(&#39;products&#39;, &#39;public&#39;);\n    $data[&#39;image&#39;] = $path;\n}\n</pre><h3><strong>Tampilkan&nbsp;Gambar</strong></h3><pre data-language=\"plain\">\n&lt;img src=&quot;{{ asset(&#39;storage/&#39; . $product-&gt;image) }}&quot; width=&quot;100&quot;&gt;\n</pre><h2><strong>4.&nbsp;Soft&nbsp;Delete</strong></h2><h3><strong>Aktifkan&nbsp;Soft&nbsp;Delete</strong></h3><pre data-language=\"plain\">\nuse Illuminate\\Database\\Eloquent\\SoftDeletes;\n\nclass Product extends Model\n{\n    use SoftDeletes;\n}\n</pre><h3><strong>Migration</strong></h3><pre data-language=\"plain\">\n$table-&gt;softDeletes();\n\nphp artisan migrate\n</pre><h3><strong>Hapus&nbsp;Sementara</strong></h3><pre data-language=\"plain\">\n$product-&gt;delete();\n</pre><h3><strong>Restore&nbsp;Data</strong></h3><pre data-language=\"plain\">\nProduct::withTrashed()-&gt;find($id)-&gt;restore();\n</pre><h2><strong>5.&nbsp;Menampilkan&nbsp;Data&nbsp;Terhapus</strong></h2><pre data-language=\"plain\">\n$products = Product::withTrashed()-&gt;get();\n\n@if($product-&gt;trashed())\n    &lt;span&gt;Terhapus&lt;/span&gt;\n@endif\n</pre><h2><strong>6.&nbsp;Optimasi&nbsp;dan&nbsp;Best&nbsp;Practice</strong></h2><h3><strong>Mass&nbsp;Assignment</strong></h3><pre data-language=\"plain\">\nprotected $fillable = [...];\n</pre><h3><strong>Gunakan&nbsp;Eager&nbsp;Loading</strong></h3><pre data-language=\"plain\">\nProduct::with(&#39;category&#39;)-&gt;get();\n</pre><h3><strong>Gunakan&nbsp;Service&nbsp;Layer&nbsp;(Opsional)</strong></h3><ul><li>Controller&nbsp;tipis</li><li>Logic&nbsp;bisnis&nbsp;terpisah</li></ul><p></p>', '2026-01-07 08:07:29', '2026-01-07 08:07:29'),
(24, 10, 'Laravel CRUD – Bagian 4: Mini Project Product & Order Management System', 'Pada bagian ini, peserta akan membangun sebuah aplikasi Laravel utuh berupa Sistem Manajemen Produk dan Pesanan. Mini project ini menggabungkan CRUD, relasi data, authentication, authorization, upload file, dan soft delete menjadi satu alur aplikasi nyata yang siap dipresentasikan dan dijadikan portofolio.', '<h2><strong>Tujuan&nbsp;Mini&nbsp;Project</strong></h2><p>Setelah&nbsp;menyelesaikan&nbsp;bagian&nbsp;ini,&nbsp;peserta&nbsp;mampu:</p><ul><li>Membangun&nbsp;aplikasi&nbsp;Laravel&nbsp;end-to-end</li><li>Mengatur&nbsp;role&nbsp;&amp;&nbsp;hak&nbsp;akses&nbsp;pengguna</li><li>Mengelola&nbsp;produk,&nbsp;kategori,&nbsp;dan&nbsp;pesanan</li><li>Menyusun&nbsp;alur&nbsp;aplikasi&nbsp;yang&nbsp;jelas</li><li>Melakukan&nbsp;deployment&nbsp;dasar</li></ul><h2><strong>1.&nbsp;Studi&nbsp;Kasus&nbsp;Aplikasi</strong></h2><h3><strong>Nama&nbsp;Aplikasi</strong></h3><p>Product&nbsp;&amp;&nbsp;Order&nbsp;Management&nbsp;System</p><h3><strong>Role&nbsp;Pengguna</strong></h3><p>RoleHak&nbsp;Akses</p><p>Admin</p><p>Kelola&nbsp;kategori,&nbsp;produk,&nbsp;user,&nbsp;laporan</p><p>Staff</p><p>Kelola&nbsp;pesanan</p><h2><strong>2.&nbsp;Struktur&nbsp;Fitur&nbsp;Aplikasi</strong></h2><h3><strong>Admin</strong></h3><ul><li>Login</li><li>Dashboard</li><li>CRUD&nbsp;Kategori</li><li>CRUD&nbsp;Produk&nbsp;(dengan&nbsp;upload&nbsp;gambar)</li><li>Lihat&nbsp;semua&nbsp;pesanan</li><li>Soft&nbsp;delete&nbsp;&amp;&nbsp;restore&nbsp;produk</li></ul><h3><strong>Staff</strong></h3><ul><li>Login</li><li>Buat&nbsp;pesanan</li><li>Lihat&nbsp;daftar&nbsp;pesanan</li></ul><h2><strong>3.&nbsp;Dashboard&nbsp;Admin</strong></h2><h3><strong>Controller</strong></h3><pre data-language=\"plain\">\nclass DashboardController extends Controller\n{\n    public function index()\n    {\n        return view(&#39;dashboard.index&#39;, [\n            &#39;totalProducts&#39; =&gt; Product::count(),\n            &#39;totalCategories&#39; =&gt; Category::count(),\n            &#39;totalOrders&#39; =&gt; Order::count(),\n        ]);\n    }\n}\n</pre><h3><strong>View</strong></h3><pre data-language=\"plain\">\n&lt;h2&gt;Dashboard&lt;/h2&gt;\n\n&lt;p&gt;Total Produk: {{ $totalProducts }}&lt;/p&gt;\n&lt;p&gt;Total Kategori: {{ $totalCategories }}&lt;/p&gt;\n&lt;p&gt;Total Pesanan: {{ $totalOrders }}&lt;/p&gt;\n</pre><h2><strong>4.&nbsp;Role&nbsp;Management&nbsp;Sederhana</strong></h2><h3><strong>Tambah&nbsp;Kolom&nbsp;Role</strong></h3><pre data-language=\"plain\">\n$table-&gt;string(&#39;role&#39;)-&gt;default(&#39;staff&#39;);\n</pre><h3><strong>Seeder&nbsp;User</strong></h3><pre data-language=\"plain\">\nUser::create([\n    &#39;name&#39; =&gt; &#39;Admin&#39;,\n    &#39;email&#39; =&gt; &#39;admin@mail.com&#39;,\n    &#39;password&#39; =&gt; bcrypt(&#39;password&#39;),\n    &#39;role&#39; =&gt; &#39;admin&#39;\n]);\n</pre><h2><strong>5.&nbsp;Middleware&nbsp;Role</strong></h2><h3><strong>Buat&nbsp;Middleware</strong></h3><pre data-language=\"plain\">\nphp artisan make:middleware RoleMiddleware\n\npublic function handle($request, Closure $next, $role)\n{\n    if (auth()-&gt;user()-&gt;role !== $role) {\n        abort(403);\n    }\n\n    return $next($request);\n}\n</pre><h3><strong>Register&nbsp;Middleware</strong></h3><pre data-language=\"plain\">\n&#39;role&#39; =&gt; \\App\\Http\\Middleware\\RoleMiddleware::class,\n</pre><h3><strong>Route&nbsp;Berdasarkan&nbsp;Role</strong></h3><pre data-language=\"plain\">\nRoute::middleware([&#39;auth&#39;, &#39;role:admin&#39;])-&gt;group(function () {\n    Route::resource(&#39;categories&#39;, CategoryController::class);\n    Route::resource(&#39;products&#39;, ProductController::class);\n});\n\nRoute::middleware([&#39;auth&#39;, &#39;role:staff&#39;])-&gt;group(function () {\n    Route::resource(&#39;orders&#39;, OrderController::class)-&gt;only([&#39;index&#39;,&#39;create&#39;,&#39;store&#39;]);\n});\n</pre><h2><strong>6.&nbsp;Alur&nbsp;Pembuatan&nbsp;Pesanan</strong></h2><h3><strong>Order&nbsp;Controller</strong></h3><pre data-language=\"plain\">\npublic function store(Request $request)\n{\n    $request-&gt;validate([\n        &#39;customer_name&#39; =&gt; &#39;required&#39;,\n        &#39;total_price&#39; =&gt; &#39;required|numeric&#39;\n    ]);\n\n    Order::create([\n        &#39;customer_name&#39; =&gt; $request-&gt;customer_name,\n        &#39;order_date&#39; =&gt; now(),\n        &#39;total_price&#39; =&gt; $request-&gt;total_price\n    ]);\n\n    return redirect()-&gt;route(&#39;orders.index&#39;);\n}\n</pre><h2><strong>7.&nbsp;Seed&nbsp;Data&nbsp;untuk&nbsp;Demo</strong></h2><pre data-language=\"plain\">\nphp artisan make:seeder ProductSeeder\n\nProduct::factory()-&gt;count(10)-&gt;create();\n\nphp artisan db:seed\n</pre><h2><strong>8.&nbsp;Deployment&nbsp;Dasar</strong></h2><h3><strong>Checklist&nbsp;Deployment</strong></h3><ul><li>.env&nbsp;production</li><li>APP_KEY</li><li>php&nbsp;artisan&nbsp;migrate&nbsp;--force</li><li>php&nbsp;artisan&nbsp;storage:link</li><li>Permission&nbsp;folder&nbsp;storage&nbsp;&amp;&nbsp;bootstrap/cache</li></ul>', '2026-01-07 08:18:24', '2026-01-07 08:19:11'),
(26, 11, 'Pengenalan React dan Konsep Dasar Frontend Modern', 'Modul ini membahas latar belakang React, alasan penggunaannya, serta konsep dasar frontend modern berbasis komponen. Peserta akan memahami posisi React dalam ekosistem web development dan perbedaannya dengan pendekatan konvensional.', '<p class=\"ql-indent-1\">React&nbsp;adalah&nbsp;library&nbsp;JavaScript&nbsp;yang&nbsp;dikembangkan&nbsp;oleh&nbsp;Facebook&nbsp;untuk&nbsp;membangun&nbsp;antarmuka&nbsp;pengguna&nbsp;(User&nbsp;Interface)&nbsp;yang&nbsp;bersifat&nbsp;interaktif&nbsp;dan&nbsp;efisien.&nbsp;Berbeda&nbsp;dengan&nbsp;pendekatan&nbsp;tradisional&nbsp;yang&nbsp;memanipulasi&nbsp;DOM&nbsp;secara&nbsp;langsung,&nbsp;React&nbsp;memperkenalkan&nbsp;konsep&nbsp;<strong>Virtual&nbsp;DOM</strong>&nbsp;yang&nbsp;membuat&nbsp;proses&nbsp;rendering&nbsp;menjadi&nbsp;lebih&nbsp;cepat&nbsp;dan&nbsp;terkontrol.</p><p class=\"ql-indent-1\">Pada&nbsp;pengembangan&nbsp;web&nbsp;modern,&nbsp;aplikasi&nbsp;tidak&nbsp;lagi&nbsp;bersifat&nbsp;statis.&nbsp;Pengguna&nbsp;mengharapkan&nbsp;interaksi&nbsp;real-time,&nbsp;perubahan&nbsp;data&nbsp;tanpa&nbsp;reload&nbsp;halaman,&nbsp;serta&nbsp;pengalaman&nbsp;pengguna&nbsp;yang&nbsp;konsisten.&nbsp;React&nbsp;menjawab&nbsp;kebutuhan&nbsp;tersebut&nbsp;dengan&nbsp;pendekatan&nbsp;<strong>Single&nbsp;Page&nbsp;Application&nbsp;(SPA)</strong>,&nbsp;di&nbsp;mana&nbsp;halaman&nbsp;tidak&nbsp;benar-benar&nbsp;berpindah,&nbsp;melainkan&nbsp;hanya&nbsp;memperbarui&nbsp;bagian&nbsp;tertentu.</p><p class=\"ql-indent-1\">Konsep&nbsp;utama&nbsp;React&nbsp;adalah&nbsp;<strong>component-based&nbsp;architecture</strong>.&nbsp;Setiap&nbsp;bagian&nbsp;UI&nbsp;dipecah&nbsp;menjadi&nbsp;komponen&nbsp;kecil&nbsp;yang&nbsp;berdiri&nbsp;sendiri&nbsp;dan&nbsp;dapat&nbsp;digunakan&nbsp;kembali.&nbsp;Pendekatan&nbsp;ini&nbsp;membuat&nbsp;kode&nbsp;lebih&nbsp;terstruktur,&nbsp;mudah&nbsp;dirawat,&nbsp;dan&nbsp;scalable&nbsp;untuk&nbsp;proyek&nbsp;besar.</p><p class=\"ql-indent-1\">React&nbsp;juga&nbsp;mendorong&nbsp;penggunaan&nbsp;JavaScript&nbsp;modern&nbsp;(ES6+),&nbsp;seperti&nbsp;arrow&nbsp;function,&nbsp;destructuring,&nbsp;dan&nbsp;module&nbsp;system.&nbsp;Hal&nbsp;ini&nbsp;menjadikan&nbsp;React&nbsp;bukan&nbsp;hanya&nbsp;library&nbsp;UI,&nbsp;tetapi&nbsp;juga&nbsp;pintu&nbsp;masuk&nbsp;untuk&nbsp;memahami&nbsp;ekosistem&nbsp;JavaScript&nbsp;modern&nbsp;secara&nbsp;menyeluruh.</p><p class=\"ql-indent-1\">Pada&nbsp;akhir&nbsp;modul&nbsp;ini,&nbsp;peserta&nbsp;diharapkan&nbsp;memahami&nbsp;apa&nbsp;itu&nbsp;React,&nbsp;mengapa&nbsp;React&nbsp;digunakan&nbsp;secara&nbsp;luas,&nbsp;serta&nbsp;bagaimana&nbsp;React&nbsp;mengubah&nbsp;cara&nbsp;berpikir&nbsp;dalam&nbsp;membangun&nbsp;antarmuka&nbsp;web.</p>', '2026-01-19 18:27:00', '2026-01-19 18:28:04'),
(27, 11, 'Setup Lingkungan React dan Struktur Proyek', 'Modul ini membahas cara menyiapkan lingkungan pengembangan React menggunakan Node.js serta memahami struktur dasar proyek React.', '<p class=\"ql-indent-1\">Sebelum&nbsp;mulai&nbsp;menulis&nbsp;kode&nbsp;React,&nbsp;diperlukan&nbsp;lingkungan&nbsp;pengembangan&nbsp;yang&nbsp;sesuai.&nbsp;React&nbsp;membutuhkan&nbsp;<strong>Node.js</strong>&nbsp;karena&nbsp;proses&nbsp;build&nbsp;dan&nbsp;dependency&nbsp;management&nbsp;dijalankan&nbsp;melalui&nbsp;npm&nbsp;atau&nbsp;yarn.&nbsp;Tanpa&nbsp;Node.js,&nbsp;React&nbsp;tidak&nbsp;dapat&nbsp;dijalankan&nbsp;secara&nbsp;optimal.</p><p class=\"ql-indent-1\">Pembuatan&nbsp;proyek&nbsp;React&nbsp;modern&nbsp;umumnya&nbsp;menggunakan&nbsp;tools&nbsp;seperti&nbsp;create-react-app&nbsp;atau&nbsp;Vite.&nbsp;Tools&nbsp;ini&nbsp;menyediakan&nbsp;konfigurasi&nbsp;awal&nbsp;seperti&nbsp;bundler,&nbsp;development&nbsp;server,&nbsp;dan&nbsp;struktur&nbsp;folder&nbsp;sehingga&nbsp;developer&nbsp;dapat&nbsp;langsung&nbsp;fokus&nbsp;pada&nbsp;pengembangan&nbsp;aplikasi.</p><p class=\"ql-indent-1\">Struktur&nbsp;dasar&nbsp;proyek&nbsp;React&nbsp;terdiri&nbsp;dari&nbsp;folder&nbsp;src,&nbsp;yang&nbsp;berisi&nbsp;seluruh&nbsp;kode&nbsp;aplikasi,&nbsp;dan&nbsp;folder&nbsp;public,&nbsp;yang&nbsp;berisi&nbsp;file&nbsp;statis.&nbsp;File&nbsp;index.js&nbsp;berperan&nbsp;sebagai&nbsp;entry&nbsp;point&nbsp;yang&nbsp;merender&nbsp;komponen&nbsp;utama&nbsp;ke&nbsp;dalam&nbsp;DOM.</p><p class=\"ql-indent-1\">Komponen&nbsp;utama&nbsp;biasanya&nbsp;bernama&nbsp;App.js.&nbsp;Komponen&nbsp;ini&nbsp;berfungsi&nbsp;sebagai&nbsp;root&nbsp;component&nbsp;yang&nbsp;menampung&nbsp;komponen&nbsp;lain.&nbsp;Pemahaman&nbsp;struktur&nbsp;ini&nbsp;penting&nbsp;agar&nbsp;developer&nbsp;tidak&nbsp;salah&nbsp;menempatkan&nbsp;logic&nbsp;dan&nbsp;tampilan.</p><p class=\"ql-indent-1\">Dengan&nbsp;memahami&nbsp;setup&nbsp;dan&nbsp;struktur&nbsp;proyek,&nbsp;peserta&nbsp;akan&nbsp;lebih&nbsp;percaya&nbsp;diri&nbsp;dalam&nbsp;mengelola&nbsp;file,&nbsp;menambah&nbsp;fitur&nbsp;baru,&nbsp;serta&nbsp;membaca&nbsp;proyek&nbsp;React&nbsp;orang&nbsp;lain.</p>', '2026-01-19 18:27:34', '2026-01-19 18:28:20'),
(28, 11, 'JSX dan Cara Kerja Rendering React', 'Modul ini menjelaskan JSX sebagai sintaks utama React dan bagaimana proses rendering bekerja di balik layar.', '<p class=\"ql-indent-1\">JSX&nbsp;adalah&nbsp;ekstensi&nbsp;sintaks&nbsp;JavaScript&nbsp;yang&nbsp;memungkinkan&nbsp;penulisan&nbsp;struktur&nbsp;UI&nbsp;menyerupai&nbsp;HTML&nbsp;di&nbsp;dalam&nbsp;JavaScript.&nbsp;Meskipun&nbsp;terlihat&nbsp;seperti&nbsp;HTML,&nbsp;JSX&nbsp;sebenarnya&nbsp;akan&nbsp;di-compile&nbsp;menjadi&nbsp;fungsi&nbsp;JavaScript.</p><p class=\"ql-indent-1\">Penggunaan&nbsp;JSX&nbsp;membuat&nbsp;kode&nbsp;React&nbsp;lebih&nbsp;deklaratif&nbsp;dan&nbsp;mudah&nbsp;dibaca.&nbsp;Developer&nbsp;dapat&nbsp;langsung&nbsp;melihat&nbsp;struktur&nbsp;UI&nbsp;tanpa&nbsp;harus&nbsp;menulis&nbsp;banyak&nbsp;pemanggilan&nbsp;fungsi&nbsp;DOM&nbsp;secara&nbsp;manual.</p><p class=\"ql-indent-1\">Dalam&nbsp;JSX,&nbsp;terdapat&nbsp;beberapa&nbsp;aturan&nbsp;penting,&nbsp;seperti&nbsp;penggunaan&nbsp;className&nbsp;вместо&nbsp;class,&nbsp;penggunaan&nbsp;{}&nbsp;untuk&nbsp;menyisipkan&nbsp;ekspresi&nbsp;JavaScript,&nbsp;dan&nbsp;keharusan&nbsp;memiliki&nbsp;satu&nbsp;parent&nbsp;element.</p><p class=\"ql-indent-1\">Proses&nbsp;rendering&nbsp;React&nbsp;tidak&nbsp;langsung&nbsp;memanipulasi&nbsp;DOM&nbsp;asli.&nbsp;React&nbsp;terlebih&nbsp;dahulu&nbsp;membangun&nbsp;<strong>Virtual&nbsp;DOM</strong>,&nbsp;lalu&nbsp;membandingkannya&nbsp;dengan&nbsp;kondisi&nbsp;sebelumnya&nbsp;menggunakan&nbsp;algoritma&nbsp;diffing&nbsp;untuk&nbsp;menentukan&nbsp;perubahan&nbsp;minimal.</p><p class=\"ql-indent-1\">Pemahaman&nbsp;JSX&nbsp;dan&nbsp;rendering&nbsp;sangat&nbsp;penting&nbsp;karena&nbsp;kesalahan&nbsp;kecil&nbsp;pada&nbsp;JSX&nbsp;dapat&nbsp;menyebabkan&nbsp;error&nbsp;runtime&nbsp;yang&nbsp;membingungkan&nbsp;bagi&nbsp;pemula.</p>', '2026-01-19 18:29:45', '2026-01-19 18:29:45'),
(29, 11, 'Komponen dan Reusability', 'Modul ini membahas konsep komponen, pemecahan UI, dan prinsip reusable code dalam React.', '<p class=\"ql-indent-1\">Komponen&nbsp;adalah&nbsp;blok&nbsp;bangunan&nbsp;utama&nbsp;dalam&nbsp;React.&nbsp;Setiap&nbsp;komponen&nbsp;bertanggung&nbsp;jawab&nbsp;atas&nbsp;satu&nbsp;bagian&nbsp;UI&nbsp;tertentu,&nbsp;seperti&nbsp;header,&nbsp;footer,&nbsp;atau&nbsp;form&nbsp;input.</p><p class=\"ql-indent-1\">React&nbsp;mengenal&nbsp;dua&nbsp;jenis&nbsp;komponen&nbsp;utama,&nbsp;yaitu&nbsp;<strong>function&nbsp;component</strong>&nbsp;dan&nbsp;<strong>class&nbsp;component</strong>.&nbsp;Pada&nbsp;React&nbsp;modern,&nbsp;function&nbsp;component&nbsp;lebih&nbsp;direkomendasikan&nbsp;karena&nbsp;lebih&nbsp;sederhana&nbsp;dan&nbsp;mendukung&nbsp;Hooks.</p><p class=\"ql-indent-1\">Dengan&nbsp;memecah&nbsp;UI&nbsp;menjadi&nbsp;komponen&nbsp;kecil,&nbsp;developer&nbsp;dapat&nbsp;menggunakan&nbsp;kembali&nbsp;komponen&nbsp;tersebut&nbsp;di&nbsp;banyak&nbsp;tempat&nbsp;tanpa&nbsp;menulis&nbsp;ulang&nbsp;kode&nbsp;yang&nbsp;sama.</p><p class=\"ql-indent-1\">Reusability&nbsp;membantu&nbsp;mengurangi&nbsp;duplikasi&nbsp;kode&nbsp;dan&nbsp;meningkatkan&nbsp;konsistensi&nbsp;tampilan&nbsp;aplikasi.&nbsp;Jika&nbsp;terjadi&nbsp;perubahan,&nbsp;developer&nbsp;cukup&nbsp;memperbarui&nbsp;satu&nbsp;komponen&nbsp;saja.</p><p class=\"ql-indent-1\">Konsep&nbsp;ini&nbsp;sangat&nbsp;penting&nbsp;ketika&nbsp;aplikasi&nbsp;mulai&nbsp;berkembang&nbsp;dan&nbsp;melibatkan&nbsp;banyak&nbsp;halaman&nbsp;serta&nbsp;fitur.</p>', '2026-01-19 18:30:22', '2026-01-19 18:30:22'),
(30, 11, 'Props: Mengirim Data Antar Komponen', 'Modul ini membahas props sebagai mekanisme utama komunikasi antar komponen.', '<p class=\"ql-indent-1\">Props&nbsp;(properties)&nbsp;adalah&nbsp;cara&nbsp;React&nbsp;mengirim&nbsp;data&nbsp;dari&nbsp;parent&nbsp;component&nbsp;ke&nbsp;child&nbsp;component.&nbsp;Props&nbsp;bersifat&nbsp;read-only&nbsp;dan&nbsp;tidak&nbsp;boleh&nbsp;diubah&nbsp;langsung&nbsp;oleh&nbsp;komponen&nbsp;penerima.</p><p class=\"ql-indent-1\">Dengan&nbsp;props,&nbsp;komponen&nbsp;menjadi&nbsp;lebih&nbsp;fleksibel&nbsp;dan&nbsp;dinamis.&nbsp;Satu&nbsp;komponen&nbsp;yang&nbsp;sama&nbsp;dapat&nbsp;menampilkan&nbsp;data&nbsp;berbeda&nbsp;tergantung&nbsp;props&nbsp;yang&nbsp;diterima.</p><p class=\"ql-indent-1\">Props&nbsp;ditulis&nbsp;seperti&nbsp;atribut&nbsp;HTML,&nbsp;namun&nbsp;nilainya&nbsp;dapat&nbsp;berupa&nbsp;string,&nbsp;number,&nbsp;object,&nbsp;array,&nbsp;bahkan&nbsp;function.</p><p class=\"ql-indent-1\">Pemahaman&nbsp;props&nbsp;membantu&nbsp;developer&nbsp;memisahkan&nbsp;logic&nbsp;dan&nbsp;tampilan&nbsp;dengan&nbsp;lebih&nbsp;rapi.&nbsp;Parent&nbsp;mengatur&nbsp;data,&nbsp;child&nbsp;fokus&nbsp;pada&nbsp;rendering.</p><p class=\"ql-indent-1\">Konsep&nbsp;props&nbsp;adalah&nbsp;fondasi&nbsp;untuk&nbsp;memahami&nbsp;state&nbsp;management&nbsp;di&nbsp;modul&nbsp;selanjutnya.</p>', '2026-01-19 18:31:47', '2026-01-19 18:31:47'),
(31, 11, 'State dan Pengelolaan Data Lokal', 'Modul ini menjelaskan state sebagai data dinamis dalam React dan cara mengelolanya menggunakan Hook useState.', '<p class=\"ql-indent-1\">State&nbsp;adalah&nbsp;data&nbsp;internal&nbsp;dalam&nbsp;komponen&nbsp;yang&nbsp;dapat&nbsp;berubah&nbsp;seiring&nbsp;interaksi&nbsp;pengguna.&nbsp;Berbeda&nbsp;dengan&nbsp;props,&nbsp;state&nbsp;dapat&nbsp;dimodifikasi&nbsp;oleh&nbsp;komponen&nbsp;itu&nbsp;sendiri.</p><p class=\"ql-indent-1\">React&nbsp;menyediakan&nbsp;Hook&nbsp;useState&nbsp;untuk&nbsp;mengelola&nbsp;state&nbsp;dalam&nbsp;function&nbsp;component.&nbsp;Hook&nbsp;ini&nbsp;memungkinkan&nbsp;React&nbsp;merender&nbsp;ulang&nbsp;UI&nbsp;ketika&nbsp;state&nbsp;berubah.</p><p class=\"ql-indent-1\">State&nbsp;sering&nbsp;digunakan&nbsp;untuk&nbsp;menangani&nbsp;input&nbsp;form,&nbsp;toggle,&nbsp;counter,&nbsp;dan&nbsp;data&nbsp;interaktif&nbsp;lainnya.</p><p class=\"ql-indent-1\">Pengelolaan&nbsp;state&nbsp;yang&nbsp;baik&nbsp;akan&nbsp;menghasilkan&nbsp;UI&nbsp;yang&nbsp;responsif&nbsp;dan&nbsp;konsisten&nbsp;dengan&nbsp;data&nbsp;yang&nbsp;ditampilkan.</p><p class=\"ql-indent-1\">Kesalahan&nbsp;umum&nbsp;pemula&nbsp;adalah&nbsp;mengubah&nbsp;state&nbsp;secara&nbsp;langsung,&nbsp;yang&nbsp;dapat&nbsp;menyebabkan&nbsp;bug&nbsp;dan&nbsp;UI&nbsp;tidak&nbsp;ter-update.</p>', '2026-01-19 18:32:39', '2026-01-19 18:32:39'),
(32, 11, 'Event Handling pada React', 'Modul ini membahas cara menangani event pengguna seperti klik, submit, dan input change.', '<p class=\"ql-indent-1\">React&nbsp;menggunakan&nbsp;event&nbsp;system&nbsp;yang&nbsp;mirip&nbsp;dengan&nbsp;JavaScript,&nbsp;namun&nbsp;dengan&nbsp;sintaks&nbsp;JSX.&nbsp;Event&nbsp;ditulis&nbsp;menggunakan&nbsp;camelCase,&nbsp;seperti&nbsp;onClick&nbsp;dan&nbsp;onChange.</p><p class=\"ql-indent-1\">Event&nbsp;handler&nbsp;biasanya&nbsp;berupa&nbsp;function&nbsp;yang&nbsp;dipanggil&nbsp;ketika&nbsp;event&nbsp;terjadi.&nbsp;Function&nbsp;ini&nbsp;sering&nbsp;digunakan&nbsp;untuk&nbsp;mengubah&nbsp;state.</p><p class=\"ql-indent-1\">React&nbsp;mengelola&nbsp;event&nbsp;secara&nbsp;efisien&nbsp;melalui&nbsp;Synthetic&nbsp;Event,&nbsp;sehingga&nbsp;kompatibel&nbsp;di&nbsp;berbagai&nbsp;browser.</p><p class=\"ql-indent-1\">Pemahaman&nbsp;event&nbsp;sangat&nbsp;penting&nbsp;untuk&nbsp;membuat&nbsp;aplikasi&nbsp;interaktif,&nbsp;seperti&nbsp;form&nbsp;dan&nbsp;tombol&nbsp;aksi.</p><p class=\"ql-indent-1\">Tanpa&nbsp;event&nbsp;handling,&nbsp;React&nbsp;hanya&nbsp;akan&nbsp;menjadi&nbsp;UI&nbsp;statis&nbsp;tanpa&nbsp;interaksi&nbsp;pengguna.</p>', '2026-01-19 18:33:10', '2026-01-19 18:33:10');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_18_035215_create_permission_tables', 1),
(5, '2025_11_18_073050_create_kelas_table', 1),
(6, '2025_11_18_073138_create_materis_table', 1),
(7, '2025_11_18_073154_create_soals_table', 1),
(8, '2025_11_18_073334_create_hasil_ujians_table', 1),
(9, '2025_11_18_085831_create_personal_access_tokens_table', 1),
(10, '2025_11_18_092512_kelas_user', 1),
(11, '2025_11_19_031525_jawaban_users', 1),
(12, '2025_01_12_000001_add_unique_constraint_hasil_ujians', 2),
(13, '2025_01_20_000001_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'auth_token', 'adb821ec902a0410b90a77909866a3590a6ab0f3c71459ccaaa899f56f0f9ef3', '[\"*\"]', '2026-01-06 02:05:12', NULL, '2026-01-05 06:15:52', '2026-01-06 02:05:12'),
(3, 'App\\Models\\User', 3, 'auth_token', '98df3edc9f4082d42c34a9b3b8c5297418e13071d71c1bc1df378fa6721a57de', '[\"*\"]', NULL, NULL, '2026-01-05 06:38:14', '2026-01-05 06:38:14'),
(5, 'App\\Models\\User', 2, 'auth_token', '179ba65b467114e3862eee50786766ad8c6f114e4e79594b88d07bc617c5c5db', '[\"*\"]', '2026-01-06 20:50:06', NULL, '2026-01-05 07:53:09', '2026-01-06 20:50:06'),
(6, 'App\\Models\\User', 1, 'auth_token', '45dcf819d48317b1bc7068ff4fdaa561348c276046ab948335c71940250df5bc', '[\"*\"]', '2026-01-07 08:19:14', NULL, '2026-01-06 18:15:03', '2026-01-07 08:19:14'),
(8, 'App\\Models\\User', 1, 'auth_token', '8d760695a0e71d450da7073b77691b297262c29e5db9784f3dc9312e70c38afd', '[\"*\"]', '2026-01-08 18:42:46', NULL, '2026-01-07 20:33:16', '2026-01-08 18:42:46'),
(9, 'App\\Models\\User', 2, 'auth_token', 'e0026a5433faa8239d550cea9cea0ee81eae550ddb4935e9b953c420931da899', '[\"*\"]', '2026-01-08 06:27:42', NULL, '2026-01-08 06:17:11', '2026-01-08 06:27:42'),
(12, 'App\\Models\\User', 2, 'auth_token', '11eecc21edfa4129c46a1c1ad6f488a4bb65af8f4db1de51702b780e4d70ca25', '[\"*\"]', '2026-01-12 07:36:37', NULL, '2026-01-11 04:42:33', '2026-01-12 07:36:37'),
(13, 'App\\Models\\User', 1, 'auth_token', '7087fcdc31a38109f59a0673bbed5db7b668e04e751e25a8cf3df57e81c7915a', '[\"*\"]', '2026-01-15 01:53:59', NULL, '2026-01-12 07:40:25', '2026-01-15 01:53:59'),
(14, 'App\\Models\\User', 2, 'auth_token', '9fd95f51b5c89b8da6a4bed206e1c75ee67c2f09ca003f32678addd52c143b48', '[\"*\"]', NULL, NULL, '2026-01-13 17:48:34', '2026-01-13 17:48:34'),
(16, 'App\\Models\\User', 3, 'auth_token', 'a534f0a1e6f9aa23d79cc41ad6e0d38527caa09cd291c37611be613702d236c8', '[\"*\"]', '2026-01-15 01:53:58', NULL, '2026-01-14 20:04:48', '2026-01-15 01:53:58'),
(17, 'App\\Models\\User', 2, 'auth_token', 'c66a15d449000e40b62dbf0ec9e106c7e8e48f85318f42a4e13c6ceebdf42e4f', '[\"*\"]', NULL, NULL, '2026-01-19 17:48:58', '2026-01-19 17:48:58'),
(18, 'App\\Models\\User', 2, 'auth_token', '43fd766e491b81ec2dedf8d5b283f01036a4de8f3c28aee11523ffa42f27e857', '[\"*\"]', '2026-01-19 18:32:08', NULL, '2026-01-19 17:51:04', '2026-01-19 18:32:08'),
(19, 'App\\Models\\User', 1, 'auth_token', 'e65166b35a23fb6b3cd41a4c566d260957ba8287898832ae18ac0baf85dab413', '[\"*\"]', '2026-01-19 18:33:13', NULL, '2026-01-19 17:52:17', '2026-01-19 18:33:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2026-01-05 06:15:27', '2026-01-05 06:15:27'),
(2, 'User', 'web', '2026-01-05 06:15:27', '2026-01-05 06:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5BC1wNakjtsrsZKRYFFHdYEz9Z3yv7GgT3AiWL8o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUmZ1RTNzSDlCbDRhWEcwamxOcjJOUmNBVkdlSFhET09lMDloQ201YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767759291),
('DINrmvSzKNdoFt9Ny9ZvISiUNs4jXjqxcs7wJei0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUVF1R1czSzJRQXBVdHNjd3VwN1g5dlZVSndscW1nU1NPNndMUm1RRyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767683731),
('Nq8orN0ubbKta4uL9SMJIPRqxPcKxcNhxrFVQhGM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiejdqUU9lSDBuaHBMaDFBd3Z3Z2pJUkxqVzZWaVJ3OERqVnpyYlRhNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1767755711);

-- --------------------------------------------------------

--
-- Table structure for table `soals`
--

CREATE TABLE `soals` (
  `id` bigint UNSIGNED NOT NULL,
  `materi_id` bigint UNSIGNED NOT NULL,
  `pertanyaan` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_a` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_b` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jawaban_c` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_d` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jawaban_benar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soals`
--

INSERT INTO `soals` (`id`, `materi_id`, `pertanyaan`, `jawaban_a`, `jawaban_b`, `jawaban_c`, `jawaban_d`, `jawaban_benar`, `created_at`, `updated_at`) VALUES
(28, 24, 'Apa fungsi utama dari Laravel sebagai framework PHP?', 'Mengelola database tanpa SQL', 'Membuat aplikasi web dengan struktur MVC', 'Menggantikan fungsi web server', 'Membuat aplikasi desktop', 'b', '2026-01-19 18:17:50', '2026-01-19 18:17:50'),
(29, 24, 'Perintah untuk membuat project Laravel baru menggunakan Composer adalah:', 'composer install laravel', 'php artisan make:project', 'composer create-project laravel/laravel nama_project', 'laravel new-project', 'c', '2026-01-19 18:17:51', '2026-01-19 18:17:51'),
(30, 24, 'Folder yang berisi file controller pada Laravel adalah:', 'routes', 'resources', 'app/Http/Controllers', 'config', 'c', '2026-01-19 18:17:52', '2026-01-19 18:17:52'),
(31, 24, 'File utama untuk mendefinisikan route web di Laravel adalah:', 'web.php', 'console.php', 'web.php', 'route.php', 'c', '2026-01-19 18:17:52', '2026-01-19 18:17:52'),
(32, 24, 'Perintah Artisan untuk menjalankan server development Laravel adalah:', 'php artisan run', 'php artisan serve', 'php artisan start', 'php artisan server', 'b', '2026-01-19 18:17:53', '2026-01-19 18:17:53'),
(33, 24, 'Apa fungsi dari file .env pada Laravel?', 'Menyimpan view', 'Menyimpan konfigurasi database dan environment', 'Menyimpan routing', 'Menyimpan controller', 'b', '2026-01-19 18:17:53', '2026-01-19 18:17:53'),
(34, 24, 'ORM bawaan Laravel yang digunakan untuk mengelola database adalah:', 'Doctrine', 'Hibernate', 'Eloquent', 'Sequelize', 'c', '2026-01-19 18:17:54', '2026-01-19 18:17:54'),
(35, 24, 'Perintah untuk membuat migration baru adalah:', 'php artisan migrate:new', 'php artisan make:migration', 'php artisan migration:create', 'php artisan create:migration', 'b', '2026-01-19 18:17:55', '2026-01-19 18:17:55'),
(36, 24, 'Perintah untuk menjalankan migration ke database adalah:', 'php artisan db:run', 'php artisan migrate', 'php artisan migration:run', 'php artisan schema:update', 'b', '2026-01-19 18:17:55', '2026-01-19 18:17:55'),
(37, 24, 'File Blade template Laravel memiliki ekstensi:', '.php', '.html', '.blade.php', '.tpl.php', 'c', '2026-01-19 18:17:56', '2026-01-19 18:17:56'),
(38, 24, 'Directive Blade untuk menampilkan data adalah:', '<?php echo ?>', '{{ }}', '{!! !!}', '@echo', 'b', '2026-01-19 18:17:56', '2026-01-19 18:17:56'),
(39, 24, 'Perintah untuk membuat controller baru adalah:', 'php artisan new:controller', 'php artisan create:controller', 'php artisan make:controller', 'php artisan controller:make', 'c', '2026-01-19 18:17:57', '2026-01-19 18:17:57'),
(40, 24, 'Apa fungsi utama dari Laravel sebagai framework PHP?', 'Mengelola database tanpa SQL', 'Membuat aplikasi web dengan struktur MVC', 'Menggantikan fungsi web server', 'Membuat aplikasi desktop', 'b', '2026-01-19 18:18:04', '2026-01-19 18:18:04'),
(41, 24, 'Perintah untuk membuat project Laravel baru menggunakan Composer adalah:', 'composer install laravel', 'php artisan make:project', 'composer create-project laravel/laravel nama_project', 'laravel new-project', 'c', '2026-01-19 18:18:04', '2026-01-19 18:18:04'),
(42, 24, 'Folder yang berisi file controller pada Laravel adalah:', 'routes', 'resources', 'app/Http/Controllers', 'config', 'c', '2026-01-19 18:18:05', '2026-01-19 18:18:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'User',
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `role`, `profile`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'AdminLearnify', 'admin', 'admin@admin.com', 'User', 'profiles/Jn1AoMTEWyP73q4aWZ2qNHR786AI1l1l4vSxIBw6.jpg', NULL, '$2y$12$5hmIzgH.k36wI7nVsOpA6.WHyjiQz3.rhz4WxlOhFP8AcggUpIG0e', NULL, '2026-01-05 06:15:28', '2026-01-19 18:01:47'),
(2, 'Galih', 'GalihPrayoga', 'user@user.com', 'User', 'profiles/6sNWBqLfc9EbeyWWtKVHqyT2riKLBcpQpgmyCHtB.jpg', NULL, '$2y$12$Usm4PPnKU12mI.H7kz5i9O4ZTgqxmQBLvBxj4wa83NaxHPti2VgXm', NULL, '2026-01-05 06:15:28', '2026-01-19 18:02:48'),
(3, 'Galih', 'Galih Prayoga', 'Galih@gmail.com', 'User', NULL, NULL, '$2y$12$6LlCHzMf6eFZpPZPgPjMdOEE9LhcaNAwpj0qGXNy9FRq0UwLHeMIy', NULL, '2026-01-05 06:38:14', '2026-01-05 06:38:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hasil_ujians_user_id_materi_id_created_at_unique` (`user_id`,`materi_id`,`created_at`),
  ADD KEY `hasil_ujians_materi_id_foreign` (`materi_id`);

--
-- Indexes for table `jawaban_users`
--
ALTER TABLE `jawaban_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jawaban_users_hasil_ujian_id_foreign` (`hasil_ujian_id`),
  ADD KEY `jawaban_users_soal_id_foreign` (`soal_id`),
  ADD KEY `jawaban_users_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas_user`
--
ALTER TABLE `kelas_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_user_kelas_id_foreign` (`kelas_id`),
  ADD KEY `kelas_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `materis`
--
ALTER TABLE `materis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materis_kelas_id_foreign` (`kelas_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `soals`
--
ALTER TABLE `soals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soals_materi_id_foreign` (`materi_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `jawaban_users`
--
ALTER TABLE `jawaban_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kelas_user`
--
ALTER TABLE `kelas_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `materis`
--
ALTER TABLE `materis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soals`
--
ALTER TABLE `soals`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_ujians`
--
ALTER TABLE `hasil_ujians`
  ADD CONSTRAINT `hasil_ujians_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hasil_ujians_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jawaban_users`
--
ALTER TABLE `jawaban_users`
  ADD CONSTRAINT `jawaban_users_hasil_ujian_id_foreign` FOREIGN KEY (`hasil_ujian_id`) REFERENCES `hasil_ujians` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_users_soal_id_foreign` FOREIGN KEY (`soal_id`) REFERENCES `soals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `kelas_user`
--
ALTER TABLE `kelas_user`
  ADD CONSTRAINT `kelas_user_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `kelas_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materis`
--
ALTER TABLE `materis`
  ADD CONSTRAINT `materis_kelas_id_foreign` FOREIGN KEY (`kelas_id`) REFERENCES `kelas` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `soals`
--
ALTER TABLE `soals`
  ADD CONSTRAINT `soals_materi_id_foreign` FOREIGN KEY (`materi_id`) REFERENCES `materis` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
