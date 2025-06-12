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
    ['icon' => 'bx-time', 'title' => 'Menunggu'],
    ['icon' => 'bx-check-circle', 'title' => 'Dikonfirmasi'],
    ['icon' => 'bx-package', 'title' => 'Packaging'],
    ['icon' => 'bx-car', 'title' => 'Pengantaran'],
    ['icon' => 'bx-home', 'title' => 'Diterima'],
  ];
    $statusMap = [
    'Menunggu'     => 1,
    'Dikonfirmasi' => 2,
    'Packaging'    => 3,
    'Pengantaran'  => 4,
    'Diterima'     => 5,
    'Dibatalkan'   => 0, // (opsional, jika ingin handle dibatalkan)
  ];
  $currentStep = $statusMap[$order->status] ?? 2;
  @endphp
 @foreach($steps as $i => $step)
  <div class="relative flex flex-col items-center z-10 w-1/4 progress-step">
    <div class="step-icon w-12 h-12 flex items-center justify-center rounded-full
      {{ $i+1 < $currentStep ? 'bg-green-400 text-white' : ($i+1 == $currentStep ? 'bg-amber-400 text-white' : 'bg-gray-200 text-gray-400') }}
      shadow mb-2 border-4 border-white z-10">
      <i class="bx {{ $step['icon'] }} text-2xl"></i>
    </div>
    <span class="step-label text-xs font-semibold mt-1
      {{ $i+1 <= $currentStep ? 'text-amber-500' : 'text-gray-400' }}">
      {{ $step['title'] }}
    </span>
    <!-- ...garis... -->
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
    function updateOrderStatus(newStatus) {
    // Map status ke step
    const statusMap = { 'Dikonfirmasi ': 1, 'Packaging': 2, 'Pengantaran': 3, 'Diterima': 4 };
    const currentStep = statusMap[newStatus] || 1;

    // Update step tampilan
    document.querySelectorAll('.progress-step').forEach((step, i) => {
        const icon = step.querySelector('.step-icon');
        const label = step.querySelector('.step-label');
        if (i + 1 < currentStep) {
            icon.className = 'step-icon bg-green-400 text-white w-12 h-12 flex items-center justify-center rounded-full shadow mb-2 border-4 border-white z-10';
            label.className = 'step-label text-xs font-semibold mt-1 text-amber-500';
        } else if (i + 1 === currentStep) {
            icon.className = 'step-icon bg-amber-400 text-white w-12 h-12 flex items-center justify-center rounded-full shadow mb-2 border-4 border-white z-10';
            label.className = 'step-label text-xs font-semibold mt-1 text-amber-500';
        } else {
            icon.className = 'step-icon bg-gray-200 text-gray-400 w-12 h-12 flex items-center justify-center rounded-full shadow mb-2 border-4 border-white z-10';
            label.className = 'step-label text-xs font-semibold mt-1 text-gray-400';
        }
    });
}

    // Tampilkan pesan sukses/error dari session Laravel (jika ada)
    @if(session('success'))
        alert("{{ session('success') }}"); // Ganti dengan modal kustom Anda jika diperlukan
    @endif

    @if(session('error'))
        alert("{{ session('error') }}"); // Ganti dengan modal kustom Anda jika diperlukan
    @endif
</script>
</html>
