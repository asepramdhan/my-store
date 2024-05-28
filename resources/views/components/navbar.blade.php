<?php
use function Livewire\Volt\{state, with};
use App\Models\Cart;
state([]);
with(fn () => ['cart' => Cart::with('product')->get()]);
$logout = function () {
  Auth::logout();
  session()->flash('success', 'User logged out successfully');
  $this->redirect(route('login'), navigate: true);
};
?>
<div>
  @volt
  <x-nav class="bg-neutral text-neutral-content" sticky full-width>
    <x-slot:brand>
      <div>
        <a href="{{ route('home') }}" wire:navigate>My Store</a>
      </div>
    </x-slot:brand>
    <x-slot:actions>
      @auth
      <x-dropdown>
        <x-slot:trigger>
          <x-button icon="o-shopping-cart" class="btn-ghost btn-sm text-slate-100 hover:text-slate-200 relative">
            <x-badge :value="$cart->where('user_id', auth()->user()->id)->count()" class="badge-error absolute -right-2 -top-2 badge-sm" />
          </x-button>
        </x-slot:trigger>
        <div class="p-2 w-40">
          <p class="text-slate-500">{{ $cart->where('user_id', auth()->user()->id)->count() }} items</p>
          @if($cart->count() == 0)
          <p class="text-info">Subtotal: 0</p>
          @else
          <p class="text-info">Subtotal: {{ number_format($cart->where('user_id', auth()->user()->id)->sum('total')) }}</p>
          @endif
          <x-button label="View Cart" :link="route('carts')" class="btn-primary btn-block btn-sm mt-2" />
        </div>
      </x-dropdown>
      <x-dropdown>
        <x-slot:trigger>
          <x-button label="Welcome, {{ Auth::user()->name }}" icon="o-user" class="btn-ghost btn-sm" responsive />
        </x-slot:trigger>

        @can('admin')
        <x-menu-item title="Dashboard" icon="o-home" class="text-slate-700 hover:text-slate-900" :link="route('dashboard')" />
        @endcan
        <x-menu-item title="My Orders" icon="o-shopping-bag" class="text-slate-700 hover:text-slate-900" :link="route('my-order')" />
        <x-menu-separator />
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
