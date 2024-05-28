<?php
use function Livewire\Volt\{state};
state([]);
$logout = function () {
  Auth::logout();
  session()->flash('success', 'User logged out successfully');
  $this->redirect(route('login'), navigate: true);
}
?>
<div>
  @volt
  <x-nav class="bg-neutral text-neutral-content" sticky full-width>
    <x-slot:brand>
      <label for="main-drawer" class="lg:hidden mr-3">
        <x-icon name="o-bars-3" class="cursor-pointer" />
      </label>
      <div>
        @can('admin')
        <a href="{{ route('dashboard') }}" wire:navigate>Seller App</a>
        @else
        <a href="{{ route('home') }}" wire:navigate>Home</a>
        @endcan
      </div>
    </x-slot:brand>
    <x-slot:actions>
      <x-dropdown>
        <x-slot:trigger>
          <x-button icon="o-user" class="btn-ghost btn-sm" />
        </x-slot:trigger>

        <x-menu-item title="Profile" icon="o-user" class="text-slate-700 hover:text-slate-900" :link="route('profile')" />
        <x-menu-separator />
        <x-menu-item title="Logout" icon="o-arrow-right-on-rectangle" class="text-slate-700 hover:text-slate-900" wire:click="logout" />
      </x-dropdown>
    </x-slot:actions>
  </x-nav>
  @endvolt
</div>
