@if ($model->pl_status == 'PROSES')
    <a onclick="return confirm('Apakah yakin untuk menerima ?')"
        href="{{ route('daftarPeminjaman.status.terima', [$model->id, 'laboratorium']) }}" type="button"
        class="btn btn-success">Terima</a>
    <a onclick="return confirm('Apakah yakin untuk menolak ?')"
        href="{{ route('daftarPeminjaman.status.tolak', [$model->id, 'laboratorium']) }}" type="button"
        class="btn btn-danger">Tolak</a>
@endif
