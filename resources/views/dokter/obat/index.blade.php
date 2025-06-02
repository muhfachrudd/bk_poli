<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Obat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Daftar Obat') }}
                        </h2>
                        <div class="flex flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.obat.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tambah Obat</a>
                            @if (session('status') === 'obat-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 2000)"
                                    class="text-sm text-green-600 mt-2"
                                >
                                    {{ __('Created.') }}
                                </p>
                            @endif
                        </div>
                    </header>

                    <div class="overflow-x-auto">
                        <table class="min-w-full table-auto table-striped table-hover border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">No</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Nama Obat</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Kemasan</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Harga</th>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($obats as $obat)
                                    <tr>
                                        <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $obat->nama_obat }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $obat->kemasan }}</td>
                                        <td class="px-4 py-2 align-middle">{{ 'Rp' . number_format($obat->harga, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 align-middle flex items-center gap-2">
                                            <a href="{{ route('dokter.obat.edit', $obat->id) }}" class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-700 transition text-sm">Edit</a>
                                            <form action="{{ route('dokter.obat.destroy', $obat->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-800 transition text-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
