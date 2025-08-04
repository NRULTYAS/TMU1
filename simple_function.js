        function loadGelombangData() {
            console.log('=== SIMPLE LOADING DATA ===');
            
            const select = document.getElementById('gelombang-select');
            if (!select) {
                console.error('Select element not found!');
                return;
            }
            
            console.log('Select element found, starting API call...');
            
            // Add loading indicator
            select.innerHTML = '<option value="">Loading data...</option>';
            
            // Get diklat_id from URL
            const urlParams = new URLSearchParams(window.location.search);
            const diklatId = urlParams.get('diklat_id') || '14-01807-46';
            
            const apiUrl = 'http://localhost/tugas1_tmu1/pendaftaran/get_periode_list/' + diklatId;
            console.log('Fetching:', apiUrl);
            
            fetch(apiUrl)
                .then(response => {
                    console.log('Response received:', response.status);
                    if (!response.ok) throw new Error('HTTP ' + response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Data received:', data);
                    
                    let options = '<option value="">-- Pilih Periode Pendaftaran --</option>';
                    
                    if (data.data && data.data.length > 0) {
                        data.data.forEach(item => {
                            const periodeText = item.pendaftaran_mulai && item.pendaftaran_akhir 
                                ? `${item.pendaftaran_mulai} s/d ${item.pendaftaran_akhir}`
                                : `Periode ${item.periode}`;
                            options += `<option value="${item.periode}">${periodeText}</option>`;
                        });
                        
                        // Store data globally
                        window.globalGelombangData = data.data;
                    } else {
                        options += '<option value="">Tidak ada data tersedia</option>';
                        window.globalGelombangData = [];
                    }
                    
                    select.innerHTML = options;
                    console.log('Dropdown updated successfully');
                    
                    // Add event listener
                    select.addEventListener('change', function() {
                        const value = this.value;
                        if (value && window.globalGelombangData) {
                            showPeriodeDetail(value, window.globalGelombangData, false);
                        } else {
                            resetPeriodeDetail();
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    select.innerHTML = '<option value="">-- Error loading data --</option>';
                });
        }
