<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Store - Panel Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css"
      rel="stylesheet"
    />
  </head>
  <body class="bg-gray-100 font-sans text-gray-800">
    <!-- Add Product Modal -->
    <div
      id="addProductModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Tambah Produk Baru</h3>
          <button id="closeAddModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Gambar Produk</label>
            <div
              class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
            >
              <i class="bx bx-cloud-upload text-4xl text-gray-400 mb-2"></i>
              <p class="text-gray-500">
                Drag & drop gambar atau klik untuk memilih
              </p>
              <input type="file" class="hidden" id="productImage" />
              <button
                type="button"
                onclick="document.getElementById('productImage').click()"
                class="mt-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm"
              >
                Pilih Gambar
              </button>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nama Produk</label>
            <input
              type="text"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Harga</label>
            <input
              type="number"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Stok</label>
            <input
              type="number"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 mb-2">Kategori</label>
            <select
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            >
              <option value="">Pilih Kategori</option>
              <option value="jajanan">Gitar</option>
              <option value="minuman">Keyboard</option>
              <option value="makanan">Drum</option>
              <option value="snack">Tradisional</option>
            </select>
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

    <!-- Edit Product Modal -->
    <div
      id="editProductModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Edit Produk</h3>
          <button id="closeEditModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Gambar Produk</label>
            <div
              class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
            >
              <img
                src="../img/piano.jpg"
                alt="Current Product"
                class="mx-auto mb-2 h-20 object-cover"
              />
              <p class="text-gray-500">
                Drag & drop gambar baru atau klik untuk memilih
              </p>
              <input type="file" class="hidden" id="editProductImage" />
              <button
                type="button"
                onclick="document.getElementById('editProductImage').click()"
                class="mt-2 bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-lg text-sm"
              >
                Pilih Gambar Baru
              </button>
            </div>
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Nama Produk</label>
            <input
              type="text"
              value="Keyboard Yamaha"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Harga</label>
            <input
              type="number"
              value="5000000"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Stok</label>
            <input
              type="number"
              value="10"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 mb-2">Kategori</label>
            <select
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            >
              <option value="">Pilih Kategori</option>
              <option value="gitar" selected>Gitar</option>
              <option value="keyboard">Keyboard</option>
              <option value="drum">Drum</option>
              <option value="tradisional">Tradisional</option>
            </select>
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
      id="deleteProductModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50"
    >
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Hapus Produk</h3>
          <button
            id="closeDeleteModal"
            class="text-gray-500 hover:text-gray-700"
          >
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <div class="mb-6">
          <p class="text-gray-700">
            Apakah Anda yakin ingin menghapus produk
            <span class="font-semibold">"Keyboard Yamaha"</span>?
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
            Hapus Produk
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
                href="/dashboard"
                class="flex items-center p-3 hover:text-amber-400"
                ><i class="bx bxs-dashboard mr-2"></i>Dashboard</a
              >
            </li>
            <li>
              <a
                href="/dashboard/store"
                class="flex items-center bg-gray-100 text-amber-400 p-3 rounded-full"
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
                class="flex items-center p-3 hover:text-amber-400"
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

        <!-- Page Content -->
        <main class="p-6">
          <div class="flex justify-between items-center mb-6">
            <div>
              <h1 class="text-2xl font-bold">Manajemen Produk</h1>
              <div class="text-sm text-gray-500">
                Dashboard > <span class="text-amber-400">Store</span>
              </div>
            </div>
            <button
              id="openAddProduct"
              class="flex items-center bg-amber-400 text-white px-4 py-2 rounded-full hover:bg-amber-500"
            >
              <i class="bx bx-plus mr-2"></i> Tambah Produk
            </button>
          </div>

          <!-- Product Table -->
          <div class="bg-white p-4 rounded shadow">
            <div class="flex justify-between items-center mb-4">
              <h3 class="text-lg font-semibold">Daftar Produk</h3>
              <div class="space-x-2 text-gray-500">
                <i class="bx bx-search"></i>
                <i class="bx bx-filter"></i>
              </div>
            </div>
            <table class="w-full text-left text-sm">
              <thead>
                <tr class="text-gray-600 border-b">
                  <th class="py-2">Nama Produk</th>
                  <th>Harga</th>
                  <th>Stok</th>
                  <th>Kategori</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($products as $product)
                <tr class="border-b hover:bg-gray-50">
                  <td class="py-2">{{$product['name']}}</td>
                  <td>Rp{{number_format($product['discount_price'], 0, ',', '.')}}</td>
                  <td>{{$product['stock']}}</td>
                  <td>{{ $product->category->name }}</td>
                  <td>{{ Str::limit($product['description'], 50) }}</td>
                  <td class="space-x-2">
                    <button
                      class="edit-btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600"
                      data-product="Keyboard Yamaha"
                    >
                      <i class="bx bxs-edit"></i>
                    </button>
                    <button
                      class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                      data-product="Keyboard Yamaha"
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
      document
        .getElementById("toggleSidebar")
        ?.addEventListener("click", () => {
          document.getElementById("sidebar")?.classList.toggle("hidden");
        });

      // Modal functionality
      const addModal = document.getElementById("addProductModal");
      const editModal = document.getElementById("editProductModal");
      const deleteModal = document.getElementById("deleteProductModal");

      // Add Product Modal
      const openAddBtn = document.getElementById("openAddProduct");
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

      // Edit Product Modal
      const editButtons = document.querySelectorAll(".edit-btn");
      const closeEditBtn = document.getElementById("closeEditModal");
      const cancelEditBtn = document.getElementById("cancelEdit");

      editButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const productName = button.getAttribute("data-product");
          // In a real app, you would fetch the product data here
          // For demo, we're just showing the modal with the product name
          editModal.classList.remove("hidden");
        });
      });

      closeEditBtn.addEventListener("click", () => {
        editModal.classList.add("hidden");
      });

      cancelEditBtn.addEventListener("click", () => {
        editModal.classList.add("hidden");
      });

      // Delete Product Modal
      const deleteButtons = document.querySelectorAll(".delete-btn");
      const closeDeleteBtn = document.getElementById("closeDeleteModal");
      const cancelDeleteBtn = document.getElementById("cancelDelete");

      deleteButtons.forEach((button) => {
        button.addEventListener("click", () => {
          const productName = button.getAttribute("data-product");
          // Update the product name in the delete confirmation
          const deleteText = deleteModal.querySelector("span");
          deleteText.textContent = `"${productName}"`;
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
