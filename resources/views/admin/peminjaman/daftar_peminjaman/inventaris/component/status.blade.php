@if ($model->pi_status == 'DIPROSES')
    <a onclick="return confirm('Apakah yakin untuk menerima ?')"
        href="{{ route('daftarPeminjaman.status.terima', [$model->id, 'inventaris']) }}" type="button"
        class="btn btn-success">Terima</a>
    <a onclick="return confirm('Apakah yakin untuk menolak ?')"
        href="{{ route('daftarPeminjaman.status.tolak', [$model->id, 'inventaris']) }}" type="button"
        class="btn btn-danger">Tolak</a>
@endif
