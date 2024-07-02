<?php

namespace App\DataTables;

use App\Models\Laboratorium;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LaboratoriumDataTable extends DataTable
{
    protected $model = Laboratorium::class;

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn("edit", "admin.laboratorium.component.action")
            ->rawColumns(["edit"]);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Laboratorium $model): QueryBuilder
    {
        return $model->join('prodis', "prodis.id", '=', 'laboratoriums.prodi_id')->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('laboratorium-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::make('l_nama')
                ->title("Nama"),
            Column::computed('l_jenis', "Jenis Laboratorium")->searchable()->orderable(),
            Column::make('p_nama')
                ->title("Nama Prodi")->searchable(false),
            Column::make('l_status')
                ->title("status")
                ->searchable()
                ->orderable(),
            Column::make('edit')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Laboratorium_' . date('YmdHis');
    }
}
