<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Tambah Fasilitas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <style>
        .transition-card { transition: all 0.3s ease; }
        .map-container { position: relative; }
        .coordinate-overlay, .map-instructions {
            background: rgba(255,255,255,0.9);
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            z-index: 1000;
            border: 1px solid #ddd;
        }
        .coordinate-overlay { position: absolute; bottom: 10px; left: 10px; }
        .map-instructions { position: absolute; top: 10px; right: 10px; max-width: 250px; }
        .image-preview {
            width: 100%; height: 200px; object-fit: cover; border-radius: 8px;
            margin-bottom: 10px; border: 1px solid #e2e8f0;
        }
        .file-input-wrapper { position: relative; overflow: hidden; display: inline-block; }
        .file-input-wrapper input[type=file] {
            position: absolute; top: 0; right: 0;
            min-width: 100%; min-height: 100%; opacity: 0; cursor: pointer;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen">
<?= $this->include('dashboard/layout/sidebar') ?>
<div class="ml-64">
    <?= $this->include('dashboard/layout/header') ?>
    <main class="p-6">
        <div class="flex justify-between items-center mb-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Tambah Fasilitas</h1>
                <p class="text-slate-500 mt-1">Silakan lengkapi data fasilitas berikut.</p>
            </div>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg flex items-center gap-2">
                <span class="material-icons-round text-green-500">check_circle</span>
                <?= esc(session()->getFlashdata('message')) ?>
            </div>
        <?php endif ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-2">
                <span class="material-icons-round text-red-500">error</span>
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-1">
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm transition-card">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="material-icons-round mr-2 text-blue-600">add</span>
                        Data Fasilitas
                    </h2>
                    <form method="post" action="<?= site_url('dashboard/tambah') ?>" id="facilityForm" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Foto Fasilitas</label>
                            <div class="mb-3">
                                <div class="image-preview bg-gray-100 flex items-center justify-center" id="imagePreview">
                                    <span class="text-gray-400 flex flex-col items-center">
                                        <span class="material-icons-round text-4xl">image</span>
                                        <span>Tidak ada gambar</span>
                                    </span>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="file-input-wrapper">
                                    <button type="button" class="px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg text-blue-700 flex items-center gap-1 hover:bg-blue-100 transition-all">
                                        <span class="material-icons-round text-sm">upload_file</span>
                                        Pilih Foto
                                    </button>
                                    <input type="file" name="image" id="imageInput" accept="image/*" />
                                </div>
                                <span id="fileNameDisplay" class="text-sm text-gray-600 max-w-[200px] truncate block">Tidak ada file yang dipilih</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Format: JPG/PNG, ukuran maks: 2MB</p>
                        </div>

                        <?php foreach (['code','name','address','district'] as $field): ?>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1 capitalize"><?= str_replace('_',' ',$field) ?></label>
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                        <span class="material-icons-round text-sm">
                                            <?php
                                            $icons = ['code' => 'qr_code', 'name' => 'local_hospital', 'address' => 'place', 'district' => 'location_city'];
                                            echo $icons[$field] ?? 'edit';
                                            ?>
                                        </span>
                                    </span>
                                    <input type="text" name="<?= $field ?>" class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                                </div>
                            </div>
                        <?php endforeach ?>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amenity</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                    <span class="material-icons-round text-sm">category</span>
                                </span>
                                <select name="amenity" required class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="">-- Pilih Jenis --</option>
                                    <?php foreach (['Puskesmas','Rumah Sakit','Klinik'] as $opt): ?>
                                        <option value="<?= $opt ?>"><?= $opt ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <?php foreach (['class','hospital_type'] as $field): ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1 capitalize"><?= str_replace('_',' ',$field) ?></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                            <span class="material-icons-round text-sm"><?= $field === 'class' ? 'grade' : 'business' ?></span>
                                        </span>
                                        <select name="<?= $field ?>" class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                            <option value="">-- Pilih --</option>
                                            <?php $opts = ($field === 'class') ? ['A','B','C','D'] : ['Pemerintah','Swasta']; ?>
                                            <?php foreach ($opts as $opt): ?>
                                                <option value="<?= $opt ?>"><?= $opt ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Care Type</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                    <span class="material-icons-round text-sm">healing</span>
                                </span>
                                <select name="care_type" required class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                                    <option value="">-- Pilih --</option>
                                    <option value="Rawat Inap">Rawat Inap</option>
                                    <option value="Non Rawat Inap">Non Rawat Inap</option>
                                </select>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <?php foreach (['lat','lng'] as $coord): ?>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1"><?= strtoupper($coord) ?></label>
                                    <div class="relative">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-500">
                                            <span class="material-icons-round text-sm"><?= $coord === 'lat' ? 'north' : 'east' ?></span>
                                        </span>
                                        <input type="text" id="<?= $coord ?>Input" name="<?= $coord ?>" pattern="[-+]?[0-9]*\.?[0-9]+" title="Format angka valid" class="w-full pl-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" />
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>

                        

                        <div class="flex justify-end gap-2">
                            <a href="<?= previous_url() ?>" class="px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition-all text-gray-700">Batal</a>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center gap-1">
                                <span class="material-icons-round text-sm">save</span> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Map Section -->
            <div class="lg:col-span-2">
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm transition-card">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="material-icons-round mr-2 text-blue-600">map</span>
                        Lokasi Fasilitas
                    </h2>
                    <div class="map-container">
                        <div id="map" class="w-full h-96 rounded-lg border border-gray-300"></div>
                        <div class="coordinate-overlay" id="coordinateDisplay"><b>Koordinat:</b> <span id="currentCoords">0.000000, 0.000000</span></div>
                        <div class="map-instructions">
                            <div class="flex items-center mb-1 text-blue-600">
                                <span class="material-icons-round text-sm mr-1">info</span>
                                <b>Petunjuk:</b>
                            </div>
                            <p class="text-sm text-gray-600">Klik pada peta untuk memilih lokasi.</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <button id="zoomToMarker" class="px-3 py-1 bg-blue-50 border border-blue-200 rounded-lg text-blue-700 flex items-center gap-1 hover:bg-blue-100 transition-all">
                            <span class="material-icons-round text-sm">center_focus_strong</span> Fokus ke Marker
                        </button>
                        <div class="flex items-center gap-2">
                            <button id="searchAddress" class="px-3 py-1 bg-green-50 border border-green-200 rounded-lg text-green-700 flex items-center gap-1 hover:bg-green-100 transition-all">
                                <span class="material-icons-round text-sm">search</span> Cari Alamat
                            </button>
                            <input type="text" id="addressSearch" placeholder="Masukkan alamat..." class="border border-gray-300 rounded-lg px-3 py-1 w-60 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
        document.addEventListener('DOMContentLoaded', () => {
            const latInput = document.getElementById('latInput');
            const lngInput = document.getElementById('lngInput');
            const coordDisplay = document.getElementById('currentCoords');
            const zoomToMarkerBtn = document.getElementById('zoomToMarker');
            const searchBtn = document.getElementById('searchAddress');
            const addressInput = document.getElementById('addressSearch');
            const imageInput = document.getElementById('imageInput');
            const fileNameDisplay = document.getElementById('fileNameDisplay');
            const imagePreview = document.getElementById('imagePreview');
            
            imageInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    fileNameDisplay.textContent = file.name;
                    
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (imagePreview.tagName === 'IMG') {
                            imagePreview.src = e.target.result;
                        } else {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.alt = 'Preview';
                            img.className = 'image-preview';
                            img.id = 'imagePreview';
                            imagePreview.parentNode.replaceChild(img, imagePreview);
                        }
                    }
                    reader.readAsDataURL(file);
                } else {
                    fileNameDisplay.textContent = 'Tidak ada file yang dipilih';
                }
            });
            
            const lat = parseFloat(latInput.value) || 5.548290;
            const lng = parseFloat(lngInput.value) || 95.323753;
                
            coordDisplay.textContent = `${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            
            const map = L.map('map').setView([lat, lng], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            
            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);
            
            marker.on('dragend', function(e) {
                const position = marker.getLatLng();
                latInput.value = position.lat.toFixed(6);
                lngInput.value = position.lng.toFixed(6);
                coordDisplay.textContent = `${position.lat.toFixed(6)}, ${position.lng.toFixed(6)}`;
            });
            
            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                latInput.value = e.latlng.lat.toFixed(6);
                lngInput.value = e.latlng.lng.toFixed(6);
                coordDisplay.textContent = `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
            });
            
            map.on('mousemove', function(e) {
                coordDisplay.textContent = `${e.latlng.lat.toFixed(6)}, ${e.latlng.lng.toFixed(6)}`;
            });
            
            latInput.addEventListener('change', updateMarkerFromInputs);
            lngInput.addEventListener('change', updateMarkerFromInputs);
            
            function updateMarkerFromInputs() {
                const newLat = parseFloat(latInput.value);
                const newLng = parseFloat(lngInput.value);
                
                if (!isNaN(newLat) && !isNaN(newLng)) {
                    marker.setLatLng([newLat, newLng]);
                    map.setView([newLat, newLng], map.getZoom());
                    coordDisplay.textContent = `${newLat.toFixed(6)}, ${newLng.toFixed(6)}`;
                }
            }
            
            zoomToMarkerBtn.addEventListener('click', function() {
                const position = marker.getLatLng();
                map.setView(position, 15);
            });
            
            searchBtn.addEventListener('click', function() {
                const searchText = addressInput.value.trim();
                if (searchText) {
                    alert(`Searching for: ${searchText}\n\nNote: Mock up, gunakan Nomatim atau Gmaps API.`);
                    const mockLat = lat + (Math.random() - 0.5) * 0.05;
                    const mockLng = lng + (Math.random() - 0.5) * 0.05;
                    
                    marker.setLatLng([mockLat, mockLng]);
                    map.setView([mockLat, mockLng], 16);
                    latInput.value = mockLat.toFixed(6);
                    lngInput.value = mockLng.toFixed(6);
                    coordDisplay.textContent = `${mockLat.toFixed(6)}, ${mockLng.toFixed(6)}`;
                }
            });
            
            addressInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });
            
            L.control.scale().addTo(map);
        });
    </script>
</body>
</html>
