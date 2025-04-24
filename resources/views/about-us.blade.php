<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - SounDeal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi fade-in */
        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Animasi khusus untuk beberapa bagian */
        .slide-in-left {
            transform: translateX(-50px);
        }
        
        .slide-in-right {
            transform: translateX(50px);
        }
        
        .slide-in-left.visible,
        .slide-in-right.visible {
            transform: translateX(0);
        }
        
        /* Delay untuk animasi berurutan */
        .delay-100 {
            transition-delay: 100ms;
        }
        .delay-200 {
            transition-delay: 200ms;
        }
        .delay-300 {
            transition-delay: 300ms;
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar User -->
    <div id="navbar-placeholder"></div>

    <!-- Konten Utama -->
    <div class="pt-16">
        <!-- Hero Section Tentang Kami -->
        <div class="bg-amber-400 text-white py-16 fade-in">
            <div class="container mx-auto px-6 text-center">
                <h1 class="text-4xl font-bold mb-4">Tentang SounDeal</h1>
                <p class="text-xl max-w-3xl mx-auto">Lebih dari sekadar toko, kami juga komunitas pecinta musik</p>
            </div>
        </div>

        <!-- Sejarah Toko -->
        <div class="container mx-auto px-6 py-12">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/2 max-w-lg mx-auto fade-in slide-in-left"> 
                    <img src="https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" 
                        alt="Sejarah Toko" 
                        class="rounded-lg shadow-lg w-full h-auto">
                </div>
                <div class="md:w-1/2 fade-in slide-in-right delay-100">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Sejarah Kami</h2>
                    <p class="text-gray-600 mb-4">SounDeal didirikan pada tahun 2023 oleh sekelompok orang yang ingin menciptakan tempat dimana setiap orang bisa menemukan alat musik berkualitas dengan harga terjangkau.</p>
                    <p class="text-gray-600">Dari sebuah toko kecil di pusat kota, kami telah berkembang menjadi salah satu distributor alat musik terpercaya di Indonesia, melayani ribuan pelanggan dari berbagai kalangan.</p>
                </div>
            </div>
        </div>

        <!-- Visi Misi -->
        <div class="bg-gray-50 py-12">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12 fade-in">
                    <h2 class="text-3xl font-bold text-gray-800">Visi & Misi Kami</h2>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Dasar dari segala yang kami lakukan</p>
                </div>
                
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="bg-white p-8 rounded-lg shadow-md fade-in delay-100">
                        <div class="text-amber-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Visi</h3>
                        <p class="text-gray-600">Menjadi pusat alat musik terkemuka di Indonesia yang tidak hanya menjual produk, tetapi juga membangun komunitas musisi yang saling mendukung dan menginspirasi.</p>
                    </div>
                    
                    <div class="bg-white p-8 rounded-lg shadow-md fade-in delay-200">
                        <div class="text-amber-400 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Misi</h3>
                        <ul class="text-gray-600 space-y-2">
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Menyediakan alat musik berkualitas dengan harga kompetitif</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Mendukung perkembangan musik lokal melalui berbagai program</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="h-5 w-5 text-green-500 mr-2 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Memberikan pelayanan terbaik dan pengetahuan musik kepada pelanggan</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tim Kami -->
        <div class="container mx-auto px-6 py-12">
            <div class="text-center mb-12 fade-in">
                <h2 class="text-3xl font-bold text-gray-800">Tim Kami</h2>
                <p class="text-gray-600 mt-2">Orang-orang yang membuat semua ini mungkin</p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden fade-in delay-100">
                    <img src="img/Foto Almamater Andro.png" alt="Tim Kami" class="w-full h-72 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Andro Lay</h3>
                        <p class="text-amber-400">Fullstack Developer</p>
                        <p class="text-gray-600 mt-2">Spesialis alat musik tiup dengan pengetahuan produk yang luas.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden fade-in delay-200">
                    <img src="img/Christian.jpg" alt="Tim Kami" class="w-full h-72 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Christian Somba</h3>
                        <p class="text-amber-400">Fullstack Developer</p>
                        <p class="text-gray-600 mt-2">Ahli dalam alat musik perkusi dan teknologi musik digital.</p>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden fade-in delay-300">
                    <img src="img/Naftali.jpg" alt="Tim Kami" class="w-full h-72 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800">Naftali Sumendap</h3>
                        <p class="text-amber-400">Fullstack Developer</p>
                        <p class="text-gray-600 mt-2">Selalu siap membantu dengan senyuman dan solusi terbaik.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nilai-nilai -->
        <div class="bg-amber-400 text-white py-12 fade-in">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold mb-4">Nilai-nilai Kami</h2>
                    <p class="text-xl max-w-3xl mx-auto">Prinsip yang memandu setiap keputusan dan tindakan kami</p>
                </div>
                
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center p-6 fade-in delay-100">
                        <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Kualitas</h3>
                        <p>Kami berkomitmen menjual produk dengan standar kualitas tinggi.</p>
                    </div>
                    
                    <div class="text-center p-6 fade-in delay-200">
                        <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Komunitas</h3>
                        <p>Kami percaya musik adalah tentang berbagi dan tumbuh bersama.</p>
                    </div>
                    
                    <div class="text-center p-6 fade-in delay-300">
                        <div class="bg-white bg-opacity-20 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">Integritas</h3>
                        <p>Kejujuran dan transparansi dalam setiap transaksi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Footer -->
  <div id="footer-placeholder"></div>

<script>
    // Intersection Observer untuk animasi scroll
    document.addEventListener('DOMContentLoaded', function() {
        const fadeElements = document.querySelectorAll('.fade-in');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });
        
        fadeElements.forEach(element => {
            observer.observe(element);
        });
    });


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

</body>
</html>
</body>
</html>