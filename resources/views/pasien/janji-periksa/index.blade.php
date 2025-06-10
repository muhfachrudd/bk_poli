<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 bg-white shadow sm:rounded-lg">
                <section>
                    <header class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Janji Periksa') }}
                        </h2>
                        <div class="flex flex-col items-center justify-center text-center">
                            <a href="{{ route('pasien.janji-periksa.create') }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Tambah
                                Janji</a>                            @if (session('status') === 'janji-periksa-created')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600 mt-2">
                                    {{ __('Janji periksa berhasil dibuat.') }}
                                </p>
                            @elseif (session('status') === 'janji-updated')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-blue-600 mt-2">
                                    {{ __('Updated.') }}
                                </p>
                            @elseif (session('status') === 'janji-deleted')
                                <p x-data="{ show: true }" x-show="show" x-transition
                                    x-init="setTimeout(() => show = false, 2000)" class="text-sm text-red-600 mt-2">
                                    {{ __('Deleted.') }}
                                </p>
                            @elseif (session('status') === 'janji-status-updated')
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
                                        No Rekam Medis</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Dokter</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Keluhan</th>
                                    <th
                                        class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                        Aksi</th>
                                   
                                </tr>
                            </thead>                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($janjiPeriksas as $janji)
                                    <tr>
                                        <td class="px-4 py-2 align-middle">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 align-middle">{{ $janji->pasien->no_rm }}</td>
                                        <td class="px-4 py-2 align-middle">
                                            {{ $janji->jadwalPeriksa->dokter->nama }}
                                            <div class="text-sm text-gray-500">
                                                Poli {{ $janji->jadwalPeriksa->dokter->poli }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $janji->jadwalPeriksa->hari }} | 
                                                {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_mulai)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($janji->jadwalPeriksa->jam_selesai)->format('H:i') }}
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 align-middle">{{ $janji->keluhan }}</td>
                                        <td class="px-4 py-2">
                                            <div class="flex items-center gap-2">
                                                <span class="px-2 py-1 bg-blue-200 text-blue-800 rounded text-xs">
                                                    Antrian: {{ $janji->no_antrian }}
                                                </span>
                                                <a href="{{ route('pasien.janji-periksa.edit', $janji->id) }}"
                                                    class="px-3 py-1 bg-gray-500 text-white rounded hover:bg-gray-700 transition text-sm">
                                                    Edit
                                                </a>
                                                <form action="{{ route('pasien.janji-periksa.destroy', $janji->id) }}"
                                                    method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus janji periksa ini?')"
                                                        class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-800 transition text-sm">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                            Belum ada janji periksa
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>