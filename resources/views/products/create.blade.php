@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50/50 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6">
        
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Jual Barang</h1>
            <p class="text-gray-500 text-sm mt-1">Isi detail di bawah untuk mulai menayangkan produkmu.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 m-6 mb-0">
                    <div class="flex">
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Nike Air Jordan 1 Low" 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 transition-all">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand') }}" placeholder="Adidas / Nike" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" name="price" value="{{ old('price') }}" placeholder="0" 
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block pl-10 p-3.5">
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Size (EUR)</label>
                            <input type="number" step="0.5" name="size" value="{{ old('size') }}" placeholder="42" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi Barang</label>
                            <select name="condition" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5">
                                <option value="BNIB">BNIB </option>
                                <option value="Like New">Like New </option>
                                <option value="Used">Used </option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                        <textarea name="description" rows="4" placeholder="Jelaskan detail barang..." 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 resize-none">{{ old('description') }}</textarea>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Produk (Wajib)</label>
                    
                    <div x-data="{ photoName: null, photoPreview: null }">
                        <input type="file" name="image" class="hidden" x-ref="photo" 
                               x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                    reader.readAsDataURL($refs.photo.files[0]);
                               ">

                        <div class="mt-2 w-full aspect-video md:aspect-[4/3] flex justify-center items-center rounded-2xl border-2 border-dashed border-gray-300 hover:bg-gray-50 hover:border-black transition-all cursor-pointer relative overflow-hidden group"
                             x-on:click.prevent="$refs.photo.click()">
                            
                            <div class="text-center" x-show="! photoPreview">
                                <svg class="mx-auto h-12 w-12 text-gray-300 group-hover:text-gray-500 transition" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <p class="mt-2 text-sm text-gray-500 font-medium">Klik untuk upload foto</p>
                            </div>

                            <div class="absolute inset-0 z-10 w-full h-full bg-cover bg-center" 
                                 x-show="photoPreview" 
                                 x-bind:style="'background-image: url(\'' + photoPreview + '\');'"
                                 style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none transition-colors">
                        Upload Produk
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection