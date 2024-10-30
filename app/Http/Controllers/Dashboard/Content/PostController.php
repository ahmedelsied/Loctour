<?php

namespace App\Http\Controllers\Dashboard\Content;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Support\Dashboard\Crud\WithDatatable;
use App\Support\Dashboard\Crud\WithDestroy;
use App\Support\Dashboard\Crud\WithForm;
use App\Support\Dashboard\Crud\WithStore;
use App\Support\Dashboard\Crud\WithUpdate;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Content\Datatables\PostDatatable;
use App\Domain\Content\Models\Post;

class PostController extends DashboardController
{
    use WithDatatable,  WithForm , WithStore ,WithUpdate , WithDestroy;

    protected string $name = 'Post';
    protected string $path = 'dashboard.content.posts';
    protected string $datatable = PostDatatable::class;
    protected string $model = Post::class;
    protected array $permissions = [ContentPermissions::class, 'Post'];


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
