<div class="bg-white w-full max-w-md rounded-xl shadow-lg p-6 pb-28 relative justify-center mx-auto">
    <!-- Avatar dan nama user -->
    <div class="flex justify-center mb-2">
        <img src="{{ asset('storage/' . $user->avatar_url) }}" alt="{{ $user->name }}"
            class="w-14 h-14 rounded-full object-cover shadow" />
    </div>

    <h2 class="text-md font-bold text-center text-gray-800 mb-2">
        🛒 Form Order <span class="text-[#ec008d]">{{ strtoupper($user->name) }}</span>
    </h2>

    <!-- Form Pemesan -->
    <section class="mb-4 p-4 bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="space-y-4">
            {{-- Nama Pemesan --}}
            <div class="relative">
                <label class="block text-gray-700 font-semibold mb-2">Nama Pemesan</label>
                <div class="relative">
                    <!-- Icon user -->
                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 peer-focus:text-green-500"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>

                    <!-- Input -->
                    <input wire:model.lazy="form.nama" type="text" placeholder="Masukkan nama kamu"
                        oninput="this.value = this.value
                .replace(/[^a-zA-Z\s]/g, '')
                .replace(/\b\w/g, c => c.toUpperCase())"
                        class="peer w-full rounded-xl border bg-white pl-10 pr-4 py-3 text-gray-700
                   shadow-sm placeholder-gray-400 transition-all duration-150 ease-in-out
                   focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400
                   @error('form.nama')
border-red-400 focus:ring-red-300
@else
border-gray-300
@enderror" />
                </div>

                @error('form.nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Nomor HP --}}
            {{-- <div>
                <label class="block text-gray-700 font-medium mb-1">Nomor HP</label>
                <input wire:model.lazy="form.hp" type="text" placeholder="081234567890"
                    oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="15"
                    class="w-full border rounded-md px-3 py-2 focus:ring-2 focus:ring-green-400
                    @error('form.hp') border-red-400 focus:ring-red-300 @else border-gray-300 @enderror" />
                @error('form.hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div> --}}

            {{-- Tipe Pesanan --}}
            <div class="relative">
                <label class="block text-gray-700 font-semibold mb-2">Tipe Pesanan</label>
                <div class="relative">
                    <select wire:model.lazy="form.tipe"
                        class="peer w-full appearance-none rounded-xl border bg-white px-4 py-3 pr-10 text-gray-700
                   shadow-sm transition-all duration-150 ease-in-out
                   focus:outline-none focus:ring-2 focus:ring-green-400 focus:border-green-400
                   @error('form.tipe') border-red-400 focus:ring-red-300 @else border-gray-300 @enderror">
                        <option value="Dine In">🍽️ Dine In</option>
                        <option value="Take Away">🥡 Take Away</option>
                    </select>

                    <!-- Icon dropdown -->
                    <svg class="pointer-events-none absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-gray-400 peer-focus:text-green-500"
                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                @error('form.tipe')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>
    </section>


    <!-- Daftar Menu -->
    <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
        @foreach ($menus as $menu)
            @php
                $hargaAsli = $menu->price;
                $hargaDiskon = $menu->discount_price;
                $harga = $hargaDiskon ?? $hargaAsli;
                $imageUrl = $menu->getFirstMediaUrl('menus') ?: asset('images/no-image.png');
            @endphp

            <div
                class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col p-3">

                {{-- Gambar Menu --}}
                <div class="relative w-full flex justify-center mb-2">
                    <img src="{{ $imageUrl }}" alt="{{ $menu->title }}"
                        class="object-cover rounded-full w-20 h-20 sm:w-24 sm:h-24 transition-transform duration-300 group-hover:scale-105">

                    @if ($hargaDiskon)
                        <span
                            class="absolute top-0 left-1 bg-yellow-400 text-white text-[10px] font-semibold px-2 py-1 rounded-full shadow">
                            Diskon
                        </span>
                    @endif
                </div>

                {{-- Konten --}}
                <div class="flex flex-col justify-between flex-1 text-center">
                    <div>
                        <h4 class="font-bold text-gray-800 text-sm sm:text-base mb-1 leading-tight">
                            {{ $menu->title }}
                        </h4>

                        @if ($menu->description)
                            <p class="text-[11px] text-gray-500 line-clamp-2">{{ $menu->description }}</p>
                        @endif
                    </div>

                    {{-- Harga --}}
                    <div class="mt-2">
                        @if ($hargaDiskon)
                            <p class="text-xs text-gray-400 line-through">
                                Rp{{ number_format($hargaAsli, 0, ',', '.') }}
                            </p>
                        @endif
                        <p class="text-base font-extrabold text-gray-600">
                            Rp{{ number_format($harga, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- Tombol jumlah --}}
                    <div class="flex items-center justify-center gap-3 mt-3">
                        <button wire:click="kurangi({{ $menu->id }})"
                            class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-green-600 transition">
                            <span class="text-sm font-bold">−</span>
                        </button>

                        <span
                            class="font-bold text-lg w-8 text-center select-none {{ ($qty[$menu->id] ?? 0) > 0 ? 'text-green-500' : 'text-green-400' }}">
                            {{ $qty[$menu->id] ?? 0 }}
                        </span>

                        <button wire:click="tambah({{ $menu->id }})"
                            class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-green-600 transition">
                            <span class="text-sm font-bold">+</span>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>




    <!-- Ringkasan -->
    <div
        class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-gradient-to-r from-green-500 to-emerald-600 text-white shadow-xl rounded-2xl px-6 py-3 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 z-50 max-w-md w-[90%] transition-all duration-300">

        {{-- Total --}}
        <p class="text-lg sm:text-xl font-semibold text-center sm:text-left">
            Total:
            <span class="text-yellow-300 font-extrabold text-2xl ml-1">
                Rp{{ number_format($this->total, 0, ',', '.') }}
            </span>
        </p>

        {{-- Tombol Kirim --}}
        <button wire:click="kirimPesanan"
            class="bg-white text-green-600 font-bold px-6 py-2 rounded-lg hover:bg-green-50 hover:scale-105 active:scale-95 transition-all duration-200 shadow-md w-full sm:w-auto">
            Kirim Pesanan 🚀
        </button>
    </div>


    <script>
        window.addEventListener('open-wa', e => window.open(e.detail.url, '_blank'));
        window.addEventListener('alert', e => alert(e.detail.message));
    </script>
</div>
