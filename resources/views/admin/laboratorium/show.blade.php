@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="'From Tambah Inventaris ' . $laboratorium->l_nama">
        <form method="post" action="{{ route('laboratorium.store') }}">
            @csrf

            {{-- Nama Laboratorium --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('l_nama') is-invalid @enderror" placeholder="..."
                    id="l_nama" name="l_nama" value="{{ old('l_nama') }}">
                <label for="l_nama" class="ms-2">Nama Laboratorium</label>
                @error('l_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis --}}
            <div class="mb-3 mt-4 col-md-6">
                <label for="l_jenis" class="form-label">Jenis Laboratorium</label>
                <select class="form-control form-control-lg text-capitalize @error('l_jenis') is-invalid @enderror"
                    id="l_jenis" name="l_jenis" value="{{ old('l_jenis') }}">
                    <option selected disabled hidden>
                        --Pilih Jenis--
                    </option>
                    <option value="laboratorium" class="text-capitalize">
                        Laboratorium
                    </option>
                    <option value="simulator" class="text-capitalize">
                        Simulator
                    </option>
                </select>
                @error('l_jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-layout-inner>

    <x-layout-inner :title="'Daftar Inventaris ' . $laboratorium->l_nama">
        <div class="table-responsive">
            <table id="table-laboratorium" class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama</th>
                        <th>Kode</th>
                        <th>Stok</th>
                        <th>edit</th>
                    </tr>
                </thead>
            </table>
        </div>
    </x-layout-inner>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#table-laboratorium').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('laboratorium.inventaris', $laboratorium->l_slug) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'inventaris[0].a_nama',
                        name: 'inventaris[0].a_nama'
                    },
                    {
                        data: 'inventaris[0].a_kode',
                        name: 'inventaris[0].a_kode'
                    }, {
                        data: 'inventaris[0].a_stok',
                        name: 'inventaris[0].a_stok'
                    }, {
                        data: 'edit',
                        name: 'edit'
                    }
                ]
            });
        });
    </script>
@endpush
