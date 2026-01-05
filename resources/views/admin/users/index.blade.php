@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">

    <aside class="w-64 bg-white border-r border-gray-200 hidden md:flex flex-col flex-shrink-0">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-8">
                <div class="w-8 h-8 bg-black text-white flex items-center justify-center rounded-lg font-bold">A</div>
                <div>
                    <h2 class="font-bold text-gray-900 text-sm">Admin Panel</h2>
                    <p class="text-xs text-gray-400">Manage System</p>
                </div>
            </div>

            <nav class="space-y-1">
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-2.5 bg-black text-white rounded-lg text-sm font-medium transition">
                    Users & Roles
                </a>
                
                <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-4 py-2.5 text-gray-500 hover:bg-gray-50 hover:text-black rounded-lg text-sm font-medium transition">
                    Reports & Omzet
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-8 overflow-y-auto">
        
        <div class="flex justify-between items-end mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Pengguna </h1>
                <p class="text-sm text-gray-500 mt-1">Atur siapa saja yang bisa mengakses sistem.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100 text-gray-500 uppercase font-semibold text-xs">
                            <tr>
                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4 text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center font-bold text-gray-500 text-xs">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-900">{{ $user->name }}</p>
                                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold {{ $user->role == 'admin' ? 'bg-black text-white' : 'bg-green-100 text-green-700' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    @if(auth()->user()->id !== $user->id)
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?');">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 hover:underline font-medium text-xs">Hapus</button>
                                    </form>
                                    @else
                                    <span class="text-gray-300 text-xs italic">Saya</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-6">
                    <h3 class="font-bold text-gray-900 mb-4">Tambah User Baru</h3>
                    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Nama</label>
                            <input type="text" name="name" class="w-full rounded-lg border-gray-200 text-sm focus:ring-black focus:border-black" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Email</label>
                            <input type="email" name="email" class="w-full rounded-lg border-gray-200 text-sm focus:ring-black focus:border-black" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Password</label>
                            <input type="password" name="password" class="w-full rounded-lg border-gray-200 text-sm focus:ring-black focus:border-black" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Role</label>
                            <select name="role" class="w-full rounded-lg border-gray-200 text-sm focus:ring-black focus:border-black">
                                <option value="user">User Biasa</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full bg-black text-white py-2.5 rounded-lg font-bold text-sm hover:bg-gray-800 transition">
                            + Simpan User
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </main>
</div>
@endsection