<?php

namespace App\Domain\Content\Datatables;

use App\Domain\Content\Models\Post;
use App\Support\Dashboard\Datatables\BaseDatatable;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\Html\Column;

class PostDatatable extends BaseDatatable
{
    public function query(): Builder
    {
        return Post::query();
    }

    protected function columns(): array
    {
        return [
            Column::make('')->title(__('')),
        ];
    }
}
