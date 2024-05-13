<?php
use function Livewire\Volt\{with, state, on, usesPagination};
use function Laravel\Folio\name;
use App\Models\Category;
usesPagination();
name('category');
with(fn () => ['categories' => Category::paginate(10)]);
state([
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'name', 'label' => 'Name'],
  ],
]);
$delete = function ($id) {
  Category::find($id)->delete();
  $this->dispatch('categories');
};
on(['categories' => function () {
  $this->categories = Category::all();
}]);
?>
<x-dashboard-layout title="Category">
  @volt
  <div>
    <div class="text-end">
      <x-button label="Add Category" icon="o-plus" class="btn-sm btn-primary mb-3" :link="route('category.create')" />
    </div>
    @if(session()->has('success'))
    <div class="mb-3">
      <x-alert title="Information" :description="session('success')" icon="o-check" shadow dismissible />
    </div>
    @endif
    @if($categories->count() == 0)
    <div class="text-center text-slate-500 text-xl my-52">
      <p>There is no category</p>
    </div>
    @else
    <x-table :headers="$headers" :rows="$categories" striped with-pagination>
      @scope('cell_id', $category)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('actions', $category)
      <div class="flex gap-2">
        <x-button icon="o-pencil" class="btn-sm" link="/auth/category/edit/{{ $category->slug }}" />
        <x-button icon="o-trash" wire:click="delete({{ $category->id }})" wire:confirm="Are you sure?" class="btn-sm" />
      </div>
      @endscope
    </x-table>
    @endif
  </div>
  @endvolt
</x-dashboard-layout>
