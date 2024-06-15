@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <div class="table-responsive">
            <table id="table-inventaris" class="table">
                <thead>
                    <tr>
                        <th>Laboratorium</th>
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
            $('#table-inventaris').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('inventaris.data') }}',
                columns: [{
                        data: 'laboratorium',
                        name: 'laboratorium',
                        orderable: false,
                        searchable: true
                    },
                    {
                        data: 'a_nama',
                        name: 'a_nama'
                    },
                    {
                        data: 'a_kode',
                        name: 'a_kode'
                    },
                    {
                        data: 'a_stok',
                        name: 'a_stok'
                    },
                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false
                    }
                ]
            });
        });
    </script>
@endpush
