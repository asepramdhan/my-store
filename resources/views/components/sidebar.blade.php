<x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
  <x-menu activate-by-route>
    @can('admin')
    <x-menu-item title="Home" icon="o-home" :link="route('dashboard')" />
    <x-menu-item title="Orders" icon="o-shopping-bag" :link="route('orders')" />
    <x-menu-item title="My Orders" icon="o-shopping-bag" badge="user" badge-classes="!badge-warning" :link="route('my-order')" />
    @else
    <x-menu-item title="My Orders" icon="o-shopping-bag" :link="route('my-order')" />
    @endcan
    @can('admin')
    <x-menu-item title="Products" icon="o-shopping-cart" :link="route('products')" />
    <x-menu-separator />
    <x-menu-item title="Users" icon="o-users" :link="route('users')" />
    <x-menu-item title="Categories" icon="o-tag" :link="route('category')" />
    @endcan
  </x-menu>
</x-slot:sidebar>
