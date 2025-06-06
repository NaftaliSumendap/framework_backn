<aside id="sidebar" class="w-72 bg-gray-50 p-4 shadow-md">
  <div class="flex items-center mb-10">
    <span class="text-2xl font-bold text-amber-400">Panel Admin</span>
  </div>
  <nav>
    <ul>
      <li>
        <a
          href="/dashboard"
          class="flex items-center p-3 rounded-full {{ Request::is('dashboard') ? 'bg-gray-100 text-amber-400' : 'hover:text-amber-400' }}"
        >
          <i class="bx bxs-dashboard mr-2"></i>Dashboard
        </a>
      </li>
      <li>
        <a
          href="/dashboard/store"
          class="flex items-center p-3 rounded-full {{ Request::is('dashboard/store*') ? 'bg-gray-100 text-amber-400' : 'hover:text-amber-400' }}"
        >
          <i class="bx bxs-shopping-bag-alt mr-2"></i>My Store
        </a>
      </li>
      <li>
        <a
          href="/dashboard/orders"
          class="flex items-center p-3 rounded-full {{ Request::is('dashboard/orders*') ? 'bg-gray-100 text-amber-400' : 'hover:text-amber-400' }}"
        >
          <i class="bx bxs-cart-alt mr-2"></i>Orders
        </a>
      </li>
      <li>
        <a
          href="/dashboard/users"
          class="flex items-center p-3 rounded-full {{ Request::is('dashboard/users*') ? 'bg-gray-100 text-amber-400' : 'hover:text-amber-400' }}"
        >
          <i class="bx bxs-user mr-2"></i>Users
        </a>
      </li>
    </ul>
    <ul class="mt-8">
      <button
        id="openLogoutModal"
        class="flex items-center p-3 text-red-600 hover:text-red-800 w-full"
      >
        <i class="bx bxs-log-out-circle mr-2"></i>Logout
      </button>
    </ul>
  </nav>

  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
    <div class="bg-white rounded-xl shadow-lg p-6 max-w-sm w-full text-center">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Konfirmasi Logout</h2>
      <p class="text-gray-600 mb-6">Apakah Anda yakin ingin logout?</p>
      <div class="flex justify-center space-x-4">
        <button
          id="cancelLogout"
          class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300"
        >
          Batal
        </button>
        <form method="POST" action="/logout">
          @csrf
          <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</aside>