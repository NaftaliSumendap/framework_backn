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
      <aside id="sidebar" class="w-72 bg-gray-50 p-4 shadow-md">
        <div class="flex items-center mb-10">
          <span class="text-2xl font-bold text-amber-400">Panel Admin</span>
        </div>
        <nav>
          <ul class="space-y-2">
            <li>
              <a
                href="/dashboard"
                class="flex items-center p-3 hover:text-amber-400"
                ><i class="bx bxs-dashboard mr-2"></i>Dashboard</a
              >
            </li>
            <li>
              <a
                href="/dashboard/store"
                class="flex items-center p-3 hover:text-amber-400"
                ><i class="bx bxs-shopping-bag-alt mr-2"></i>My Store</a
              >
            </li>
            <li>
              <a
                href="/dashboard/orders"
                class="flex items-center bg-gray-100 text-amber-400 p-3 rounded-full"
                ><i class="bx bxs-cart-alt mr-2"></i>Orders</a
              >
            </li>
            <li>
              <a
                href="/dashboard/users"
                class="flex items-center p-3 hover:text-amber-400"
                ><i class="bx bxs-user mr-2"></i>Users</a
              >
            </li>
          </ul>
          <div class="mt-10 border-t pt-4">
            <a href="../sign-in.html" class="flex items-center p-3 text-red-600"
              ><i class="bx bxs-log-out-circle mr-2"></i>Logout</a
            >
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <div class="flex-1">
        <!-- Navbar -->
        <nav class="flex justify-between items-center bg-gray-50 p-4 shadow relative">
          <i id="toggleSidebar" class="bx bx-menu text-xl cursor-pointer"></i>
          <div class="relative flex items-center w-full max-w-lg">
            <form action="search.html" method="GET" class="w-full">
              <div class="relative">
                <input
                  type="text"
                  name="query"
                  placeholder="Cari alat musik..."
                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
                />
                <button
                  type="submit"
                  class="absolute right-0 top-0 mt-2 mr-3 text-gray-500 hover:text-amber-400"
                >
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                      d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                    />
                  </svg>
                </button>
              </div>
            </form>
          </div>
          <div class="flex items-center space-x-4">
            <img
              src="../img/Foto Almamater Andro.png"
              class="w-9 h-9 rounded-full"
              alt="Profile"
            />
          </div>
        </nav>

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