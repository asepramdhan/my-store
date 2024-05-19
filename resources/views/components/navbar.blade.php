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
      <div>My Store</div>
    </x-slot:brand>
    <x-slot:actions>
      @auth
      <x-dropdown>
        <x-slot:trigger>
          <x-button icon="o-shopping-cart" class="btn-ghost btn-sm text-slate-100 hover:text-slate-200 relative">
            <x-badge value="2" class="badge-error absolute -right-2 -top-2 badge-sm" />
          </x-button>
        </x-slot:trigger>
        <div class="p-2 w-40">
          <p class="text-slate-500">8 items</p>
          <p class="text-info">Subtotal: 20.000</p>
          <x-button label="View Cart" link="#" class="btn-primary btn-block btn-sm mt-2" />
        </div>
      </x-dropdown>
      <x-dropdown>
        <x-slot:trigger>
          <x-button label="Welcome, {{ Auth::user()->name }}" icon="o-user" class="btn-ghost btn-sm" responsive />
        </x-slot:trigger>

        <x-menu-item title="Dashboard" icon="o-home" class="text-slate-700 hover:text-slate-900" :link="route('dashboard')" />
        <x-menu-item title="Logout" icon="o-arrow-right-on-rectangle" class="text-slate-700 hover:text-slate-900" wire:click="logout" />
      </x-dropdown>
      @else
      <x-button label="Login" icon="o-user" :link="route('login')" class="btn-ghost btn-sm" responsive />
      <x-button label="Register" icon="o-user-plus" :link="route('register')" class="btn-ghost btn-sm" responsive />
      @endauth
    </x-slot:actions>
  </x-nav>
  @endvolt
</div>
