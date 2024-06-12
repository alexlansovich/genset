<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\FuncModel;

class RunsModel extends Model
{
    protected $table = 'genset__runs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['genId', 'startDate', 'stopDate', 'runType', 'runResult'];

    public function getRuns($genId = false)
    {
        if ($genId === false) {
            return $this
                ->join('gensets', 'gensets.genId = genset__runs.genId')
                ->join('genset__types', 'genset__types.id = gensets.genTypeId')
                ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
                ->orderBy('startDate', 'desc')
                ->findAll();
        }
        return $this
            ->where('genId', $genId)
            ->orderBy('startDate', 'desc')
            ->findAll();
    }

    public function parseRuns($runs)
    {
        $model = model(FuncModel::class);
        foreach ($runs as $key => $run) {
            if (!empty($run['stopDate']))
                $runs[$key]['worktime'] = $model->calculateTimeDifference($run['startDate'], $run['stopDate']);
            else
                $runs[$key]['worktime'] = $model->calculateTimeDifference($run['startDate'], time());
        }
        return $runs;
    }

    public function getRunning($genId)
    {
        return $this
            ->where('genId', $genId)
            ->where('stopDate', null)
            ->first();
    }

    public function getRunsDay($startOfDay, $endOfDay)
    {
        return $this
            ->groupStart()
                ->where('stopDate', null)
                ->orGroupStart()
                    ->groupStart()
                        ->where('stopDate >=', $startOfDay)
                        ->where('stopDate <=', $endOfDay)
                    ->groupEnd()
                ->groupEnd()
            ->groupEnd()
            ->join('gensets', 'gensets.genId = genset__runs.genId')
            ->join('genset__types', 'genset__types.id = gensets.genTypeId')
            ->join('genset__fueltanks', 'genset__fueltanks.id = gensets.fuelTankId')
            ->orderBy('startDate', 'asc')
            ->findAll();
    }

}

