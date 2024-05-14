<?php
use function Livewire\Volt\{state, rules, updated};
use function Laravel\Folio\name;
use App\Models\Category;
name('category.create');
state(['name', 'slug']);
rules([
  'name' => 'required|min:3',
  'slug' => 'required',
])->messages([
  'name.required' => 'Name is required',
  'name.min' => 'Name must be at least 3 characters',
  'slug.required' => 'Slug is required',
]);
updated(['name' => fn () => $this->slug = Str::slug($this->name) . '-' . Str::random(5)]);
$store = function () {
  $validatedData = $this->validate();
  Category::create($validatedData);
  session()->flash('success', 'Category created successfully');
  $this->redirect(route('category'), navigate: true);
};
$storeNewCategory = function () {
  $validatedData = $this->validate();
  Category::create($validatedData);
  session()->flash('success', 'Category created successfully');
  $this->reset();
};
?>
<x-dashboard-layout title="Create Category">
  @volt
  <div>
    <x-form>
      <x-input label="Name" wire:model.lazy="name" autofocus />
      <x-input label="slug" wire:model="slug" readonly />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('category')" />
        <x-button label="Create & New Category" wire:click="storeNewCategory" class="btn-secondary" spinner="storeNewCategory" />
        <x-button label="Create" wire:click="store" class="btn-primary" spinner="store" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
