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
        <a href="{{ route('dashboard') }}" wire:navigate>Seller App</a>
      </div>
    </x-slot:brand>
    <x-slot:actions>
      <x-button wire:click="logout" label="Logout" icon-right="o-arrow-right-on-rectangle" class="btn-ghost btn-sm" responsive />
    </x-slot:actions>
  </x-nav>
  @endvolt
</div>
