<nav class="bg-white shadow-md fixed w-full top-0 z-50">
  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">
      <!-- Logo -->
      <div class="flex items-center">
        <a href="/" class="flex items-center">
          <img src="../img/SounDeal.svg" alt="SounDeal Logo" class="h-16">
        </a>
      </div>

      <!-- Hamburger Button (Mobile) -->
      <div class="lg:hidden">
        <button id="toggleMenu" class="text-gray-800 focus:outline-none">
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>
        </button>
      </div>

      <!-- Menu (Desktop) -->
      <div
        id="navMenu"
        class="hidden lg:flex items-center flex-1 justify-center">
        <!-- Search Bar - Dipindahkan ke tengah -->
        <div class="absolute left-1/2 transform -translate-x-1/2 w-[70%] sm:w-[60%] md:w-[50%] lg:w-[40%] xl:w-[30%]">
          <form action="/search" method="GET">
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

        <!-- User Section - Tetap di posisi semula -->
        <div class="flex items-center space-x-4 ml-auto">
          <!-- Tambahkan ikon status pengiriman di sini -->
          <a href="/status" class="text-gray-800 hover:text-amber-400">
            <svg
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
              />
            </svg>
          </a>
          <a href="/chat" class="text-gray-800 hover:text-amber-400">
            <svg
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M7 8h10M7 12h6m-6 4h8m5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2l4 4 4-4h4a2 2 0 002-2z"
              />
            </svg>
          </a>
          <a href="/cart" class="text-gray-800 hover:text-amber-400">
            <svg
              class="h-6 w-6"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              viewBox="0 0 24 24"
            >
              <path
                d="M3 3h2l.4 2M7 13h10l4-8H5.4"
                stroke-linecap="round"
                stroke-linejoin="round"
              />
              <circle cx="9" cy="21" r="1" />
              <circle cx="20" cy="21" r="1" />
            </svg>
          </a>
          <a href="/profil" class="flex items-center space-x-2 group">
            <span
              class="text-gray-800 font-medium group-hover:text-amber-400 transition"
              >
              {{ Auth::user()->name }}
              
              </span
            >
            <img
              src="/img/{{ Auth::user()->image }}"
              alt="Profile"
              class="w-9 h-9 rounded-full object-cover border-2 border-gray-300 group-hover:border-amber-400 transition"
            />
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Menu (Mobile - Toggle) - Tambahkan menu status pengiriman -->
  <div
    id="mobileMenu"
    class="lg:hidden hidden px-4 pb-4 pt-4 space-y-6 bg-white"
  >
    <form action="/search" method="GET">
      <input
        type="text"
        name="query"
        placeholder="Cari alat musik..."
        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
      />
    </form>
    <div class="flex flex-col gap-4">
      <a
        href="/status"
        class="flex items-center gap-2 text-gray-800 hover:text-amber-400"
      >
        <svg
          class="h-5 w-5"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"
          />
        </svg>
        Status Pengiriman
      </a>
      <a
        href="/chat"
        class="flex items-center gap-2 text-gray-800 hover:text-amber-400"
      >
        <svg
          class="h-5 w-5"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M7 8h10M7 12h6m-6 4h8m5-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v8a2 2 0 002 2h2l4 4 4-4h4a2 2 0 002-2z"
          />
        </svg>
        Chat
      </a>
      <a
        href="/cart"
        class="flex items-center gap-2 text-gray-800 hover:text-amber-400"
      >
        <svg
          class="h-5 w-5"
          fill="none"
          stroke="currentColor"
          stroke-width="2"
          viewBox="0 0 24 24"
        >
          <path
            d="M3 3h2l.4 2M7 13h10l4-8H5.4"
            stroke-linecap="round"
            stroke-linejoin="round"
          />
          <circle cx="9" cy="21" r="1" />
          <circle cx="20" cy="21" r="1" />
        </svg>
        Keranjang
      </a>
      <a
        href="/profil"
        class="flex items-center gap-2 text-gray-800 hover:text-amber-400"
      >
        <img
          src="img/{{ Auth::user()->image }}"
          alt="Profile"
          class="w-6 h-6 rounded-full border border-gray-300"
        />
        {{ Auth::user()->name }}
        
      </a>
    </div>
  </div>
</nav>