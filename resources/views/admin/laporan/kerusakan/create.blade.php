@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="'From Laporan Kerusakan Kerusakan'">
        <form method="post" action="{{ route('laporan.kerusakan.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Lampiran --}}
            <div class="mb-3 col-md-6">
                <label for="lk_lampiran" class="form-label">Lampiran</label>
                <input type="file" class="form-control form-control-lg @error('lk_lampiran') is-invalid @enderror"
                    id="lk_lampiran" name="lk_lampiran" multiple>
                <span class="form-text">Hanya menerima file dengan exstension pg, jpeg, png, bmp,
                    gif, svg, atau webp</span>
                @error('lk_lampiran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Keterangan --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('lk_keterangan') is-invalid @enderror" placeholder="..."
                    id="lk_keterangan" name="lk_keterangan" value="{{ old('lk_keterangan') }}">
                <label for="lk_keterangan" class="ms-2">Keterangan</label>
                @error('lk_keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-layout-inner>
@endsection
