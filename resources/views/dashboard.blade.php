<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('TAMPILAN UTAMA TOKO JAYUSMAN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- <x-primary-button tag="a" href="">Print PDF</x-primary-button> -->
                    @if(auth()->user() && auth()->user()->role === 'admin')
                    <x-table name="header">
                        <tr class="py-10">
                            <th scope="col">#</th>
                            <th scope="col">pengguna aktif</th>
                            <th scope="col">total transaksi</th>
                            <th scope="col">pendapatan harian</th>
                            <th scope="col">pendapatan mingguan</th>
                            <th scope="col">pendapatan bulanan</th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </x-table>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
