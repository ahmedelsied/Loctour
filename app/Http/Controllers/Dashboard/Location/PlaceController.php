<?php

namespace App\Http\Controllers\Dashboard\Location;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Support\Dashboard\Crud\WithForm;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Location\Datatables\PlaceDatatable;
use App\Domain\Location\Models\Place;

class PlaceController extends DashboardController
{
    use WithDatatable,  WithForm , WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'Place';
    protected string $path = 'dashboard.location.places';
    protected string $datatable = PlaceDatatable::class;
    protected string $model = Place::class;
    protected array $permissions = [LocationPermissions::class, 'Place'];


    protected function rules()
    {
        return [

        ];
    }

    protected function formData(?Model $model = null): array
    {
        return [

        ];
    }
}
