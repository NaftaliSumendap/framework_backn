<footer class="bg-slate-800 shadow-md mt-8">
    <div class="container mx-auto px-6 py-8">
      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
        <div>
          <h3 class="text-lg font-semibold text-white">Tentang Kami</h3>
          <p class="mt-2 text-slate-300">
            Toko Alat Musik terbaik dengan kualitas terjamin.
          </p>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-white">Layanan</h3>
          <ul class="mt-2 text-slate-300">
            <li>
              <a href="/about-us" class="hover:text-amber-400"
                >Tentang Kami</a
              >
            </li>
            <li>
              <a href="/term" class="hover:text-amber-400"
                >Panduan Belanja</a
              >
            </li>
            <li>
              <a href="/privacy" class="hover:text-amber-400"
                >Kebijakan Privasi</a
              >
            </li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-white">Hubungi Kami</h3>
          <ul class="mt-2 text-slate-300">
            <li>Email: SounDeal@gmail.com</li>
            <li>Telepon: +62123456789</li>
          </ul>
        </div>
        <div>
          <h3 class="text-lg font-semibold text-white">Ikuti Kami</h3>
          <div class="mt-2 flex space-x-4">
            <a
              href="https://facebook.com"
              class="text-slate-300 hover:text-amber-400"
              >Facebook</a
            >
            <a
              href="https://twitter.com"
              class="text-slate-300 hover:text-amber-400"
              >Twitter</a
            >
            <a
              href="https://instagram.com"
              class="text-slate-300 hover:text-amber-400"
              >Instagram</a
            >
          </div>
        </div>
      </div>
    </div>
  </footer>
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

      attachNavbarEvents();
</script>