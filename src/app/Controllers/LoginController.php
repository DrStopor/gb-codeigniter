<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class LoginController extends BaseController
{
    private UsersModel $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }

    public function index()
    {
        return view('Login/index', [
            'title' => 'Авторизация',
            'description' => 'Авторизация пользователя',
        ]);
    }

    public function login()
    {
        $data = $this->request->getPost();

        $user = $this->model->where('email', $data['email'])->first();

        if (!$user) {
            return redirect()->back()->withInput()
                ->with('warning', 'Пользователь с таким email не найден');
        }

        if (!password_verify($data['password'], $user->password_hash)) {
            return redirect()->back()->withInput()
                ->with('warning', 'Неверный пароль');
        }

        $session = session();
        $session->regenerate();
        $session->set('user_id', $user->id);
        $session->set('username', $user->username);
        $session->set('email', $user->email);
        $session->set('role', $user->role);

        return redirect()->to('/')->with('success', 'Вы успешно авторизовались');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('/')->with('success', 'Вы успешно вышли из аккаунта');
    }
}