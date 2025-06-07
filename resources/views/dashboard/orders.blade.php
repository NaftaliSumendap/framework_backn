<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Orders - Panel Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans text-gray-800">

  <!-- Status Update Modal -->
  <div id="statusModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">Update Status Pesanan</h3>
        <button id="closeStatusModal" class="text-gray-500 hover:text-gray-700">
          <i class="bx bx-x text-2xl"></i>
        </button>
      </div>
      <form id="statusUpdateForm" method="POST" action="">
        @csrf
        @method('PUT')
        <div class="mt-4">
          <label class="block text-gray-700 mb-2">Status Pembayaran</label>
          <select id="paymentStatusSelect" name="payment_status" class="w-full border rounded px-3 py-2">
            <option value="0">Pending</option>
            <option value="1">Lunas</option>
          </select>
        </div>
        <div class="mb-6">
          <p class="text-gray-700 mb-4">Pilih status baru untuk pesanan:</p>
          <div class="space-y-2">
            <button type="button" data-status="Dikonfirmasi" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Dikonfirmasi</button>
            <button type="button" data-status="Packaging" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Packaging</button>
            <button type="button" data-status="Pengantaran" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Pengantaran</button>
            <button type="button" data-status="Diterima" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Diterima</button>
            <button type="button" data-status="Dibatalkan" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100 text-red-600">Batalkan Pesanan</button>
          </div>
          <input type="hidden" id="statusInput" name="status" value="">
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" id="cancelStatusUpdate" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
          <button type="submit" id="confirmStatusUpdate" class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Delete Modal -->
  <div id="deleteProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-xl font-bold">Hapus Produk</h3>
        <button id="closeDeleteModal" class="text-gray-500 hover:text-gray-700">
          <i class="bx bx-x text-2xl"></i>
        </button>
      </div>
      <div class="mb-6">
        <p class="text-gray-700">
          Apakah Anda yakin ingin menghapus
          <span class="font-semibold">pesanan</span>?
        </p>
        <p class="text-red-500 mt-2 text-sm">
          Aksi ini tidak dapat dibatalkan!
        </p>
      </div>
      <div class="flex justify-end space-x-3">
        <button type="button" id="cancelDelete" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
        <form id="delete-form" method="POST" enctype="multipart/form-data" action="">
          @csrf
          @method('DELETE')
          <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
            Hapus Produk
          </button>
        </form>
      </div>
    </div>
  </div>

  <div class="flex min-h-screen">
    <!-- Sidebar -->
    <x-sidebar-dashboard></x-sidebar-dashboard>

    <!-- Main Content -->
    <div class="flex-1">
      <!-- Navbar -->
      <x-navbar-dashboard></x-navbar-dashboard>

      <!-- Page Content -->
      <main class="p-6">
        <div class="flex justify-between items-center mb-6">
          <div>
            <h1 class="text-2xl font-bold">Manajemen Pesanan</h1>
            <div class="text-sm text-gray-500">
              Dashboard > <span class="text-amber-400">Orders</span>
            </div>
          </div>
        </div>

        <!-- Alerts -->
        @if (session('success'))
          <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
          </div>
        @endif
        @if (session('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-2" role="alert">
            <strong class="font-bold">Gagal!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
          </div>
        @endif

        <!-- Orders Table -->
        <div class="bg-white p-4 rounded shadow">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Daftar Pesanan</h3>
            <div class="space-x-2 text-gray-500">
              <i class="bx bx-search"></i>
              <i class="bx bx-filter"></i>
            </div>
          </div>
          <table class="w-full text-left text-sm">
            <thead>
              <tr class="text-gray-600 border-b">
                <th class="py-2">Nama Pelanggan</th>
                <th>Nama Produk</th>
                <th>Tanggal</th>
                <th>Total</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr class="border-b hover:bg-gray-50" data-order-id="{{ $order->id }}">
                  <td class="py-2">{{ $order->user->name }}</td>
                  <td>{{ $order->product->name ?? '-' }}</td>
                  <td>{{ $order->created_at ?? '-' }}</td>
                  <td>{{ $order->total_amount }}</td>
                  <td>
                  <span class="status-badge status-payment text-xs px-3 py-1 rounded-full
                    {{ $order->payment_status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $order->payment_status ? 'Lunas' : 'Pending' }}
                  </span>
                  </td>
                  <td>
                    <span class="status-badge status-order text-xs px-3 py-1 rounded-full
                      @if($order->status == 'Dikonfirmasi') bg-purple-100 text-purple-800
                      @elseif($order->status == 'Packaging') bg-blue-100 text-blue-800
                      @elseif($order->status == 'Pengantaran') bg-orange-100 text-orange-800
                      @elseif($order->status == 'Diterima') bg-green-100 text-green-800
                      @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-800
                      @else bg-gray-100 text-gray-800 @endif">
                      {{ $order->status }}
                    </span>
                  </td>
                  <td class="space-x-2">
                    <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                      <i class="bx bx-edit"></i>
                    </button>
                    <button
                      type="button"
                      class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                      data-id="{{ $order->id }}"
                      data-name="{{ $order->product->name ?? '-' }}"
                    >
                      <i class="bx bxs-trash"></i>
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </main>
    </div>
  </div>

  <script>
    // Auto-remove alert
    setTimeout(() => {
      document.querySelectorAll('[role="alert"]').forEach(el => el.remove());
    }, 1000);

    document.addEventListener('DOMContentLoaded', () => {
      // Sidebar toggle
      document.getElementById("toggleSidebar")?.addEventListener("click", () => {
        document.getElementById("sidebar")?.classList.toggle("hidden");
      });

      // --- LOGOUT MODAL ---
      const openLogoutModal = document.getElementById("openLogoutModal");
      const logoutModal = document.getElementById("logoutModal");
      const cancelLogout = document.getElementById("cancelLogout");

      openLogoutModal?.addEventListener("click", () => {
        logoutModal.classList.remove("hidden");
        logoutModal.classList.add("flex");
      });

      cancelLogout?.addEventListener("click", () => {
        logoutModal.classList.add("hidden");
        logoutModal.classList.remove("flex");
      });

      logoutModal?.addEventListener("click", (e) => {
        if (e.target === logoutModal) {
          logoutModal.classList.add("hidden");
          logoutModal.classList.remove("flex");
        }
      });

      // --- STATUS MODAL ---
      const statusModal = document.getElementById('statusModal');
      const updateStatusBtns = document.querySelectorAll('.update-status-btn');
      const statusOptions = document.querySelectorAll('.status-option');
      const paymentStatusSelect = document.getElementById('paymentStatusSelect');
      const statusInput = document.getElementById('statusInput');
      const statusUpdateForm = document.getElementById('statusUpdateForm');
      let currentRow = null;
      let currentOrderId = null;

      updateStatusBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          currentRow = e.target.closest('tr');
          currentOrderId = currentRow.getAttribute('data-order-id');
          // Set action form
          statusUpdateForm.action = `/dashboard/orders/${currentOrderId}`;
          // Set status awal
          const statusBadge = currentRow.querySelector('.status-badge.status-order');
          statusInput.value = statusBadge ? statusBadge.textContent.trim() : '';
          // Set payment status awal
          const paymentBadge = currentRow.querySelector('.status-badge.status-payment');
          paymentStatusSelect.value = (paymentBadge && paymentBadge.textContent.trim() === 'Lunas') ? '1' : '0';
          statusModal.classList.remove('hidden');
        });
      });

      statusOptions.forEach(option => {
        option.addEventListener('click', (e) => {
          statusOptions.forEach(opt => opt.classList.remove('bg-amber-100', 'border-amber-400'));
          e.target.classList.add('bg-amber-100', 'border-amber-400');
          statusInput.value = e.target.getAttribute('data-status');
        });
      });

      document.getElementById('closeStatusModal')?.addEventListener('click', () => {
        statusModal.classList.add('hidden');
      });
      document.getElementById('cancelStatusUpdate')?.addEventListener('click', () => {
        statusModal.classList.add('hidden');
      });

      // --- DELETE MODAL ---
      const deleteBtns = document.querySelectorAll('.delete-btn');
      const deleteProductModal = document.getElementById('deleteProductModal');
      const closeDeleteModal = document.getElementById('closeDeleteModal');
      const cancelDelete = document.getElementById('cancelDelete');
      const deleteForm = document.getElementById('delete-form');

      deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          const orderId = btn.getAttribute('data-id');
          deleteForm.action = `/dashboard/orders/${orderId}`;
          deleteProductModal.classList.remove('hidden');
          deleteProductModal.classList.add('flex');
        });
      });

      closeDeleteModal?.addEventListener('click', () => {
        deleteProductModal.classList.add('hidden');
        deleteProductModal.classList.remove('flex');
      });
      cancelDelete?.addEventListener('click', () => {
        deleteProductModal.classList.add('hidden');
        deleteProductModal.classList.remove('flex');
      });
      deleteProductModal?.addEventListener('click', (e) => {
        if (e.target === deleteProductModal) {
          deleteProductModal.classList.add('hidden');
          deleteProductModal.classList.remove('flex');
        }
      });
    });
  </script>
</body>
</html>