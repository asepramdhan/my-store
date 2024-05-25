<x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
  <x-menu activate-by-route>
    <x-menu-item title="Home" icon="o-home" :link="route('dashboard')" />
    <x-menu-item title="Orders" icon="o-shopping-bag" :link="route('orders')" />
    <x-menu-item title="My Orders" icon="o-shopping-bag" :link="route('my-order')" />
    <x-menu-item title="Products" icon="o-shopping-cart" :link="route('products')" />
    <x-menu-item title="Categories" icon="o-tag" :link="route('category')" />
  </x-menu>
</x-slot:sidebar>
