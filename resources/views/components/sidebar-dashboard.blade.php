<aside id="sidebar" class="w-72 bg-gray-50 p-4 shadow-md">
  <div class="flex items-center mb-10">
    <span class="text-2xl font-bold text-amber-400">Panel Admin</span>
  </div>
  <nav>
    <ul class="space-y-2">
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
    <div class="mt-10 border-t pt-4">
      <a href="../sign-in" class="flex items-center p-3 text-red-600 hover:text-red-800">
        <i class="bx bxs-log-out-circle mr-2"></i>Logout
      </a>
    </div>
  </nav>
</aside>
