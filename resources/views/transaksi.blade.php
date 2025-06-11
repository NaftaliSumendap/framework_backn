<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transaksi - SounDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  </head>
  <body class="bg-gray-100">
    <!-- Navbar User -->
    <x-navbar></x-navbar>

    <!-- Konten Utama Halaman Transaksi -->
    <main class="pt-20 pb-12 px-4 md:px-10">
      <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
          Ringkasan Transaksi
        </h2>

        {{-- Tampilkan bagian checkout jika keranjang tidak kosong --}}
        @if ($carts->isNotEmpty())
            {{-- Hitung total amount di sini jika belum dihitung di controller --}}
            @php
                $totalAmount = $carts->sum(function ($cart) {
                    return $cart->product->discount_price * $cart->quantity;
                });
            @endphp
            <form action="{{ route('checkout.process') }}" method="POST" id="paymentForm">
            @csrf

            <!-- Input tersembunyi untuk alamat pengiriman -->
            <input type="hidden" name="shipping_address" id="hidden_shipping_address" value="{{ $user->address ?? '' }}">

            <!-- Informasi Transaksi -->
            <div class="mb-6 text-sm text-gray-600 space-y-1">
                <p><strong>Tanggal Pesanan:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
                <p>
                <strong>Alamat Pengiriman:</strong>
                <span id="shipping-address-display">{{ $user->address ?? 'Belum diatur. Silakan perbarui di profil.' }}</span>
                <button type="button" onclick="openAddressModal()" class="text-amber-400 hover:text-amber-500 ml-2 text-sm">Ubah</button>
                </p>
                <p><strong>Estimasi Sampai:</strong> 3-5 hari kerja setelah pembayaran dikonfirmasi</p>
            </div>

            <!-- Daftar Produk di Keranjang -->
            <div class="space-y-6">
                @foreach ($carts as $cart)
                <div class="flex items-center justify-between border-b border-t-0 border-gray-200 py-4 first:border-t">
                    <div class="flex items-center">
                    <img src="img/{{$cart->product->image_path}}" alt="{{$cart->product->name}}" class="w-16 h-16 object-cover rounded mr-4" />
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">{{$cart->product->name}}</h3>
                        <p class="text-gray-600 text-sm">Jumlah: {{ $cart->quantity }}</p>
                    </div>
                    </div>
                    <p class="font-bold text-gray-800">Rp{{number_format($cart->product->discount_price * $cart->quantity, 0, ',', '.')}}</p>
                </div>
                @endforeach
            </div>

            <!-- Ringkasan Pembayaran -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Total Harga Barang</span>
                <span class="font-bold text-gray-800">Rp{{number_format($totalAmount, 0, ',', '.')}}</span>
                </div>
                <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Biaya Pengiriman</span>
                <span class="font-bold text-gray-800">Rp0</span>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between items-center text-xl font-bold text-amber-400">
                <span>Total Pembayaran</span>
                <span>Rp{{number_format($totalAmount, 0, ',', '.')}}</span>
                </div>
            </div>

            <!-- Metode Pengiriman -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Metode Pengiriman</h3>
                <div class="space-y-3">
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="shipping_method" value="JNE" class="form-radio text-amber-400 h-5 w-5" checked />
                    <span class="ml-3 text-gray-700 font-medium">JNE</span>
                    <span class="ml-auto text-gray-600">Gratis</span>
                </label>
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="shipping_method" value="POS" class="form-radio text-amber-400 h-5 w-5" />
                    <span class="ml-3 text-gray-700 font-medium">POS Indonesia</span>
                    <span class="ml-auto text-gray-600">Gratis</span>
                </label>
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="shipping_method" value="TIKI" class="form-radio text-amber-400 h-5 w-5" />
                    <span class="ml-3 text-gray-700 font-medium">TIKI</span>
                    <span class="ml-auto text-gray-600">Gratis</span>
                </label>
                </div>
            </div>

            <!-- Metode Pembayaran -->
            <div class="mt-8">
                <h3 class="text-xl font-bold text-gray-800 mb-4">Metode Pembayaran</h3>
                <div class="space-y-3">
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="payment_method" value="Transfer Bank" class="form-radio text-amber-400 h-5 w-5" checked />
                    <span class="ml-3 text-gray-700 font-medium">Transfer Bank</span>
                </label>
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="payment_method" value="Kartu Kredit" class="form-radio text-amber-400 h-5 w-5" />
                    <span class="ml-3 text-gray-700 font-medium">Kartu Kredit</span>
                </label>
                <label class="flex items-center bg-gray-50 p-4 rounded-lg cursor-pointer hover:bg-gray-100 transition">
                    <input type="radio" name="payment_method" value="E-Wallet" class="form-radio text-amber-400 h-5 w-5" />
                    <span class="ml-3 text-gray-700 font-medium">E-Wallet</span>
                </label>
                </div>
            </div>

            <!-- Tombol Bayar Sekarang -->
            <div class="mt-8">
                <button
                type="submit"
                class="w-full bg-amber-400 text-white py-3 rounded-lg shadow-md hover:bg-amber-500 transition duration-300"
                >
                Bayar Sekarang
                </button>
            </div>
            </form>
        @else
            {{-- Tampilkan pesan jika keranjang kosong --}}
            <div class="text-center py-10 bg-gray-50 rounded-lg shadow-inner mb-8">
                <p class="text-lg text-gray-600">Keranjang belanja Anda kosong. Tambahkan produk untuk memulai transaksi!</p>
                <a href="{{ route('index') }}" class="mt-4 inline-block bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500 transition">
                    Lanjutkan Belanja
                </a>
            </div>
        @endif

        {{-- Bagian untuk menampilkan pesanan yang menunggu pembayaran --}}
        @if ($pendingOrders->isNotEmpty())
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">
                    Pesanan Menunggu Pembayaran Anda
                </h2>

                <div class="space-y-6">
                    @foreach ($pendingOrders as $order)
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-amber-300">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-semibold text-gray-800">Pesanan #{{ $order->order_number }}</h3>
                            <span class="text-amber-500 font-bold">{{ ucfirst($order->status) }}</span>
                        </div>
                        <p class="text-gray-600 text-sm mb-2">Tanggal Pesanan: {{ $order->created_at->translatedFormat('d F Y H:i') }}</p>
                        <p class="text-gray-600 text-sm mb-4">Total: Rp{{ number_format($order->total_amount, 0, ',', '.') }}</p>

                        <h4 class="text-md font-semibold mb-2">Detail Barang:</h4>
                        <ul class="list-disc pl-5 text-gray-700 text-sm mb-4">
                            @foreach ($order->orderItems as $item)
                                <li>{{ $item->product->name ?? 'Produk Dihapus' }} (x{{ $item->quantity }}) - Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}</li>
                            @endforeach
                        </ul>

                        <a href="{{ route('status.order', ['order' => $order->id]) }}" class="inline-block bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500 transition">
                            Lanjutkan Pembayaran
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif
      </div>
    </main>

    <!-- Success Modal (untuk pesan sukses umum dan pembuatan pesanan) -->
    <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-sm">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <i class="bx bx-check text-green-600 text-2xl"></i>
          </div>
          <h3 id="successModalTitle" class="text-lg font-medium text-gray-900 mt-3">Berhasil!</h3>
          <div class="mt-2">
            <p id="successModalMessage" class="text-sm text-gray-500"></p>
          </div>
          <div class="mt-4">
            {{-- Tombol aksi untuk melihat status pesanan (hanya muncul jika ada orderId) --}}
            <button
              id="successModalActionButton"
              type="button"
              class="w-full bg-amber-400 text-white py-2 rounded hover:bg-amber-500 transition hidden"
            >
              Lihat Status Pesanan
            </button>
            {{-- Tombol tutup generik (muncul jika tidak ada orderId) --}}
            <button
              id="successModalCloseButton"
              type="button"
              onclick="closeSuccessModal()"
              class="w-full bg-gray-300 text-gray-700 py-2 rounded hover:bg-gray-400 transition mt-2 hidden"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Error Modal (untuk menampilkan error validasi atau error lainnya) -->
    <div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-sm">
        <div class="text-center">
          <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100">
            <i class="bx bx-x text-red-600 text-2xl"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mt-3">Terjadi Kesalahan!</h3>
          <div class="mt-2">
            <p id="errorMessage" class="text-sm text-gray-500"></p>
          </div>
          <div class="mt-4">
            <button
              type="button"
              onclick="closeErrorModal()"
              class="w-full bg-amber-400 text-white py-2 rounded hover:bg-amber-500 transition"
            >
              Tutup
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Address Edit Modal -->
    <div id="addressModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Ubah Alamat Pengiriman</h3>
          <button type="button" onclick="closeAddressModal()" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form id="addressUpdateForm">
          @csrf
          <div class="mb-4">
            <label for="new_shipping_address" class="block text-gray-700 text-sm font-bold mb-2">Alamat Lengkap:</label>
            <textarea id="new_shipping_address" name="address" rows="4" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $user->address ?? '' }}</textarea>
          </div>
          <div class="flex justify-end">
            <button type="button" onclick="saveAddress()" class="bg-amber-400 hover:bg-amber-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
              Simpan Alamat
            </button>
          </div>
        </form>
      </div>
    </div>


  </body>
  <!-- Footer -->
  <x-footer></x-footer>
  <script>
    // Fungsi untuk menampilkan modal sukses
    function showSuccessModal(message, orderId = null) {
        const successModal = document.getElementById('successModal');
        const successModalTitle = document.getElementById('successModalTitle');
        const successModalMessage = document.getElementById('successModalMessage');
        const successModalActionButton = document.getElementById('successModalActionButton');
        const successModalCloseButton = document.getElementById('successModalCloseButton');

        successModalTitle.innerText = 'Berhasil!';
        successModalMessage.innerText = message;

        if (orderId) {
            successModal.dataset.orderId = orderId;
            successModalActionButton.classList.remove('hidden');
            successModalActionButton.innerHTML = '<i class="bx bx-check mr-2"></i>Lihat Status Pesanan';
            successModalActionButton.onclick = () => {
                 window.location.href = `{{ route('status.order', ['order' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', orderId);
            };
            successModalCloseButton.classList.add('hidden');
        } else {
            successModal.removeAttribute('data-order-id');
            successModalActionButton.classList.add('hidden');
            successModalCloseButton.classList.remove('hidden');
            successModalCloseButton.onclick = () => closeSuccessModal();
        }

        successModal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal sukses (hanya menyembunyikan)
    function closeSuccessModal() {
        document.getElementById('successModal').classList.add('hidden');
    }

    // Fungsi untuk menampilkan modal error
    function showErrorModal(message) {
        document.getElementById('errorMessage').innerText = message;
        document.getElementById('errorModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal error
    function closeErrorModal() {
        document.getElementById('errorModal').classList.add('hidden');
    }

    // Fungsi untuk membuka modal alamat
    function openAddressModal() {
        document.getElementById('addressModal').classList.remove('hidden');
    }

    // Fungsi untuk menutup modal alamat
    function closeAddressModal() {
        document.getElementById('addressModal').classList.add('hidden');
    }

    // Fungsi untuk menyimpan alamat (menggunakan AJAX)
    async function saveAddress() {
        const newAddress = document.getElementById('new_shipping_address').value;
        try {
            const response = await fetch('{{ route('profile.update.ajax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ field: 'address', value: newAddress })
            });

            const data = await response.json();

            if (response.ok) {
                document.getElementById('shipping-address-display').innerText = newAddress;
                document.getElementById('hidden_shipping_address').value = newAddress;

                closeAddressModal();
                showSuccessModal('Alamat berhasil diperbarui!');
            } else {
                showErrorModal(data.message || 'Gagal memperbarui alamat.');
            }
        } catch (error) {
            console.error('Error:', error);
            showErrorModal('Terjadi kesalahan jaringan atau server.');
        }
    }

    // Tampilkan pesan sukses/error dari session Laravel saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi nilai hidden input alamat saat halaman dimuat
        const initialAddress = "{{ $user->address ?? '' }}";
        document.getElementById('hidden_shipping_address').value = initialAddress;

        @if(session('success'))
            @if(session('order_id'))
                showSuccessModal('{{ session('success') }}', '{{ session('order_id') }}');
            @else
                showSuccessModal('{{ session('success') }}');
            @endif
        @endif

        @if(session('error'))
            showErrorModal('{{ session('error') }}');
        @endif

        // Tampilkan error validasi Laravel jika ada
        @if ($errors->any())
            let errorMessages = '';
            @foreach ($errors->all() as $error)
                errorMessages += '{{ $error }}\n';
            @endforeach
            showErrorModal('Terjadi kesalahan validasi:\n' + errorMessages);
        @endif
    });
  </script>
</html>
