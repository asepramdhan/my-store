<?php
use function Livewire\Volt\{with, state, on, usesPagination};
use function Laravel\Folio\name;
use App\Models\User;
usesPagination();
name('users');
with(fn () => ['users' => User::paginate(10)]);
state([
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'is_admin', 'label' => 'Status'],
  ],
]);
$delete = function ($id) {
  User::find($id)->delete();
  $this->dispatch('users');
};
on(['users' => function () {
  $this->users = User::all();
}]);
?>
<x-dashboard-layout title="Users">
  @volt
  <div>
    {{-- <div class="text-end">
      <x-button label="Add User" icon="o-plus" class="btn-sm btn-primary mb-3" :link="route('category.create')" />
    </div> --}}
    @if(session()->has('success'))
    <div class="mb-3">
      <x-alert title="Information" :description="session('success')" icon="o-check" shadow dismissible />
    </div>
    @endif
    @if($users->count() == 0)
    <div class="text-center text-slate-500 text-xl my-52">
      <p>There is no user</p>
    </div>
    @else
    <x-table :headers="$headers" :rows="$users" striped with-pagination>
      @scope('cell_id', $user)
      <strong>{{ $this->loop->iteration }}</strong>
      @endscope
      @scope('cell_is_admin', $user)
      @if($user->is_admin)
      <p class="text-green-800 text-sm">Admin</p>
      @else
      <p class="text-slate-500 text-sm">User</p>
      @endif
      @endscope
      @scope('actions', $user)
      <div class="flex gap-2">
        <x-button icon="o-pencil" class="btn-sm" link="/auth/admin/users/edit/{{ $user->id }}" />
        <x-button icon="o-trash" wire:click="delete({{ $user->id }})" wire:confirm="Are you sure?" class="btn-sm" />
      </div>
      @endscope
    </x-table>
    @endif
  </div>
  @endvolt
</x-dashboard-layout>
