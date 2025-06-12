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

        {{-- Form untuk memproses pesanan --}}
        <form action="{{ route('checkout.process') }}" method="POST" id="paymentForm">
          @csrf

          <!-- Informasi Transaksi -->
          <div class="mb-6 text-sm text-gray-600 space-y-1">
            <p><strong>Tanggal Pesanan:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
            {{-- Alamat Pengiriman (ambil dari data user yang login) --}}
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
                <img src="{{ asset('storage/products/' . $cart->product->image_path) }} "alt="{{$cart->product->name}}" class="w-16 h-16 object-cover rounded mr-4" />
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
              <span class="font-bold text-gray-800">Rp0</span> {{-- Anda bisa menambahkan logika biaya pengiriman di sini --}}
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
      <span class="ml-3 text-xs text-gray-500">
        (BCA 1234567890 a.n. PT SounDeal)
      </span>
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
      </div>
    </main>

<!-- Modal Pesanan Berhasil -->
<div id="orderSuccessModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white rounded-lg p-6 w-full max-w-sm">
    <div class="text-center">
      <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
        <i class="bx bx-check text-green-600 text-2xl"></i>
      </div>
      <h3 class="text-lg font-medium text-gray-900 mt-3">Pesanan Berhasil!</h3>
      <div class="mt-2">
        <p class="text-sm text-gray-500">Pesanan Anda berhasil dibuat. Silakan cek status pesanan Anda di bawah ini.</p>
      </div>
      <div class="mt-4">
        <button type="button" onclick="closeOrderSuccessModal()" class="w-full bg-amber-400 text-white py-2 rounded hover:bg-amber-500 transition">
          Tutup
        </button>
      </div>
    </div>
  </div>
</div>

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
          {{-- Gunakan PATCH atau PUT jika Anda memiliki rute untuk update alamat di UserController --}}
          {{-- <input type="hidden" name="_method" value="PATCH"> --}}
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
    function showSuccessModal(message, orderId = null) {
        const successModal = document.getElementById('successModal');
        const successModalTitle = document.getElementById('successModalTitle');
        const successModalMessage = document.getElementById('successModalMessage');
        const successModalActionButton = document.getElementById('successModalActionButton');
        const successModalCloseButton = document.getElementById('successModalCloseButton');

        successModalTitle.innerText = 'Berhasil!'; // Judul umum untuk sukses
        successModalMessage.innerText = message; // Pesan yang dinamis

        if (orderId) {
            // Jika ada orderId, ini adalah sukses pesanan
            successModal.dataset.orderId = orderId;
            successModalActionButton.classList.remove('hidden'); // Tampilkan tombol aksi
            successModalActionButton.innerHTML = '<i class="bx bx-check mr-2"></i>Lihat Status Pesanan';
            // Pastikan URL redirect menggunakan orderId yang benar
            successModalActionButton.onclick = () => {
                 window.location.href = `{{ route('status.order', ['order' => 'PLACEHOLDER']) }}`.replace('PLACEHOLDER', orderId);
            };
            successModalCloseButton.classList.add('hidden'); // Sembunyikan tombol tutup generik
        } else {
            // Jika tidak ada orderId, ini adalah sukses umum (misal update alamat)
            successModal.removeAttribute('data-order-id'); // Hapus data-order-id jika ada
            successModalActionButton.classList.add('hidden'); // Sembunyikan tombol aksi
            successModalCloseButton.classList.remove('hidden'); // Tampilkan tombol tutup generik
            successModalCloseButton.onclick = () => closeSuccessModal(); // Pastikan tombol ini menutup modal
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
        console.log('closeAddressModal() called'); // Debug log
        document.getElementById('addressModal').classList.add('hidden');
        console.log('addressModal hidden class added'); // Debug log
    }

    // Fungsi untuk menyimpan alamat (menggunakan AJAX)
    async function saveAddress() {
        console.log('saveAddress() called'); // Debug log
        const newAddress = document.getElementById('new_shipping_address').value;
        console.log('New address:', newAddress); // Debug log

        try {
            console.log('Sending fetch request...'); // Debug log
            const response = await fetch('{{ route('profile.update.ajax') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ field: 'address', value: newAddress })
            });
            console.log('Fetch request completed. Response status:', response.status); // Debug log

            const data = await response.json();
            console.log('Response data:', data); // Debug log

            if (response.ok) {
                console.log('Response OK. Updating display and closing modal...'); // Debug log
                document.getElementById('shipping-address-display').innerText = newAddress;
                closeAddressModal(); // Ini akan menutup modal alamat
                showSuccessModal('Alamat berhasil diperbarui!'); // Panggil showSuccessModal dengan pesan saja
                console.log('Address update successful flow completed.'); // Debug log
            } else {
                console.log('Response not OK. Showing error modal.'); // Debug log
                showErrorModal(data.message || 'Gagal memperbarui alamat.');
            }
        } catch (error) {
            console.error('Error in saveAddress:', error); // Debug log
            showErrorModal('Terjadi kesalahan jaringan atau server.');
        }
    }

      function showOrderSuccessModal(orderId) {
    document.getElementById('orderSuccessModal').classList.remove('hidden');
    // Ganti link ke status pesanan
    document.getElementById('orderStatusBtn').href = "{{ route('status.order', ['order' => 'ORDER_ID']) }}".replace('ORDER_ID', orderId);
  }
  function closeOrderSuccessModal() {
    document.getElementById('orderSuccessModal').classList.add('hidden');
  }
  @if(session('success') && session('order_id'))
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('orderSuccessModal').classList.remove('hidden');
    });
  @endif

    // Tampilkan pesan sukses/error dari session Laravel saat halaman dimuat
  </script>