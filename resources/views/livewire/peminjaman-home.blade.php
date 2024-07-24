<div class="card">
    <div class="nav nav-tabs nav-stacked card-header" id="navigation_container">
        <a class="nav-link cursor-pointer active" id="inventaris_nav">Peminjaman
            Inventaris</a>
        <a class="nav-link cursor-pointer" id="laboratorium_nav">Peminjaman
            Laboratorium</a>
        <a class="nav-link cursor-pointer" id="history_peminjaman">Riwayat
            Peminjaman</a>
    </div>

    <div class="card-body" id="body-peminjaman">
        <div id="inventaris_container" class="">
            <h5 class="text-uppercase">Form Peminjaman Inventaris</h5>
            <form action="{{ route('peminjaman.inventaris.action') }}" id="peminjamanForm">
                @csrf
                <div class="mb-3">
                    <label for="pi_jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control container-fluid" id="pi_jam_mulai">
                    <div id="jam_mulai_error" class="form-text text-danger"></div>

                    <label for="pi_jam_akhir" clas1s="form-label">Jam Akhir</label>
                    <input type="time" class="form-control container-fluid" id="pi_jam_akhir">
                    <div id="jam_akhir_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="laboratorium" class="form-label">Laboratorium</label>
                    <select class="form-control" id="laboratorium">
                        <option hidden selected>--Pilih Laboratorium--</option>
                        @forelse ($laboratorium as $row)
                            <option value="{{ $row->id }}">{{ $row->l_nama }}</option>
                        @empty
                            <option>Tidak ada laboratorium</option>
                        @endforelse
                    </select>
                    <div id="laboratorium_error" class="form-text text-danger"></div>
                </div>

                <div class="mb-3 d-none" id="inventaris-field">
                    <label for="Inventaris" class="form-label">Inventaris</label>
                    <select class="form-control" id="Inventaris">
                        <option hidden selected>--Pilih Inventaris--</option>
                    </select>

                    <label for="qty" class="form-label">Qty</label>
                    <input type="text" class="form-control container-fluid" id="qty">
                    <div id="qty_error" class="form-text text-danger"></div>
                </div>
                <button type="submit" class="btn btn-primary" id="addInventaris">Pilih inventaris</button>
            </form>

            <table id="inventarisTable" class="table">
                <thead>
                    <tr>
                        <th scope="col">Nama Inventaris</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <button type="button" class="btn btn-primary" id="submitForm">Submit</button>

        </div>

        <div id="laboratorium_container" class="d-none">
            <h5 class="text-uppercase">Form Peminjaman Laboratorium</h5>
            <form action="{{ route('peminjaman.laboratorium.action') }}" id="peminjamanFormLaboratorium"
                data-parsley-validate="">
                @csrf
                <div class="mb-3">
                    <label for="pl_jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" class="form-control container-fluid" id="pl_jam_mulai">
                    <div id="pl_jam_mulai_error" class="form-text text-danger"></div>

                    <label for="pl_jam_akhir" clas1s="form-label">Jam Akhir</label>
                    <input type="time" class="form-control container-fluid" id="pl_jam_akhir">
                    <div id="pl_jam_akhir_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="pl_mata_kuliah" class="form-label">Mata Kuliah</label>
                    <input type="text" class="form-control container-fluid" id="pl_mata_kuliah">
                    <div id="pl_mata_kuliah_error" class="form-text text-danger"></div>

                    <label for="pl_dosen_pengajar" class="form-label">Dosen Pengajar</label>
                    <input type="text" class="form-control container-fluid" id="pl_dosen_pengajar">
                    <div id="pl_dosen_pengajar_error" class="form-text text-danger"></div>

                    <label for="pl_jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                    <select class="form-control container-fluid" id="pl_jenis_kegiatan">
                        <option hidden>-- Pilih Jenis Kegiatan --</option>
                        <option value="penelitian">Penelitian</option>
                        <option value="praktikum">Praktikum</option>
                    </select>
                    <div id="jenis_kegiatan_error" class="form-text text-danger"></div>
                </div>
                <div class="mb-3">
                    <label for="laboratorium" class="form-label">Laboratorium</label>
                    <select class="form-control" id="pl_laboratorium">
                        <option hidden>--Pilih Laboratorium--</option>
                        @forelse ($laboratorium as $row)
                            <option value="{{ $row->id }}">{{ $row->l_nama }}</option>
                        @empty
                            <option>Tidak ada laboratorium</option>
                        @endforelse
                    </select>
                    <div id="pl_laboratorium_error" class="form-text text-danger"></div>
                </div>
            </form>

            <button type="button" id="buttonSubmitLaboratorium" class="btn btn-primary">Submit</button>
        </div>

        <div id="history_peminjaman_container" class="table-responsive d-none">
            <h5 class="text-uppercase mb-3">Riwayat Peminjaman</h5>
            <div id="tag_container">
                <span id="inventaris_tag"
                    class="border border-primary rounded-pill p-2 cursor-pointer bg-primary text-white">Inventaris</span>
                <span id="laboratorium_tag"
                    class="border border-primary rounded-pill p-2 cursor-pointer">Laboratorium</span>
            </div>

            <div id="table_history_container">
                <table class="mt-3 table table-hover" id="table_inventaris">
                    <tbody id="list_peminjaman_inventaris">
                    </tbody>
                </table>

                <div id="modal_inventaris_container"></div>

                <table class="mt-3 table table-hover d-none" id="table_laboratorium">
                    <tbody id="list_peminjaman_laboratorium">
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

@section('script')
    <script type="module" src="{{ asset('js/peminjaman/inventaris/action.js') }}"></script>
    <script type="module" src="{{ asset('js/peminjaman/laboratorium/action.js') }}"></script>
    <script type="module" src="{{ asset('js/peminjaman/history/action.js') }}"></script>
    <script type="module" src="{{ asset('js/peminjaman/display.js') }}"></script>
@endsection

@section('style')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        a {
            text-decoration: none
        }

        .hover-red:hover {
            color: red
        }
    </style>
@endsection
