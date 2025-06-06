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
    <div id="addProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Tambah Produk Baru</h3>
          <button id="closeAddModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
      <div>
        <div class="max-w-xl w-full mx-auto bg-white p-6 rounded shadow-lg max-h-[90vh] overflow-y-auto">
          <form 
              action="/dashboard/store" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-4"
          >
            @csrf
            <div>
              <label class="block font-semibold mb-1">Gambar Produk</label>
              <input type="file" id="addProductImage" name="image" accept="image/*" class="w-full border p-2 rounded @error('image') border-red-500 @enderror" required>
              <img id="addProductImagePreview" src="#" alt="Preview Gambar" class="mt-2 rounded w-32 h-32 object-cover" style="display:none;">
              @error('image')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Nama Produk</label>
              <input type="text" name="name" class="w-full border p-2 rounded @error('name') border-red-500 @enderror" 
                    value="{{ old('name') }}" required>
              @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Harga</label>
              <input type="number" name="price" class="w-full border p-2 rounded @error('price') border-red-500 @enderror"
                    value="{{ old('price') }}" required>
              @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Harga Diskon (Opsional)</label>
              <input type="number" name="discount_price" class="w-full border p-2 rounded @error('discount_price') border-red-500 @enderror"
                    value="{{ old('discount_price') }}">
              @error('discount_price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Stok</label>
              <input type="number" name="stock" class="w-full border p-2 rounded @error('stock') border-red-500 @enderror"
                    value="{{ old('stock') }}" required>
              @error('stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Merek (Opsional)</label>
              <input type="text" name="brand" class="w-full border p-2 rounded @error('brand') border-red-500 @enderror"
                    value="{{ old('brand') }}">
              @error('brand')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Spesifikasi (Opsional)</label>
              <textarea name="specifications" class="w-full border p-2 rounded @error('specifications') border-red-500 @enderror"
                        rows="3">{{ old('specifications') }}</textarea>
              @error('specifications')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Deskripsi</label>
              <textarea name="description" class="w-full border p-2 rounded @error('description') border-red-500 @enderror"
                        rows="3" required>{{ old('description') }}</textarea>
              @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block font-semibold mb-1">Kategori</label>
              <select name="category_id" class="w-full border p-2 rounded @error('category_id') border-red-500 @enderror" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
              @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex items-center gap-2">
              <input type="checkbox" name="is_featured" value="1" class="accent-amber-400"
                    {{ old('is_featured') ? 'checked' : '' }}>
              <label class="font-medium">Tandai sebagai produk unggulan</label>
            </div>

            <div class="flex justify-end gap-4">
              <button type="submit" class="px-4 py-2 bg-amber-400 text-white rounded hover:bg-amber-500" :disabled="isLoading">
                <span x-show="!isLoading">Tambahkan</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>


    <!-- Edit Product Modal -->
    <div id="editProductModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
      <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-xl font-bold">Edit Produk</h3>
          <button id="closeEditModal" class="text-gray-500 hover:text-gray-700">
            <i class="bx bx-x text-2xl"></i>
          </button>
        </div>
        <form id="edit-form" method="POST" enctype="multipart/form-data" action="">
          @csrf
          @method('PUT')
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Gambar Produk</label>
            <div
              class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center"
            >
              <img
                src="../img/"
                alt="Current Product"
                class="mx-auto mb-2 h-20 object-cover"
              />
              <p class="text-gray-500">
                Drag & drop gambar baru atau klik untuk memilih
              </p>
              <input type="file" class="hidden" id="editProductImage" />
              <button
                name="image"
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
              name="name"
              type="text"
              value="Keyboard Yamaha"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Harga</label>
            <input
              name="discount_price"
              type="number"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-4">
            <label class="block text-gray-700 mb-2">Stok</label>
            <input
              name ="stock"
              type="number"
              value="10"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            />
          </div>
          <div class="mb-6">
            <label class="block text-gray-700 mb-2">Kategori</label>
            <select
            name="category_id"
              class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-400"
            >
              @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
              @endforeach
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
            <span class="font-semibold"></span>?
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
          <form id="delete-form" method="POST" enctype="multipart/form-data" action="">
            @csrf
            @method('DELETE')
          <button
            type="submit"
            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
          >
            Hapus Produk
          </button>
          </form>
        </div>
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
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
                    data-price="{{ $product->discount_price }}"
                    data-stock="{{ $product->stock }}"
                    data-category="{{ $product->category->name }}"
                    data-description="{{ $product->description }}"
                    data-image="{{ $product->image_path }}"
                  >
                    <i class="bx bxs-edit"></i>
                  </button>

                  <button 
                    class="delete-btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600"
                    data-id="{{ $product->id }}"
                    data-name="{{ $product->name }}"
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
  // Auto-remove alert
  setTimeout(() => {
    document.querySelectorAll('[role="alert"]').forEach(el => el.remove());
  }, 1000);

  // Helper untuk toggle modal
  function setupModal({ openBtnId, modalId, closeBtnId, cancelBtnId }) {
    const openBtn = document.getElementById(openBtnId);
    const modal = document.getElementById(modalId);
    const closeBtn = document.getElementById(closeBtnId);
    const cancelBtn = document.getElementById(cancelBtnId);

    if (openBtn && modal) {
      openBtn.addEventListener("click", () => {
        modal.classList.remove("hidden");
        modal.classList.add("flex");
      });
    }

    [closeBtn, cancelBtn].forEach(btn => {
      if (btn && modal) {
        btn.addEventListener("click", () => {
          modal.classList.add("hidden");
          modal.classList.remove("flex");
        });
      }
    });

    // Close modal when clicking outside
    if (modal) {
      window.addEventListener("click", (e) => {
        if (e.target === modal) {
          modal.classList.add("hidden");
          modal.classList.remove("flex");
        }
      });
    }
  }

  // Sidebar toggle
  const toggleSidebar = document.getElementById("toggleSidebar");
  toggleSidebar?.addEventListener("click", () => {
    document.getElementById("sidebar")?.classList.toggle("hidden");
  });

  // Setup Modals
  setupModal({ openBtnId: "openAddProduct", modalId: "addProductModal", closeBtnId: "closeAddModal", cancelBtnId: "cancelAdd" });
  setupModal({ openBtnId: "openLogoutModal", modalId: "logoutModal", closeBtnId: "cancelLogout", cancelBtnId: "cancelLogout" });

  // ESC key close modals
  window.addEventListener("keydown", (e) => {
    if (e.key === "Escape") {
      ["addProductModal", "editProductModal", "deleteProductModal", "logoutModal"].forEach(id => {
        const modal = document.getElementById(id);
        if (modal && !modal.classList.contains("hidden")) {
          modal.classList.add("hidden");
          modal.classList.remove("flex");
        }
      });
    }
  });

  // Edit Product Modal
  const editModal = document.getElementById("editProductModal");
  const closeEdit = document.getElementById("closeEditModal");
  const cancelEdit = document.getElementById("cancelEdit");

  if (editModal) {
    const editForm = document.getElementById("edit-form");
    const editButtons = document.querySelectorAll(".edit-btn");

    editButtons.forEach(button => {
      button.addEventListener("click", () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = button.dataset.price;
        const stock = button.dataset.stock;
        const category = button.dataset.category;
        const image = button.dataset.image;

        if (editForm) editForm.action = `/products/${id}`;
        editModal.querySelector('input[name="name"]').value = name;
        editModal.querySelector('input[name="discount_price"]').value = price;
        editModal.querySelector('input[name="stock"]').value = stock;
        editModal.querySelector('select[name="category_id"]').value = category;
        editModal.querySelector("img").src = `/img/${image}`;

        editModal.classList.remove("hidden");
        editModal.classList.add("flex");
      });
    });

    [closeEdit, cancelEdit].forEach(btn => {
      btn?.addEventListener("click", () => {
        editModal.classList.add("hidden");
        editModal.classList.remove("flex");
      });
    });

    // Close on click outside
    window.addEventListener("click", (e) => {
      if (e.target === editModal) {
        editModal.classList.add("hidden");
        editModal.classList.remove("flex");
      }
    });
  }

  // Delete Product Modal
  const deleteModal = document.getElementById("deleteProductModal");
  const closeDelete = document.getElementById("closeDeleteModal");
  const cancelDelete = document.getElementById("cancelDelete");
  const deleteForm = document.getElementById("delete-form");

  if (deleteModal) {
    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach(button => {
      button.addEventListener("click", () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        deleteModal.querySelector("span").textContent = `"${name}"`;
        if (deleteForm) deleteForm.action = `/products/${id}`;
        deleteModal.classList.remove("hidden");
        deleteModal.classList.add("flex");
      });
    });

    [closeDelete, cancelDelete].forEach(btn => {
      btn?.addEventListener("click", () => {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("flex");
      });
    });

    // Click outside to close
    window.addEventListener("click", (e) => {
      if (e.target === deleteModal) {
        deleteModal.classList.add("hidden");
        deleteModal.classList.remove("flex");
      }
    });
  }
  document.addEventListener("DOMContentLoaded", () => {
  const imageInput = document.getElementById("addProductImage");
  const previewImg = document.getElementById("addProductImagePreview");

  if (imageInput && previewImg) {
    imageInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewImg.src = e.target.result;
          previewImg.style.display = "block";
        };
        reader.readAsDataURL(file);
      } else {
        previewImg.src = "#";
        previewImg.style.display = "none";
      }
    });
  }
});
</script>

  </body>
</html>
