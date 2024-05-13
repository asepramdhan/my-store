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
?>
<x-dashboard-layout title="Create Category">
  @volt
  <div>
    <x-form wire:submit="store">
      <x-input label="Name" wire:model.lazy="name" />
      <x-input label="slug" wire:model="slug" readonly />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('category')" />
        <x-button label="Create" class="btn-primary" type="submit" spinner="store" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
