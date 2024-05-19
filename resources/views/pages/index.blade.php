<?php
use function Livewire\Volt\{state, with};
use App\Models\Product;
state([]);
with(fn () => ['products' => Product::all()]);
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
          <x-button wire:click="beli_sekarang" icon-right="o-shopping-cart" class="btn-ghost btn-circle btn-sm" spinner="beli_sekarang" />
        </x-slot:menu>
        <x-slot:actions>
          <x-button label="Beli Sekarang" wire:click="beli_sekarang" icon-right="o-shopping-bag" class="btn-block btn-primary btn-sm my-2" spinner="beli_sekarang" />
        </x-slot:actions>
      </x-card>
      @endforeach
    </div>
  </div>
  @endvolt
</x-app-layout>
