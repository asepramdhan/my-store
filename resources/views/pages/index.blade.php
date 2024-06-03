<?php
use function Livewire\Volt\{state, with};
use function Laravel\Folio\name;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;
name('home');
state([]);
with(fn () => ['products' => Product::all()]);
$cart = function ($id) {
  // buat fungsi jika user klik cart tapi belum login
  if (! auth()->check()) {
    session()->flash('error', 'Please login first');
    $this->redirect(route('login'), navigate: true);
  } else {
    $cart = Cart::where('user_id', auth()->user()->id)->where('product_id', $id)->first();
    if ($cart) {
      $cart->increment('quantity');
      Cart::where('user_id', auth()->user()->id)->where('product_id', $id)->update(['total' => $cart->product->price * $cart->quantity]);
      $this->redirect(route('home'), navigate: true);
    } else {
      Cart::create([
        'user_id' => auth()->user()->id,
        'product_id' => $id,
        'quantity' => 1,
        'total' => Product::find($id)->price,
      ]);
      $this->redirect(route('home'), navigate: true);
    }
  }
};
?>
<x-app-layout title="Home">
  @volt
  <div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      @foreach ($products as $product)
      <x-card>
        <x-slot:title class="text-sm">
          {{ $product->name }}
        </x-slot:title>
        Rp. {{ number_format($product->price) }}

        <x-slot:figure>
          <img src="{{ asset('storage/' . $product->image) }}" />
        </x-slot:figure>
        <x-slot:menu>
          <x-button wire:click="cart({{ $product->id }})" icon-right="o-shopping-cart" class="btn-ghost btn-circle btn-sm" />
        </x-slot:menu>
        <x-slot:actions>
          <x-button label="Beli Sekarang" link="/auth/checkout/{{ $product->id }}" icon-right="o-shopping-bag" class="btn-block btn-primary btn-sm my-2" />
        </x-slot:actions>
      </x-card>
      @endforeach
    </div>
  </div>
  @endvolt
</x-app-layout>
