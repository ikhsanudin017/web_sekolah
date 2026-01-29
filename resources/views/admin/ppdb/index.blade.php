<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Kelola Pendaftaran PPDB') }}
            </h2>
            <a href="{{ route('admin.ppdb.export', request()->all()) }}" 
               class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Download Excel
            </a>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-600">Total Pendaftar</div>
            <div class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</div>
        </div>
        <div class="bg-yellow-50 rounded-lg shadow p-4 border-l-4 border-yellow-500">
            <div class="text-sm text-gray-600">Pending</div>
            <div class="text-2xl font-bold text-yellow-600">{{ $stats['pending'] }}</div>
        </div>
        <div class="bg-blue-50 rounded-lg shadow p-4 border-l-4 border-blue-500">
            <div class="text-sm text-gray-600">Proses</div>
            <div class="text-2xl font-bold text-blue-600">{{ $stats['proses'] }}</div>
        </div>
        <div class="bg-green-50 rounded-lg shadow p-4 border-l-4 border-green-500">
            <div class="text-sm text-gray-600">Diterima</div>
            <div class="text-2xl font-bold text-green-600">{{ $stats['diterima'] }}</div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <div class="mb-3 flex items-center gap-2 text-sm text-gray-600">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>Filter data yang aktif akan diterapkan saat download Excel</span>
            </div>
            <form method="GET" action="{{ route('admin.ppdb.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari nama, NISN, email..." 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                        <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                        Filter
                    </button>
                </div>
                @if(request()->has('search') || request()->has('status'))
                    <div>
                        <a href="{{ route('admin.ppdb.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg transition-colors">
                            Reset
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6">
            @if($registrations->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                        <thead class="bg-gradient-to-r from-blue-600 to-blue-700">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">No</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">Nama Lengkap</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">NISN</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">No. HP</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">Asal Sekolah</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">Tanggal Daftar</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-white uppercase tracking-wider border-r border-blue-500">Status</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-white uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($registrations as $index => $registration)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-500 border-r border-gray-200">
                                        {{ $registrations->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border-r border-gray-200">
                                        <div class="text-sm font-semibold text-gray-900">{{ $registration->nama_lengkap }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 border-r border-gray-200">
                                        {{ $registration->nisn ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 border-r border-gray-200">
                                        {{ $registration->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 border-r border-gray-200">
                                        {{ $registration->no_hp }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 border-r border-gray-200">
                                        {{ $registration->asal_sekolah ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 border-r border-gray-200">
                                        {{ $registration->created_at->format('d M Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center border-r border-gray-200">
                                        @if($registration->status === 'pending')
                                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-300">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($registration->status === 'proses')
                                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-blue-100 text-blue-800 border border-blue-300">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Proses
                                            </span>
                                        @else
                                            <span class="inline-flex px-3 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                                </svg>
                                                Diterima
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                        <button onclick="openModal({{ $registration->id }}, '{{ $registration->status }}')" 
                                            class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition-colors shadow-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Ubah Status
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-600">
                        Menampilkan {{ $registrations->firstItem() }} - {{ $registrations->lastItem() }} dari {{ $registrations->total() }} data
                    </div>
                    <div>
                        {{ $registrations->links() }}
                    </div>
                    <a href="{{ route('admin.ppdb.export', request()->all()) }}" 
                       class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg shadow transition-all text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Data
                    </a>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Tidak ada data pendaftaran.</p>
            @endif
        </div>
    </div>

    <!-- Modal Ubah Status -->
    <div id="statusModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Ubah Status Pendaftaran</h3>
                <form id="statusForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="statusSelect" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="pending">Pending</option>
                            <option value="proses">Proses</option>
                            <option value="diterima">Diterima</option>
                        </select>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeModal()" 
                            class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            Batal
                        </button>
                        <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal(id, currentStatus) {
            document.getElementById('statusForm').action = `/admin/ppdb/${id}/status`;
            document.getElementById('statusSelect').value = currentStatus;
            document.getElementById('statusModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('statusModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('statusModal');
            if (event.target == modal) {
                closeModal();
            }
        }
    </script>
</x-app-layout>

