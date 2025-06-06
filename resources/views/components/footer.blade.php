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