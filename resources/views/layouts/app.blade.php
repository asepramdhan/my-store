<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="corporate">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title ?? 'My Store' }}</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

  <x-nav sticky full-width>
    <x-slot:brand>
      <label for="main-drawer" class="lg:hidden mr-3">
        <x-icon name="o-bars-3" class="cursor-pointer" />
      </label>
      <div>App</div>
    </x-slot:brand>

    <x-slot:actions>
      <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
      <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
    </x-slot:actions>
  </x-nav>

  <x-main with-nav full-width>
    <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-200">
      <x-menu activate-by-route>
        <x-menu-item title="Home" icon="o-home" link="###" />
        <x-menu-item title="Messages" icon="o-envelope" link="###" />
        <x-menu-sub title="Settings" icon="o-cog-6-tooth">
          <x-menu-item title="Wifi" icon="o-wifi" link="####" />
          <x-menu-item title="Archives" icon="o-archive-box" link="####" />
        </x-menu-sub>
      </x-menu>
    </x-slot:sidebar>

    <x-slot:content>
      {{ $slot }}
    </x-slot:content>
  </x-main>

  <x-toast />
</body>
</html>
