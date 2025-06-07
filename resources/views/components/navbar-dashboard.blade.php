<nav
          class="flex justify-between items-center bg-gray-50 p-4 shadow relative"
        >
          <i id="toggleSidebar" class="bx bx-menu text-xl cursor-pointer"></i>
          <div class="flex items-center space-x-4">
            <img
              src="../img/{{ Auth::user()->image }}"
              class="w-9 h-9 rounded-full object-cover border-2 border-gray-300 group-hover:border-amber-400 transition"
              alt="Profile"
            />
          </div>
        </nav>