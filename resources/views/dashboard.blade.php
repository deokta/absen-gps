<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Karyawan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 mb-8">
                <div class="p-6 flex flex-col md:flex-row items-center">
                    <div class="relative">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 class="w-24 h-24 rounded-2xl object-cover border-4 border-indigo-50 shadow-sm">
                        @else
                            <div class="w-24 h-24 rounded-2xl bg-indigo-600 flex items-center justify-center shadow-lg">
                                <span class="text-3xl font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div class="absolute -bottom-1 -right-1 bg-green-500 w-5 h-5 rounded-full border-4 border-white"></div>
                    </div>

                    <div class="mt-4 md:mt-0 md:ml-6 text-center md:text-left flex-grow">
                        <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
                        <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-1 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                NIK: <strong class="ml-1 text-gray-800">{{ Auth::user()->nik ?? '-' }}</strong>
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                {{ Auth::user()->email }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0">
                        <span class="bg-green-50 text-green-700 px-4 py-1.5 rounded-lg text-xs font-bold uppercase tracking-wider border border-green-100">
                            Karyawan Aktif
                        </span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                
                <a href="{{ route('absen.datang') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-600 transition">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-700">Absen Datang</h3>
                </a>

                <a href="{{ route('absen.pulang') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-600 transition">
                        <svg class="w-8 h-8 text-orange-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-700">Absen Pulang</h3>
                </a>

                <a href="{{ route('cuti.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-purple-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-600 transition">
                        <svg class="w-8 h-8 text-purple-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-700">Ajukan Cuti</h3>
                </a>

                <a href="{{ route('izin.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition text-center group">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-red-600 transition">
                        <svg class="w-8 h-8 text-red-600 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 15.634c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <h3 class="font-bold text-gray-700">Izin & Sakit</h3>
                </a>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 mb-8">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Aktivitas Terakhir</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th class="pb-3">Waktu</th>
                                    <th class="pb-3">Tipe</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse($absensi as $row)
                                <tr>
                                    <td class="py-4">
                                        <p class="font-medium text-gray-900">{{ $row->created_at->format('H:i') }}</p>
                                        <p class="text-xs text-gray-500">{{ $row->created_at->format('d M Y') }}</p>
                                    </td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded-md text-xs font-bold {{ $row->type == 'in' ? 'bg-blue-100 text-blue-700' : 'bg-orange-100 text-orange-700' }}">
                                            {{ $row->type == 'in' ? 'DATANG' : 'PULANG' }}
                                        </span>
                                    </td>
                                    <td class="py-4 font-semibold {{ $row->status == 'Terlambat' ? 'text-red-600' : 'text-green-600' }}">
                                        {{ $row->status }}
                                    </td>
                                    <td class="py-4 text-center">
                                        <button class="text-indigo-600 hover:underline font-medium">Detail</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-400 italic">Belum ada riwayat absensi.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800">Riwayat Izin & Cuti</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    <th class="pb-3">Tanggal Izin</th>
                                    <th class="pb-3">Jenis</th>
                                    <th class="pb-3">Status</th>
                                    <th class="pb-3">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-sm">
                                @forelse($izin as $iz)
                                <tr>
                                    <td class="py-4 font-medium text-gray-900">
                                        {{ \Carbon\Carbon::parse($iz->date)->format('d M Y') }}
                                    </td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700 uppercase">
                                            {{ $iz->type }}
                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <span class="px-2 py-1 rounded-md text-xs font-bold 
                                            {{ $iz->status == 'approved' ? 'bg-green-100 text-green-700' : ($iz->status == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ strtoupper($iz->status) }}
                                        </span>
                                    </td>
                                    <td class="py-4 text-gray-500">
                                        {{ Str::limit($iz->reason, 40) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-6 text-center text-gray-400 italic">Belum ada riwayat pengajuan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>