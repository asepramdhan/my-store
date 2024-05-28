<?php
use function Livewire\Volt\{state, mount, rules};
use function Laravel\Folio\name;
use App\Models\User;
name('profile');
state(['name', 'no_whatsapp', 'address']);
mount(function () {
  $this->name = auth()->user()->name;
  $this->no_whatsapp = auth()->user()->no_whatsapp;
  $this->address = auth()->user()->address;
});
rules([
  'name' => 'required|min:3',
  'no_whatsapp' => 'required',
  'address' => 'required',
])->messages([
  'name.required' => 'Name is required',
  'name.min' => 'Name must be at least 3 characters',
  'no_whatsapp.required' => 'No. WhatsApp is required',
  'address.required' => 'Address is required',
]);
$save = function ($id) {
  $validatedData = $this->validate();
  User::where('id', $id)->update($validatedData);
  session()->flash('success', 'Profile updated successfully');
}
?>
<x-dashboard-layout title="Profile">
  @volt
  <div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      @if(session()->has('success'))
      <x-alert title="Information" :description="session('success')" icon="o-check" class="mb-3" dismissible />
      @endif
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <x-form wire:submit="save({{ auth()->user()->id }})">
        <x-input label="Nama Panggilan" wire:model="name" />
        <x-input label="No. WhatsApp" type="number" wire:model="no_whatsapp" />
        <x-textarea label="Alamat" wire:model="address" placeholder="Alamat lengkap ..." rows="5" />

        <x-slot:actions>
          <x-button label="Simpan" type="submit" icon-right="o-check" class="btn-primary btn-sm" spinner="save" />
        </x-slot:actions>
      </x-form>
    </div>
  </div>
  @endvolt
</x-dashboard-layout>
