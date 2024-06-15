@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </x-layout-inner>
@endsection

@push('scripts')
    <script>
        $(function() {
            let table = new DataTable("#table-prodi")
        })
    </script>

    {{ $dataTable->scripts() }}
@endpush
