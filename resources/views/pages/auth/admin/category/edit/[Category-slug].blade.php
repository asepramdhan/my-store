<?php
use function Livewire\Volt\{state, mount, rules, updated};
state(['category', 'name', 'slug']);
mount(function () {
  $this->name = $this->category->name;
  $this->slug = $this->category->slug;
});
rules([
  'name' => 'required|min:3',
  'slug' => 'required',
])->messages([
  'name.min' => 'Name must be at least 3 characters',
  'slug.required' => 'Slug is required',
]);
updated(['name' => fn () => $this->slug = Str::slug($this->name) . '-' . Str::random(5)]);
$update = function () {
  $validatedData = $this->validate();
  $this->category->update($validatedData);
  session()->flash('success', 'Category updated successfully');
  $this->redirect(route('category'), navigate: true);
}
?>
<x-dashboard-layout title="Edit Category">
  @volt
  <div>
    <x-form wire:submit="update">
      <x-input label="Name" wire:model.lazy="name" />
      <x-input label="slug" wire:model="slug" readonly />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('category')" />
        <x-button label="Update" class="btn-success" type="submit" spinner="update" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
