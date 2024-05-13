<x-nav sticky full-width>
  <x-slot:brand>
    <label for="main-drawer" class="lg:hidden mr-3">
      <x-icon name="o-bars-3" class="cursor-pointer" />
    </label>
    <div>My Store</div>
  </x-slot:brand>

  <x-slot:actions>
    <x-button label="Logout" icon-right="o-arrow-right-on-rectangle" class="btn-ghost btn-sm" responsive />
  </x-slot:actions>
</x-nav>
