<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Konsumen dan Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar User -->
    <x-navbar></x-navbar>


    <!-- Chat Section -->
    <div class="pt-20 container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Chat dengan Penjual</h2>
    
        <!-- Chat Box -->
        <div class="bg-white rounded-lg shadow-md p-6 h-[500px] overflow-y-auto">
            <!-- Pesan Konsumen -->
            <div class="flex items-end justify-end mb-2">
                <div class="bg-gray-200 text-gray-800 px-4 py-2 rounded-tl-lg rounded-br-lg max-w-md break-words">
                  Apakah ada gitar Yamaha yang tersedia di toko ini? Saya sedang mencari beberapa pilihan gitar untuk dipertimbangkan.
                </div>
                <img src="img/Naftali.jpg" alt="Konsumen" class="w-8 h-8 rounded-full ml-2">
            </div>
    
            <!-- Pesan Penjual -->
            <div class="flex items-start mb-2">
                <img src="img/Foto Almamater Andro.png" alt="Penjual" class="w-8 h-8 rounded-full mr-2">
                <div class="bg-amber-400 text-white px-4 py-2 rounded-tr-lg rounded-bl-lg max-w-md break-words">
                    Ya, gitar Yamaha tersedia. Apakah Anda ingin memesan? Kami juga memiliki berbagai pilihan gitar lainnya yang mungkin menarik bagi Anda.
                </div>
            </div>
        </div>
    
        <!-- Input Chat -->
        <div class="mt-4 flex items-center">
            <input type="text" placeholder="Ketik pesan..." class="flex-grow px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400">
            <button class="ml-2 px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500">Kirim</button>
        </div>
    </div>
  </body>
</html>