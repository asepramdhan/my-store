<?php
use function Livewire\Volt\{state, with};
use function Laravel\Folio\name;
use App\Models\Order;
state([]);
with(fn () => ['orders' => Order::where('user_id', auth()->user()->id)->get()]);
name('payment');
?>
<x-app-layout title="Payment">
  @volt
  <div>
    Halaman Pembayaran
  </div>
  @endvolt
</x-app-layout>
