document.addEventListener('DOMContentLoaded', function () {
    const btn = document.getElementById('btnShowProfile');
    const btnEdit = document.getElementById('edit-profile-btn');
    let lastFetchedProfile = null;

    const profileDataUrl = document.querySelector('meta[name="profile-data-url"]').content;
    const profileUpdateUrl = document.querySelector('meta[name="profile-update-url"]').content;
    const profileUpdatePhotoUrl = document.querySelector('meta[name="profile-photo-update-url"]').content;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    if (btn) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();

            fetch(profileDataUrl)
                .then(res => res.json())
                .then(data => {
                    lastFetchedProfile = data;
                    document.getElementById('profile-nama').textContent = data.nama ?? '-';
                    document.getElementById('profile-ttl').textContent = data.ttl ?? '-';
                    document.getElementById('profile-gender').textContent = data.gender ?? '-';
                    document.getElementById('profile-nip').textContent = data.nip ?? '-';
                    document.getElementById('profile-email').textContent = data.email ?? '-';
                    document.getElementById('profile-alamat').textContent = data.alamat ?? '-';
                    document.getElementById('profile-photo').src = data.photo_url;

                    new bootstrap.Modal(document.getElementById('profileModal')).show();
                })
                .catch(err => alert(err.message));
        });
    }

    if (btnEdit) {
        btnEdit.addEventListener('click', () => {
            if (!lastFetchedProfile) return;

            document.getElementById('edit-nama').value = lastFetchedProfile.nama ?? '';
            // Pastikan format tanggal sesuai YYYY-MM-DD jika ttl ada dan valid
            if (lastFetchedProfile.ttl) {
                // Coba parse dan format ke YYYY-MM-DD jika perlu
                const date = new Date(lastFetchedProfile.ttl);
                if (!isNaN(date.getTime())) {
                    // Format ke YYYY-MM-DD
                    const yyyy = date.getFullYear();
                    const mm = String(date.getMonth() + 1).padStart(2, '0');
                    const dd = String(date.getDate()).padStart(2, '0');
                    document.getElementById('edit-ttl').value = `${yyyy}-${mm}-${dd}`;
                } else {
                    document.getElementById('edit-ttl').value = '';
                }
            } else {
                document.getElementById('edit-ttl').value = '';
            }
            document.getElementById('edit-gender').value =
                lastFetchedProfile.gender.toLowerCase() === 'laki-laki' ? 'male' : 'female';
            document.getElementById('edit-nip').value = lastFetchedProfile.nip ?? '';
            document.getElementById('edit-alamat').value = lastFetchedProfile.alamat ?? '';

            bootstrap.Modal.getInstance(document.getElementById('profileModal')).hide();
            new bootstrap.Modal(document.getElementById('editProfileModal')).show();
        });
    }

    document.getElementById('edit-profile-form').addEventListener('submit', function (e) {
        e.preventDefault();

        const data = {
            nama: document.getElementById('edit-nama').value,
            ttl: document.getElementById('edit-ttl').value,
            gender: document.getElementById('edit-gender').value,
            nip: document.getElementById('edit-nip').value,
            alamat: document.getElementById('edit-alamat').value,
        };

        fetch(profileUpdateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data),
        })
            .then(res => res.json())
            // .then(() => {
            //     bootstrap.Modal.getInstance(document.getElementById('editProfileModal')).hide();
            //     btn.click();
            //     alert('Profil berhasil diperbarui');
            // })
            .catch(err => alert(err.message));
    });

    // Upload Foto
    const wrapper = document.getElementById('photo-wrapper');
    const photoInput = document.getElementById('photo-upload');
    const profilePhoto = document.getElementById('profile-photo');
    const overlay = document.getElementById('photo-overlay');
    const editLabel = document.getElementById('edit-photo-label');

    wrapper.addEventListener('mouseenter', () => {
        overlay.style.display = 'block';
        editLabel.style.display = 'block';
    });
    wrapper.addEventListener('mouseleave', () => {
        overlay.style.display = 'none';
        editLabel.style.display = 'none';
    });

    photoInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        profilePhoto.src = URL.createObjectURL(file);

        const formData = new FormData();
        formData.append('photo', photoInput.files[0]);

        fetch(profileUpdatePhotoUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        })
        .then(async res => {
            if (!res.ok) {
                const text = await res.text();
                console.error('Response not OK:', res.status, text);
                throw new Error('Server returned status ' + res.status);
            }
            return res.json();
        })
        .then(data => {
            if (data.success) {
                alert("Foto berhasil diperbarui!");
            } else {
                alert("Gagal mengunggah foto: " + (data.message ?? ''));
            }
        })
        .catch(err => {
            console.error('Fetch error:', err);
            alert("Terjadi kesalahan saat mengunggah foto.");
        });

    });
});
