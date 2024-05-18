<?php
use function Livewire\Volt\{state, rules};
use function Laravel\Folio\name;
use App\Models\User;
name('login');
state(['email', 'password']);
rules([
  'email' => 'required|email',
  'password' => 'required',
])->messages([
  'email.required' => 'Email is required',
  'email.email' => 'Email must be a valid email address',
  'password.required' => 'Password is required',
]);
$login = function () {
  $validatedData = $this->validate();
  $user = User::where('email', $validatedData['email'])->first();
  if ($user && Hash::check($validatedData['password'], $user->password)) {
    Auth::login($user);
    session()->flash('success', 'User logged in successfully');
    $this->redirect(route('dashboard'), navigate: true);
  }
}
?>
<x-app-layout title="Login">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-10 gap-4">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-4">
      @if(session()->has('success'))
      <x-alert title="Information" :description="session('success')" icon="o-check" class="mb-3" dismissible />
      @endif
      <x-form wire:submit="login">
        <x-input label="Email" type="email" wire:model="email" />
        <x-input label="Password" type="password" wire:model="password" />

        <x-button label="Login" type="submit" icon-right="o-user" class="btn-primary mt-2" spinner="login" />
      </x-form>

      <div class="mt-4">
        <a href="{{ route('register') }}" wire:navigate class="text-sm text-gray-500 hover:text-gray-700">Not registered? Register</a>
      </div>
    </div>
  </div>
  @endvolt
</x-app-layout>
