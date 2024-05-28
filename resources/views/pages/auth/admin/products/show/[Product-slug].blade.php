<?php
use function Livewire\Volt\{state};
use App\Models\Product;
state(['product']);
$delete = function ($id) {
  // buat kondisi untuk menghapus gambar jika ada
  if (Product::find($id)->image) {
    Storage::disk('public')->delete(Product::find($id)->image);
  }
  Product::find($id)->delete();
  $this->redirect(route('products'), navigate: true);
};
?>
<x-dashboard-layout title="{{ $product->name }}">
  @volt
  <div>
    <h4 class="text-2xl mb-3">{{ $product->name }}</h4>
    <x-button label="Back to Products" :link="route('products')" icon="o-arrow-left" class="btn-sm btn-success me-1" />
    <x-button label="Edit" link="/auth/products/edit/{{ $product->slug }}" icon="o-pencil" class="btn-sm btn-warning me-1" />
    <x-button label="Delete" icon="o-trash" wire:click='delete({{ $product->id }})' wire:confirm='Are you sure?' class="btn-sm btn-error" />
    <img src="{{ asset('storage/' . $product->image) }}" class="h-96 rounded-lg my-5" />
    {!! $product->description !!}
  </div>
  @endvolt
</x-dashboard-layout>
