<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('transaksi') }}" class="brand-link">
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
                <a href="#" class="d-block">
                    {{-- {{ Auth::user()->level }} --}}
                </a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Transaksi Start --}}
                <li class="nav-item {{ $title == 'Data Pokok' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Data Pokok' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Instansi
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('transaksi') }}"
                                class="nav-link {{ $action == 'lihat_transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Prodi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}"
                                class="nav-link {{ $action == 'tambah_transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laboratorium</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('transaksi-tambah') }}"
                                class="nav-link {{ $action == 'tambah_transaksi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alat</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Transaksi End --}}

                {{-- Pengeluaran Start --}}

                <li class="nav-item {{ $title == 'Pengeluaran' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Pengeluaran' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-wallet"></i>
                        <p>
                            Pengeluaran
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- @if (auth()->user()->level == 'owner') --}}
                        <li class="nav-item">
                            <a href="{{ asset('pengeluaran') }}"
                                class="nav-link {{ $action == 'lihat_pengeluaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Pengeluaran</p>
                            </a>
                        </li>
                        {{-- @endif --}}
                        <li class="nav-item">
                            <a href="{{ asset('pengeluaran-tambah') }}"
                                class="nav-link {{ $action == 'tambah_pengeluaran' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Pengeluaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Pengeluaran End --}}
                {{-- @if (auth()->user()->level == 'owner') --}}
                {{-- Unit Kendaraan Start --}}
                <li class="nav-item {{ $title == 'Kendaraan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Kendaraan' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-car"></i>
                        <p>
                            Unit Kendaraan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/kendaraan') }}"
                                class="nav-link {{ $action == 'lihat_kendaraan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Unit Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('/kendaraan-tambah') }}"
                                class="nav-link {{ $action == 'tambah_kendaraan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Unit Kendaraan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ asset('/kendaraan-tambah/brand') }}"
                                class="nav-link {{ $action == 'brand_kendaraan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Merek/Brand Kendaraan</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- Unit Kendaraan End --}}

                {{-- Beranda Start --}}
                <li class="nav-item {{ $title == 'Laporan' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Laporan' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-chart-line"></i>
                        <p>
                            Laporan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/kredit-debit') }}"
                                class="nav-link {{ $action == 'Kredit_Debit_Lihat' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Debit Kredit</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- User Controller --}}
                <li class="nav-item {{ $title == 'User' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'User' ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            User Control
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/user-control') }}"
                                class="nav-link {{ $action == 'user_tambah' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Admin</p>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/user/ubah-sandi') }}"
                                class="nav-link {{ $action == 'user_ubah' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ubah Sandi</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ $title == 'Jadwal' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $title == 'Jadwal' ? 'active' : '' }}">
                        <i class="nav-icon fa-regular fa-calendar-days"></i>
                        <p>
                            Jadwal
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ asset('/jadwal') }}"
                                class="nav-link {{ $action == 'lihat_jadwal' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jadwal</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}
                {{-- Beranda End --}}
            </ul>


        </nav>
    </div>
</aside>
