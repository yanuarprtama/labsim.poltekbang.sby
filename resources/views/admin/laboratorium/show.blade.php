@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="'From Tambah Inventaris ' . $laboratorium->l_nama">
        <form method="post" action="{{ route('inventaris.store') }}">
            @csrf
            <input type="text" name="laboratorium_id" value="{{ $laboratorium->id }}" class="visually-hidden">

            {{-- Nama Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_nama') is-invalid @enderror" placeholder="..."
                    id="a_nama" name="a_nama" value="{{ old('a_nama') }}">
                <label for="a_nama" class="ms-2">Nama</label>
                @error('a_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kode Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_kode') is-invalid @enderror" placeholder="..."
                    id="a_kode" name="a_kode" value="{{ old('a_kode') }}">
                <label for="a_kode" class="ms-2">Kode</label>
                @error('a_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stok Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_stok') is-invalid @enderror" placeholder="..."
                    id="a_stok" name="a_stok" value="{{ old('a_stok') }}">
                <label for="a_stok" class="ms-2">Stok</label>
                @error('a_stok')
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
                        data: 'a_nama',
                        name: 'a_nama',

                    },
                    {
                        data: 'a_kode',
                        name: 'a_kode',

                    }, {
                        data: 'a_stok',
                        name: 'a_stok',

                    }, {
                        data: 'edit',
                        name: 'edit'
                    }
                ]
            });
        });
    </script>
@endpush
