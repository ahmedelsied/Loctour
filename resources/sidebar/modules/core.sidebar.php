<?php

use App\Domain\Core\Enums\CorePermissions;
use HsmFawaz\UI\Support\Sidebar\SidebarGenerator;

return static function (SidebarGenerator $sidebar) {
    $sidebar
        ->addModule('Core', 10)
        ->addMenu(
            name: __('Managers'),
            icon: 'fas fa-cog',
            links: function ($menu) {
                $menu
                    ->addLink(
                        name: __('Users'),
                        url: route('dashboard.core.users.index'),
                        icon: 'fas fa-users',
                        permission: CorePermissions::users()->can('read')
                    )
                    ->addLink(
                        name: __('Roles and Permissions'),
                        url: route('dashboard.core.roles.index'),
                        icon: 'fas fa-key',
                        permission: CorePermissions::roles()->can('read')
                    );
            }
        );
};
