@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <form method="post" action="{{ route('inventaris.store') }}">
            @csrf

            {{-- Laboratorium --}}
            <div class="mb-3 mt-4 col-md-6">
                <label for="laboratorium_id" class="form-label">Laboratorium</label>
                <select class="form-control form-control-lg text-capitalize @error('laboratorium_id') is-invalid @enderror"
                    id="laboratorium_id" name="laboratorium_id" value="{{ old('laboratorium_id') }}">

                    @foreach ($laboratorium as $row)
                        <option value="{{ $row->id }}"
                            {{ (old('laboratorium_id') == $row->id or $inventaris->laboratorium->id == $row->id) ? 'selected' : '' }}
                            class="text-capitalize">
                            {{ $row->l_nama }}
                        </option>
                    @endforeach
                </select>
                @error('laboratorium_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Nama Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_nama') is-invalid @enderror" placeholder="..."
                    id="a_nama" name="a_nama" value="{{ old('a_nama') ?: $inventaris->a_nama }}">
                <label for="a_nama" class="ms-2">Nama</label>
                @error('a_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Kode Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_kode') is-invalid @enderror" placeholder="..."
                    id="a_kode" name="a_kode" value="{{ old('a_kode') ?: $inventaris->a_kode }}">
                <label for="a_kode" class="ms-2">Kode</label>
                @error('a_kode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Stok Inventaris --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('a_stok') is-invalid @enderror" placeholder="..."
                    id="a_stok" name="a_stok" value="{{ old('a_stok') ?: $inventaris->a_stok }}">
                <label for="a_stok" class="ms-2">Stok</label>
                @error('a_stok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-layout-inner>
@endsection
