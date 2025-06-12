<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 font-sans transition-colors duration-300">
    <div class="flex">
      <!-- Sidebar -->
      <x-sidebar-dashboard></x-sidebar-dashboard>

      <!-- Main content -->
      <div class="flex-1">
        <!-- Navbar -->
        <x-navbar-dashboard></x-navbar-dashboard>
        <!-- Main section -->
        <main class="p-6">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h1 class="text-2xl font-bold">Dashboard</h1>
              <div class="text-sm text-gray-500">
                Dashboard > <span class="text-amber-400">Home</span>
              </div>
            </div>
          </div>

          <!-- Ringkasan Pengguna -->
          <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <div class="flex items-center justify-between">
              <div>
                <h2 class="text-xl font-semibold mb-2">Data Pengguna</h2>
                <p class="text-3xl font-bold text-amber-400">
                  Total: {{ number_format($totalUsers) }} Akun
                </p>
              </div>
              <a
                href="/dashboard/users"
                class="bg-amber-400 text-white px-4 py-2 rounded hover:bg-amber-500 transition"
              >
                Lihat Semua Pengguna
              </a>
            </div>
          </div>

          <!-- Summary Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="flex items-center bg-white p-4 rounded shadow">
              <i class="bx bxs-user text-3xl text-amber-500 mr-4"></i>
              <div>
                <h3 class="text-xl font-bold">{{ number_format($totalUsers) }}</h3>
                <p>Total Users</p>
              </div>
            </div>
            <div class="flex items-center bg-white p-4 rounded shadow">
              <i class="bx bxs-cart text-3xl text-yellow-500 mr-4"></i>
              <div>
                <h3 class="text-xl font-bold">{{ number_format($totalOrders) }}</h3>
                <p>Total Order</p>
              </div>
            </div>
            <div class="flex items-center bg-white p-4 rounded shadow">
              <i class="bx bxs-dollar-circle text-3xl text-orange-500 mr-4"></i>
              <div>
                <h3 class="text-xl font-bold">Rp{{ number_format($totalTransaction, 0, ',', '.') }}</h3>
                <p>Total Transaksi</p>
              </div>
            </div>
          </div>

          <!-- Recent Orders Section -->
          <div class="bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-semibold">Orderan terbaru</h3>
              <div class="space-x-2 text-gray-500">
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
              </div>
            </div>
            <table class="w-full text-left">
              <thead>
                <tr class="text-gray-600 border-b">
                  <th class="py-2">User</th>
                  <th>Tanggal Orderan</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($recentOrders as $order)
                  <tr class="border-b-2 hover:bg-gray-100">
                    <td class="py-2 flex items-center">
                      <i class="bx bx-user-circle text-2xl text-gray-400"></i>
                      <span class="ml-3">{{ $order->user->name ?? '-' }}</span>
                    </td>
                    <td>{{ $order->created_at ? $order->created_at->format('d-m-Y') : '-' }}</td>
                    <td>
                      <span class="status-badge
                        @if($order->status == 'Diterima') bg-green-100 text-green-800
                        @elseif($order->status == 'Dikonfirmasi') bg-purple-100 text-purple-800
                        @elseif($order->status == 'Packaging') bg-blue-100 text-blue-800
                        @elseif($order->status == 'Pengantaran') bg-orange-100 text-orange-800
                        @elseif($order->status == 'Dibatalkan') bg-red-100 text-red-800
                        @else bg-yellow-100 text-yellow-800 @endif
                        text-xs px-3 py-1 rounded-full">
                        {{ $order->status }}
                      </span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="3" class="text-center py-4 text-gray-400">Belum ada order terbaru.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <script>
      document.getElementById("toggleSidebar").addEventListener("click", () => {
        document.getElementById("sidebar").classList.toggle("hidden");
      });

      const openLogoutModal = document.getElementById("openLogoutModal");
      const logoutModal = document.getElementById("logoutModal");
      const cancelLogout = document.getElementById("cancelLogout");

      openLogoutModal.addEventListener("click", () => {
        logoutModal.classList.remove("hidden");
        logoutModal.classList.add("flex");
      });

      cancelLogout.addEventListener("click", () => {
        logoutModal.classList.add("hidden");
        logoutModal.classList.remove("flex");
      });

      logoutModal.addEventListener("click", (e) => {
        if (e.target === logoutModal) {
          logoutModal.classList.add("hidden");
          logoutModal.classList.remove("flex");
        }
      });

        // document.getElementById("logoutButton").addEventListener("click", () => {
        //   document.getElementById("logoutModal").classList.remove("hidden");
        // });

        // document.getElementById("cancelLogout").addEventListener("click", () => {
        //   document.getElementById("logoutModal").classList.add("hidden");
        // });
    </script>
  </body>
</html>
