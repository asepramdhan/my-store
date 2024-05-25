<?php
use function Livewire\Volt\{state, with, rules};
use App\Models\Order;
use App\Models\Cart;
use App\Models\Payment;
state(['cart', 'name', 'no_whatsapp', 'address', 'payment']);
with(fn () => ['payments' => Payment::all()]);
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
$checkout = function ($id) {
  $validatedData = $this->validate();
  $validatedData['user_id'] = auth()->user()->id;
  $validatedData['product_id'] = $id;
  $validatedData['payment_id'] = $this->payment;
  $validatedData['order_number'] = Str::random(12);
  $validatedData['quantity'] = $this->cart->quantity;
  $validatedData['total'] = $this->cart->total;
  $validatedData['status'] = '0';
  Order::create($validatedData);
  Cart::destroy($this->cart->id);
  $this->redirect('/auth/payment/' . $validatedData['order_number'], navigate: true);
} 
?>
<x-app-layout title="Checkout">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-10 gap-2">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-4">
      <x-form wire:submit="checkout({{ $cart->id }})">
        <x-input label="Nama Penerima" wire:model="name" />
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
