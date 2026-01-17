<x-app-layout>
    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl p-6">
                <h2 class="text-xl font-bold mb-4 text-center">Scan Lokasi & Absen</h2>
                
                <div id="my_camera" class="rounded-xl overflow-hidden bg-gray-100 mb-4 mx-auto" style="width:320px; height:240px;"></div>

                <form action="{{ route('absen.store') }}" method="POST" id="absenForm">
                    @csrf
                    <input type