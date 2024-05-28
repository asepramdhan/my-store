<?php
use function Livewire\Volt\{with, state, on, usesPagination};
use function Laravel\Folio\name;
use App\Models\Product;
usesPagination();
with(fn () => ['products' => Product::with('category')->paginate(10)]);
name('products');
state([
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'image', 'label' => 'Image', 'class' => 'h-20 w-full md:h-full md:w-20'],
    ['key' => 'name', 'label' => 'Title', 'class' => 'truncate'],
    ['key' => 'category_id', 'label' => 'Category'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'stock', 'label' => 'Stock'],
  ],
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
    @if($products->count() == 0)
    <div class="text-center text-slate-500 text-xl my-52">
      <p>There is no product</p>
    </div>
    @else
    <x-table :headers="$headers" :rows="$products" striped with-pagination>
      @scope('cell_id', $product)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_category_id', $product)
      {{ $product->category->name }}
      @endscope
      @scope('cell_image', $product)
      <img src="{{ asset('storage/' . $product->image) }}" />
      @endscope
      @scope('cell_price', $product)
      {{ number_format($product->price) }}
      @endscope
      @scope('actions', $product)
      <div class="flex gap-2">
        <x-button icon="o-eye" class="btn-sm" link="/auth/products/show/{{ $product->slug }}" />
        <x-button icon="o-pencil" class="btn-sm" link="/auth/products/edit/{{ $product->slug }}" />
        <x-button icon="o-trash" wire:click="delete({{ $product->id }})" wire:confirm='Are you sure?' class="btn-sm" />
      </div>
      @endscope
    </x-table>
    @endif
  </div>
  @endvolt
</x-dashboard-layout>
