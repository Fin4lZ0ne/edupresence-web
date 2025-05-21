<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>

<script src="{{ asset('js/simplebar.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<script src="{{ asset('js/template.js') }}"></script>
<script src="{{ asset('js/template.init.js') }}"></script>
<script src="{{ asset('js/sidebarmenu.js') }}"></script>
<script src="{{ asset('js/template.custom.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('btnShowProfile');

        if (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                fetch("{{ route('profile.data') }}")
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal mengambil data. Mungkin belum login.');
                        }
                        return response.json();
                    })
                    .then(data => {
                        document.getElementById('profile-nama').textContent = data.nama ?? '-';
                        document.getElementById('profile-ttl').textContent = data.ttl ?? '-';
                        document.getElementById('profile-gender').textContent = data.gender ?? '-';
                        document.getElementById('profile-nip').textContent = data.nip ?? '-';
                        document.getElementById('profile-username').textContent = data.username ?? '-';
                        document.getElementById('profile-email').textContent = data.email ?? '-';
                        document.getElementById('profile-alamat').textContent = data.alamat ?? '-';

                        const modal = new bootstrap.Modal(document.getElementById('profileModal'));
                        modal.show();
                    })
                    .catch(error => alert(error.message));
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.bootstrap5.js"></script>

{{-- <script src="https://cdn.datatables.net/plug-ins/2.0.5/i18n/id.json"></script> --}}

<script src="https://unpkg.com/@turf/turf@6.5.0/turf.min.js"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Konfigurasi Global DataTables -->
<script>
    // Gunakan file lokal yang Anda simpan sendiri jika ingin menghindari CORS (dijelaskan di bawah)
    Object.assign(DataTable.defaults, {
        language: {
            url: '{{ asset('datatables/id.json') }}', // Simpan file ini di public/datatables/id.json
        },
    });

    // Konfigurasi Pusher
    const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
        cluster: 'ap1',
    });
</script>

@livewireScripts

@stack('script')

<script src="{{ asset('js/main.js') }}"></script>



    
    