<?php
use function Livewire\Volt\{state, with};
use function Laravel\Folio\name;
use App\Models\Payment;
state([]);
with(fn () => ['payments' => Payment::all()]);
name('checkout');
?>
<x-app-layout title="Checkout">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-10 gap-2">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-4">
      <x-form wire:submit="checkout">
        <x-input label="Nama Lengkap" wire:model="name" />
        <x-input label="No. WhatsApp" type="number" wire:model="no_whatsapp" />
        <x-textarea label="Alamat" wire:model="address" placeholder="Alamat lengkap ..." rows="5" />
        <x-select label="Pembayaran" :options="$payments" wire:model="payment" placeholder="Pilih metode pembayaran ..." />

        <x-slot:actions>
          <x-button label="Cancel" :link="route('home')" class="btn-secondary btn-sm" />
          <x-button label="Checkout" type="submit" icon-right="o-check" class="btn-primary btn-sm" spinner="checkout" />
        </x-slot:actions>
      </x-form>
    </div>
  </div>
  @endvolt
</x-app-layout>
