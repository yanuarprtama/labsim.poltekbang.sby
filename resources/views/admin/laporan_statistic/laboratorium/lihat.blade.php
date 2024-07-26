@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <livewire:laporan-peminjaman-laboratorium-table />
    </x-layout-inner>
@endsection
