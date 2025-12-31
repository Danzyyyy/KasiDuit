<x-layouts.app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Wrapper utama dengan x-data --}}
    <div class="py-12" x-data="{ 
        editOpen: false, 
        editName: '', 
        editUrl: '' 
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">Selamat Datang, {{ Auth::user()->name }}!</h3>
                    <p class="mb-4">Anda telah berhasil masuk ke dalam sistem Kasiduit.</p>

                    {{-- PESAN SUKSES (3 DETIK HILANG) --}}
                    @if(session('success'))
                        <div x-data="{ show: true }" 
                             x-init="setTimeout(() => show = false, 3000)" 
                             x-show="show" 
                             x-transition.duration.500ms
                             class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div class="bg-blue-100 p-4 rounded-lg border border-blue-200">
                            <h4 class="font-bold text-blue-800">Total Donasi</h4>
                            <p class="text-2xl font-bold text-blue-600">Rp 0</p>
                        </div>
                        <div class="bg-green-100 p-4 rounded-lg border border-green-200">
                            <h4 class="font-bold text-green-800">Kampanye Aktif</h4>
                            <p class="text-2xl font-bold text-green-600">0</p>
                        </div>
                        <div class="bg-purple-100 p-4 rounded-lg border border-purple-200">
                            <h4 class="font-bold text-purple-800">User Terdaftar</h4>
                            <p class="text-2xl font-bold text-purple-600">1</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Form Tambah Kategori --}}
                <div class="md:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Tambah Kategori</h3>
                            
                            <form action="{{ route('categories.store') }}" method="POST">
                                @csrf 
                                <div class="mb-4">
                                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                                    <input type="text" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="Contoh: Kesehatan" required>
                                </div>
                                
                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">
                                    + Simpan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Tabel Daftar Kategori --}}
                <div class="md:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <h3 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Daftar Kategori</h3>

                            <div class="overflow-x-auto">
                                <table class="min-w-full table-auto">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-600">No</th>
                                            <th class="px-4 py-2 text-left text-sm font-bold text-gray-600">Nama</th>
                                            <th class="px-4 py-2 text-center text-sm font-bold text-gray-600">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @forelse($categories as $index => $cat)
                                        <tr class="hover:bg-gray-50"> 
                                            <td class="px-4 py-2 text-sm text-gray-700">{{ $index + 1 }}</td>
                                            <td class="px-4 py-2 text-sm font-semibold text-gray-800">{{ $cat->name }}</td>
                                            <td class="px-4 py-2 text-center flex justify-center gap-2">
                                                
                                                <button 
                                                    @click="editOpen = true; editName = '{{ $cat->name }}'; editUrl = '{{ route('categories.update', $cat->id) }}'"
                                                    class="bg-yellow-400 hover:bg-yellow-500 text-white text-xs font-bold py-1 px-2 rounded">
                                                    Edit
                                                </button>

                                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                                    @csrf
                                                    @method('DELETE') 
                                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-xs font-bold py-1 px-2 rounded">
                                                        Hapus
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="px-4 py-4 text-center text-gray-500 italic">Belum ada data kategori.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- MODAL EDIT --}}
        <div x-show="editOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                
                {{-- Overlay Gelap --}}
                <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="editOpen = false">
                    <div class="absolute inset-0 bg-gray-900 opacity-75"></div>
                </div>

                {{-- 
                    PERBAIKAN DISINI:
                    Ditambahkan class 'relative z-10' agar posisi modal DI ATAS overlay gelap.
                --}}
                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full relative z-10">
                    
                    <form :action="editUrl" method="POST">
                        @csrf
                        @method('PUT') 
                        
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Edit Kategori</h3>
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Nama</label>
                                <input type="text" name="name" x-model="editName" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>
                        
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Update
                            </button>
                            <button type="button" @click="editOpen = false" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        {{-- END MODAL --}}

    </div> 
</x-layouts.app>