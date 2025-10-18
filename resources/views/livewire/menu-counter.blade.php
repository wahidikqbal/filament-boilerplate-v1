<div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 pb-28 relative justify-center mx-auto mt-8">
    <!-- Avatar dan nama user -->
    <div class="flex justify-center mb-4">
        <img src="{{ asset('images/MieGacoan.svg') }}" alt="{{ $user->name }}"
            class="w-16 h-16 rounded-full object-cover shadow" />
    </div>

    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">
        🛒 Form Order <span class="text-[#ec008d]">{{ strtoupper($user->name) }}</span>
    </h2>

    <!-- Form Pemesan -->
    <section class="mb-6 p-4 bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="space-y-4">
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nama Pemesan</label>
                <input wire:model="form.nama" type="text" placeholder="Nama Kamu"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-sky-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Nomor HP</label>
                <input wire:model="form.hp" type="text" placeholder="081234567890"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-sky-400" />
            </div>
            <div>
                <label class="block text-gray-700 font-medium mb-1">Tipe Pesanan</label>
                <select wire:model="form.tipe"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-sky-400">
                    <option>Dine In</option>
                    <option>Take Away</option>
                </select>
            </div>
        </div>
    </section>

    <!-- Daftar Menu -->
    <div>
        <h3 class="text-xl font-bold text-sky-500 mb-4 text-center">📋 Daftar Menu</h3>
        @if ($menus->count())
            <div class="grid grid-cols-2 gap-4">
                @foreach ($menus as $menu)
                    @php
                        $harga = $menu->discount_price ?? $menu->price;
                    @endphp
                    <div
                        class="bg-white text-center p-4 rounded-lg shadow-md hover:shadow-lg transition duration-200 flex flex-col items-center justify-between">
                        <h4 class="text-md font-semibold text-gray-800 mb-1">{{ $menu->title }}</h4>
                        @if ($menu->description)
                            <p class="text-xs text-gray-500 mb-1">{{ $menu->description }}</p>
                        @endif
                        <p class="text-sm text-gray-500 mb-3">
                            Rp{{ number_format($harga, 0, ',', '.') }}
                        </p>
                        <div class="flex items-center gap-3">
                            <button wire:click="kurangi({{ $menu->id }})"
                                class="bg-sky-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-sky-600">-</button>
                            <span
                                class="font-bold text-2xl w-8 text-center select-none {{ ($qty[$menu->id] ?? 0) > 0 ? 'text-blue-600' : 'text-gray-800' }}">
                                {{ $qty[$menu->id] ?? 0 }}
                            </span>
                            <button wire:click="tambah({{ $menu->id }})"
                                class="bg-sky-500 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-sky-600">+</button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-500">Belum ada menu untuk {{ $user->name }}.</p>
        @endif
    </div>

    <!-- Ringkasan -->
    <div
        class="fixed bottom-0 left-1/2 transform -translate-x-1/2 bg-white border-t shadow-md px-6 py-3 flex flex-col items-center z-50 max-w-md w-full">
        <p class="text-lg font-bold text-gray-900">
            Total:
            <span class="text-green-600 font-extrabold text-2xl">
                Rp{{ number_format($this->total, 0, ',', '.') }}
            </span>
        </p>
        <button wire:click="kirimPesanan"
            class="mt-2 bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-md transition w-full max-w-xs">
            Kirim Pesanan
        </button>
    </div>

    <script>
        window.addEventListener('open-wa', e => window.open(e.detail.url, '_blank'));
        window.addEventListener('alert', e => alert(e.detail.message));
    </script>
</div>
