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
        $messages = $this->model->select('id, name, text, created_at')
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

    public function delete($id)
    {
        if ($this->model->delete($id)) {
            return redirect()
                ->to( base_url('/') )
                ->with('success', 'Сообщение успешно удалено');
        }

        return redirect()
            ->to( base_url('/') )
            ->with('errors', $this->model->errors());
    }

    public function partList(int $limit = 3, string $param, string $order = 'asc')
    {
        $currentPage = $this->request->getVar('page_id') ?: 1;
        $param =  $this->getParamNameByValue($param);
        $order = $order === 'desc' ? 'desc' : 'asc';

        $messagesWithLimit = $this->model->select('id, name, text, created_at')
            ->orderBy($param, $order)
            ->paginate($limit, 'id', $currentPage);

        return view('Messages/index', [
            'messages' => $messagesWithLimit,
            'pager' => $this->model->pager,
            'title' => 'Сообщения',
            'description' => 'Описание страницы сообщений',
            'param' => $param === 'created_at' ? 'date' : 'id',
            'order' => $order
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

    private function getParamNameByValue($value)
    {
        if ($value === 'date') {
            return 'created_at';
        }

        return 'id';
    }
}