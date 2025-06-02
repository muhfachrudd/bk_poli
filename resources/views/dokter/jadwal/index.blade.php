<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Jadwal Periksa') }}
                        </h2>
                        <div class="flex flex-col items-center justify-center text-center">
                            <a href="{{ route('dokter.jadwal.create') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tambah
                                Jadwal</a>
                            @if (session('status') === 'jadwal-created')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 mt-2">
                                    {{ __('Created.') }}
                                </p>
                            @elseif (session('status') === 'jadwal-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-blue-600 mt-2">
                                    {{ __('Updated.') }}
                                </p>
                            @elseif (session('status') === 'jadwal-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-red-600 mt-2">
                                    {{ __('Deleted.') }}
                                </p>
                            @elseif (session('status') === 'jadwal-status-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-yellow-600 mt-2">
                                    {{ __('Status Updated.') }}
                                </p>
                            @endif
                        </div>
                    </header>
                    <div class="overflow-x-auto">
                        <table
                            class="min-w-full table-auto table-striped table-hover border border-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        No</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Hari</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Jam Mulai</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Jam Selesai</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Status</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($jadwals as $jadwal)
                                    <tr>
                                        <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $jadwal->hari }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $jadwal->jam_mulai }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $jadwal->jam_selesai }}</td>
                                        <td class="px-4 py-2 align-middle">
                                            @if($jadwal->status)
                                                <span class="px-2 py-1 bg-green-200 text-green-800 rounded text-xs">Aktif</span>
                                            @else
                                                <span
                                                    class="px-2 py-1 bg-red-200 text-red-800 rounded text-xs">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-2 align-middle flex items-center gap-2">
                                            <a href="{{ route('dokter.jadwal.edit', $jadwal->id) }}"
                                                class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-700 transition text-sm">Edit</a>
                                            <form action="{{ route('dokter.jadwal.destroy', $jadwal->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-800 transition text-sm">Delete</button>
                                            </form>
                                            <form action="{{ route('dokter.jadwal.toggle-status', $jadwal->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                    class="px-3 py-1 {{ $jadwal->status ? 'bg-yellow-500 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-800' }} text-white rounded transition text-sm">
                                                    {{ $jadwal->status ? 'Nonaktifkan' : 'Aktifkan' }}
                                                </button>
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