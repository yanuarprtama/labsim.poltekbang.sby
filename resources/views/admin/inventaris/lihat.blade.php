@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </x-layout-inner>
@endsection

@push('scripts')
    {{-- <script>
        $(document).ready(function() {
            $('#table-inventaris').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('inventaris.data') }}',
                columns: [{
                        data: 'l_nama',
                        name: 'l_nama',
                        searchable: false
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
    </script> --}}
    {{ $dataTable->scripts() }}
@endpush
