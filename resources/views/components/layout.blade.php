<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar User -->
    <x-navbar></x-navbar> 
    <!-- Pajangan Utama -->
    <main>
        {{ $slot }}
    </main>
  </body>
  <!-- Bagian Footer -->
   <x-footer></x-footer>
  </html>