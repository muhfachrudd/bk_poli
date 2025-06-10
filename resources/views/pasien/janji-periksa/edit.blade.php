<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Janji Periksa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Janji Periksa') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Perbarui informasi janji periksa Anda.') }}
                            </p>
                        </header>

                        <form class="mt-6" action="{{ route('pasien.janji-periksa.update', $janji->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label for="formGroupExampleInput">Nomor Rekam Medis</label>
                                <input type="text" class="rounded form-control" id="formGroupExampleInput"
                                    placeholder="Example input" value="{{ $janji->pasien->no_rm }}" readonly>
                            </div>
                            
                            <div class="form-group">
                                <label for="dokterSelect">Dokter</label> 
                                <select class="form-control" id="dokterSelect" name="id_jadwal_periksa" required>
                                    <option value="">Pilih Dokter</option>
                                    @foreach ($dokters as $dokter)
                                        @foreach ($dokter->jadwalPeriksas as $jadwalPeriksa)
                                            <option value="{{ $jadwalPeriksa->id }}" 
                                                {{ $janji->id_jadwal_periksa == $jadwalPeriksa->id ? 'selected' : '' }}>
                                                {{$dokter->nama}} - Spesialis {{$dokter->poli}} | {{$jadwalPeriksa->hari}} |
                                                {{$jadwalPeriksa->jam_mulai}} - {{$jadwalPeriksa->jam_selesai}}
                                            </option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('id_jadwal_periksa')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <textarea class="form-control" id="keluhan" name="keluhan" rows="3" required>{{ old('keluhan', $janji->keluhan) }}</textarea>
                                @error('keluhan')
                                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="flex items-center gap-4">
                                <a href="{{ route('pasien.janji-periksa.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-primary">Update</button>

                                @if (session('status') === 'janji-updated')
                                    <p x-data="{ show: true }" x-show="show" x-transition
                                        x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                        {{ __('Berhasil Diperbarui.') }}
                                    </p>
                                @endif
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>