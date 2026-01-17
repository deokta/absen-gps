<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rekap Absensi Seluruh Karyawan') }}
            </h2>
            <a href="{{ route('admin.export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Export CSV
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                
                <div class="mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Laporan Kehadiran Real-time</h3>
                    <p class="text-sm text-gray-600">Memantau seluruh aktivitas absen masuk dan pulang karyawan serta lokasi pengambilan data.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full border-separate border-spacing-y-2">
                        <thead class="bg-gray-50 text-gray-500 uppercase text-xs font-bold">
                            <tr>
                                <th class="px-6 py-4 text-left rounded-l-lg tracking-wider">Karyawan</th>
                                <th class="px-6 py-4 text-left tracking-wider">Waktu</th>
                                <th class="px-6 py-4 text-left tracking-wider">Tipe</th>
                                <th class="px-6 py-4 text-left tracking-wider">Status</th>
                                <th class="px-6 py-4 text-center tracking-wider">Lokasi</th>
                                <th class="px-6 py-4 text-center rounded-r-lg tracking-wider">Foto Bukti</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($semua_absensi as $row)
                            <tr class="bg-white hover:bg-indigo-50/30 transition duration-200">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold uppercase">
                                                {{ substr($row->user->name, 0, 2) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $row->user->name }}</div>
                                            <div class="text-xs text-gray-500">{{ $row->user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    <div class="font-medium text-gray-900">{{ $row->created_at->translatedFormat('d F Y') }}</div>
                                    <div class="text-xs font-mono text-indigo-500">{{ $row->created_at->format('H:i:s') }} WIB</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $row->type == 'in' ? 'bg-green-100 text-green-700' : 'bg-orange-100 text-orange-700' }}">
                                        {{ $row->type == 'in' ? 'Masuk' : 'Pulang' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold {{ $row->status == 'Terlambat' ? 'bg-red-100 text-red-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $row->status ?? 'Tepat Waktu' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($row->latitude && $row->longitude)
                                        <a href="https://www.google.com/maps?q={{ $row->latitude }},{{ $row->longitude }}" 
                                           target="_blank" 
                                           class="inline-flex items-center text-indigo-600 hover:text-indigo-900 text-xs font-bold underline decoration-indigo-200 underline-offset-4">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                            Map
                                        </a>
                                    @else
                                        <span class="text-gray-400 text-[10px] italic">No GPS</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($row->photo)
                                        <a href="{{ asset('storage/' . $row->photo) }}" target="_blank" class="block">
                                            <img src="{{ asset('storage/' . $row->photo) }}" class="h-12 w-12 rounded-xl object-cover mx-auto border-2 border-white shadow-md hover:scale-125 transition-transform duration-200">
                                        </a>
                                    @else
                                        <div class="h-12 w-12 rounded-xl bg-gray-100 border border-gray-200 flex items-center justify-center mx-auto">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-400 italic">
                                    Belum ada data absensi untuk hari ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>