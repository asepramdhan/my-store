<?php
use function Livewire\Volt\{state, rules, updated, usesFileUploads};
use function Laravel\Folio\name;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
name('products.create');
usesFileUploads();
state(['image', 'name', 'slug', 'category_id' => "1", 'description', 'price', 'stock', 'categories' => Category::all()]);
rules([
  'image' => 'image|file|max:1024',
  'name' => 'required|min:3',
  'slug' => 'required',
  'category_id' => 'required',
  'description' => 'required',
  'price' => 'required',
  'stock' => 'required',
])->messages([
  'image.image' => 'Image must be an image',
  'image.file' => 'Image must be an image',
  'image.max' => 'Image must be less than 1MB',
  'name.required' => 'Name is required',
  'name.min' => 'Name must be at least 3 characters',
  'slug.required' => 'Slug is required',
  'category_id.required' => 'Category is required',
  'description.required' => 'Description is required',
  'price.required' => 'Price is required',
  'stock.required' => 'Stock is required',
]);
updated(['name' => fn () => $this->slug = Str::slug($this->name) . '-' . Str::random(5)]);
$store = function () {
  $validatedData = $this->validate();
  $validatedData['image'] = $this->image->store('images/products');
  Product::create($validatedData);
  session()->flash('success', 'Product created successfully');
  $this->redirect(route('products'), navigate: true);
}
?>
<x-dashboard-layout title="Create Product">
  @volt
  <div>
    <x-form wire:submit="store">
      <x-file wire:model="image" accept="image/png, image/jpeg">
        <img src="{{ '/image/default.jpg' }}" class="h-40 rounded-lg" />
      </x-file>
      <x-input label="Name" wire:model.lazy="name" />
      <x-input label="slug" wire:model="slug" readonly />
      <x-select label="Category" :options="$categories" wire:model="category_id" />
      <x-editor wire:model="description" label="Description" hint="The full product description" disk="public" folder="images" />
      <x-input label="Price" wire:model="price" />
      <x-input label="Stock" wire:model="stock" />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('products')" />
        <x-button label="Create" class="btn-primary" type="submit" spinner="store" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
