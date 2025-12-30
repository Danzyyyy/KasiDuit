<div class="p-6">
    <div class="max-w-4xl mx-auto">
        
        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- BAGIAN 1: FORM INPUT (Kiri) --}}
            <div class="md:col-span-1">
                <div class="bg-white p-4 shadow rounded-lg">
                    <h2 class="text-xl font-bold mb-4">
                        {{ $isEditMode ? 'Edit Kategori' : 'Tambah Kategori' }}
                    </h2>

                    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                            <input type="text" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                {{ $isEditMode ? 'Update' : 'Simpan' }}
                            </button>
                            
                            @if($isEditMode)
                                <button type="button" wire:click="resetInput" class="text-gray-500 hover:text-gray-800">
                                    Batal
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            {{-- BAGIAN 2: TABEL LIST DATA (Kanan) --}}
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Nama
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Slug
                                </th>
                                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                                <tr>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-900 whitespace-no-wrap">{{ $cat->name }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <p class="text-gray-600 whitespace-no-wrap">{{ $cat->slug }}</p>
                                    </td>
                                    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                        <button wire:click="edit({{ $cat->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                                        <button wire:click="delete({{ $cat->id }})" wire:confirm="Yakin ingin menghapus kategori ini?" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <div class="p-4">
                        {{ $categories->links() }} 
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>