<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Konsumen dan Penjual</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar User -->
    <x-navbar></x-navbar>

    <!-- Chat Section -->
    <div class="container mx-auto flex-1 flex flex-col pt-20 pb-8">
        <div class="flex h-[70vh] bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Kontak -->
            <div class="w-1/4 bg-gray-50 border-r px-0 py-4 flex flex-col">
                <h3 class="font-bold mb-4 px-6 text-lg text-amber-500">Kontak</h3>
                <div class="flex-1 overflow-y-auto">
                    @foreach($contacts as $contact)
                        <a href="{{ route('chat', $contact->id) }}"
                        class="flex items-center py-3 px-6 rounded-l-full transition-all duration-150 mb-1
                        {{ isset($receiver) && $receiver->id == $contact->id ? 'bg-amber-100 font-semibold text-amber-600' : 'hover:bg-gray-100 text-gray-700' }}">
                            <img src="{{ asset('img/' . ($contact->image ?? 'default.png')) }}"
                                alt="Foto {{ $contact->name }}"
                                class="w-8 h-8 rounded-full object-cover mr-3 border border-gray-300">
                            <span>{{ $contact->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
            <!-- Chat Box -->
            <div class="w-3/4 flex flex-col">
                <div class="border-b px-8 py-4 bg-gray-50">
                    <h2 class="text-xl font-bold text-gray-800">Chat dengan {{ $receiver->name ?? '...' }}</h2>
                </div>
                <div id="chatBox" class="flex-1 bg-white px-8 py-6 overflow-y-auto space-y-2">
                    @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                            <div class="
                                px-4 py-2 rounded-2xl max-w-xs break-words shadow
                                {{ $msg->sender_id == auth()->id()
                                    ? 'bg-amber-400 text-white rounded-br-none'
                                    : 'bg-gray-200 text-gray-800 rounded-bl-none'
                                }}">
                                <div>{{ $msg->message }}</div>
                                <div class="text-xs text-gray-400 mt-1 text-right">{{ $msg->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if(isset($receiver))
                <form action="{{ route('chat.send') }}" method="POST" class="flex items-center gap-2 border-t px-8 py-4 bg-gray-50">
                    @csrf
                    <input type="hidden" name="receiver_id" value="{{ $receiver->id }}">
                    <input type="text" name="message" autocomplete="off" placeholder="Ketik pesan..." class="flex-grow px-4 py-2 border rounded-full focus:outline-none focus:ring-2 focus:ring-amber-400 bg-white" required>
                    <button class="px-6 py-2 bg-amber-400 text-white rounded-full font-semibold hover:bg-amber-500 transition">Kirim</button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <x-footer></x-footer>

    <script>
        // Scroll otomatis ke bawah saat halaman dimuat
        window.onload = function() {
            var chatBox = document.getElementById('chatBox');
            if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
        }
    </script>
</body>
</html>