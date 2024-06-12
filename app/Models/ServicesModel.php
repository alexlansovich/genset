<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicesModel extends Model
{
    protected $table = 'genset__services';
    protected $primaryKey = 'id';
    protected $allowedFields = ['genId', 'serviceDate', 'serviceWorks', 'serviceDesc'];

    public function getServices($genId = false)
    {
        if ($genId === false) {
            return $this
                ->join('gensets', 'gensets.genId = genset__services.genId')
                ->join('genset__types', 'genset__types.id = gensets.genTypeId')
                ->orderBy('serviceDate', 'desc')
                ->findAll();
        }
        return $this
            ->where('genId', $genId)
            ->orderBy('serviceDate', 'desc')
            ->findAll();
    }
}

