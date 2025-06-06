<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders - Panel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
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
        <div class="mb-6">
          <p class="text-gray-700 mb-4">Pilih status baru untuk pesanan:</p>
          <div class="space-y-2">
            <button data-status="Dikonfirmasi" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Dikonfirmasi</button>
            <button data-status="Packaging" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Packaging</button>
            <button data-status="Pengantaran" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Pengantaran</button>
            <button data-status="Diterima" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100">Diterima</button>
            <button data-status="Dibatalkan" class="status-option w-full text-left px-4 py-2 border rounded-lg hover:bg-gray-100 text-red-600">Batalkan Pesanan</button>
          </div>
        </div>
        <div class="flex justify-end space-x-3">
          <button type="button" id="cancelStatusUpdate" class="px-4 py-2 border rounded-lg hover:bg-gray-100">Batal</button>
          <button type="button" id="confirmStatusUpdate" class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500">Simpan</button>
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
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2">Pembeli dermawan 1</td>
            <td>Gitar Akustik</td>
            <td>10-04-2025</td>
            <td>Rp 2.000.000</td>
            <td>
              <span class="status-badge bg-yellow-100 text-yellow-800 text-xs px-3 py-1 rounded-full">
                Menunggu
              </span>
            </td>
            <td class="space-x-2">
              <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                <i class="bx bx-edit"></i>
              </button>
              <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                <i class="bx bxs-trash"></i>
              </button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2">Pembeli dermawan 2</td>
            <td>Keyboard Yamaha</td>
            <td>09-04-2025</td>
            <td>Rp 3.500.000</td>
            <td>
              <span class="status-badge bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
                Diterima
              </span>
            </td>
            <td class="space-x-2">
              <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                <i class="bx bx-edit"></i>
              </button>
              <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                <i class="bx bxs-trash"></i>
              </button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2">Pembeli dermawan 3</td>
            <td>Drum Elektrik</td>
            <td>08-04-2025</td>
            <td>Rp 1.200.000</td>
            <td>
              <span class="status-badge bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full">
                Dikonfirmasi
              </span>
            </td>
            <td class="space-x-2">
              <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                <i class="bx bx-edit"></i>
              </button>
              <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                <i class="bx bxs-trash"></i>
              </button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2">Pembeli dermawan 4</td>
            <td>Biola</td>
            <td>07-04-2025</td>
            <td>Rp 750.000</td>
            <td>
              <span class="status-badge bg-blue-100 text-blue-800 text-xs px-3 py-1 rounded-full">
                Packaging
              </span>
            </td>
            <td class="space-x-2">
              <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                <i class="bx bx-edit"></i>
              </button>
              <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                <i class="bx bxs-trash"></i>
              </button>
            </td>
          </tr>
          <tr class="border-b hover:bg-gray-50">
            <td class="py-2">Pembeli dermawan 5</td>
            <td>Ukulele</td>
            <td>06-04-2025</td>
            <td>Rp 2.100.000</td>
            <td>
              <span class="status-badge bg-orange-100 text-orange-800 text-xs px-3 py-1 rounded-full">
                Pengantaran
              </span>
            </td>
            <td class="space-x-2">
              <button class="update-status-btn bg-amber-400 text-white px-3 py-1 rounded hover:bg-amber-500">
                <i class="bx bx-edit"></i>
              </button>
              <button class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                <i class="bx bxs-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


    <script>
      document.getElementById("toggleSidebar")?.addEventListener("click", () => {
        document.getElementById("sidebar")?.classList.toggle("hidden");
      });

      // Status Modal functionality
      const statusModal = document.getElementById('statusModal');
      const closeStatusModal = document.getElementById('closeStatusModal');
      const cancelStatusUpdate = document.getElementById('cancelStatusUpdate');
      const confirmStatusUpdate = document.getElementById('confirmStatusUpdate');
      const updateStatusBtns = document.querySelectorAll('.update-status-btn');
      const deleteBtns = document.querySelectorAll('.delete-btn');
      const statusOptions = document.querySelectorAll('.status-option');
      
      let currentStatus = '';
      let currentRow = null;

      updateStatusBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          currentRow = e.target.closest('tr');
          statusModal.classList.remove('hidden');
        });
      });

      deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
          if(confirm('Apakah Anda yakin ingin menghapus pesanan ini?')) {
            e.target.closest('tr').remove();
            alert('Pesanan berhasil dihapus');
          }
        });
      });

      statusOptions.forEach(option => {
        option.addEventListener('click', (e) => {
          // Remove active class from all options
          statusOptions.forEach(opt => opt.classList.remove('bg-amber-100', 'border-amber-400'));
          
          // Add active class to selected option
          e.target.classList.add('bg-amber-100', 'border-amber-400');
          currentStatus = e.target.getAttribute('data-status');
        });
      });

      closeStatusModal.addEventListener('click', () => {
        statusModal.classList.add('hidden');
      });

      cancelStatusUpdate.addEventListener('click', () => {
        statusModal.classList.add('hidden');
      });

      confirmStatusUpdate.addEventListener('click', () => {
        if (currentStatus && currentRow) {
          const statusBadge = currentRow.querySelector('.status-badge');
          
          // Update badge color and text based on status
          statusBadge.textContent = currentStatus;
          statusBadge.className = 'status-badge text-xs px-3 py-1 rounded-full';
          
          if (currentStatus === 'Menunggu') {
            statusBadge.classList.add('bg-yellow-100', 'text-yellow-800');
          } else if (currentStatus === 'Dikonfirmasi') {
            statusBadge.classList.add('bg-purple-100', 'text-purple-800');
          } else if (currentStatus === 'Packaging') {
            statusBadge.classList.add('bg-blue-100', 'text-blue-800');
          } else if (currentStatus === 'Pengantaran') {
            statusBadge.classList.add('bg-orange-100', 'text-orange-800');
          } else if (currentStatus === 'Diterima') {
            statusBadge.classList.add('bg-green-100', 'text-green-800');
          } else if (currentStatus === 'Dibatalkan') {
            statusBadge.classList.add('bg-red-100', 'text-red-800');
          }
          
          statusModal.classList.add('hidden');
          
          // Show success message
          alert(`Status berhasil diubah menjadi ${currentStatus}`);
        }
      });

      // Close modal when clicking outside
      window.addEventListener('click', (e) => {
        if (e.target === statusModal) {
          statusModal.classList.add('hidden');
        }
      });
    </script>
  </body>
</html>