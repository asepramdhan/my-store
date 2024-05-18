<?php
use function Livewire\Volt\{state, rules};
use function Laravel\Folio\name;
use App\Models\User;
name('register');
state(['name', 'email', 'password']);
rules([
  'name' => 'required|min:3',
  'email' => 'required|email',
  'password' => 'required|min:6',
])->messages([
  'name.required' => 'Name is required',
  'name.min' => 'Name must be at least 3 characters',
  'email.required' => 'Email is required',
  'email.email' => 'Email must be a valid email address',
  'password.required' => 'Password is required',
  'password.min' => 'Password must be at least 6 characters',
]);
$register = function () {
  $validatedData = $this->validate();
  $validatedData['password'] = Hash::make($validatedData['password']);
  User::create($validatedData);
  session()->flash('success', 'User created successfully');
  $this->redirect(route('login'), navigate: true);
}
?>
<x-app-layout title="Register">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-10 gap-4">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-4">
      <x-form wire:submit="register">
        <x-input label="Name" wire:model="name" />
        <x-input label="Email" type="email" wire:model="email" />
        <x-input label="Password" type="password" wire:model="password" />

        <x-button label="Register" type="submit" icon-right="o-user-plus" class="btn-primary mt-2" spinner="register" />
      </x-form>

      <div class="mt-4">
        <a href="{{ route('login') }}" wire:navigate class="text-sm text-gray-500 hover:text-gray-700">Already registered? Login</a>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
