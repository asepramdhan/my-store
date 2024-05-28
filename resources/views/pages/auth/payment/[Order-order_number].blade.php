<?php
use function Livewire\Volt\{with, state, usesPagination, usesFileUploads, rules};
use App\Models\Order;
usesPagination();
usesFileUploads();
state(['order', 'image', 'shipments', 'shipment',
  'headers' => [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-500/20 w-1'],
    ['key' => 'image', 'label' => 'Image', 'class' => 'h-20 w-full md:h-full md:w-20'],
    ['key' => 'name', 'label' => 'Title'],
    ['key' => 'price', 'label' => 'Price'],
    ['key' => 'quantity', 'label' => 'QTY'],
    ['key' => 'total', 'label' => 'Total', 'class' => 'truncate'],
  ],
]);
with(fn () => ['orders' => Order::with('product', 'shipment')->where('user_id', auth()->user()->id)->where('order_number', $this->order->order_number)->paginate(10)]);
rules([
  'shipment' => 'required',
  'image' => 'image|file|max:1024',
])->messages([
  'shipment.required' => 'Shipment is required',
  'image.image' => 'Image must be an image',
  'image.file' => 'Image must be an image',
  'image.max' => 'Image must be less than 1MB',
]);
$payment = function () {
  $validatedData = $this->validate();
  $validatedData['status'] = '1';
  $validatedData['image'] = $this->image->store('payments');
  $this->order->update($validatedData);
  $this->redirect(route('my-order'), navigate: true);
}
?>
<x-app-layout title="Payment">
  @volt
  <div class="grid grid-cols-12 md:grid-cols-6 gap-4">
    <div class="col-start-1 col-span-12 md:col-span-4 md:col-start-2">
      @if(session()->has('success'))
      <div class="mb-3">
        <x-alert title="Information" :description="session('success')" icon="o-check" shadow dismissible />
      </div>
      @endif
      @if($orders->where('user_id', auth()->user()->id)->count() == 0)
      <div class="text-center text-slate-500 text-xl my-52">
        <p>There is no order</p>
      </div>
      @else
      <x-table :headers="$headers" :rows="$orders" striped with-pagination>
        @scope('cell_id', $order)
        <strong>{{ $this->loop->iteration }}</strong>
        @endscope
        @scope('cell_image', $order)
        <img src="{{ asset('storage/' . $order->product->image) }}" />
        @endscope
        @scope('cell_name', $order)
        {{ $order->product->name }}
        @endscope
        @scope('cell_price', $order)
        {{ number_format($order->product->price) }}
        @endscope
        @scope('cell_total', $order)
        <p class="text-slate-500 text-sm">{{ $order->shipment->name }}</p>
        {{ number_format($order->product->price * $order->quantity + $order->shipment->price) }}
        @endscope
      </x-table>
      <div class="text-center">
        <p>Total Bayar</p>
        <p class="text-2xl py-3">
          {{ number_format($orders->first()->product->price * $orders->first()->quantity + $orders->first()->shipment->price) }}
        </p>
        <p>
          <span>Nama bank : {{ $orders->first()->payment->name }}</span> <br>
          <span>Atas nama : {{ $orders->first()->payment->of_name }}</span> <br>
          <span>Nomor Rekening</span> <br>
          <span class="text-slate-500 text-xl">{{ $orders->first()->payment->number }}</span>
        </p>
      </div>
      <x-form wire:submit='payment'>
        <div class="flex justify-center my-3">
          <x-file wire:model="image" hint="Unggah bukti pembayaran" />
        </div>
        <div class="flex justify-center my-3">
          <x-button label="Bayar" type="submit" icon="o-credit-card" class="btn-sm btn-primary" />
        </div>
      </x-form>
      @endif
    </div>
  </div>
  @endvolt
</x-app-layout>
