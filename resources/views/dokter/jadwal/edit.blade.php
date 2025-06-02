<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Jadwal Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Data Jadwal Periksa') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Silakan perbarui informasi jadwal periksa sesuai dengan hari, jam mulai dan jam selesai terbaru.') }}
                            </p>
                        </header>
                        <form action="{{ route('dokter.jadwal.update', $jadwal->id) }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                                <select name="hari" id="hari"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">Pilih Hari</option>
                                    @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $hari)
                                        <option value="{{ $hari }}" {{ old('hari', $jadwal->hari) == $hari ? 'selected' : '' }}>
                                            {{ $hari }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('hari')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="jam_mulai" class="block text-sm font-medium text-gray-700">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai"
                                    value="{{ old('jam_mulai', $jadwal->jam_mulai) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('jam_mulai')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="jam_selesai" class="block text-sm font-medium text-gray-700">Jam
                                    Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai"
                                    value="{{ old('jam_selesai', $jadwal->jam_selesai) }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                @error('jam_selesai')
                                    <span class="text-red-600 text-xs">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('dokter.jadwal.index') }}"
                                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400 transition">Batal</a>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Update</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
</x-app-layout>