
document.getElementById('btnShowProfile').addEventListener('click', function (e) {
    e.preventDefault();

    fetch("{{ route('profile.data') }}")
        .then(response => response.json())
        .then(data => {
            document.getElementById('profile-nama').textContent = data.nama;
            document.getElementById('profile-ttl').textContent = data.ttl;
            document.getElementById('profile-gender').textContent = data.gender;
            document.getElementById('profile-nip').textContent = data.nip;
            document.getElementById('profile-username').textContent = data.username;
            document.getElementById('profile-email').textContent = data.email;
            document.getElementById('profile-alamat').textContent = data.alamat;

            var modal = new bootstrap.Modal(document.getElementById('profileModal'));
            modal.show();
        });
});
