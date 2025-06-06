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
      id="editModal"
      class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
    >
      <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Edit User</h2>
        <form id="editForm" method="POST" action="" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="mb-4">
            <label for="editUsername" class="block text-gray-700">Username</label>
            <input type="text" id="editUsername" name="name" class="w-full px-3 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label for="editEmail" class="block text-gray-700">Email</label>
            <input type="email" id="editEmail" name="email" class="w-full px-3 py-2 border rounded" required />
          </div>
          <div class="mb-4">
            <label for="editRole" class="block text-gray-700">Role</label>
            <select id="editRole" name="role" class="w-full px-3 py-2 border rounded" required>
              <option value="admin">Admin</option>
              <option value="kasir">User</option>
            </select>
          </div>
          <div class="flex justify-end gap-2">
            <button
              type="button"
              class="cancel-edit-btn border text-gray-800 px-4 py-2 rounded hover:bg-gray-100"
            >
              Batal
            </button>
            <button
              type="submit"
              class="bg-amber-400 text-white px-4 py-2 rounded hover:bg-amber-500"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div
    id="deleteModal"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden"
  >
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Konfirmasi Hapus</h2>
      <p class="mb-6 text-gray-700">Apakah kamu yakin ingin menghapus user <span id="deleteUserName" class="font-bold"></span>?</p>
      <form id="deleteForm" method="POST" action="dashboard/users/{{ $user->id }}">
        @csrf
        @method('DELETE')
        <div class="flex justify-end gap-2">
          <button
            type="button"
            class="cancel-delete-btn bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400"
          >
            Batal
          </button>
          <button
            type="submit"
            class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600"
          >
            Hapus
          </button>
        </div>
      </form>
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
            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative my-2" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif
            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative my-2" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif
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
                @foreach ($users as $user)
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2">
                    <img
                      src="../img/{{$user['image']}}"
                      class="w-8 h-8 rounded-full object-cover"
                      alt="Profile"
                    />
                  </td>
                  <td>{{$user['name']}}</td>
                  <td>{{$user['name']}}</td>
                  <td>{{$user['email']}}</td>
                  <td>
                    <span
                      class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full"
                      >{{$user['role']}}</span
                    >
                  </td>
                  <td class="space-x-2">
                  <button
                    class="edit-btn bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}"
                    data-email="{{ $user->email }}"
                    data-role="{{ $user->role }}"
                    type="button"
                  >
                    <i class="bx bxs-edit"></i>
                  </button>
                  <button
                    class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                    data-id="{{ $user->id }}"
                    data-name="{{ $user->name }}" 
                  >
                    <i class="bx bxs-trash"></i>
                  </button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </main>
      </div>
    </div>

<script>
  // Toggle sidebar
  document.getElementById("toggleSidebar")?.addEventListener("click", () => {
    document.getElementById("sidebar")?.classList.toggle("hidden");
  });

  document.addEventListener("DOMContentLoaded", () => {
    const editButtons = document.querySelectorAll(".edit-btn");
    const editModal = document.getElementById("editModal");
    const editForm = document.getElementById("editForm");
    const editUsername = document.getElementById("editUsername");
    const editEmail = document.getElementById("editEmail");
    const editRole = document.getElementById("editRole");
    const cancelEditBtn = editModal.querySelector(".cancel-edit-btn");

    editButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const id = button.getAttribute("data-id");
        const username = button.getAttribute("data-name");
        const email = button.getAttribute("data-email");
        const role = button.getAttribute("data-role");

        editForm.action = `/dashboard/users/${id}`;
        editUsername.value = username;
        editEmail.value = email;
        editRole.value = role;

        editModal.classList.remove("hidden");
      });
    });

    cancelEditBtn.addEventListener("click", () => {
      editModal.classList.add("hidden");
    });

    window.addEventListener("click", (e) => {
      if (e.target === editModal) {
        editModal.classList.add("hidden");
      }
    });
  });
  document.addEventListener("DOMContentLoaded", () => {
    const deleteButtons = document.querySelectorAll(".delete-btn");
    const deleteModal = document.getElementById("deleteModal");
    const deleteUserName = document.getElementById("deleteUserName");
    const deleteForm = document.getElementById("deleteForm");
    const cancelDeleteBtn = deleteModal.querySelector(".cancel-delete-btn");

    deleteButtons.forEach((button) => {
      button.addEventListener("click", () => {
        const userId = button.getAttribute("data-id");
        const name = button.getAttribute("data-name");

        deleteUserName.textContent = `"${name}"`;
        deleteForm.action = `/dashboard/users/${userId}`;
        deleteModal.classList.remove("hidden");
      });
    });

    cancelDeleteBtn.addEventListener("click", () => {
      deleteModal.classList.add("hidden");
    });

    window.addEventListener("click", (e) => {
      if (e.target === deleteModal) {
        deleteModal.classList.add("hidden");
      }
    });
  });
</script>

  </body>
</html>
