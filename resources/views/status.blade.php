<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Status Pengiriman - SounDeal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <link href="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js" rel="stylesheet"></link>
  <style>
    .step-active {
      color: #f59e0b;
      font-weight: 600;
    }

    .step-completed {
      color: #10b981;
      font-weight: 600;
    }

    .step-icon-active {
      background-color: #f59e0b;
      color: white;
    }

    .step-icon-completed {
      background-color: #10b981;
      color: white;
    }
  </style>
</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

  <!-- Navbar User -->
  <x-navbar></x-navbar>

  <!-- Main Content -->
  <main class="flex-grow container mx-auto px-4 py-20 space-y-6">
    <!-- Tracking Order Section -->
    <div class="bg-white p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-6">Status Pengiriman Pesanan #{{ $order->order_number }}</h2>
      <p class="text-gray-600 mb-4">Status saat ini: <span class="font-semibold text-amber-500">{{ ucfirst($order->status) }}</span></p>

      <div class="relative flex flex-col items-center py-4">
        <!-- Progress Bar (Vertical) -->
        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gray-200 rounded-full">
          <div id="progressBar" class="absolute bottom-0 w-full bg-amber-400 rounded-full transition-all duration-500 ease-in-out" style="height: 0%;"></div>
        </div>

        <!-- Steps -->
        <div class="flex flex-col items-center w-full">
          <!-- Step 1: Dikonfirmasi -->
          <div id="step1" class="flex items-center w-full py-4 relative">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center z-10 transition-colors duration-300">
              <i class="bx bx-check text-white text-xl"></i>
            </div>
            <div class="ml-4 flex-grow">
              <p class="text-gray-500 font-medium">Pesanan Dikonfirmasi</p>
              <p class="text-gray-400 text-sm">Pesanan Anda telah diterima dan dikonfirmasi.</p>
            </div>
          </div>

          <!-- Step 2: Packaging -->
          <div id="step2" class="flex items-center w-full py-4 relative">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center z-10 transition-colors duration-300">
              <i class="bx bx-package text-white text-xl"></i>
            </div>
            <div class="ml-4 flex-grow">
              <p class="text-gray-500 font-medium">Sedang Dikemas</p>
              <p class="text-gray-400 text-sm">Produk Anda sedang disiapkan untuk pengiriman.</p>
            </div>
          </div>

          <!-- Step 3: Pengantaran -->
          <div id="step3" class="flex items-center w-full py-4 relative">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center z-10 transition-colors duration-300">
              <i class="bx bx-truck text-white text-xl"></i>
            </div>
            <div class="ml-4 flex-grow">
              <p class="text-gray-500 font-medium">Dalam Pengantaran</p>
              <p class="text-gray-400 text-sm">Pesanan Anda sedang dalam perjalanan.</p>
            </div>
          </div>

          <!-- Step 4: Diterima -->
          <div id="step4" class="flex items-center w-full py-4 relative">
            <div class="w-8 h-8 rounded-full bg-gray-300 flex items-center justify-center z-10 transition-colors duration-300">
              <i class="bx bx-home text-white text-xl"></i>
            </div>
            <div class="ml-4 flex-grow">
              <p class="text-gray-500 font-medium">Pesanan Diterima</p>
              <p class="text-gray-400 text-sm">Pesanan Anda telah berhasil diterima.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Detail Pesanan -->
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-xl font-bold mb-4">Detail Pesanan</h3>
        <div class="space-y-2 text-gray-700">
          <p><strong>Nomor Pesanan:</strong> {{ $order->order_number }}</p>
          <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->translatedFormat('d F Y H:i') }}</p>
          <p><strong>Total Pembayaran:</strong> Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>
          <p><strong>Metode Pengiriman:</strong> {{ $order->shipping_method }}</p>
          <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
          <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
        </div>

        <h4 class="text-lg font-semibold mt-6 mb-3">Item Pesanan:</h4>
        <ul class="space-y-2">
          @foreach ($order->orderItems as $item)
          <li class="flex justify-between items-center text-gray-600 border-b pb-2">
            <span>{{ $item->product->name }} (x{{ $item->quantity }})</span>
            <span>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
          </li>
          @endforeach
        </ul>
      </div>

