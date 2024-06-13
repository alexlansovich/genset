<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceTypesModel extends Model
{
    protected $table = 'genset__servicetypes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['servicetype_name', 'servicetype_description'];

    public function getServiceTypes($id = false)
    {
        if ($id === false) {
            return $this
                ->orderBy('servicetype_name', 'asc')
                ->findAll();
        }
        return $this->where(['id' => $id])->getRow();
    }
}

