<?php

namespace App\Domain\Location\Datatables;

use App\Domain\Location\Models\Place;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class PlaceDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Place::query();
    }

    protected function columns(): array
    {
        return [
            Column::make('')->title(__('')),
        ];
    }
}
