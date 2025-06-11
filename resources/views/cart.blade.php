<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Keranjang Belanja</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar User -->
    <x-navbar></x-navbar>

  <!-- Daftar Produk -->
  <main class="flex-grow container mx-auto px-4 py-8 space-y-4">
    <h2 class="text-2xl font-bold mb-4">Keranjang Belanja</h2>

    <!-- Produk List -->
    <div class="space-y-4">
      @foreach ($carts as $cart)
      <div class="bg-white p-4 rounded-lg shadow-md flex items-start justify-between">
        <div class="flex items-start">
          {{-- Checkbox removed as per original request --}}
          <img src="{{ asset('storage/products/' . $cart->product->image_path) }}" alt="{{$cart->product->name}}" class="w-24 h-24 object-cover rounded mr-4" />
          <div>
            <h3 class="text-lg font-semibold">{{$cart->product->name}}</h3>
            <p class="text-gray-600">Harga: Rp{{number_format($cart->product->discount_price, 0, ',', '.')}}</p>
            
            {{-- Form untuk Update Quantity --}}
            <form action="{{ route('cart.update', $cart->id) }}" method="POST" class="flex items-center mt-2">
              @csrf
              @method('PUT') {{-- Gunakan metode PUT untuk update --}}
              <label for="quantity-{{$cart->id}}" class="sr-only">Jumlah</label>
              <input
                type="number"
                id="quantity-{{$cart->id}}"
                name="quantity"
                value="{{ $cart->quantity }}"
                min="1"
                class="w-20 px-2 py-1 border rounded-md text-center"
                onchange="this.form.submit()" {{-- Submit form saat jumlah berubah --}}
              />
              {{-- Tombol submit tersembunyi, submit via onchange --}}
              <button type="submit" class="hidden">Update</button>
            </form>

            {{-- Form untuk Hapus Produk --}}
            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE') {{-- Gunakan metode DELETE untuk hapus --}}
                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">
                    Hapus
                </button>
            </form>
          </div>
        </div>
        <p class="font-bold text-lg">Rp{{number_format($cart->product->discount_price * $cart->quantity, 0, ',', '.')}}</p>
      </div>
      @endforeach
    </div>

    <!-- Ringkasan Belanja -->
    <div class="bg-white mt-10 p-6 rounded-lg shadow-md w-full">
      <h2 class="text-xl font-bold mb-4">Ringkasan Belanja</h2>
      <div class="space-y-4">
        <div class="flex justify-between">
          <span class="text-gray-600">Total Harga</span>
          <span class="font-bold">Rp{{number_format($carts->sum(function ($cart) { return $cart->product->discount_price * $cart->quantity; }), 0, ',', '.')}}</span>
        </div>
        <hr class="my-2" />
        <div class="flex justify-between">
          <span class="text-gray-600">Total Pembayaran</span>
          <span class="font-bold text-amber-400">Rp{{number_format($carts->sum(function ($cart) { return $cart->product->discount_price * $cart->quantity; }), 0, ',', '.')}}</span>
        </div>
        <a href="/transaksi">
          <button class="w-full bg-amber-400 text-white py-2 px-4 rounded-lg hover:bg-amber-500 transition">
            Lanjutkan ke Pembayaran
          </button>
        </a>
      </div>
    </div>
  </main>

</body>
<!-- Bagian Footer -->
<x-footer></x-footer>
<script>
    // Anda bisa menambahkan SweetAlert2 atau modal kustom di sini
    // untuk notifikasi sukses/gagal jika diperlukan,
    // mirip dengan yang Anda gunakan di sign-up.blade.php.
    // Misalnya, untuk menampilkan pesan 'success' dari session:
    @if(session('success'))
        alert("{{ session('success') }}"); // Ganti dengan modal kustom Anda
    @endif

    @if(session('error'))
        alert("{{ session('error') }}"); // Ganti dengan modal kustom Anda
    @endif
</script>
</html>
