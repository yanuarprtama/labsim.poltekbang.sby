<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('transaksi') }}" class="brand-link text-decoration-none">
        <img src={{ asset('dist/img/AdminLTELogo.png') }} alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Laboratorium</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src={{ asset('dist/img/user2-160x160.jpg') }} class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ asset('/') }}" class="d-block text-decoration-none">
                    {{ Auth::user()->nama }}
                </a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Instansi Start --}}
                <li
                    class="nav-item {{ ($title == 'Prodi' or $title == 'Laboratorium' or $title == 'Inventaris') ? 'menu-open' : '' }}">
                    <a href="#"
                        class="nav-link {{ ($title == 'Prodi' or $title == 'Laboratorium' or $title == 'Inventaris') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Instansi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('prodi.index') }}"
                                class="nav-link {{ $action == 'Prodi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prodi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laboratorium.index') }}"
                                class="nav-link {{ $action == 'Laboratorium' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laboratorium</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('inventaris.index') }}"
                                class="nav-link {{ $action == 'Inventaris' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventaris</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Instansi End --}}

                {{-- Laporan Kerusakan Start --}}

                <li class="nav-item {{ $title == 'kerusakan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'kerusakan' ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-pass-fill nav-icon" viewBox="0 0 16 16">
                            <path
                                d="M10 0a2 2 0 1 1-4 0H3.5A1.5 1.5 0 0 0 2 1.5v13A1.5 1.5 0 0 0 3.5 16h9a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 12.5 0zM4.5 5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1m0 2h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1" />
                        </svg>
                        <p>
                            Pengajuan Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.kerusakan.index') }}"
                                class="nav-link {{ $action == 'lihat pengajuan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Kerusakan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporan.kerusakan.create') }}"
                                class="nav-link {{ $action == 'tambah pengajuan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ajukan Kerusakan</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Laporan Kerusakan End --}}

                {{-- Peminjaman Start --}}
                <li class="nav-item {{ $title == 'Peminjaman' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Peminjaman' ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-cart2 nav-icon" viewBox="0 0 16 16">
                            <path
                                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                        </svg>
                        <p>
                            Daftar Peminjaman
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('daftarPeminjaman.inventaris') }}"
                                class="nav-link {{ $action == 'daftar_inventaris' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventaris</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('daftarPeminjaman.laboratorium') }}"
                                class="nav-link {{ $action == 'daftar_laboratorium' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laboratorium</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Peminjaman End --}}

                {{-- Laporan Start --}}
                <li class="nav-item {{ $title == 'Laporan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Laporan' ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" class="bi bi-cart2 nav-icon"
                            height="16" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                            <path
                                d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7 7 0 0 0-.985-.299l.219-.976q.576.129 1.126.342zm1.37.71a7 7 0 0 0-.439-.27l.493-.87a8 8 0 0 1 .979.654l-.615.789a7 7 0 0 0-.418-.302zm1.834 1.79a7 7 0 0 0-.653-.796l.724-.69q.406.429.747.91zm.744 1.352a7 7 0 0 0-.214-.468l.893-.45a8 8 0 0 1 .45 1.088l-.95.313a7 7 0 0 0-.179-.483m.53 2.507a7 7 0 0 0-.1-1.025l.985-.17q.1.58.116 1.17zm-.131 1.538q.05-.254.081-.51l.993.123a8 8 0 0 1-.23 1.155l-.964-.267q.069-.247.12-.501m-.952 2.379q.276-.436.486-.908l.914.405q-.24.54-.555 1.038zm-.964 1.205q.183-.183.35-.378l.758.653a8 8 0 0 1-.401.432z" />
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z" />
                            <path
                                d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.statik.inventaris') }}"
                                class="nav-link {{ $action == 'laporan_inventaris' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inventaris</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('laporan.statik.laboratorium') }}"
                                class="nav-link {{ $action == 'laporan_laboratorium' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laboratorium</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Laporan End --}}
        </nav>
    </div>
</aside>
