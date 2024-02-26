<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <a href=""><img src="{{ asset('assets/compiled/svg/logo.svg') }}" alt="Logo"
                            srcset=""></a>
                </div>
                <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                    <div class="form-check form-switch fs-6">
                        <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                        <label class="form-check-label"></label>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                        aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                        preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                        </path>
                    </svg>
                </div>
                <div class="sidebar-toggler  x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-item {{ request()->routeIs('dashboard-masjid') ? 'active' : '' }}">
                    <a href="{{ route('dashboard-masjid') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>

                </li>

                <li class="sidebar-item {{ request()->routeIs('kas.*') ? 'active' : '' }}">
                    <a href="{{ route('kas.index') }}" class='sidebar-link'>
                        <i class="fas fa-wallet"></i>
                        <span>Kas Masjid</span>
                    </a>
                </li>
                <li class="sidebar-item  {{ request()->routeIs('infaq.*') ? 'active' : '' }}">
                    <a href="{{ route('infaq.index') }}" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span> Data Infaq</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="#" class='sidebar-link'>
                        <i class="fas fa-donate"></i>
                        <span>Donate</span>
                    </a>
                </li>
                <li class="sidebar-title">Informasi Masjid</li>
                <li class="sidebar-item {{ request()->routeIs('masjid.*') ? 'active' : '' }}">
                    <a href="{{ route('masjid.index') }}" class='sidebar-link'>
                        <i class="fas fa-mosque"></i>
                        <span>Data Masjid</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('profile-masjid.*') ? 'active' : '' }}">
                    <a href="{{ route('profile-masjid.index') }}" class='sidebar-link'>
                        <i class="fas fa-place-of-worship"></i>
                        <span>Profil Masjid</span>
                    </a>
                </li>

                <li class="sidebar-item {{ request()->routeIs('masjid-bank.*') ? 'active' : '' }}">
                    <a href="{{ route('masjid-bank.index') }}" class='sidebar-link'>
                        <i class="bi bi-credit-card-fill"></i>
                        <span>Data Bank</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}" class='sidebar-link'>
                        <i class="fas fa-book"></i>
                        <span>Kategori Informasi</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('informasi.*') ? 'active' : '' }}">
                    <a href="{{ route('informasi.index') }}" class='sidebar-link'>
                        <i class="fas fa-calendar-check"></i>
                        <span>Agenda / Acara</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('kurban.*') ? 'active' : '' }}">
                    <a href="{{ route('kurban.index') }}" class='sidebar-link'>
                        <i class="fas fa-scroll"></i>
                        <span>Informasi Kurban</span>
                    </a>
                </li>
                @can('create-role')
                    <li class="sidebar-title">Role & Permission</li>
                    <li class="sidebar-item {{ request()->routeIs('roles-masjid.*') ? 'active' : '' }}">
                        <a href="{{ route('roles-masjid.index') }}" class='sidebar-link'>
                            <i class="fas fa-user-lock"></i>
                            <span>Role (Peran)</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('permission-masjid.*') ? 'active' : '' }}">
                        <a href="{{ route('permission-masjid.index') }}" class='sidebar-link'>
                            <i class="fas fa-clipboard"></i>
                            <span>Hak Akses</span>
                        </a>
                    </li>
                @endcan

                <li class="sidebar-title">Manajemen User</li>
                @can('create-user')
                    <li class="sidebar-item {{ request()->routeIs('user-masjid.*') ? 'active' : '' }}">
                        <a href="{{ route('user-masjid.index') }}" class='sidebar-link'>
                            <i class="fas fa-users"></i>
                            <span>Data Pengguna</span>
                        </a>
                    </li>
                @endcan
                <li class="sidebar-item {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}" class='sidebar-link'>
                        <i class="bi bi-person-circle"></i>
                        <span>Akun Saya</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</div>
