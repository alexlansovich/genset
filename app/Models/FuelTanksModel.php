<?php

namespace App\Models;

use CodeIgniter\Model;

class FuelTanksModel extends Model
{
    protected $table = 'genset__fueltanks';
    protected $primaryKey = 'id';
    protected $allowedFields = ['fueltank_name', 'fueltank_litres', 'fueltank_description'];

    public function getFuelTanks($id = false)
    {
        if ($id === false) {
            return $this
                ->orderBy('fueltank_name', 'asc')
                ->findAll();
        }
        return $this->where(['id' => $id])->getRow();
    }



}

