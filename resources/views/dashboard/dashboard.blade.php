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
      <aside
        id="sidebar"
        class="w-72 bg-gray-50 min-h-screen p-4 transition-all duration-300"
      >
        <div class="flex items-center mb-10">
          <span class="text-2xl font-bold text-amber-400">Panel Admin</span>
        </div>
        <nav>
          <ul id="side-menu" class="space-y-2">
            <li>
              <a
                href="#"
                class="flex items-center p-3 text-amber-400 font-semibold bg-gray-100 rounded-full"
              >
                <i class="bx bxs-dashboard mr-2"></i> Dashboard
              </a>
            </li>
            <li>
              <a
                href="/dashboard/store"
                class="flex items-center hover:text-amber-400 p-3"
              >
                <i class="bx bxs-shopping-bag-alt mr-2"></i> My Store
              </a>
            </li>
            <li>
              <a
                href="/dashboard/orders"
                class="flex items-center hover:text-amber-400 p-3"
              >
                <i class="bx bxs-cart-alt mr-2"></i> Orders
              </a>
            </li>
            <li>
              <a
                href="/dashboard/users"
                class="flex items-center hover:text-amber-400 p-3"
              >
                <i class="bx bxs-user mr-2"></i> Users
              </a>
            </li>
          </ul>
          <div class="mt-10 border-t pt-4">
            <a href="../sign-in" class="flex items-center text-red-600 p-3">
              <i class="bx bxs-log-out-circle mr-2"></i> Logout
            </a>
          </div>
        </nav>
      </aside>

      <!-- Main content -->
      <div class="flex-1">
        <!-- Navbar -->
        <nav
          class="flex justify-between items-center bg-gray-50 p-4 shadow relative"
        >
          <i id="toggleSidebar" class="bx bx-menu text-xl cursor-pointer"></i>
          <div class="relative flex items-center w-full max-w-lg">
            <form action="/search" method="GET" class="w-full">
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
                  Total: 1,234 Akun
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
                <h3 class="text-xl font-bold">123</h3>
                <p>Total Users</p>
              </div>
            </div>
            <div class="flex items-center bg-white p-4 rounded shadow">
              <i class="bx bxs-cart text-3xl text-yellow-500 mr-4"></i>
              <div>
                <h3 class="text-xl font-bold">23</h3>
                <p>Orderan Terbaru</p>
              </div>
            </div>
            <div class="flex items-center bg-white p-4 rounded shadow">
              <i class="bx bxs-dollar-circle text-3xl text-orange-500 mr-4"></i>
              <div>
                <h3 class="text-xl font-bold">Rp12,345,540</h3>
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
                <tr class="border-b-2 hover:bg-gray-100">
                  <td class="py-2">
                    <i class="bx bx-user-circle text-2xl text-gray-400"></i>
                    <span class="ml-3">John Doe</span>
                  </td>
                  <td>01-10-2021</td>
                  <td>
                    <span class="status-badge bg-green-100 text-green-800 text-xs px-3 py-1 rounded-full">
                      Diterima
                    </span>
                  </td>
                </tr>
                <tr class="border-b-2 hover:bg-gray-100">
                  <td class="py-2">
                    <i class="bx bx-user-circle text-2xl text-gray-400"></i>
                    <span class="ml-3">Jane Smith</span>
                  </td>
                  <td>02-10-2021</td>
                  <td>
                    <span class="status-badge bg-purple-100 text-purple-800 text-xs px-3 py-1 rounded-full">
                      Dikonfirmasi
                    </span>
                  </td>
                </tr>
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
    </script>
  </body>
</html>
