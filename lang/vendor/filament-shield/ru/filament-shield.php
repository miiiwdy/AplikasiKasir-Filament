<?php

return [
    /*
    |------------------------------------------------- -------------------------
    | Table Columns
    |------------------------------------------------- -------------------------
    */

    'column.name' => 'Имя',
    'column.guard_name' => 'Имя гварда',
    'column.roles' => 'Роли',
    'column.permissions' => 'Разрешения',
    'column.updated_at' => 'Обновлено',

    /*
    |------------------------------------------------- -------------------------
    | Form Fields
    |------------------------------------------------- -------------------------
    */

    'field.name' => 'Имя',
    'field.guard_name' => 'Имя гварда',
    'field.permissions' => 'Разрешения',
    'field.select_all.name' => 'Выбрать все',
    'field.select_all.message' => 'Включить все разрешения, которые <span class="text-primary font-medium">Доступны</span> для этой роли',

    /*
    |------------------------------------------------- -------------------------
    | Navigation & Resource
    |------------------------------------------------- -------------------------
    */

    'nav.group' => 'Admin Room',
    'nav.role.label' => 'Роли',
    'nav.role.icon' => 'heroicon-o-shield-check',
    'resource.label.role' => 'Роль',
    'resource.label.roles' => 'Роли',

    /*
    |------------------------------------------------- -------------------------
    | Section & Tabs
    |------------------------------------------------- -------------------------
    */

    'section' => 'Сути',
    'resources' => 'Ресурсы',
    'widgets' => 'Виджеты',
    'pages' => 'Страницы',
    'custom' => 'Пользовательские разрешения',

    /*
    |------------------------------------------------- -------------------------
    | Messages
    |------------------------------------------------- -------------------------
    */

    'forbidden' => 'У вас нет доступа',

    /*
    |------------------------------------------------- -------------------------
    | Resource Permissions' Labels
    |------------------------------------------------- -------------------------
    */

    'resource_permission_prefixes_labels' => [
        'view' => 'Просмотр',
        'view_any' => 'Может смотреть любое',
        'create' => 'Создание',
        'update' => 'Обновление',
        'delete' => 'Удаление',
        'delete_any' => 'Может удалить любой',
        'force_delete' => 'Принудительно удалить',
        'force_delete_any' => 'Может принудительно удалить любой',
        'restore' => 'Восстановление',
        'reorder' => 'Изменение порядка',
        'restore_any' => 'Может восстановить любой',
        'replicate' => 'Копировать',
    ],
];
