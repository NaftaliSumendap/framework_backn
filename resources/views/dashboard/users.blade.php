<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Management - Panel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 font-sans text-gray-800">
    <!-- Add User Modal -->
    <div
      id="addUserModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Tambah Pengguna Baru</h3>
          <button id="closeAddModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Profil Pengguna</label>
            <div
              class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
            >
              <i class="bx bx-user text-4xl text-gray-400 mb-2"></i>
              <p class="text-gray-500">
                Drag & drop gambar atau klik untuk memilih
              </p>
              <input type="file" class="hidden" id="userImage" />
              <button
                type="button"
                onclick="document.getElementById('userImage').click()"
                class="mt-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm"
              >
                Pilih Gambar
              </button>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Username</label>
            <input
              type="text"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
              placeholder="Masukkan username"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nama Lengkap</label>
            <input
              type="text"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
              placeholder="Masukkan nama lengkap"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Email</label>
            <input
              type="email"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
              placeholder="Masukkan email"
            />
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 mb-2">Role</label>
            <select
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            >
              <option value="">Pilih Role</option>
              <option value="admin">Admin</option>
              <option value="user">User</option>
              <option value="guest">Guest</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Password</label>
            <input
              type="password"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
              placeholder="Masukkan password"
            />
          </div>
          <div class="flex justify-end space-x-3">
            <button
              type="button"
              id="cancelAdd"
              class="px-4 py-2 border rounded-lg hover:bg-gray-100"
            >
              Batal
            </button>
            <button
              type="submit"
              class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500"
            >
              Tambahkan
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Edit User Modal -->
    <div
      id="editUserModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Edit Pengguna</h3>
          <button id="closeEditModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Profil Pengguna</label>
            <div
              class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
            >
              <img
                src="../../image/Foto Almamater Andro.png"
                alt="Current User"
                class="mx-auto mb-2 h-20 w-20 rounded-full object-cover"
              />
              <p class="text-gray-500">
                Drag & drop gambar baru atau klik untuk memilih
              </p>
              <input type="file" class="hidden" id="editUserImage" />
              <button
                type="button"
                onclick="document.getElementById('editUserImage').click()"
                class="mt-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm"
              >
                Pilih Gambar Baru
              </button>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Username</label>
            <input
              type="text"
              value="admin123"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nama Lengkap</label>
            <input
              type="text"
              value="Admin Utama"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Email</label>
            <input
              type="email"
              value="admin@example.com"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 mb-2">Role</label>
            <select
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            >
              <option value="admin" selected>Admin</option>
              <option value="user">User</option>
              <option value="guest">Guest</option>
            </select>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2"
              >Password (biarkan kosong jika tidak ingin mengubah)</label
            >
            <input
              type="password"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
              placeholder="Masukkan password baru"
            />
          </div>
          <div class="flex justify-end space-x-3">
            <button
              type="button"
              id="cancelEdit"
              class="px-4 py-2 border rounded-lg hover:bg-gray-100"
            >
              Batal
            </button>
            <button
              type="submit"
              class="px-4 py-2 bg-amber-400 text-white rounded-lg hover:bg-amber-500"
            >
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div
      id="deleteUserModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Hapus Pengguna</h3>
          <button
            id="closeDeleteModal"
            class="text-gray-500 hover:text-gray-700"
          >
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <div class="mb-6">
          <p class="text-gray-700">
            Apakah Anda yakin ingin menghapus pengguna
            <span class="font-semibold">"admin123"</span>?
          </p>
          <p class="text-red-500 mt-2 text-sm">
            Aksi ini tidak dapat dibatalkan!
          </p>
        </div>
        <div class="flex justify-end space-x-3">
          <button
            type="button"
            id="cancelDelete"
            class="px-4 py-2 border rounded-lg hover:bg-gray-100"
          >
            Batal
          </button>
          <button
            type="button"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
          >
            Hapus Pengguna
          </button>
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
                href="/dashboard/dashboard"
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
                class="flex items-center p-3 hover:text-amber-400"
                ><i class="bx bxs-cart-alt mr-2"></i>Orders</a
              >
            </li>
            <li>
              <a
                href="/dashboard/users"
                class="flex items-center bg-gray-100 text-amber-400 p-3 rounded-full"
                ><i class="bx bxs-user mr-2"></i>Users</a
              >
            </li>
          </ul>
          <div class="mt-10 border-t pt-4">
            <a href="../sign-in" class="flex items-center p-3 text-red-600"
              ><i class="bx bxs-log-out-circle mr-2"></i>Logout</a
            >
          </div>
        </nav>
      </aside>

      <!-- Main Content -->
      <div class="flex-1">
        <!-- Navbar -->
        <nav
          class="flex justify-between items-center bg-gray-50 p-4 shadow relative"
        >
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
              <h1 class="text-2xl font-bold">Manajemen Pengguna</h1>
              <div class="text-sm text-gray-500">
                Dashboard > <span class="text-amber-400">Users</span>
              </div>
            </div>
            <button
              id="openAddUser"
              class="flex items-center bg-amber-400 text-white px-4 py-2 rounded-full hover:bg-amber-500"
            >
              <i class="bx bx-plus mr-2"></i> Tambah Pengguna
            </button>
          </div>

          <!-- Users Table -->
          <div class="bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-semibold">Daftar Pengguna</h3>
              <div class="space-x-2 text-gray-500">
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
              </div>
            </div>
            <table class="w-full text-left text-sm">
              <thead>
                <tr class="text-gray-600 border-b">
                  <th class="py-2">Profil</th>
                  <th>Username</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2">
                    <img
                      src="../../image/Foto Almamater Andro.png"
                      class="w-8 h-8 rounded-full object-cover"
                      alt="Profile"
                    />
                  </td>
                  <td>admin123</td>
                  <td>Admin Utama</td>
                  <td>admin@example.com</td>
                  <td>
                    <span
                      class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full"
                      >Admin</span
                    >
                  </td>
                  <td class="space-x-2">
                    <button
                      class="edit-btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                      data-user="admin123"
                    >
                      <i class="bx bxs-edit"></i>
                    </button>
                    <button
                      class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                      data-user="admin123"
                    >
                      <i class="bx bxs-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2">
                    <i class="bx bx-user-circle text-2xl text-gray-400"></i>
                  </td>
                  <td>user456</td>
                  <td>Pengguna Biasa</td>
                  <td>user@example.com</td>
                  <td>
                    <span
                      class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full"
                      >User</span
                    >
                  </td>
                  <td class="space-x-2">
                    <button
                      class="edit-btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                      data-user="user456"
                    >
                      <i class="bx bxs-edit"></i>
                    </button>
                    <button
                      class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                      data-user="user456"
                    >
                      <i class="bx bxs-trash"></i>
                    </button>
                  </td>
                </tr>
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2">
                    <i class="bx bx-user-circle text-2xl text-gray-400"></i>
                  </td>
                  <td>guest789</td>
                  <td>Tamu</td>
                  <td>guest@example.com</td>
                  <td>
                    <span
                      class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full"
                      >Guest</span
                    >
                  </td>
                  <td class="space-x-2">
                    <button
                      class="edit-btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                      data-user="guest789"
                    >
                      <i class="bx bxs-edit"></i>
                    </button>
                    <button
                      class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                      data-user="guest789"
                    >
                      <i class="bx bxs-trash"></i>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

    <script>
      document
        .getElementById("toggleSidebar")
        ?.addEventListener("click", () => {
          document.getElementById("sidebar")?.classList.toggle("hidden");
        });

      // Modal functionality
      const addModal = document.getElementById("addUserModal");
      const editModal = document.getElementById("editUserModal");
      const deleteModal = document.getElementById("deleteUserModal");

      // Add User Modal
      const openAddBtn = document.getElementById("openAddUser");
      const closeAddBtn = document.getElementById("closeAddModal");
      const cancelAddBtn = document.getElementById("cancelAdd");

      openAddBtn.addEventListener("click", () => {
        addModal.classList.remove("hidden");
      });

      closeAddBtn.addEventListener("click", () => {
        addModal.classList.add("hidden");
      });

      cancelAddBtn.addEventListener("click", () => {
        addModal.classList.add("hidden");
      });

      // Edit User Modal
      const editButtons = document.querySelectorAll(".edit-btn");
      const closeEditBtn = document.getElementById("closeEditModal");
      const cancelEditBtn = document.getElementById("cancelEdit");

      editButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const username = button.getAttribute("data-user");
          // In a real app, you would fetch the user data here
          editModal.classList.remove("hidden");
        });
      });

      closeEditBtn.addEventListener("click", () => {
        editModal.classList.add("hidden");
      });

      cancelEditBtn.addEventListener("click", () => {
        editModal.classList.add("hidden");
      });

      // Delete User Modal
      const deleteButtons = document.querySelectorAll(".delete-btn");
      const closeDeleteBtn = document.getElementById("closeDeleteModal");
      const cancelDeleteBtn = document.getElementById("cancelDelete");

      deleteButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const username = button.getAttribute("data-user");
          // Update the username in the delete confirmation
          const deleteText = deleteModal.querySelector("span");
          deleteText.textContent = `"${username}"`;
          deleteModal.classList.remove("hidden");
        });
      });

      closeDeleteBtn.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
      });

      cancelDeleteBtn.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
      });

      // Close modals when clicking outside
      window.addEventListener("click", (e) => {
        if (e.target === addModal) {
          addModal.classList.add("hidden");
        }
        if (e.target === editModal) {
          editModal.classList.add("hidden");
        }
        if (e.target === deleteModal) {
          deleteModal.classList.add("hidden");
        }
      });
    </script>
  </body>
</html>
