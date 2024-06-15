@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <form method="post" action="{{ route('prodi.store') }}">
            @csrf

            {{-- Prodi --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('p_nama') is-invalid @enderror" placeholder="..."
                    id="p_nama" name="p_nama" value="{{ old('p_nama') }}">
                <label for="p_nama" class="ms-2">Nama Prodi</label>
                @error('p_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kode --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('p_kode') is-invalid @enderror" placeholder="..."
                    id="p_kode" name="p_kode" value="{{ old('p_kode') }}">
                <label for="p_kode" class="ms-2">Kode</label>
                @error('p_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-layout-inner>
@endsection
