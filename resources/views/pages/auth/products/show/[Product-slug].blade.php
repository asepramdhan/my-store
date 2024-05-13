<?php
use function Livewire\Volt\{state};
use App\Models\Product;
state(['product', 'deleteModal' => false,]);
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
    <x-button label="Back to Products" :link="route('products')" icon="o-arrow-left" class="btn-sm btn-success" />
    <x-button label="Edit" link="/auth/products/edit/{{ $product->slug }}" icon="o-pencil" class="btn-sm btn-warning" />
    <x-button label="Delete" icon="o-trash" @click="$wire.deleteModal = true" class="btn-sm btn-danger" />
    <img src="{{ asset('storage/' . $product->image) }}" class="h-96 rounded-lg my-5" />
    {!! $product->description !!}
    <x-modal wire:model="deleteModal" class="backdrop-blur" class="text-center">
      <div class="mb-5">Apakah anda yakin ingin menghapus produk ini?</div>
      <x-button label="Cancel" @click="$wire.deleteModal = false" />
      <x-button label="Delete" @click="$wire.deleteModal = false; $wire.delete({{ $product->id }})" />
    </x-modal>
  </div>
  @endvolt
</x-dashboard-layout>
