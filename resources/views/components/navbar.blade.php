<header
    class="app-header"
    style="z-index: 9999;"
>
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a
                    class="nav-link sidebartoggler nav-icon-hover ms-n3"
                    id="headerCollapse"
                    href="javascript:void(0)"
                >
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
        </ul>

        <div class="d-block d-lg-none">
            <img
                src="{{ asset('img/logo-dark1.png') }}"
                class="dark-logo"
                width="120"
                alt=""
            />
            <img
                src="{{ asset('img/logo-light.png') }}"
                class="light-logo"
                width="100"
                alt=""
            />
        </div>

        <button
            class="navbar-toggler p-0 border-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation"
        >
            <span class="p-2">
                <i class="ti ti-dots fs-7"></i>
            </span>
        </button>

        <div
            class="collapse navbar-collapse justify-content-end"
            id="navbarNav"
        >
            <div class="d-flex align-items-center justify-content-between">
                <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-center">
                    <li class="nav-item dropdown">
                        <a
                            class="nav-link pe-0"
                            href="javascript:void(0)"
                            id="drop1"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <div class="d-flex align-items-center">
                                <div class="user-profile-img">
                                    <img
                                        src="{{ asset('img/profile/noimage.jpg') }}"
                                        class="rounded-circle"
                                        width="35"
                                        height="35"
                                        alt=""
                                    />
                                </div>
                            </div>
                        </a>
                        <div
                            class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up"
                            aria-labelledby="drop1"
                        >
                            <div
                                class="profile-dropdown position-relative"
                                data-simplebar
                            >
                                <div class="py-3 px-7 pb-0">
                                    <h5 class="mb-0 fs-5 fw-semibold">User Profile</h5>
                                </div>
                                <div class="d-flex align-items-center py-9 mx-7 border-bottom">
                                    <img
                                        src="{{ asset('img/profile/noimage.jpg') }}"
                                        class="rounded-circle"
                                        width="80"
                                        height="80"
                                        alt=""
                                    />
                                    <div class="ms-3">
                                        <h5 class="mb-1 fs-3">{{ Auth::user()->name }}</h5>
                                        <span class="mb-1 d-block text-dark">Administrator</span>
                                        <p class="mb-0 d-flex text-dark align-items-center gap-2">
                                            <i class="ti ti-mail fs-4"></i> {{ Auth::user()->email }}
                                        </p>
                                    </div>
                                </div>
                                <div class="message-body">
                                    <a
                                        {{-- href="{{ route('profile') }}" --}}
                                        href="#"
                                        id="btnShowProfile"
                                        class="py-8 px-7 mt-8 d-flex align-items-center"
                                    >
                                        <span
                                            class="d-flex align-items-center justify-content-center bg-light rounded-1 p-6"
                                        >
                                            <i class="ti ti-settings"></i>
                                        </span>
                                        <div class="w-75 d-inline-block v-middle ps-3">
                                            <h6 class="mb-1 bg-hover-primary fw-semibold"> My Profile </h6>
                                            <span class="d-block text-dark">Account Settings</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="d-grid py-4 px-7 pt-8">
                                    <a
                                        href="{{ route('logout') }}"
                                        class="btn btn-outline-primary"
                                    >Log Out</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            {{-- <script>
                document.addEventListener('DOMContentLoaded', function () {
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
                });
            </script> --}}
            {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        </div>
    </nav>
</header>
