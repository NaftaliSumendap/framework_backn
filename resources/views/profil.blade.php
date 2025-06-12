<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Alat Musik</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<!-- Navbar User -->
<x-navbar></x-navbar>

<!-- Profile Content -->
<body> 
  <div class="mt-20 bg-white rounded-lg shadow-sm p-6">
    <div class="flex flex-col md:flex-row mb-[51px]">
      <!-- Left Side - Profile Image -->
      <div class="md:w-1/3 mb-6 md:mb-0">
        <h2 class="text-lg font-medium text-gray-700 mb-4">Profil Pribadi</h2>
        <div class="flex flex-col items-center">
          <div class="w-40 h-40 bg-red-300 rounded-lg overflow-hidden mb-2">
            <img src="img/{{$user['image']}}" alt="Profile" class="w-full h-full object-cover">
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
                <span class="text-gray-700 mr-2" id="nama-value">{{$user['name']}}</span>
                <button onclick="openModal('Nama', 'nama-value', 'text')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Tanggal Lahir</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="tanggal-lahir-value">Belum diatur</span>
                <button onclick="openModal('Tanggal Lahir', 'tanggal-lahir-value', 'date')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Jenis Kelamin</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="jenis-kelamin-value">Belum diatur</span>
                <button onclick="openModal('Jenis Kelamin', 'jenis-kelamin-value', 'select', ['Laki-laki', 'Perempuan'])" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Alamat</span>
                <div class="flex items-center">
                  <span class="text-gray-700 mr-2" id="alamat-value">{{$user['address']}}</span>
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
                <span class="text-gray-700 mr-2" id="email-value">{{$user['email']}}</span>
                <button onclick="openModal('Email', 'email-value', 'email')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
            <div class="flex items-center justify-between">
              <span class="text-gray-600">Nomor HP</span>
              <div class="flex items-center">
                <span class="text-gray-700 mr-2" id="nomor-hp-value">{{$user['phone']}}</span>
                <button onclick="openModal('Nomor HP', 'nomor-hp-value', 'tel')" class="text-amber-400 hover:text-amber-500 text-lg font-bold">&gt;</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- Penutup untuk flex container -->
  </div> <!-- Penutup untuk bg-white container -->

  <!-- Logout Confirmation Modal -->
  <div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
      <h3 class="text-lg font-semibold mb-4">Konfirmasi Keluar</h3>
      <p class="text-gray-700 mb-6">Apakah Anda yakin ingin keluar dari akun ini?</p>
      <div class="flex justify-end mt-4 space-x-2">
            <button onclick="hideLogoutConfirmation()" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded">Batal</button>
          <form id="logoutForm" method="POST" action="/logout">
            @csrf
            <button onclick="performLogout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Keluar</button>
          </form>
      </div>
    </div>
  </div>

    <!-- Modal Edit -->

  <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
  <div class="bg-white p-6 rounded-lg w-96">
    <h3 id="modalTitle" class="text-lg font-semibold mb-4"></h3>
    
    <form id="editForm" method="POST" action="{{ route('profile.update.ajax') }}">
      @csrf
      <input type="hidden" name="field" id="fieldName">
      <div id="inputContainer" class="mb-4"></div>
      <div class="flex justify-end gap-2">
        <button type="button" onclick="closeModal()" class="text-gray-600 hover:text-gray-900">Batal</button>
        <button type="submit" class="bg-amber-400 hover:bg-amber-500 text-white px-4 py-1 rounded">Simpan</button>
      </div>
    </form>
  </div>
</div>

</body>
<!-- Footer -->
<x-footer></x-footer>
</html>

<script>
  document.getElementById('editForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const field = formData.get('field');
    const value = formData.get('value');

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        });
        const data = await response.json();
        if (data.success) {
            // Update tampilan profil secara langsung
            document.getElementById(field.replace('_', '-') + '-value').textContent = value;
            closeModal();
            alert('Profil berhasil diperbarui!');
        } else {
            alert(data.message || 'Gagal memperbarui profil.');
        }
    } catch (err) {
        alert('Terjadi kesalahan.');
    }
});

  let currentFieldId = null;
  let currentInputType = null;

  // Fungsi untuk buka modal dengan tipe input yang berbeda
function openModal(title, spanId, inputType, options = []) {
    const modal = document.getElementById('editModal');
    const modalTitle = document.getElementById('modalTitle');
    const inputContainer = document.getElementById('inputContainer');
    const fieldName = document.getElementById('fieldName');
    const currentValue = document.getElementById(spanId).textContent.trim();

    modalTitle.textContent = `Ubah ${title}`;
    fieldName.value = spanId.replace('-value', '').replace('-', '_');

    let inputHTML = '';
    if (inputType === 'textarea') {
        inputHTML = `<textarea name="value" class="w-full border rounded p-2" rows="3">${currentValue}</textarea>`;
    } else if (inputType === 'select') {
        inputHTML = `<select name="value" class="w-full border rounded p-2">
            ${options.map(opt => `<option value="${opt}" ${opt === currentValue ? 'selected' : ''}>${opt}</option>`).join('')}
        </select>`;
    } else {
        inputHTML = `<input type="${inputType}" name="value" value="${currentValue}" class="w-full border rounded p-2">`;
    }

    inputContainer.innerHTML = inputHTML;
    modal.classList.remove('hidden');
}

function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

  // Fungsi untuk melakukan logout
function performLogout() {
    document.getElementById('logoutForm').submit();
}
</script>
