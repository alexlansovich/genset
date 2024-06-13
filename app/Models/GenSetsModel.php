<?php

namespace App\Models;

use CodeIgniter\Model;

class GenSetsModel extends Model
{
    protected $table = 'gensets';
    protected $primaryKey = 'genId';
    protected $allowedFields = ['genTypeId', 'address', 'city', 'fuelTankId', 'genState', 'genLitres'];

    public function getGenSets($genId = false)
    {
        if ($genId === false) {
            return $this
                ->join('genset__types', 'genset__types.id = gensets.genTypeId')
                ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
                ->orderBy('city', 'asc')
                ->orderBy('address', 'asc')
                ->findAll();

        }
        return $this
            ->join('genset__types', 'genset__types.id = gensets.genTypeId')
            ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
            ->find($genId);
    }

    public function getGenSetsState($genState = false)
    {
        // Subquery to select the latest run for each generator
        $subQuery = $this->db->table('genset__runs')
            ->select('genId as runGenId, MAX(startDate) AS last_run_timestamp')
            ->groupBy('genId')
            ->getCompiledSelect();

        $query = $this
            ->join('genset__types', 'genset__types.id = gensets.genTypeId')
            ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
            ->join("($subQuery) AS last_runs", 'last_runs.runGenId = gensets.genId', 'left')
            ->orderBy('city', 'asc')
            ->orderBy('address', 'asc');

        // Add condition based on generator state
        if ($genState === false) {
            $query->where('genState', null);
        } else {
            $query->where('genState', $genState);
        }

        return $query->findAll();

    }
}

