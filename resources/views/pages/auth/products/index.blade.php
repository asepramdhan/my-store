<?php
use function Livewire\Volt\{state, on};
use function Laravel\Folio\name;
use App\Models\Product;
name('products');
state([
  'products' => Product::all(),
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'image', 'label' => 'Image'],
    ['key' => 'name', 'label' => 'Title'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'stock', 'label' => 'Stock'],
  ],
  'deleteModal' => false,
]);
$delete = function ($id) {
  // buat kondisi untuk menghapus gambar jika ada
  if (Product::find($id)->image) {
    Storage::disk('public')->delete(Product::find($id)->image);
  }
  Product::find($id)->delete();
  $this->dispatch('products');
};
on(['products' => function () {
  $this->products = Product::all();
}]);
?>
<x-dashboard-layout title="Products">
  @volt
  <div>
    <div class="text-end">
      <x-button label="Add Product" icon="o-plus" class="btn-sm btn-primary mb-3" :link="route('products.create')" />
    </div>
    @if(session()->has('success'))
    <div class="mb-3">
      <x-alert title="Information" :description="session('success')" icon="o-check" shadow dismissible />
    </div>
    @endif
    <x-table :headers="$headers" :rows="$products" striped>
      @scope('cell_id', $product)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_image', $product)
      <img src="{{ asset('storage/' . $product->image) }}" class="h-20 rounded-lg" />
      @endscope
      @scope('actions', $product)
      <div class="flex gap-2">
        <x-button icon="o-eye" class="btn-sm" link="/auth/products/show/{{ $product->slug }}" />
        <x-button icon="o-pencil" class="btn-sm" link="/auth/products/edit/{{ $product->slug }}" />
        <x-button icon="o-trash" @click="$wire.deleteModal = true" class="btn-sm" />
      </div>
      <x-modal wire:model="deleteModal" class="backdrop-blur" class="text-center">
        <div class="mb-5">Apakah anda yakin ingin menghapus produk ini?</div>
        <x-button label="Cancel" @click="$wire.deleteModal = false" />
        <x-button label="Delete" @click="$wire.deleteModal = false; $wire.delete({{ $product->id }})" />
      </x-modal>
      @endscope
    </x-table>
  </div>
  @endvolt
</x-dashboard-layout>
