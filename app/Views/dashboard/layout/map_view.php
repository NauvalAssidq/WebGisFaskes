<!-- Map -->
<div id="map" class="border border-gray-400 rounded h-[600px]"></div>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    const bandaAcehBounds = L.latLngBounds(
        L.latLng(5.40, 95.20),
        L.latLng(5.70, 95.45)
    );
    const map = L.map('map', {
        maxBounds: bandaAcehBounds,
        maxBoundsViscosity: 1.0,
        minZoom: 12,
        maxZoom: 18
    }).setView([5.5483, 95.3238], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18,
        minZoom: 12
    }).addTo(map);
    let markers = [];
    const filterEndpoints = {
        amenity: '/map/getAmenitiesList',
        district: '/map/getDistricts',
        hospital_type: '/map/getHospitalTypes',
        hospital_class: '/map/getClasses'
    };
    
    const activeFilters = {
        search: '',
        amenity: [],
        district: [],
        hospital_type: [],
        hospital_class: []
    };
    const getMarkerIcon = (amenity) => {
        let color;
        switch(amenity) {
            case 'Rumah Sakit': color = 'red'; break;
            case 'Puskesmas': color = 'blue'; break;
            case 'Klinik': color = 'green'; break;
            default: color = 'gray';
        }
        
        return L.divIcon({
            className: 'custom-marker',
            html: `<div class="marker-pin bg-${color}-500"></div>`,
            iconSize: [30, 30],
            iconAnchor: [15, 15]
        });
    };
    document.getElementById('toggleFilterBtn').addEventListener('click', function() {
        const filterPanel = document.getElementById('filterPanel');
        filterPanel.classList.toggle('hidden');
    });
    function clearMarkers() {
        markers.forEach(m => map.removeLayer(m));
        markers = [];
    }
    function updateActiveFilterBadges() {
        const container = document.getElementById('activeFilters');
        container.innerHTML = '';
        
        let hasActiveFilters = false;
        if (activeFilters.search) {
            const badge = createFilterBadge('search', 'Pencarian', activeFilters.search);
            container.appendChild(badge);
            hasActiveFilters = true;
        }
        
        for (const [type, values] of Object.entries(activeFilters)) {
            if (type === 'search') continue;
            
            if (Array.isArray(values) && values.length > 0) {
                values.forEach(value => {
                    const badge = createFilterBadge(type, getCategoryName(type), value);
                    container.appendChild(badge);
                });
                hasActiveFilters = true;
            }
        }
        
        if (!hasActiveFilters) {
            container.innerHTML = '<span class="text-gray-500 text-sm">Tidak ada filter aktif</span>';
        }
    }
    
    function createFilterBadge(type, category, value) {
        const badge = document.createElement('div');
        badge.className = 'filter-badge';
        badge.dataset.type = type;
        badge.dataset.value = value;
        
        badge.innerHTML = `
            <span>${category}: <strong>${value}</strong></span>
            <span class="remove material-icons text-sm">close</span>
        `;
        
        badge.querySelector('.remove').addEventListener('click', function() {
            removeFilter(type, value);
        });
        
        return badge;
    }
    function getCategoryName(type) {
        switch(type) {
            case 'amenity': return 'Jenis Fasilitas';
            case 'district': return 'Kecamatan';
            case 'hospital_type': return 'Tipe RS';
            case 'hospital_class': return 'Kelas RS';
            default: return type;
        }
    }
    function removeFilter(type, value) {
        if (type === 'search') {
            activeFilters.search = '';
            document.getElementById('searchInput').value = '';
        } else if (Array.isArray(activeFilters[type])) {
            activeFilters[type] = activeFilters[type].filter(item => item !== value);
            
            const checkbox = document.querySelector(`input[data-type="${type}"][data-value="${value}"]`);
            if (checkbox) checkbox.checked = false;
        }
        
        updateActiveFilterBadges();
        loadMarkers();
    }
    function clearAllFilters() {
        activeFilters.search = '';
        activeFilters.amenity = [];
        activeFilters.district = [];
        activeFilters.hospital_type = [];
        activeFilters.hospital_class = [];
        
        document.getElementById('searchInput').value = '';
        document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
            checkbox.checked = false;
        });
        
        updateActiveFilterBadges();
        loadMarkers();
    }
    function createFilterItem(type, value) {
        const id = `${type}-${value.replace(/\s+/g, '-').toLowerCase()}`;
        
        const label = document.createElement('label');
        label.className = 'filter-item inline-flex items-center px-3 py-1.5 bg-white border border-gray-300 rounded-md hover:bg-gray-50';
        label.htmlFor = id;
        
        const checkbox = document.createElement('input');
        checkbox.type = 'checkbox';
        checkbox.id = id;
        checkbox.className = 'form-checkbox h-4 w-4 text-blue-600 mr-2';
        checkbox.dataset.type = type;
        checkbox.dataset.value = value;
        checkbox.checked = activeFilters[type].includes(value);
        
        label.appendChild(checkbox);
        label.append(value);
        
        return label;
    }
    function toggleFilter(type, value, checked) {
        if (checked) {
            if (!activeFilters[type].includes(value)) {
                activeFilters[type].push(value);
            }
        } else {
            activeFilters[type] = activeFilters[type].filter(item => item !== value);
        }
    }
    async function loadFilterOptions(filterType, containerId) {
        try {
            const container = document.getElementById(containerId);
            container.innerHTML = '<span class="text-gray-500">Loading...</span>';
            
            const url = filterEndpoints[filterType];
            const response = await fetch(url);
            
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            
            const data = await response.json();
            container.innerHTML = '';
            
            if (Array.isArray(data)) {
                const options = data.map(item => {
                    let value;
                    if (filterType === 'hospital_class') {
                        value = item.class;
                    } else {
                        value = item[filterType] || '';
                    }
                    
                    return value;
                }).filter(v => v && typeof v === 'string');
                
                options.sort();
                
                options.forEach(option => {
                    const filterItem = createFilterItem(filterType, option);
                    container.appendChild(filterItem);
                    
                    const checkbox = filterItem.querySelector('input[type="checkbox"]');
                    checkbox.addEventListener('change', function() {
                        toggleFilter(filterType, option, this.checked);
                    });
                });
            }
            
            if (container.children.length === 0) {
                container.innerHTML = '<span class="text-gray-500">Tidak ada opsi tersedia</span>';
            }
        } catch (error) {
            console.error(`Error loading ${filterType} options:`, error);
            document.getElementById(containerId).innerHTML = 
                '<span class="text-red-500">Error loading options</span>';
        }
    }
    function applyFilters() {
        activeFilters.search = document.getElementById('searchInput').value;
        updateActiveFilterBadges();
        loadMarkers();
        document.getElementById('filterPanel').classList.add('hidden');
    }
    function searchFacilities() {
        activeFilters.search = document.getElementById('searchInput').value;
        updateActiveFilterBadges();
        loadMarkers();
    }
    function loadMarkers() {
        const query = new URLSearchParams();
        
        if (activeFilters.search) {
            query.append('search', activeFilters.search);
        }
        
        for (const [type, values] of Object.entries(activeFilters)) {
            if (type === 'search') continue;
            
            if (Array.isArray(values) && values.length > 0) {
                values.forEach(value => {
                    query.append(`${type}[]`, value);
                });
            }
        }
        
        document.getElementById('facilityCount').textContent = 'memuat...';
        
        fetch(`/map/getMarkers?${query.toString()}`)
            .then(res => {
                if (!res.ok) {
                    throw new Error(`HTTP error! Status: ${res.status}`);
                }
                return res.json();
            })
            .then(data => {
                clearMarkers();
                
                if (data && Array.isArray(data)) {
                    data.forEach(item => {
                        if (item.lat && item.lng) {
                            const icon = getMarkerIcon(item.amenity);
                            const marker = L.marker([item.lat, item.lng], { icon: icon }).addTo(map);
                            
                            marker.bindTooltip(item.name, { direction: 'top' });
                            marker.bindPopup(`
                                <strong>${item.name}</strong><br>
                                ${item.amenity || ''}<br>
                                ${item.address || 'Alamat tidak tersedia'}<br>
                                ${item.district ? `Kecamatan: ${item.district}` : ''}<br>
                                ${item.amenity === "Rumah Sakit" ? `
                                    Tipe: ${item.hospital_type || 'N/A'}<br>
                                    Kelas: ${item.class || 'N/A'}<br>
                                ` : ''}
                            `);
                            
                            markers.push(marker);
                        }
                    });
                    
                    document.getElementById('facilityCount').textContent = data.length;
                } else {
                    console.error('Invalid data format received');
                    document.getElementById('facilityCount').textContent = '0';
                }
            })
            .catch(error => {
                console.error('Error loading markers:', error);
                document.getElementById('facilityCount').textContent = 'Error';
            });
    }
    document.addEventListener('DOMContentLoaded', function() {
        loadFilterOptions('amenity', 'amenityFilters');
        loadFilterOptions('district', 'districtFilters');
        loadFilterOptions('hospital_type', 'hospitalTypeFilters');
        loadFilterOptions('hospital_class', 'hospitalClassFilters');
        
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchFacilities();
            }
        });
        
        updateActiveFilterBadges();
        loadMarkers();
    });
</script>