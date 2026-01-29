<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Data Guru') }}
            </h2>
            <div>
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                    Edit
                </a>
                <a href="{{ route('admin.teachers.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white shadow-sm sm:rounded-lg">
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/3">
                    @if($teacher->photo)
                        <img src="{{ Storage::url($teacher->photo) }}" alt="{{ $teacher->name }}" class="w-full rounded-lg">
                    @else
                        <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400">No Photo</span>
                        </div>
                    @endif
                </div>
                <div class="md:w-2/3">
                    <h1 class="text-3xl font-bold mb-4">{{ $teacher->name }}</h1>
                    
                    <div class="space-y-3">
                        @if($teacher->nip)
                            <div>
                                <span class="font-semibold text-gray-700">NIP:</span>
                                <span class="ml-2 text-gray-600">{{ $teacher->nip }}</span>
                            </div>
                        @endif

                        <div>
                            <span class="font-semibold text-gray-700">Jabatan:</span>
                            <span class="ml-2 text-gray-600">{{ $teacher->position }}</span>
                        </div>

                        @if($teacher->email)
                            <div>
                                <span class="font-semibold text-gray-700">Email:</span>
                                <span class="ml-2 text-gray-600">{{ $teacher->email }}</span>
                            </div>
                        @endif

                        @if($teacher->phone)
                            <div>
                                <span class="font-semibold text-gray-700">No. HP:</span>
                                <span class="ml-2 text-gray-600">{{ $teacher->phone }}</span>
                            </div>
                        @endif

                        <div>
                            <span class="font-semibold text-gray-700">Status:</span>
                            @if($teacher->is_active)
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            @else
                                <span class="ml-2 px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Tidak Aktif</span>
                            @endif
                        </div>

                        @if($teacher->media_sosial_json)
                            <div>
                                <span class="font-semibold text-gray-700">Media Sosial:</span>
                                <div class="mt-2 flex flex-wrap gap-2">
                                    @if(isset($teacher->media_sosial_json['facebook']))
                                        <a href="{{ $teacher->media_sosial_json['facebook'] }}" target="_blank" class="text-blue-600 hover:text-blue-800">Facebook</a>
                                    @endif
                                    @if(isset($teacher->media_sosial_json['instagram']))
                                        <a href="https://instagram.com/{{ $teacher->media_sosial_json['instagram'] }}" target="_blank" class="text-pink-600 hover:text-pink-800">Instagram</a>
                                    @endif
                                    @if(isset($teacher->media_sosial_json['twitter']))
                                        <a href="https://twitter.com/{{ $teacher->media_sosial_json['twitter'] }}" target="_blank" class="text-blue-400 hover:text-blue-600">Twitter</a>
                                    @endif
                                    @if(isset($teacher->media_sosial_json['linkedin']))
                                        <a href="{{ $teacher->media_sosial_json['linkedin'] }}" target="_blank" class="text-blue-700 hover:text-blue-900">LinkedIn</a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>

                    @if($teacher->bio)
                        <div class="mt-6">
                            <h3 class="font-semibold text-gray-700 mb-2">Biografi</h3>
                            <p class="text-gray-600 whitespace-pre-wrap">{{ $teacher->bio }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

