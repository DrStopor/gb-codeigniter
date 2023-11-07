<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class RolesController extends BaseController
{
    public function index()
    {
        return view('Roles/index', [
            'title' => 'Роли',
            'description' => 'Существующие роли пользователей',
        ]);
    }

    public function add()
    {
        return view('Roles/add', [
            'title' => 'Добавление роли',
            'description' => 'Добавление новой роли пользователей',
        ]);
    }

    public function edit()
    {
        return view('Roles/edit', [
            'title' => 'Редактирование роли',
            'description' => 'Редактирование роли пользователей',
        ]);
    }

    public function delete()
    {
        return view('Roles/delete', [
            'title' => 'Удаление роли',
            'description' => 'Удаление роли пользователей',
        ]);
    }
}