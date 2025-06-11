<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - SounDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Menggunakan Boxicons JS untuk ikon --}}
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <style>
        /* Gaya tambahan untuk status */
        .status-pending {
            color: #f59e0b; /* Amber */
        }
        .status-processing {
            color: #3b82f6; /* Blue */
        }
        .status-shipped {
            color: #10b981; /* Green */
        }
        .status-delivered {
            color: #22c55e; /* Emerald Green */
        }
        .status-cancelled, .status-failed, .status-expired {
            color: #ef4444; /* Red */
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar User -->
    <x-navbar></x-navbar>

    <main class="flex-grow container mx-auto px-4 py-20 space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pesanan Saya</h2>

        @if ($orders->isEmpty())
            <div class="text-center py-10 bg-white rounded-lg shadow-md">
                <p class="text-lg text-gray-600 mb-4">Anda belum memiliki pesanan apa pun.</p>
                <a href="{{ route('index') }}" class="inline-block bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="text-xl font-semibold text-gray-800">Pesanan #{{ $order->order_number }}</h3>
                        <span class="font-bold text-sm
                            @if ($order->status == 'pending') status-pending
                            @elseif ($order->status == 'processing') status-processing
                            @elseif ($order->status == 'shipped') status-shipped
                            @elseif ($order->status == 'delivered') status-delivered
                            @else status-cancelled
                            @endif
                        ">{{ ucfirst($order->status) }}</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-2">Tanggal Pesanan: {{ $order->created_at->translatedFormat('d F Y H:i') }}</p>
                    <p class="text-gray-600 text-sm mb-4">Total Pembayaran: <span class="font-bold">Rp{{ number_format($order->total_amount, 0, ',', '.') }}</span></p>

                    <h4 class="text-md font-semibold mb-2">Detail Barang:</h4>
                    <ul class="list-disc pl-5 text-gray-700 text-sm mb-4">
                        @foreach ($order->orderItems as $item)
                            <li>{{ $item->product->name ?? 'Produk Dihapus' }} (x{{ $item->quantity }}) - Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</li>
                        @endforeach
                    </ul>

                    <div class="flex justify-end mt-4">
                        <a href="{{ route('status.order', ['order' => $order->id]) }}" class="inline-block bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500 transition">
                            Lihat Detail & Status
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
<!-- Bagian Footer -->
<x-footer></x-footer>
</html>
