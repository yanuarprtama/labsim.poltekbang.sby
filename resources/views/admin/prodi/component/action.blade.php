<div class="d-flex justify-center gap-1" style="width: 50%">
    <a class="block btn btn-primary" href="{{ route('prodi.edit', $model->id) }}">Edit</a>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#hapus{{ $model->id }}">
        <i class="ti ti-trash fs-5"></i>Ubah Status</a>
    </button>
</div>


<!-- Modal -->
<div class="modal fade" id="hapus{{ $model->id }}" tabindex="-1" aria-labelledby="hapusLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="hapusLabel">Ubah Status Data!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">

                    <div class="row mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="#FA896B"
                            class="bi bi-x-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                    </div>
                    <div class="row">
                        <p class="text-center">
                            Apakah yakin ingin mengubah status<strong
                                class="text-capitalize">"{{ $model->p_nama }}"</strong>?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <form method="post" action="{{ route('prodi.update.status', $model->id) }}">
                    @csrf
                    @method('put')
                    <button class="btn btn-primary">Iya</button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tidak</button>
            </div>
        </div>
    </div>
</div>
