<!-- Modal Profil -->
<div class="modal fade" id="profileModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Profil Pengguna</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">

        <!-- Foto Profil -->
        <div class="text-center position-relative mb-4" id="photo-wrapper" style="max-width: 200px; margin: auto;">
          <img id="profile-photo" class="img-fluid rounded-circle border"
               src="{{ asset('img/profile/default-profile.png') }}"
               style="width: 200px; height: 200px; object-fit: cover;">
          <div id="photo-overlay"
               class="position-absolute top-0 start-0 w-100 h-100 rounded-circle"
               style="background-color: rgba(0,0,0,0.4); display: none;"></div>
          <label for="photo-upload" id="edit-photo-label"
                 class="position-absolute top-50 start-50 translate-middle text-white p-2"
                 style="cursor: pointer; display: none;">
            <i class="bi bi-pencil-square fs-3"></i>
          </label>
          <input type="file" id="photo-upload" class="d-none" accept="image/*">
        </div>

        <!-- Tabel -->
        <table class="table table-bordered">
          <tr><th>Nama</th><td id="profile-nama"></td></tr>
          <tr><th>Tempat/Tanggal Lahir</th><td id="profile-ttl"></td></tr>
          <tr><th>Jenis Kelamin</th><td id="profile-gender"></td></tr>
          <tr><th>NIP</th><td id="profile-nip"></td></tr>
          <tr><th>Email</th><td id="profile-email"></td></tr>
          <tr><th>Alamat</th><td id="profile-alamat"></td></tr>
        </table>

        <div class="text-end">
          <button class="btn btn-primary" id="edit-profile-btn">Ubah</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editProfileModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="edit-profile-form">
        <div class="modal-header">
          <h5 class="modal-title">Ubah Profil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3"><label class="form-label">Nama</label><input id="edit-nama" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Tempat, Tanggal Lahir</label><input id="edit-ttl" class="form-control" placeholder="Contoh: Jakarta, 01 Januari 1990"></div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select id="edit-gender" class="form-select">
              <option value="">Pilih</option>
              <option value="male">Laki-laki</option>
              <option value="female">Perempuan</option>
            </select>
          </div>
          <div class="mb-3"><label class="form-label">NIP</label><input id="edit-nip" class="form-control"></div>
          <div class="mb-3"><label class="form-label">Alamat</label><textarea id="edit-alamat" class="form-control"></textarea></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
