<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\User;
use Livewire\Component;

class MenuCounter extends Component
{
    public $user;
    public $menus = [];
    public $qty = [];

    public $form = [
        'nama' => '',
        'hp' => '',
        'tipe' => 'Dine In',
    ];

    protected $rules = [
        'form.nama' => ['required', 'regex:/^[A-Z][a-zA-Z\s]*$/'],
        'form.hp' => ['required', 'digits_between:10,15', 'regex:/^[0-9]+$/'],
        'form.tipe' => ['required', 'in:Dine In,Take Away'],
    ];

    protected $messages = [
        'form.nama.required' => 'Nama pemesan wajib diisi.',
        'form.nama.regex' => 'Gunakan huruf saja dan huruf pertama harus kapital.',
        'form.hp.required' => 'Nomor HP wajib diisi.',
        'form.hp.regex' => 'Nomor HP hanya boleh angka.',
        'form.hp.digits_between' => 'Nomor HP harus 10–15 digit.',
        'form.tipe.required' => 'Silakan pilih tipe pesanan.',
    ];

    public function mount(User $user)
    {
        $this->user = $user;

        // Ambil semua menu milik user berdasarkan user_id dan status 'available'
        $this->menus = Menu::where('user_id', $user->id)
            ->where('status', 'available')
            ->get();
    }

    public function tambah($menuId)
    {
        $this->qty[$menuId] = ($this->qty[$menuId] ?? 0) + 1;
    }

    public function kurangi($menuId)
    {
        $this->qty[$menuId] = max(($this->qty[$menuId] ?? 0) - 1, 0);
    }

    public function getTotalProperty()
    {
        return $this->menus->reduce(function ($total, $menu) {
            $harga = $menu->discount_price ?? $menu->price;
            $jumlah = $this->qty[$menu->id] ?? 0;
            return $total + ($harga * $jumlah);
        }, 0);
    }

    public function kirimPesanan()
    {
        $this->validate();

        // Filter hanya menu yang dipesan
        $pesanan = collect($this->menus)
            ->filter(fn($menu) => ($this->qty[$menu->id] ?? 0) > 0);

        if ($pesanan->isEmpty()) {
            $this->dispatch('swal', [
                'title' => 'Belum ada menu yang dipilih',
                'text' => 'Silakan pilih minimal 1 menu sebelum memesan.',
                'icon' => 'warning',
            ]);
            return;
        }

        // Susun pesan WhatsApp
        $pesan = "Halo, saya ingin memesan dari {$this->user->name}:\n\n";

        foreach ($pesanan as $menu) {
            $jumlah = $this->qty[$menu->id];
            $harga = $menu->discount_price ?? $menu->price;
            $total = $harga * $jumlah;
            $pesan .= "- {$menu->title} x{$jumlah} = Rp" . number_format($total, 0, ',', '.') . "\n";
        }

        $pesan .= "\nTotal: *Rp" . number_format($this->total, 0, ',', '.') . "*";
        $pesan .= "\n\n📋 *Data Pemesan:*\n";
        $pesan .= "👤 Nama: {$this->form['nama']}\n";
        $pesan .= "📱 Nomor HP: {$this->form['hp']}\n";
        $pesan .= "🍽️ Tipe Pesanan: {$this->form['tipe']}";

        $encoded = urlencode($pesan);
        $nomorWA = '6282234278342';

        $this->dispatch('open-wa', url: "https://wa.me/{$nomorWA}?text={$encoded}");
    }

    public function render()
    {
        return view('livewire.menu-counter');
    }
}
