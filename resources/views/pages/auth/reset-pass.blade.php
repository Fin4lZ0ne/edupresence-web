<div class="col-xl-5 col-xxl-4">
    <div class="authentication-login min-vh-100 bg-body row justify-content-center align-items-center p-4">
        <div class="auth-max-width col-sm-8 col-md-6 col-xl-10 px-4">
            <div class="mb-5">
                @if ($verified)
                    <h3 class="fw-bolder fs-7 mb-3">Reset Password</h3>
                    <p>Masukkan password baru untuk akun anda
                    </p>

                    <form wire:submit.prevent="resetPassword">
                        <div class="mb-2">
                            <x-form.input type="password" label="Password Baru" name="password" bold="true" />
                        </div>
                        <div class="mb-4">
                            <x-form.input type="password" label="Konfirmasi Password" name="password_confirmation"
                                bold="true" />
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-8 mb-2 rounded-2">Konfirmasi</button>
                    </form>
                @else
                    <h3 class="fw-bolder fs-7 mb-3">Kode Verifikasi</h3>
                    <p>Masukkan kode verifikasi yang telah dikirimkan pada email terdaftar.
                    </p>
                    <h6 class="fw-bolder mb-5">{{ obfuscate_email($email) }}</h6>
                    <form wire:submit="verify">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label fw-semibold">Masukkan 6 digit kode</label>
                            <div class="d-flex justify-content-center gap-2 gap-sm-3">
                                @for ($i = 0; $i < 6; $i++)
                                    <input type="text" class="form-control text-center code-input"
                                        style="width: 50px; height: 50px; font-size: 24px; font-weight: bold; border: 1px solid #ccc; border-radius: 8px;"
                                        maxlength="1" wire:model="code.{{ $i }}">
                                @endfor
                            </div>
                            @error('code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-8 mb-4">Verifikasi</button>
                        @if ($canResend)
                            <div class="d-flex align-items-center">
                                <p class="fs-4 mb-0 text-dark">Tidak mendapatkan kode?</p>
                                <a class="text-primary fw-medium ms-2" href="#" wire:click.prevent="resend">kirim
                                    ulang</a>
                            </div>
                        @endif
                    </form>
                @endif
            </div>
        </div>
    </div>

    @push('script')
        <script>
            // Ganti script keyup lama dengan ini
            $('.code-input').on('input', function() {
                const input = $(this);
                const val = input.val();

                // Hanya lanjut kalau input angka
                if (/^[0-9]$/.test(val)) {
                    input.next('.code-input').focus();
                } else {
                    input.val(''); // Hapus karakter tidak valid
                }
            });

            // Tambahkan script ini sebagai tambahan
            $('.code-input').on('keydown', function(e) {
                if (e.key === 'Backspace' && $(this).val() === '') {
                    $(this).prev('.code-input').focus();
                } else if (e.key === 'ArrowLeft') {
                    $(this).prev('.code-input').focus();
                } else if (e.key === 'ArrowRight') {
                    $(this).next('.code-input').focus();
                }
            });

            Livewire.on('otp-error', (msg) => {
                toastr.error(msg[0], {
                    timeOut: 1000,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    containerId: "toast-top-right",
                });
            });

            Livewire.on('otp-sent', (msg) => {
                toastr.success('Berhasil mengirimkan kode OTP', {
                    timeOut: 1000,
                    showMethod: "fadeIn",
                    hideMethod: "fadeOut",
                    containerId: "toast-top-right",
                });
            });
        </script>
    @endpush
</div>
