<?php
use function Livewire\Volt\{state, with};
use function Laravel\Folio\name;
use App\Models\Order;
name('dashboard');
state([]);
with(fn () => ['orders' => Order::all()]);
?>
<x-dashboard-layout>
  @volt
  <div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <a href="{{ route('orders.belum-bayar') }}" wire:navigate>
        <x-stat title="Belum Bayar" :value="$orders->where('status', 0)->count()" icon="o-exclamation-circle" tooltip-bottom="Belum Bayar" class="drop-shadow-md bg-slate-200 py-12" />
      </a>
      <a href="{{ route('orders.perlu-diproses') }}" wire:navigate>
        <x-stat title="Perlu Diproses" :value="$orders->where('status', 1)->count()" icon="o-clock" tooltip-bottom="Perlu Diproses" class="drop-shadow-md bg-slate-200 py-12" />
      </a>
      <a href="{{ route('orders.sedang-diproses') }}" wire:navigate>
        <x-stat title="Sedang Diproses" :value="$orders->where('status', 2)->count()" icon="o-gift-top" tooltip-bottom="Sedang Diproses" class="drop-shadow-md bg-slate-200 py-12" />
      </a>
      <a href="{{ route('orders.dikirim') }}" wire:navigate>
        <x-stat title="Dikirim" :value="$orders->where('status', 3)->count()" icon="o-truck" tooltip-bottom="Dikirim" class="drop-shadow-md bg-slate-200 py-12" />
      </a>
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
