<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\User;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = false;
    protected $returnType       = User::class;
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'id', 'first_name', 'last_name', 'email', 'phone', 'address',
        'professional_status', 'last_login', 'created_at', 'updated_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';

    protected $validationRules = [
        'id' => 'isValidUuidV4',
        'first_name' => 'required|min_length[3]|max_length[100]',
        'last_name'  => 'required|min_length[3]|max_length[100]',
        'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
        'phone'      => 'required|min_length[10]|max_length[15]',
        'address'    => 'required|max_length[255]',
        'professional_status' => 'required|max_length[100]',
    ];
    protected $validationMessages = [
        'id' => [
            'isValidUuidV4' => 'The ID must be a valid UUID v4.'
        ],
    ];
    protected $skipValidation     = false;

    protected $beforeInsert = ['setTimestamps'];
    protected $beforeUpdate = ['setUpdatedTimestamp'];

    protected function generateUUID(array $data)
    {
        if (empty($data['data']['id'])) {
            $data['data']['id'] = $this->generateUUIDv4();
        }
        return $data;
    }

    protected function setTimestamps(array $data)
    {
        $currentTime = date('Y-m-d H:i:s');
        if (!isset($data['data']['created_at'])) {
            $data['data']['created_at'] = $currentTime;
        }
        $data['data']['updated_at'] = $currentTime;

        return $data;
    }

    protected function setUpdatedTimestamp(array $data)
    {
        $data['data']['updated_at'] = date('Y-m-d H:i:s');

        return $data;
    }

    public function updateUser($id, $data)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');

        // So that the email uniqueness rule does not apply to the modified user
        $data['id'] = $id;

        if (!$this->validate($data)) {
            return false;
        }

        return $this->db->table($this->table)
            ->where('id', $id)
            ->update($data);
    }
}
