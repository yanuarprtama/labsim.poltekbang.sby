<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Models\PeminjamanInventari;
use App\Models\PeminjamanInventaris;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class PeminjamanInventarisDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.peminjaman.daftar_peminjaman.inventaris.component.status')
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PeminjamanInventaris $model): QueryBuilder
    {
        return $model->select("peminjaman_inventaris.*", "users.nama")->join("users", "users.id", "=", "peminjaman_inventaris.user_id")->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('peminjamaninventaris-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('nama')->title("Nama Pengguna"),
            Column::make('pi_jam_mulai')->title("Jam Mulai"),
            Column::make('pi_jam_akhir')->title("Jam Akhir"),
            Column::make('pi_status')->title("Status"),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'PeminjamanInventaris_' . date('YmdHis');
    }
}
