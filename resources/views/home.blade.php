<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Home - Tailwind Landing Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite(['resources/css/app.css']) <!-- Pastikan ini diarahkan ke Tailwind-mu -->
</head>

<body class="bg-white text-gray-800">

  <!-- Navbar -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <h1 class="text-2xl font-bold text-indigo-600">MyWebsite</h1>
      <nav class="space-x-4">
        <a href="#" class="text-gray-600 hover:text-indigo-600">Home</a>
        <a href="#" class="text-gray-600 hover:text-indigo-600">Features</a>
        <a href="#" class="text-gray-600 hover:text-indigo-600">Contact</a>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <section class="bg-indigo-600 text-white">
    <div class="max-w-7xl mx-auto px-4 py-20 text-center">
      <h2 class="text-4xl md:text-5xl font-extrabold mb-4">Selamat Datang di MyWebsite</h2>
      <p class="text-lg md:text-xl mb-8">Bangun website impianmu dengan Tailwind CSS yang powerful dan fleksibel.</p>
      <a href="#" class="bg-white text-indigo-600 px-6 py-3 rounded-md font-semibold hover:bg-gray-100 transition">Mulai Sekarang</a>
    </div>
  </section>

  <!-- Fitur -->
  <section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
      <h3 class="text-3xl font-bold text-center mb-12">Fitur Unggulan</h3>
      <div class="grid md:grid-cols-3 gap-8">
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">⚡</div>
          <h4 class="text-xl font-semibold mb-2">Cepat & Ringan</h4>
          <p class="text-gray-600">Optimasi performa dengan framework CSS yang minimalis dan cepat.</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">🎨</div>
          <h4 class="text-xl font-semibold mb-2">Desain Fleksibel</h4>
          <p class="text-gray-600">Buat tampilan sesuai keinginanmu tanpa harus menulis banyak CSS.</p>
        </div>
        <div class="bg-white shadow rounded-lg p-6 text-center">
          <div class="text-indigo-600 text-4xl mb-4">🚀</div>
          <h4 class="text-xl font-semibold mb-2">Siap Produksi</h4>
          <p class="text-gray-600">Siap digunakan di proyek nyata, baik kecil maupun besar.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 border-t text-sm text-gray-600">
    <div class="max-w-7xl mx-auto px-4 py-8 md:flex md:items-start md:justify-between">

      <!-- Brand & Description -->
      <div class="mb-6 md:mb-0">
        <h2 class="text-xl font-semibold text-indigo-600">MyWebsite</h2>
        <p class="mt-2 max-w-sm text-gray-500">
          Membangun website modern dengan teknologi terbaik. Simple, cepat, dan efisien.
        </p>
      </div>

      <!-- Navigation Links -->
      <div class="grid grid-cols-2 gap-8 sm:grid-cols-3">
        <div>
          <h3 class="text-gray-800 font-medium mb-2">Layanan</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-indigo-600 transition">Website</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Mobile App</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Integrasi API</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-gray-800 font-medium mb-2">Perusahaan</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-indigo-600 transition">Tentang Kami</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Karir</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Kontak</a></li>
          </ul>
        </div>
        <div>
          <h3 class="text-gray-800 font-medium mb-2">Legal</h3>
          <ul class="space-y-2">
            <li><a href="#" class="hover:text-indigo-600 transition">Privasi</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Syarat & Ketentuan</a></li>
            <li><a href="#" class="hover:text-indigo-600 transition">Kebijakan Cookie</a></li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="mt-2 border-t pt-2 text-center text-gray-400">
      © 2025 MyWebsite. All rights reserved.
    </div>
  </footer>

</body>

</html>