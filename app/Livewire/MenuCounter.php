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
        $total = 0;
        foreach ($this->menus as $menu) {
            $harga = $menu->discount_price ?? $menu->price;
            $total += $harga * ($this->qty[$menu->id] ?? 0);
        }
        return $total;
    }

    public function kirimPesanan()
    {
        if (!$this->form['nama'] || !$this->form['hp']) {
            $this->dispatch('alert', message: 'Mohon isi Nama dan Nomor HP terlebih dahulu.');
            return;
        }

        $pesan = "Halo, saya ingin memesan dari {$this->user->name}:\n\n";
        foreach ($this->menus as $menu) {
            $jumlah = $this->qty[$menu->id] ?? 0;
            if ($jumlah > 0) {
                $harga = $menu->discount_price ?? $menu->price;
                $pesan .= "- {$menu->title} x{$jumlah} = Rp" .
                    number_format($harga * $jumlah, 0, ',', '.') . "\n";
            }
        }

        $pesan .= "\nTotal: Rp" . number_format($this->total, 0, ',', '.');
        $pesan .= "\n\nData Pemesan:\nNama: *{$this->form['nama']}*\nNomor HP: {$this->form['hp']}\nTipe Pesanan: {$this->form['tipe']}";

        $encoded = urlencode($pesan);
        $nomorWA = '6282234278342';

        $this->dispatch('open-wa', url: "https://wa.me/{$nomorWA}?text={$encoded}");
    }

    public function render()
    {
        return view('livewire.menu-counter');
    }
}
