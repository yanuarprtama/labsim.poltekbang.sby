@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <div class="table-responsive">
            <table id="table-laboratorium" class="table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nama</th>
                        <th>Prodi</th>
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
                ajax: '{{ route('laboratorium.data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'l_nama',
                        name: 'l_nama'
                    },
                    {
                        data: 'prodi.p_nama',
                        name: 'prodi.p_nama'
                    }, {
                        data: 'edit',
                        name: 'edit'
                    }
                ]
            });
        });
    </script>
@endpush
