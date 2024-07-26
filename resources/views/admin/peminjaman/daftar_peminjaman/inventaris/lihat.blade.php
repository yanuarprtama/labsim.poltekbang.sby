@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <div class="table-responsive">
            {{ $dataTable->table() }}
        </div>
    </x-layout-inner>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
