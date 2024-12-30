<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Transaksi') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-r from-gray-400 via-blue-500 to-blue-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 bg-white">

                    <x-primary-button tag="a" href="{{ route('transaksi.create') }}">Tambah Transaksi</x-primary-button>

                    <x-table>
                        <x-slot name="header">
                            <tr class="py-10">
                                <th scope="col">#</th>
                                <th scope="col">Cabang</th>
                                <th scope="col">Kasir</th>
                                <th scope="col">Produk</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Total Harga</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </x-slot>
                        @if ($transaksi->isEmpty())
    <tr>
        <td colspan="8" class="text-center">Tidak ada data transaksi</td>
    </tr>
@else
    @foreach ($transaksi as $transaksi)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $transaksi->cabangToko->nama }}</td>
            <td>{{ $transaksi->user->name }}</td>
            <td>{{ $transaksi->produk->nama }}</td>
            <td>{{ $transaksi->qty }}</td>
            <td>{{ number_format($transaksi->total_harga, 2) }}</td>
            <td>{{ $transaksi->tanggal_transaksi }}</td>
            <td>
                <x-primary-button tag="a" href="{{ route('transaksi.edit', $transaksi->id) }}">Edit</x-primary-button>
                <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-transaksi-deletion')"
                    x-on:click="$dispatch('set-action', '{{ route('transaksi.destroy', $transaksi->id) }}')">
                    {{ __('Delete') }}
                </x-danger-button>
            </td>
        </tr>
    @endforeach
@endif

                    </x-table>

                    <x-modal name="confirm-transaksi-deletion" focusable maxWidth="xl">
                        <form method="post" x-bind:action="action" class="p-6">
                            @method('delete')
                            @csrf
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Apakah anda yakin akan menghapus data?') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __('Setelah proses dilaksanakan. Data akan dihilangkan secara permanen.') }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Cancel') }}
                                </x-secondary-button>
                                <x-danger-button class="ml-3">
                                    {{ __('Delete!!!') }}
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
