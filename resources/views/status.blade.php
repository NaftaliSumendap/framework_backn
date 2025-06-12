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
  @forelse($orders as $order)
<div class="bg-white p-8 rounded-xl shadow-lg mb-10 border border-gray-100">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
      <h2 class="text-xl md:text-2xl font-bold mb-1 text-amber-500">#{{ $order->order_number }}</h2>
      <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
        {{ $order->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
        {{ $order->status === 'processing' ? 'bg-blue-100 text-blue-700' : '' }}
        {{ $order->status === 'shipped' ? 'bg-purple-100 text-purple-700' : '' }}
        {{ $order->status === 'delivered' ? 'bg-green-100 text-green-700' : '' }}">
        {{ ucfirst($order->status) }}
      </span>
    </div>
    <div class="text-gray-400 text-sm mt-2 md:mt-0">
      {{ $order->created_at->translatedFormat('d F Y H:i') }}
    </div>
  </div>

  <!-- Progress Steps -->
  <div class="relative flex items-center justify-between mb-8 px-2">
  <!-- Garis horizontal penuh -->
  <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-200 z-0" style="transform: translateY(-50%);"></div>
  @php
    $steps = [
      ['icon' => 'bx-check', 'title' => 'Dikonfirmasi'],
      ['icon' => 'bx-package', 'title' => 'Dikemas'],
      ['icon' => 'bx-truck', 'title' => 'Dikirim'],
      ['icon' => 'bx-home', 'title' => 'Diterima'],
    ];
    $statusMap = ['pending'=>1, 'processing'=>2, 'shipped'=>3, 'delivered'=>4];
    $currentStep = $statusMap[$order->status] ?? 1;
  @endphp
  @foreach($steps as $i => $step)
    <div class="relative flex flex-col items-center z-10 w-1/4">
      <!-- Bulatan step -->
      <div class="w-12 h-12 flex items-center justify-center rounded-full
        {{ $i+1 < $currentStep ? 'bg-green-400 text-white' : ($i+1 == $currentStep ? 'bg-amber-400 text-white' : 'bg-gray-200 text-gray-400') }}
        shadow mb-2 border-4 border-white z-10">
        <i class="bx {{ $step['icon'] }} text-2xl"></i>
      </div>
      <!-- Label step -->
      <span class="text-xs font-semibold mt-1
        {{ $i+1 <= $currentStep ? 'text-amber-500' : 'text-gray-400' }}">
        {{ $step['title'] }}
      </span>
      <!-- Garis aktif di belakang bulatan, kecuali step terakhir -->
      @if($i < count($steps)-1)
        <div class="absolute top-1/2 left-1/2 w-full h-1
          {{ $i+1 < $currentStep ? 'bg-green-400' : 'bg-gray-200' }}"
          style="z-index:0; transform: translateY(-50%); left: 50%; right: 0;">
        </div>
      @endif
    </div>
  @endforeach
</div>

  <!-- Detail Pesanan -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div>
      <div class="mb-2"><span class="font-semibold">Metode Pengiriman:</span> {{ $order->shipping_method }}</div>
      <div class="mb-2"><span class="font-semibold">Metode Pembayaran:</span> {{ $order->payment_method }}</div>
      <div class="mb-2"><span class="font-semibold">Alamat Pengiriman:</span> {{ $order->shipping_address }}</div>
      <div class="mb-2"><span class="font-semibold">Total Pembayaran:</span> <span class="text-amber-500 font-bold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></div>
      @if($order->description)
        <div class="mb-2"><span class="font-semibold">Catatan:</span> {{ $order->description }}</div>
      @endif
    </div>
<div>
  <h4 class="font-semibold mb-2">Item Pesanan:</h4>
  <ul class="divide-y divide-gray-100">
    @forelse ($order->orderItems as $item)
      <li class="flex items-center justify-between py-2">
        <div class="flex items-center">
          @if($item->product->image_path)
            <img src="{{ asset('storage/products/' . $item->product->image_path) }}" alt="{{ $item->product->name }}" class="w-10 h-10 object-cover rounded mr-3" />
          @endif
          <div>
            <div class="font-medium">{{ $item->product->name }}</div>
            <div class="text-xs text-gray-400">x{{ $item->quantity }}</div>
          </div>
        </div>
        <span class="font-semibold text-gray-700">Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
      </li>
    @empty
      <li class="text-gray-400 italic">Tidak ada item.</li>
    @endforelse
  </ul>
</div>
  </div>
</div>
  @empty
    <div class="text-center text-gray-500 py-12">Belum ada pesanan.</div>
  @endforelse
</main>
</body>
<!-- Footer -->
<x-footer></x-footer>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mendapatkan status pesanan dari data yang dikirimkan oleh controller
         // Contoh: 'pending', 'processing', 'shipped', 'delivered'
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
