<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Formulir Pendaftaran PPDB</h1>
            <p class="text-gray-600">Isi formulir dengan lengkap dan benar</p>
        </div>

        <!-- Stepper -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                @for($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center flex-1">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm
                                {{ $currentStep >= $i ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-600' }}">
                                {{ $i }}
                            </div>
                            <div class="mt-2 text-xs text-center {{ $currentStep >= $i ? 'text-blue-600 font-semibold' : 'text-gray-500' }}">
                                @if($i == 1) Data Diri
                                @elseif($i == 2) Sekolah Asal
                                @else Upload Berkas
                                @endif
                            </div>
                        </div>
                        @if($i < $totalSteps)
                            <div class="flex-1 h-1 mx-2 {{ $currentStep > $i ? 'bg-blue-600' : 'bg-gray-200' }}"></div>
                        @endif
                    </div>
                @endfor
            </div>
        </div>

        <!-- Success Message -->
        @if (session()->has('success'))
            <div class="mb-6 bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <!-- Error Message -->
        @if (session()->has('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Form -->
        <form wire:submit.prevent="{{ $currentStep == $totalSteps ? 'submit' : 'nextStep' }}">
            <!-- Step 1: Data Diri -->
            @if($currentStep == 1)
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Data Diri</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="nama_lengkap" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" wire:model.blur="nama_lengkap" id="nama_lengkap" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_lengkap') border-red-500 @enderror">
                            @error('nama_lengkap') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="nisn" class="block text-sm font-medium text-gray-700 mb-2">NISN *</label>
                            <input type="text" wire:model.blur="nisn" id="nisn" maxlength="10" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nisn') border-red-500 @enderror"
                                placeholder="10 digit angka">
                            @error('nisn') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                            <p class="text-xs text-gray-500 mt-1">Harus berupa 10 digit angka</p>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" wire:model.blur="email" id="email" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                            @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="no_hp" class="block text-sm font-medium text-gray-700 mb-2">No. HP *</label>
                            <input type="text" wire:model.blur="no_hp" id="no_hp" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('no_hp') border-red-500 @enderror">
                            @error('no_hp') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tempat Lahir *</label>
                            <input type="text" wire:model.blur="tempat_lahir" id="tempat_lahir" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tempat_lahir') border-red-500 @enderror">
                            @error('tempat_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Lahir *</label>
                            <input type="date" wire:model.blur="tanggal_lahir" id="tanggal_lahir" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_lahir') border-red-500 @enderror">
                            @error('tanggal_lahir') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kelamin *</label>
                            <select wire:model.blur="jenis_kelamin" id="jenis_kelamin" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jenis_kelamin') border-red-500 @enderror">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            @error('jenis_kelamin') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                        <textarea wire:model.blur="alamat" id="alamat" rows="3" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror"></textarea>
                        @error('alamat') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

            <!-- Step 2: Data Sekolah Asal -->
            @if($currentStep == 2)
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Data Sekolah Asal</h2>
                    
                    <div>
                        <label for="asal_sekolah" class="block text-sm font-medium text-gray-700 mb-2">Nama Sekolah Asal *</label>
                        <input type="text" wire:model.blur="asal_sekolah" id="asal_sekolah" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('asal_sekolah') border-red-500 @enderror">
                        @error('asal_sekolah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="alamat_sekolah" class="block text-sm font-medium text-gray-700 mb-2">Alamat Sekolah Asal *</label>
                        <textarea wire:model.blur="alamat_sekolah" id="alamat_sekolah" rows="3" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat_sekolah') border-red-500 @enderror"></textarea>
                        @error('alamat_sekolah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="tahun_lulus" class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus *</label>
                        <input type="number" wire:model.blur="tahun_lulus" id="tahun_lulus" min="2020" max="{{ date('Y') + 1 }}" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tahun_lulus') border-red-500 @enderror">
                        @error('tahun_lulus') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            @endif

            <!-- Step 3: Upload Berkas -->
            @if($currentStep == 3)
                <div class="space-y-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Upload Berkas</h2>
                    
                    <div>
                        <label for="foto_dokumen" class="block text-sm font-medium text-gray-700 mb-2">Foto Dokumen *</label>
                        <input type="file" wire:model="foto_dokumen" id="foto_dokumen" accept="image/*" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('foto_dokumen') border-red-500 @enderror">
                        @error('foto_dokumen') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, Maksimal 2MB</p>
                        @if($foto_dokumen)
                            <div class="mt-2">
                                <img src="{{ $foto_dokumen->temporaryUrl() }}" alt="Preview" class="h-32 w-auto rounded">
                            </div>
                        @endif
                    </div>

                    <div>
                        <label for="ijazah" class="block text-sm font-medium text-gray-700 mb-2">Ijazah (Opsional)</label>
                        <input type="file" wire:model="ijazah" id="ijazah" accept=".pdf,image/*" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ijazah') border-red-500 @enderror">
                        @error('ijazah') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-1">Format: PDF/JPG/PNG, Maksimal 2MB</p>
                    </div>

                    <div>
                        <label for="ktp_ortu" class="block text-sm font-medium text-gray-700 mb-2">KTP Orang Tua (Opsional)</label>
                        <input type="file" wire:model="ktp_ortu" id="ktp_ortu" accept=".pdf,image/*" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('ktp_ortu') border-red-500 @enderror">
                        @error('ktp_ortu') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-1">Format: PDF/JPG/PNG, Maksimal 2MB</p>
                    </div>
                </div>
            @endif

            <!-- Navigation Buttons -->
            <div class="flex justify-between mt-8">
                @if($currentStep > 1)
                    <button type="button" wire:click="previousStep" 
                        class="px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                        Kembali
                    </button>
                @else
                    <div></div>
                @endif

                @if($currentStep < $totalSteps)
                    <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Selanjutnya
                    </button>
                @else
                    <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Submit Pendaftaran
                    </button>
                @endif
            </div>
        </form>
    </div>
</div>

