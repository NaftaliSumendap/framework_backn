<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Status Pengiriman - SounDeal</title>
  <script src="https://cdn.tailwindcss.com"></script>
  {{-- Memuat Boxicons untuk ikon --}}
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <style>
    /* Gaya asli dari desain lama */
    .step-active {
      color: #f59e0b; /* Amber */
      font-weight: 600;
    }

    .step-completed {
      color: #10b981; /* Green */
      font-weight: 600;
    }

    .step-icon-active {
      background-color: #f59e0b; /* Amber */
      color: white;
    }

    .step-icon-completed {
      background-color: #10b981; /* Green */
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
      <h2 class="text-2xl font-bold mb-6">Status Pengiriman</h2>
      <p class="text-gray-600 mb-4">Status saat ini: <span class="font-semibold text-amber-500">{{ ucfirst($order->status) }}</span></p>

      <div class="relative flex flex-col items-center py-4">
        <!-- Progress Bar (Vertical) -->
        <div class="absolute left-1/2 transform -translate-x-1/2 h-full w-1 bg-gray-200 rounded-full">
          {{-- ID progressBar untuk kontrol JS --}}
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

      {{-- Tombol Lanjutkan Pembayaran (hanya tampil jika status pending) --}}
      @if ($order->status === 'pending' && !$order->payment_status)
        <div class="mt-6 text-center">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Pembayaran Anda Belum Selesai</h3>
            <p class="text-gray-600 mb-4">Mohon selesaikan pembayaran untuk pesanan ini agar dapat diproses.</p>
            {{-- Mengubah tombol menjadi link ke halaman transaksi --}}
            <a href="{{ route('checkout.form') }}" class="inline-block bg-amber-400 text-white py-2 px-6 rounded-lg hover:bg-amber-500 transition">
                Lanjutkan Pembayaran
            </a>
        </div>
      @endif

      <!-- Detail Pesanan -->
      <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <h3 class="text-xl font-bold mb-4">Detail Pesanan</h3>
        <div class="space-y-2 text-gray-700">
          <p><strong>Nomor Pesanan:</strong> <span class="text-amber-600">{{ $order->order_number }}</span></p>
          <p><strong>Tanggal Pesanan:</strong> {{ $order->created_at->translatedFormat('d F Y H:i') }}</p>
          <p><strong>Total Pembayaran:</strong> <span class="font-bold text-green-700">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></p>
          <p><strong>Metode Pengiriman:</strong> {{ $order->shipping_method }}</p>
          <p><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
          <p><strong>Alamat Pengiriman:</strong> {{ $order->shipping_address }}</p>
          <p><strong>Status Pembayaran:</strong>
            @if ($order->payment_status)
                <span class="text-green-600 font-semibold">Sudah Dibayar</span>
            @else
                <span class="text-red-500 font-semibold">Belum Dibayar</span>
            @endif
          </p>
        </div>

        <h4 class="text-lg font-semibold mt-6 mb-3">Item Pesanan:</h4>
        <ul class="space-y-2">
          @foreach ($order->orderItems as $item)
          <li class="flex justify-between items-center text-gray-600 border-b pb-2 last:border-b-0 last:pb-0">
            <span>{{ $item->product->name ?? 'Produk Dihapus' }} (x{{ $item->quantity }})</span>
            <span>Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
          </li>
          @endforeach
        </ul>
      </div>

      <!-- Tombol Kembali ke Beranda -->
      <button class="w-full mt-6 bg-amber-400 text-white py-2 px-6 rounded-lg hover:bg-amber-500 transition">
        <a href="{{ route('index') }}">
          <i class="bx bx-home mr-2"></i>Kembali ke Beranda
        </a>
      </button>
    </div>
  </main>

</body>
<!-- Footer -->
<x-footer></x-footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const orderStatus = "{{ $order->status }}";
        const progressBar = document.getElementById('progressBar'); // Menggunakan ID yang benar
        const steps = [
            { id: 'step1', status: 'pending' },
            { id: 'step2', status: 'processing' },
            { id: 'step3', status: 'shipped' },
            { id: 'step4', status: 'delivered' }
        ];

        let currentStep = 0; // Default ke langkah 0 atau tidak ada

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
        // Tinggi bar dihitung berdasarkan jarak antara pusat ikon
        // Asumsi ada 4 langkah, berarti 3 segmen antar ikon
        // 0% pada 'pending', 33% pada 'processing', 66% pada 'shipped', 100% pada 'delivered'
        if (currentStep >= 1) {
            if (currentStep === 1) progressBar.style.height = '0%'; // Jika pending, bar masih di awal
            if (currentStep === 2) progressBar.style.height = '33%'; // Packaging
            if (currentStep === 3) progressBar.style.height = '66%'; // Pengantaran
            if (currentStep === 4) progressBar.style.height = '100%'; // Diterima
        } else {
            progressBar.style.height = '0%'; // Jika status tidak dikenal atau belum dimulai
        }


        // Highlight current step
        for (let i = 1; i <= 4; i++) {
            const step = document.getElementById(`step${i}`);
            const iconDiv = step.querySelector('div:first-child'); // Target div ikon (anak pertama dari step)
            const textP = step.querySelector('p:first-child');    // Target p teks utama (anak pertama dari div ml-4)

            // Hapus semua kelas aktif/selesai yang mungkin ada dari iterasi sebelumnya
            step.classList.remove('step-active', 'step-completed');
            iconDiv.classList.remove('step-icon-active', 'step-icon-completed');
            iconDiv.classList.add('bg-gray-300'); // Reset ke warna default ikon
            textP.classList.remove('step-active', 'step-completed');
            textP.classList.add('text-gray-500'); // Reset ke warna default teks

            if (i < currentStep) {
                // Langkah yang sudah selesai
                step.classList.add('step-completed');
                iconDiv.classList.add('step-icon-completed');
                textP.classList.add('step-completed');
            } else if (i === currentStep) {
                // Langkah saat ini
                step.classList.add('step-active');
                iconDiv.classList.add('step-icon-active');
                textP.classList.add('step-active');
            }
        }
    });

    // Tampilkan pesan sukses/error dari session Laravel (jika ada)
    @if(session('success'))
        alert("{{ session('success') }}"); // Menggunakan alert sederhana
    @endif

    @if(session('error'))
        alert("{{ session('error') }}"); // Menggunakan alert sederhana
    @endif
</script>
</html>
