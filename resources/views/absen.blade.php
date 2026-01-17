<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
            {{ __('Ambil Presensi') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6 border border-gray-100">
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Diri</label>
                    <div id="my_camera" class="rounded-2xl overflow-hidden shadow-inner bg-gray-100 mx-auto border-4 border-indigo-50" style="width: 320px; height: 240px;"></div>
                    <input type="hidden" name="image" id="image_tag">
                </div>

                <div id="status_gps" class="mb-4 p-3 bg-blue-50 text-blue-700 rounded-xl text-xs flex items-center">
                    <svg class="w-4 h-4 mr-2 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    <span>Mencari koordinat lokasi Anda...</span>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <button type="button" onclick="take_snapshot('in')" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-200 flex flex-col items-center">
                        <span class="text-sm">Absen</span>
                        <span class="text-xs font-normal opacity-80 uppercase">Masuk</span>
                    </button>
                    <button type="button" onclick="take_snapshot('out')" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-200 flex flex-col items-center">
                        <span class="text-sm">Absen</span>
                        <span class="text-xs font-normal opacity-80 uppercase">Pulang</span>
                    </button>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script language="JavaScript">
        // Konfigurasi Kamera
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        // Ambil Lokasi GPS saat halaman dibuka
        let lat, long;
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                lat = position.coords.latitude;
                long = position.coords.longitude;
                document.getElementById('status_gps').innerHTML = "📍 Lokasi terkunci! Anda siap melakukan absen.";
                document.getElementById('status_gps').className = "mb-4 p-3 bg-green-50 text-green-700 rounded-xl text-xs flex items-center";
            });
        }

        function take_snapshot(type) {
            if (!lat || !long) {
                Swal.fire('Error', 'Gagal mendapatkan lokasi GPS. Pastikan izin lokasi aktif!', 'error');
                return;
            }

            Webcam.snap(function(data_uri) {
                // Kirim data ke Controller menggunakan AJAX
                $.ajax({
                    url: "{{ route('absen.store') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        photo: data_uri,
                        latitude: lat,
                        longitude: long,
                        type: type
                    },
                    success: function(response) {
                        Swal.fire('Berhasil!', response.message, 'success').then(() => {
                            window.location.href = "{{ route('dashboard') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', xhr.responseJSON.message, 'error');
                    }
                });
            });
        }
    </script>
</x-app-layout>