<?php
use function Livewire\Volt\{state};
use App\Models\Order;
state(['order']);
?>
<x-dashboard-layout title="Detail Order">
  @volt
  <div>
    <x-header title="Detail Order" subtitle="Order #{{ $order->order_number }}" size="text-xl" separator />
    {{-- image product --}}
    <image src="{{ asset('storage/' . $order->product->image) }}" alt="{{ $order->product->name }}" class="w-32 h-32" />
    <x-card :title="$order->product->name" :subtitle="$order->created_at->diffForHumans()" shadow separator>
      <p class="text-slate-500">Pembeli : ramdan</p>
      @if($order->status == 0)
      <span class="text-red-500 truncate">Belum Bayar</span>
      @elseif($order->status == 1)
      <span class="text-green-400 truncate">Perlu Diproses</span>
      @elseif($order->status == 2)
      <span class="text-green-600 truncate">Sedang Diproses</span>
      @elseif($order->status == 3)
      <span class="text-green-800 truncate">Dikirim</span>
      @elseif($order->status == 4)
      <span class="text-red-800 truncate">Dibatalkan</span>
      @endif
      <div class="my-4">
        <p class="text-slate-500">QTY</p>
        <p class="text-2xl">{{ $order->quantity }}</p>
        <p class="text-slate-500">Total</p>
        <p class="text-2xl">{{ number_format($order->product->price * $order->quantity) }}</p>
      </div>
      <x-button label="Kembali" :link="route('orders')" />
      @if($order->status == 0)
      @elseif($order->status == 1)
      <x-button label='Batalkan' class="btn-error" wire:click="cancel({{ $order->id }})" wire:confirm="Are you sure?" />
      <x-button label="Proses" class="btn-primary" wire:click="update({{ $order->id }})" />
      @elseif($order->status == 2)
      <x-button label='Batalkan' class="btn-error" wire:click="cancel({{ $order->id }})" wire:confirm="Are you sure?" />
      <x-button label="Kirim" class="btn-success" wire:click="update({{ $order->id }})" />
      @elseif($order->status == 3)
      <x-button label='Batalkan' class="btn-error" wire:click="cancel({{ $order->id }})" wire:confirm="Are you sure?" />
      @elseif($order->status == 4)
      @endif
    </x-card>
  </div>
  @endvolt
</x-dashboard-layout>