<<<<<<< HEAD
      <!-- Tombol Kembali ke Beranda -->
      <button class="w-full mt-6 bg-amber-400 text-white py-2 px-6 rounded-lg hover:bg-amber-500 transition">
        <a href="{{ route('index') }}">
          <i class="bx bx-home mr-2"></i>Kembali ke Beranda
=======
      <!-- Order Summary -->
      <div class="mt-6 space-y-3">
        <div class="flex justify-between">
          <span class="text-gray-600">Subtotal</span>
          <span>Rp3.000.000</span>
        </div>
        <div class="flex justify-between font-bold text-lg mt-4">
          <span>Total Pembayaran</span>
          <span class="text-amber-400">Rp3.000.000</span>
        </div>
      </div>

      <!-- Payment Info -->
      <div class="mt-6 border-t pt-6">
        <h3 class="font-semibold mb-4">Informasi Pembayaran</h3>
        <div class="flex justify-between">
          <span class="text-gray-600">Metode Pembayaran</span>
          <span>Transfer Bank BCA</span>
        </div>
        <div class="flex justify-between mt-2">
          <span class="text-gray-600">Status Pembayaran</span>
          <span class="text-green-500 font-semibold">Lunas</span>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex flex-col sm:flex-row gap-4 mt-6">
      <button class="bg-white border border-gray-300 text-gray-700 py-2 px-6 rounded-lg hover:bg-gray-50 transition">
        <a href="/chat">
          <i class="fas fa-question-circle mr-2"></i>Butuh Bantuan?
        </a>
      </button>
      <button class="bg-amber-400 text-white py-2 px-6 rounded-lg hover:bg-amber-500 transition">
        <a href="/">
          <i class="fas fa-home mr-2"></i>Kembali ke Beranda
>>>>>>> 60722fea16dc7dec8838775e05b780c37f792fc1
        </a>
      </button>
    </div>
  </main>
</body>
<!-- Footer -->
<x-footer></x-footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan status pesanan dari data yang dikirimkan oleh controller
        const orderStatus = "{{ $order->status }}"; // Contoh: 'pending', 'processing', 'shipped', 'delivered'
        let currentStep = 0;

        // Menentukan langkah saat ini berdasarkan status pesanan
        if (orderStatus === 'pending') {
            currentStep = 1;
        } else if (orderStatus === 'processing') {
            currentStep = 2;
        } else if (orderStatus === 'shipped') {
            currentStep = 3;
        } else if (orderStatus === 'delivered') {
            currentStep = 4;
        }

        // Memperbarui tinggi progress bar
        const progressBar = document.getElementById('progressBar');
        if (currentStep === 1) {
            progressBar.style.height = '25%';
        } else if (currentStep === 2) {
            progressBar.style.height = '50%';
        } else if (currentStep === 3) {
            progressBar.style.height = '75%';
        } else if (currentStep === 4) {
            progressBar.style.height = '100%';
        } else {
            progressBar.style.height = '0%'; // Jika status tidak dikenal atau belum dimulai
        }

        // Menyorot langkah yang sudah selesai dan aktif
        for (let i = 1; i <= 4; i++) {
            const step = document.getElementById(`step${i}`);
            const icon = step.querySelector('div:first-child');
            const text = step.querySelector('p:first-child');

            if (i < currentStep) {
                // Langkah yang sudah selesai
                step.classList.add('step-completed');
                icon.classList.remove('bg-gray-300');
                icon.classList.add('step-icon-completed');
                text.classList.remove('text-gray-500');
                text.classList.add('step-completed');
            } else if (i === currentStep) {
                // Langkah saat ini
                step.classList.add('step-active');
                icon.classList.remove('bg-gray-300');
                icon.classList.add('step-icon-active');
                text.classList.remove('text-gray-500');
                text.classList.add('step-active');
            } else {
                // Langkah yang belum tercapai
                step.classList.remove('step-active', 'step-completed');
                icon.classList.remove('step-icon-active', 'step-icon-completed');
                icon.classList.add('bg-gray-300');
                text.classList.remove('step-active', 'step-completed');
                text.classList.add('text-gray-500');
            }
        }
    });

    // Tampilkan pesan sukses/error dari session Laravel (jika ada)
    @if(session('success'))
        alert("{{ session('success') }}"); // Ganti dengan modal kustom Anda jika diperlukan
    @endif

    @if(session('error'))
        alert("{{ session('error') }}"); // Ganti dengan modal kustom Anda jika diperlukan
    @endif
</script>
</html>
