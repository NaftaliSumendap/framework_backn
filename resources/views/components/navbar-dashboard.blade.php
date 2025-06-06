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
              src="../img/{{ Auth::user()->image }}"
              class="w-9 h-9 rounded-full object-cover border-2 border-gray-300 group-hover:border-amber-400 transition"
              alt="Profile"
            />
          </div>
        </nav>