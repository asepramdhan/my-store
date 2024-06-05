<?php
use function Livewire\Volt\{state, with};
use App\Models\Product;
use App\Models\Cart;
state(['product']);
with(fn () => ['products' => Product::take(6)->get()]);
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
      $this->redirect(route('carts'), navigate: true);
    }
  }
};
?>
<x-app-layout title="{{ $product->name }}">
  @volt
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="col-span-1 md:col-span-3">
      <h4 class="text-2xl mb-3">{{ $product->name }}</h4>
      <img src="{{ asset('storage/' . $product->image) }}" class="h-auto rounded-lg my-5" />
      <div class="mb-3">
        <x-button label="Masuk keranjang" wire:click="cart({{ $product->id }})" icon-right="o-shopping-cart" class="btn-block btn-ghost mb-2 btn-sm" />
        <x-button label="Beli Sekarang" link="/auth/checkout/{{ $product->id }}" icon-right="o-shopping-bag" class="btn-block btn-primary btn-sm" />
      </div>
      {!! $product->description !!}
    </div>
    <div class="...">
      @foreach ($products->where('slug', '!=', $this->product->slug) as $product)
      <x-card>
        <x-slot:title class="text-sm">
          <a href="/show/{{ $product->slug }}" wire:navigate>{{ $product->name }}</a>
        </x-slot:title>
        Rp. {{ number_format($product->price) }}

        <x-slot:figure>
          <a href="/show/{{ $product->slug }}" wire:navigate>
            <img src="{{ asset('storage/' . $product->image) }}" />
          </a>
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
