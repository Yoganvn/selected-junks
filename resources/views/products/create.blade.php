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
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada input:</h3>
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
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 transition-all duration-200 hover:bg-gray-100 focus:bg-white placeholder-gray-400">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand') }}" placeholder="Adidas / Nike" 
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 transition-all duration-200 hover:bg-gray-100 focus:bg-white placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm font-medium">Rp</span>
                                </div>
                                <input type="number" name="price" value="{{ old('price') }}" placeholder="0" 
                                    class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block pl-10 p-3.5 transition-all duration-200 hover:bg-gray-100 focus:bg-white placeholder-gray-400">
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
                                class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 transition-all duration-200 hover:bg-gray-100 focus:bg-white placeholder-gray-400">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Kondisi Barang</label>
                            <div class="relative">
                                <select name="condition" class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 appearance-none hover:bg-gray-100 focus:bg-white transition-all cursor-pointer">
                                    <option value="BNIB">BNIB (Brand New In Box)</option>
                                    <option value="Like New">Like New (Bekas Rasa Baru)</option>
                                    <option value="Used">Used (Pemakaian Wajar)</option>
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Produk</label>
                        <textarea name="description" rows="4" placeholder="Jelaskan detail barang, kelengkapan box, atau minus pemakaian..." 
                            class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-black focus:border-black block p-3.5 transition-all duration-200 hover:bg-gray-100 focus:bg-white placeholder-gray-400 resize-none">{{ old('description') }}</textarea>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Produk</label>
                    
                    <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                        <input type="file" name="image" class="hidden" x-ref="photo"
                               x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => { photoPreview = e.target.result; };
                                    reader.readAsDataURL($refs.photo.files[0]);
                               ">

                        <div class="mt-2 flex justify-center rounded-2xl border-2 border-dashed border-gray-300 px-6 py-10 hover:bg-gray-50 hover:border-gray-400 transition-all cursor-pointer relative overflow-hidden"
                             x-on:click.prevent="$refs.photo.click()">
                            
                            <div class="text-center" x-show="! photoPreview">
                                <svg class="mx-auto h-12 w-12 text-gray-300" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="mt-4 flex text-sm text-gray-600 justify-center">
                                    <span class="relative cursor-pointer rounded-md font-medium text-black hover:underline focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2">
                                        Upload file
                                    </span>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">PNG, JPG, JPEG up to 2MB</p>
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
                    <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-black hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-colors">
                        Tayangkan Produk Sekarang
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection