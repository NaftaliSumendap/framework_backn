<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Musik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

    <!-- Navbar User -->
    <div id="navbar-placeholder"></div>

<!-- Profile Content -->
<div class="mt-20 bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row">
      <!-- Left Side - Profile Image -->
      <div class="md:w-1/3 mb-6 md:mb-0">
        <h2 class="text-lg font-medium text-gray-700 mb-4">Profil Pribadi</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 bg-red-300 rounded-lg overflow-hidden mb-2">
            <img src="img/Foto Almamater Andro.png" alt="Profile" class="w-full h-full object-cover">
          </div>
          <button class="bg-white text-gray-700 border border-gray-300 rounded-md px-4 py-2 text-sm mt-2 w-full">Pilih Foto</button>
          <!-- Logout Button -->
          <button onclick="showLogoutConfirmation()" class="bg-red-500 hover:bg-red-600 text-white rounded-md px-4 py-2 text-sm mt-4 w-full transition-colors duration-200">
            Keluar
          </button>
        </div>
      </div>
  
      <!-- Right Side - Personal Information -->
      <div class="md:w-2/3 md:pl-8">
        <div class="mb-8">
          <h2 class="text-lg font-medium text-gray-700 mb-4">Biodata Diri</h2>
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Nama</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="nama-value">Andro Lay</span>
                <button onclick="openModal('Nama', 'nama-value', 'text')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Tanggal Lahir</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="tanggal-lahir-value">25 April 2005</span>
                <button onclick="openModal('Tanggal Lahir', 'tanggal-lahir-value', 'date')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Jenis Kelamin</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="jenis-kelamin-value">Laki-laki</span>
                <button onclick="openModal('Jenis Kelamin', 'jenis-kelamin-value', 'select', ['Laki-laki', 'Perempuan'])" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Alamat</span>
                <div class="flex items-center">
                  <span class="text-gray-700 mr-2" id="alamat-value">Paal dua</span>
                  <button onclick="openModal('Alamat', 'alamat-value', 'textarea')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
                </div>
              </div>
          </div>
        </div>
  
        <div>
          <h2 class="text-lg font-medium text-gray-700 mb-4">Kontak</h2>
          <div class="space-y-4">
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Email</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="email-value">androlay30@gmail.com</span>
                <button onclick="openModal('Email', 'email-value', 'email')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Nomor HP</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="nomor-hp-value">62895397323281</span>
                <button onclick="openModal('Nomor HP', 'nomor-hp-value', 'tel')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Penutup untuk flex container -->
  </div> <!-- Penutup untuk bg-white container -->
 
  <!-- Footer -->
  <div id="footer-placeholder"></div>

  <!-- Modal Edit -->
  <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Ubah <span id="modalFieldName">Data</span></h3>
      <div id="modalInputContainer">
        <!-- Input field will be inserted here dynamically -->
      </div>
      <div class="flex justify-end mt-4 space-x-2">
        <button onclick="closeModal()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</button>
        <button onclick="saveModal()" class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-2 rounded">Simpan</button>
      </div>
    </div>
  </div>

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Konfirmasi Keluar</h3>
      <p class="text-gray-700 mb-6">Apakah Anda yakin ingin keluar dari akun ini?</p>
      <div class="flex justify-end mt-4 space-x-2">
        <button onclick="hideLogoutConfirmation()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</button>
        <button onclick="performLogout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Keluar</button>
      </div>
    </div>
  </div>

</body>
</html>

<script>
  let currentFieldId = null;
  let currentInputType = null;

  // Fungsi untuk buka modal dengan tipe input yang berbeda
  function openModal(fieldName, fieldId, inputType, options = null) {
    document.getElementById("modalFieldName").innerText = fieldName;
    const currentValue = document.getElementById(fieldId).innerText;
    const inputContainer = document.getElementById("modalInputContainer");
    inputContainer.innerHTML = '';
    
    currentFieldId = fieldId;
    currentInputType = inputType;
    
    if (inputType === 'textarea') {
      // Textarea untuk alamat
      const textarea = document.createElement('textarea');
      textarea.className = 'w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-amber-400';
      textarea.rows = 4;
      textarea.value = currentValue;
      inputContainer.appendChild(textarea);
    } else if (inputType === 'select' && options) {
      // Select dropdown untuk jenis kelamin
      const select = document.createElement('select');
      select.className = 'w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-amber-400';
      
      options.forEach(option => {
        const optElement = document.createElement('option');
        optElement.value = option;
        optElement.textContent = option;
        if (option === currentValue) optElement.selected = true;
        select.appendChild(optElement);
      });
      
      inputContainer.appendChild(select);
    } else {
      // Input standar untuk tipe lainnya
      const input = document.createElement('input');
      input.type = inputType === 'date' ? 'date' : 
                  inputType === 'email' ? 'email' : 
                  inputType === 'tel' ? 'tel' : 'text';
      input.className = 'w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-amber-400';
      input.value = currentValue;
      inputContainer.appendChild(input);
    }
    
    document.getElementById("editModal").classList.remove("hidden");
  }

  // Fungsi untuk simpan perubahan
  function saveModal() {
    const inputContainer = document.getElementById("modalInputContainer");
    let newValue = '';
    
    if (currentInputType === 'textarea') {
      newValue = inputContainer.querySelector('textarea').value;
    } else if (currentInputType === 'select') {
      newValue = inputContainer.querySelector('select').value;
    } else {
      newValue = inputContainer.querySelector('input').value;
    }
    
    if (currentFieldId) {
      document.getElementById(currentFieldId).innerText = newValue;
    }
    closeModal();
  }

  // Fungsi tutup modal
  function closeModal() {
    document.getElementById("editModal").classList.add("hidden");
    currentFieldId = null;
    currentInputType = null;
  }

  // Fungsi untuk menampilkan konfirmasi logout
  function showLogoutConfirmation() {
    document.getElementById("logoutModal").classList.remove("hidden");
  }

  // Fungsi untuk menyembunyikan konfirmasi logout
  function hideLogoutConfirmation() {
    document.getElementById("logoutModal").classList.add("hidden");
  }

  // Fungsi untuk melakukan logout
  function performLogout() {
    // Di sini Anda bisa menambahkan logika logout seperti:
    // - Membersihkan session/local storage
    // - Redirect ke halaman login
    alert("Anda telah berhasil logout");
    window.location.href = "/sign-in"; // Ganti dengan halaman login Anda
  }

      fetch("html/navbar.html")
        .then((res) => res.text())
        .then((data) => {
          const navbarDiv = document.getElementById("navbar-placeholder");
          navbarDiv.innerHTML = data;

          // Setelah navbar dimuat, jalankan fungsi toggle
          attachNavbarEvents();
        });

      function attachNavbarEvents() {
        const toggleBtn = document.getElementById("toggleMenu");
        const mobileMenu = document.getElementById("mobileMenu");

        if (toggleBtn && mobileMenu) {
          toggleBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
          });
        } else {
          console.warn("Element toggleMenu atau mobileMenu tidak ditemukan");
        }
      }
  // Fungsi untuk memuat footer
  function loadFooter() {
    fetch('html/footer.html')
      .then(response => response.text())
      .then(data => {
        document.getElementById('footer-placeholder').innerHTML = data;
      })
      .catch(error => {
        console.error('Error loading footer:', error);
        document.getElementById('footer-placeholder').innerHTML = `
          <footer class="bg-slate-800 text-white text-center p-4">
            <p>© ${new Date().getFullYear()} Toko Alat Musik</p>
          </footer>
        `;
      });
  }

  // Panggil fungsi saat halaman selesai dimuat
  document.addEventListener('DOMContentLoaded', loadFooter);

</script>