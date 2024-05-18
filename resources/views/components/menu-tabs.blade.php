<?php
use function Livewire\Volt\{state};
use App\Models\Order;
state(['orders' => Order::all()]);
?>
<x-tab name="semua-tab">
  <x-slot:label>
    <a href="{{ route('orders') }}" wire:navigate>
      Semua
      @volt
      <x-badge value="{{ $orders->count() }}" class="badge-primary" />
      @endvolt
    </a>
  </x-slot:label>
</x-tab>
<x-tab name="belum-bayar-tab">
  <x-slot:label>
    <a href="{{ route('orders.belum-bayar') }}" wire:navigate>
      Belum Bayar
      @volt
      <x-badge value="{{ $orders->where('status', 0)->count() }}" class="badge-primary" />
      @endvolt
    </a>
  </x-slot:label>
</x-tab>
<x-tab name="perlu-diproses-tab">
  <x-slot:label>
    <a href="{{ route('orders.perlu-diproses') }}" wire:navigate>
      Perlu Diproses
      @volt
      <x-badge value="{{ $orders->where('status', 1)->count() }}" class="badge-primary" />
      @endvolt
    </a>
  </x-slot:label>
</x-tab>
<x-tab name="sedang-diproses-tab">
  <x-slot:label>
    <a href="{{ route('orders.sedang-diproses') }}" wire:navigate>
      Sedang Diproses
      @volt
      <x-badge value="{{ $orders->where('status', 2)->count() }}" class="badge-primary" />
      @endvolt
    </a>
  </x-slot:label>
</x-tab>
<x-tab name="dikirim-tab">
  <x-slot:label>
    <a href="{{ route('orders.dikirim') }}" wire:navigate>
      Dikirim
      @volt
      <x-badge value="{{ $orders->where('status', 3)->count() }}" class="badge-primary" />
      @endvolt
    </a>
  </x-slot:label>
</x-tab>
