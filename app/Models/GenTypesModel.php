<?php

namespace App\Models;

use CodeIgniter\Model;

class GenTypesModel extends Model
{
    protected $table = 'genset__types';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type_name', 'type_description', 'litresPerHour', 'phase', 'powerKva', 'powerKw', 'serviceParameters'];

    public function getGenTypes($id = false)
    {
        if ($id === false) {
            return $this
                ->orderBy('type_name', 'asc')
                ->findAll();
        }
        return $this->where(['id' => $id])->getRow();
    }



}

