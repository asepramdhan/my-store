<x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
  <x-menu activate-by-route>
    <x-menu-item title="Home" icon="o-home" :link="route('dashboard')" />
    <x-menu-item title="Products" icon="o-shopping-cart" :link="route('products')" />
  </x-menu>
</x-slot:sidebar>
