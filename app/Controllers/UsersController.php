<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class UsersController extends BaseController
{
    public function index()
    {
        return view('Users/index', [
            'title' => 'Пользователи',
            'description' => 'Описание страницы пользователей',
        ]);
    }

    public function add()
    {
        return view('Users/add', [
            'title' => 'Добавление пользователя',
            'description' => 'Добавление нового пользователя',
        ]);
    }

    public function edit()
    {
        return view('Users/edit', [
            'title' => 'Редактирование пользователя',
            'description' => 'Редактирование пользователя',
        ]);
    }

    public function delete()
    {
        return view('Users/delete', [
            'title' => 'Удаление пользователя',
            'description' => 'Удаление пользователя',
        ]);
    }
}