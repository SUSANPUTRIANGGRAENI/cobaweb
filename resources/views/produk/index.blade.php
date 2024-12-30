<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Produk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- <x-primary-button tag="a" href="">Print PDF</x-primary-button> -->
                    <x-table name="header">
                        <tr class="py-10">
                            <th scope="col">#</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Stok</th>
                        </tr>
                        @foreach ($produk as $produks)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $produks->nama }}</td>
                            <td>{{ $produks->kategori }}</td>
                            <td>Rp. {{ $produks->harga }}</td>
                            <td>{{ $produks->stok }}</td>
                        </tr>
                        @endforeach
                    </x-table>
                </div>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
</x-app-layout>
