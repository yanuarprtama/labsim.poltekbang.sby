@extends('layouts-admin.head')

@section('content')
    <x-layout-inner :title="$title">
        <form method="post" action="{{ route('laboratorium.store') }}">
            @csrf

            {{-- Nama Laboratorium --}}
            <div class="mb-3 col-md-6 form-floating">
                <input type="text" class="form-control @error('l_nama') is-invalid @enderror" placeholder="..."
                    id="l_nama" name="l_nama" value="{{ old('l_nama') }}">
                <label for="l_nama" class="ms-2">Nama Laboratorium</label>
                @error('l_nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Jenis --}}
            <div class="mb-3 mt-4 col-md-6">
                <label for="l_jenis" class="form-label">Jenis Laboratorium</label>
                <select class="form-control form-control-lg text-capitalize @error('l_jenis') is-invalid @enderror"
                    id="l_jenis" name="l_jenis" value="{{ old('l_jenis') }}">
                    <option selected disabled hidden>
                        --Pilih Jenis--
                    </option>
                    <option value="laboratorium" class="text-capitalize">
                        Laboratorium
                    </option>
                    <option value="simulator" class="text-capitalize">
                        Simulator
                    </option>
                </select>
                @error('l_jenis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Prodi --}}
            <div class="mb-3 mt-4 col-md-6">
                <label for="prodi_id" class="form-label">Prodi</label>
                <select class="form-control form-control-lg text-capitalize @error('prodi_id') is-invalid @enderror"
                    id="prodi_id" name="prodi_id" value="{{ old('prodi_id') }}">
                    <option selected disabled hidden>
                        {{ count($prodi) == 0 ? 'Tidak Ada Prodi' : '--Pilih Prodi--' }}
                    </option>
                    @foreach ($prodi as $row)
                        <option value="{{ $row->id }}" class="text-capitalize">
                            {{ $row->p_nama }}
                        </option>
                    @endforeach
                </select>
                @error('prodi_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-layout-inner>
@endsection
