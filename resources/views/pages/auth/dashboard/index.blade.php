<?php
use function Livewire\Volt\{state};
use function Laravel\Folio\name;
name('dashboard');
state([]);
?>
<x-dashboard-layout>
  @volt
  <div>
    Halaman dashboard
  </div>
  @endvolt
</x-dashboard-layout>
