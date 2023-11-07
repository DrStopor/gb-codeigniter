<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class UsersController extends BaseController
{
    private UsersModel $users;

    public function __construct()
    {
        $this->users = new UsersModel();
    }

    public function index()
    {
        $users = $this->model->select('id, username, email, created_at')->findAll();

        return view('Users/index', [
            'title' => 'Пользователи',
            'description' => 'Описание страницы пользователей',
            'users' => $users,
        ]);
    }
}