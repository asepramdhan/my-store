<?php
use function Livewire\Volt\{state, with, usesPagination, on};
use function Laravel\Folio\name;
use App\Models\Order;
name('orders');
usesPagination();
with(fn () => ['orders' => Order::with('product', 'shipment', 'payment')->paginate(10)]);
state(['selectedTab' => 'semua-tab',
'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'image', 'label' => 'Image', 'class' => 'h-20 w-full md:h-full md:w-20'],
    ['key' => 'name', 'label' => 'Title'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'quantity', 'label' => 'QTY'],
    ['key' => 'total', 'label' => 'Total', 'class' => 'truncate'],
    ['key' => 'status', 'label' => 'Status'],
    ['key' => 'actions', 'label' => 'Actions']
  ],
]);
$cancel = function ($id) {
Order::find($id)->update(['status' => 4]);
$this->dispatch('orders');
};
on(['orders' => function () {
  $this->orders = Order::all();
}])
?>
<x-dashboard-layout title="Semua Order">
  @volt
  <div>
    <x-tabs wire:model="selectedTab">
      <x-menu-tabs />
    </x-tabs>
    @if($orders->count() == 0)
    <div class="text-center text-slate-500 text-xl my-52">
      <p>There is no order</p>
    </div>
    @else
    <x-table :headers="$headers" :rows="$orders" striped with-pagination>
      @scope('cell_id', $order)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_image', $order)
      <img src="{{ asset('storage/' . $order->product->image) }}" />
      @endscope
      @scope('cell_name', $order)
      {{ $order->product->name }}
      @endscope
      @scope('cell_price', $order)
      {{ number_format($order->product->price) }}
      @endscope
      @scope('cell_total', $order)
      <p class="text-slate-500 text-sm">{{ $order->shipment->name }}</p>
      {{ number_format($order->product->price * $order->quantity + $order->shipment->price) }}
      @endscope
      @scope('cell_status', $order)
      @if($order->status == 0)
      <p class="text-slate-500 text-sm">{{ $order->payment->name }}</p>
      <span class="text-red-500 truncate">Belum Bayar</span>
      @elseif($order->status == 1)
      <p class="text-slate-500 text-sm">{{ $order->payment->name }}</p>
      <span class="text-green-400 truncate">Perlu Diproses</span>
      @elseif($order->status == 2)
      <p class="text-slate-500 text-sm">{{ $order->payment->name }}</p>
      <span class="text-green-600 truncate">Sedang Diproses</span>
      @elseif($order->status == 3)
      <p class="text-slate-500 text-sm">{{ $order->payment->name }}</p>
      <span class="text-green-800 truncate">Dikirim</span>
      @elseif($order->status == 4)
      <p class="text-slate-500 text-sm">{{ $order->payment->name }}</p>
      <span class="text-red-800 truncate">Dibatalkan</span>
      @endif
      @endscope

      @scope('cell_actions', $order)
      <div class="flex gap-2">
        <x-button label='Detail' class="btn-sm" link="/auth/admin/orders/detail/{{ $order->order_number }}" />
        <x-button label='Cancel' wire:click="cancel({{ $order->id }})" wire:confirm='Are you sure?' class="btn-sm" />
      </div>
      @endscope
    </x-table>
    @endif
  </div>
  @endvolt
</x-dashboard-layout>
