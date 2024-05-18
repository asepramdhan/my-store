<x-nav sticky full-width>
  <x-slot:brand>
    <label for="main-drawer" class="lg:hidden mr-3">
      <x-icon name="o-bars-3" class="cursor-pointer" />
    </label>
    <div>App</div>
  </x-slot:brand>
  <x-slot:actions>
    <x-button label="Login" icon="o-user" :link="route('login')" class="btn-ghost btn-sm" responsive />
    <x-button label="Register" icon="o-user-plus" :link="route('register')" class="btn-ghost btn-sm" responsive />
  </x-slot:actions>
</x-nav>
