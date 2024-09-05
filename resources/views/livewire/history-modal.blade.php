<div>
    @if($showModal)
        <x-filament::modal wire:model.defer="showModal">
            <x-slot name="title">
                History Details
            </x-slot>

            <x-slot name="content">
                @if($history)
                    <p>Transaction Code: {{ $history->kode_transaksi }}</p>
                    <p>Item Name: {{ $history->nama_barang }}</p>
                    <p>Quantity: {{ $history->quantity }}</p>
                    <p>Total Price: {{ $history->total_harga }}</p>
                @else
                    <p>No details available.</p>
                @endif
            </x-slot>

            <x-slot name="footer">
                <x-button wire:click="close">Close</x-button>
            </x-slot>
        </x-filament::modal>
    @endif
</div>
