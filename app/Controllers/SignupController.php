<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class SignupController extends BaseController
{
    private UsersModel $model;

    public function __construct()
    {
        $this->model = new UsersModel();
    }

    public function index()
    {
        return view('Signup/index', [
            'title' => 'Регистрация',
            'description' => 'Регистрация нового пользователя',
        ]);
    }

    public function add()
    {
        $data = $this->request->getPost();

        if (!$this->validate($this->model->getValidationRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        if (!$this->model->save($data)) {
            return redirect()->back()->withInput()
                ->with('errors', $this->model->errors())
                ->with('warning', 'При регистрации произошла ошибка');
        }

        return redirect()->to('/signup/success');
    }

    public function success()
    {
        return view('Signup/success', [
            'title' => 'Регистрация прошла успешно',
            'description' => 'Описание страницы успешной регистрации',
        ]);
    }

    public function new()
    {
        return view('Signup/index', [
            'title' => 'Регистрация пользователя',
            'description' => 'Описание страницы регистрации'
        ]);
    }
}