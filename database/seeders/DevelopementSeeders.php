<?php

namespace Database\Seeders;

use App\Domain\Entertainments\Models\Board;
use App\Domain\Entertainments\Models\Device;
use App\Domain\Entertainments\Models\Room;
use App\Domain\Finance\Models\SideExpense;
use App\Domain\Finance\Models\Stock;
use App\Domain\Core\Models\Contact;
use App\Domain\Core\Models\User;
use App\Domain\Tenant\Models\Tenant;
use App\Domain\Tenant\Models\TenantPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DevelopementSeeders extends Seeder
{
    public function run()
    {
        if(env('APP_ENV') == 'local'){
        }

    }
}
