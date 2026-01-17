<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Form Pengajuan Izin / Cuti') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-8">
                
                <form action="{{ route('izin.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tipe Pengajuan</label>
                        <select name="type" class="w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="leave">Ajukan Cuti</option>
                            <option value="sick">Izin Sakit</option>
                            <option value="late">Izin Datang Terlambat</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal</label>
                        <input type="date" name="date" required class="w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alasan / Keterangan</label>
                        <textarea name="reason" rows="4" required placeholder="Jelaskan alasan Anda..." class="w-full border-gray-300 rounded-xl shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                    </div>

                    <div class="mb-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Lampiran Dokumen (Opsional)</label>
                        <p class="text-xs text-gray-500 mb-2">*Upload surat dokter jika sakit atau bukti pendukung lainnya.</p>
                        <input type="file" name="document" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:underline text-sm font-medium">Batal</a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg transition duration-200">
                            Kirim Pengajuan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>