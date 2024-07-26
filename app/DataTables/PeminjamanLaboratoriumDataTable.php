<?php

namespace App\DataTables;

use App\Models\PeminjamanLaboratorium;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PeminjamanLaboratoriumDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'admin.peminjaman.daftar_peminjaman.laboratorium.component.status')
            ->setRowId('id')
            ->rawColumns(["action"]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(PeminjamanLaboratorium $model): QueryBuilder
    {
        return $model->select("peminjaman_laboratoriums.*", "users.nama")->join("users", "users.id", "=", "peminjaman_laboratoriums.user_id")->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('peminjamanlaboratorium-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
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
            Column::make('nama')->title('Nama Peminjaman'),
            Column::make('pl_jam_mulai')->title("Jam Mulai"),
            Column::make('pl_jam_akhir')->title("Jam Akhir"),
            Column::make('pl_jenis_kegiatan')->title("Jenis Kegiatan"),
            Column::make('pl_status')->title("Status"),
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
        return 'PeminjamanLaboratorium_' . date('YmdHis');
    }
}
