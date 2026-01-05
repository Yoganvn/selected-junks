@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50/50 py-12">
    <div class="max-w-3xl mx-auto px-4">
        
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('products.manage') }}" class="text-gray-400 hover:text-black transition">
                &larr; Kembali
            </a>
            <h1 class="text-2xl font-bold">Edit Produk</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
                @csrf
                @method('PUT') 

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name', $product->name) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Brand</label>
                            <input type="text" name="brand" value="{{ old('brand', $product->brand) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold mb-2">Size</label>
                            <input type="number" step="0.5" name="size" value="{{ old('size', $product->size) }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">Kondisi</label>
                            <select name="condition" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">
                                <option value="BNIB" {{ $product->condition == 'BNIB' ? 'selected' : '' }}>BNIB</option>
                                <option value="Like New" {{ $product->condition == 'Like New' ? 'selected' : '' }}>Like New</option>
                                <option value="Used" {{ $product->condition == 'Used' ? 'selected' : '' }}>Used</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" class="w-full bg-gray-50 border border-gray-200 rounded-xl p-3.5 focus:ring-black">{{ old('description', $product->description) }}</textarea>
                    </div>
                </div>

                <hr class="border-gray-100">

                <div>
                    <label class="block text-sm font-semibold mb-4">Foto Produk</label>
                    <div class="flex items-start gap-6 bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <div class="shrink-0 text-center">
                            <img src="{{ asset('storage/' . $product->image) }}" class="h-24 w-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                            <p class="text-[10px] text-gray-500 mt-2 uppercase font-bold">Saat Ini</p>
                        </div>

                        <div class="flex-1">
                            <label class="block w-full cursor-pointer">
                                <span class="sr-only">Choose profile photo</span>
                                <input type="file" name="image" class="block w-full text-sm text-slate-500
                                  file:mr-4 file:py-2.5 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-xs file:font-semibold
                                  file:bg-black file:text-white
                                  hover:file:bg-gray-800
                                  transition
                                "/>
                            </label>
                            <p class="text-xs text-gray-500 mt-2">Upload foto baru hanya jika Anda ingin mengganti foto yang lama.</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full py-4 px-4 rounded-xl font-bold text-white bg-black hover:bg-gray-800 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection