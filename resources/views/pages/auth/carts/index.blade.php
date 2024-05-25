<?php
use function Livewire\Volt\{with, state, usesPagination};
use function Laravel\Folio\name;
use App\Models\Cart;
usesPagination();
with(fn () => ['carts' => Cart::with('product')->where('user_id', auth()->user()->id)->paginate(10)]);
name('carts');
state([
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'image', 'label' => 'Image', 'class' => 'h-20 w-full md:h-full md:w-20'],
    ['key' => 'name', 'label' => 'Title'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'quantity', 'label' => 'QTY'],
    ['key' => 'total', 'label' => 'Total', 'class' => 'truncate'],
  ],
]);
$delete = function ($id) {
  Cart::find($id)->delete();
  $this->redirect(route('carts'), navigate: true);
};
?>
<x-app-layout title="Carts">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-6 gap-4">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-2">
      @if(session()->has('success'))
      <div class="mb-3">
        <x-alert title="Information" :description="session('success')" icon="o-check" shadow dismissible />
      </div>
      @endif
      @if($carts->where('user_id', auth()->user()->id)->count() == 0)
      <div class="text-center text-slate-500 text-xl my-52">
        <p>There is no cart</p>
      </div>
      @else
      <x-table :headers="$headers" :rows="$carts" striped with-pagination>
        @scope('cell_id', $cart)
        <strong>{{ $this->loop->iteration }}</strong>
        @endscope
        @scope('cell_image', $cart)
        <img src="{{ asset('storage/' . $cart->product->image) }}" />
        @endscope
        @scope('cell_name', $cart)
        {{ $cart->product->name }}
        @endscope
        @scope('cell_price', $cart)
        {{ number_format($cart->product->price) }}
        @endscope
        @scope('cell_total', $cart)
        {{ number_format($cart->product->price * $cart->quantity) }}
        @endscope
        @scope('actions', $cart)
        <div class="flex gap-2">
          <x-button icon="o-trash" wire:click="delete({{ $cart->id }})" wire:confirm='Are you sure?' class="btn-sm" />
          <x-button icon="o-shopping-cart" class="btn-sm" link="/auth/checkout/{{ $cart->id }}" />
        </div>
        @endscope
      </x-table>
      <div class="flex justify-between my-3">
        <div>Total : {{ number_format($carts->sum('total')) }}</div>
        <x-button label="Checkout Semua" icon="o-shopping-cart" class="btn-sm btn-primary" :link="route('checkout')" />
      </div>
      @endif
    </div>
  </div>
  @endvolt
</x-app-layout>
