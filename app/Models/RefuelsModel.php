<?php

namespace App\Models;

use CodeIgniter\Model;

class RefuelsModel extends Model
{
    protected $table = 'genset__refuels';
    protected $primaryKey = 'id';
    protected $allowedFields = ['genId', 'date', 'litres', 'litresBefore', 'litresAfter'];

    public function getRefuels($genId = false)
    {
        if ($genId === false) {
            return $this
                ->join('gensets', 'gensets.genId = genset__refuels.genId')
                ->join('genset__types', 'genset__types.id = gensets.genTypeId')
                ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
                ->orderBy('date', 'desc')
                ->findAll();
        }
        return $this
            ->where('genId', $genId)
            ->orderBy('date', 'desc')
            ->findAll();
    }

}

