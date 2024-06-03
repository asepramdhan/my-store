<?php
use function Livewire\Volt\{state, mount, rules};
state(['user', 'name', 'is_admin',
'users' => [
  [
    'id' => 1,
    'name' => 'Admin',
  ],
  [
    'id' => 0,
    'name' => 'User',
  ],
]
]);
mount(function () {
  $this->name = $this->user->name;
  $this->is_admin = $this->user->is_admin;
});
rules([
  'name' => 'required|min:3',
  'is_admin' => 'required',
])->messages([
  'name.min' => 'Name must be at least 3 characters',
  'is_admin.required' => 'Role is required',
]);
$update = function () {
  $validatedData = $this->validate();
  dd($validatedData);
  $this->user->update($validatedData);
  session()->flash('success', 'User updated successfully');
  $this->redirect(route('users'), navigate: true);
}
?>
<x-dashboard-layout title="Edit User">
  @volt
  <div>
    <x-form wire:submit="update">
      <x-input label="Name" wire:model="name" />
      <x-select label="Role" :options="$users" wire:model="is_admin" />

      <x-slot:actions>
        <x-button label="Cancel" :link="route('users')" />
        <x-button label="Update" class="btn-success" type="submit" spinner="update" />
      </x-slot:actions>
    </x-form>
  </div>
  @endvolt
</x-dashboard-layout>
