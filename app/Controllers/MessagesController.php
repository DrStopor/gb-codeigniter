<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\MessagesEntity;
use App\Models\MessagesModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class MessagesController extends BaseController
{
    private MessagesModel $model;

    public function __construct()
    {
        $this->model = new MessagesModel();
    }
    public function index()
    {
        $messages = $this->model->select('id, id_user, message, created_at, updated_at')
            ->join('users', 'users.id = messages.id_user')
            ->join('roles', 'roles.id = users.id_role')
            ->findAll();

        return view('Messages/index', [
            'title' => 'Сообщения',
            'description' => 'Описание страницы сообщений',
            'messages' => $messages,
        ]);
    }

    public function add()
    {
        return view('Messages/add', [
            'title' => 'Добавление сообщения',
            'description' => 'Добавление нового сообщения',
        ]);
    }

    public function create()
    {
        helper(['form', 'url']);
        $message = new MessagesEntity($this->request->getPost());

        if ($this->model->insert($message)) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Сообщение успешно добавлено',
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => $this->model->errors(),
        ]);
    }

    public function edit($id)
    {
        $message = $this->getMessageOr404($id);

        return view('Messages/edit', [
            'message' => $message,
            'title' => 'Редактирование сообщения',
            'description' => 'Редактирование сообщения',
        ]);
    }

    public function delete($id)
    {
        $message = $this->getMessageOr404($id);

        return view('Messages/delete', [
            'message' => $message,
            'title' => 'Удаление сообщения',
            'description' => 'Удаление сообщения',
        ]);
    }

    public function partList(int $limit = 3)
    {
        $currentPage = $this->request->getVar('page_id') ?: 1;
        $param =  $this->request->getVar('param') === 'date' ? 'created_at' : 'id';
        $order = $this->request->getVar('order') === 'desc' ? 'desc' : 'asc';

        $messagesWithLimit = $this->model->select('messages.id as id, messages.id_user as id_user, message, messages.created_at as created_at, messages.updated_at as updated_at, u.username as name, r.name as role')
            ->join('users u', 'u.id = messages.id_user', 'left')
            ->join('roles r', 'r.id = u.id_role', 'left')
            ->orderBy("messages.$param", $order)
            ->paginate($limit, 'id', $currentPage);

        return view('Messages/index', [
            'messages' => $messagesWithLimit,
            'pager' => $this->model->pager,
            'title' => 'Сообщения',
            'description' => 'Описание страницы сообщений',
        ]);
    }

    private function getMessageOr404($id)
    {
        $message = $this->model->find($id);

        if (is_null($message)) {
            throw new PageNotFoundException('Cannot find the message item: '. $id);
        }

        return $message;
    }
}