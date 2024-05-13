<?php
use function Livewire\Volt\{state, mount, rules, updated, usesFileUploads};
use App\Models\Category;
usesFileUploads();
state(['product', 'image', 'name', 'slug', 'category_id', 'description', 'price', 'stock', 'categories' => Category::all()]);
mount(function () {
  $this->name = $this->product->name;
  $this->slug = $this->product->slug;
  $this->category_id = $this->product->category_id;
  $this->description = $this->product->description;
  $this->price = $this->product->price;
  $this->stock = $this->product->stock;
});
rules([
  'name' => 'required|min:3',
  'slug' => 'required',
  'category_id' => 'required',
  'description' => 'required',
  'price' => 'required',
  'stock' => 'required',
])->messages([
  'name.min' => 'Name must be at least 3 characters',
  'slug.required' => 'Slug is required',
  'category_id.required' => 'Category is required',
  'description.required' => 'Description is required',
  'price.required' => 'Price is required',
  'stock.required' => 'Stock is required',
]);
updated(['name' => fn () => $this->slug = Str::slug($this->name) . '-' . Str::random(5)]);
$update = function () {
  $validatedData = $this->validate();
  if ($this->image == null) {
    $validatedData['image'] = $this->product->image;
  } else {
    // hapus gambar lama jika ada
    if ($this->product->image) {
      Storage::disk('public')->delete($this->product->image);
    }
    // simpan gambar baru
    $validatedData['image'] = $this->image->store('images/products');
  }
  $this->product->update($validatedData);
  session()->flash('success', 'Product updated successfully');
  $this->redirect(route('products'), navigate: true);
}
?>
<x-dashboard-layout title="Edit Product">
  @volt
  <div>
    <x-form wire:submit="update">
      <x-file wire:model="image" accept="image/png, image/jpeg">
        <img src="{{ asset('storage/' . $product->image) ? asset('storage/' . $product->image) : '/image/default.jpg' }}" class="h-40 rounded-lg" />
      </x-file>
      <x-input label="Name" wire:model.lazy="name" />
      <x-input label="slug" wire:model="slug" readonly />
      <x-select label="Category" :options="$categories" wire:model="category_id" />
      <x-editor wire:model="description" label="Description" hint="The full product description" disk="public" folder="images" />
      <x-input label="Price" wire:model="price" />
      <x-input label="Stock" wire:model="stock" />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('products')" />
        <x-button label="Update" class="btn-success" type="submit" spinner="update" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
