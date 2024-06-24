<?php

namespace App\Controllers;

use App\Entities\User;
use CodeIgniter\RESTful\ResourceController;

class UserController extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';
    private const MAX_PER_PAGE = 25;

    public function list()
    {
        $users = $this->model->paginate(self::MAX_PER_PAGE);
        $pager = $this->model->pager;

        return $this->respond([
            'users' => $users,
            'pager' => [
                'currentPage' => $pager->getCurrentPage(),
                'totalPages' => $pager->getPageCount(),
                'totalUsers' => $pager->getTotal(),
                'perPage' => $pager->getPerPage()
            ]
        ]);
    }

    public function create()
    {
        $user = new User($this->request->getJson(true));

        if (!$this->model->save($user)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($this->model->find($user->id));
    }

    public function update($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        $data = $this->request->getJson(true);

        if (!$this->model->updateUser($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respond($this->model->find($user->id));
    }

    public function delete($id = null)
    {
        $user = $this->model->find($id);
        if (!$user) {
            return $this->failNotFound('User not found');
        }

        if (!$this->model->delete($id)) {
            return $this->failServerError('Could not delete user');
        }

        return $this->respondDeleted($user);
    }
}
