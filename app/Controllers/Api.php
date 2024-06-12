<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\GenSetsModel;
use App\Models\RunsModel;
use App\Models\GenTypesModel;
use App\Models\FuelTanksModel;
use App\Models\ServiceTypesModel;

class Api extends BaseController
{
    use ResponseTrait;

    public function genTypes()
    {
        $model = model(GenTypesModel::class);
        $generatorTypes = $model->getGenTypes();
        if ($generatorTypes) {
            return $this->respond($generatorTypes);
        } else {
            return $this->failNotFound('Generator types not found.');
        }
    }

    public function fuelTanks()
    {
        $model = model(FuelTanksModel::class);
        $fuelTanks = $model->getFuelTanks();
        if ($fuelTanks) {
            return $this->respond($fuelTanks);
        } else {
            return $this->failNotFound('Fuel tanks not found.');
        }
    }

    public function serviceTypes()
    {
        $model = model(ServiceTypesModel::class);
        $serviceTypes = $model->getServiceTypes();
        if ($serviceTypes) {
            return $this->respond($serviceTypes);
        } else {
            return $this->failNotFound('service types not found.');
        }
    }

    public function genSets()
    {
        $model = model(GenSetsModel::class);
        $genSets = $model->getGenSets();
        if ($genSets) {
            return $this->respond($genSets);
        } else {
            return $this->failNotFound('Gensets not found.');
        }
    }

    public function genRunning($genId)
    {
        $model = model(RunsModel::class);
        $genRunning = $model->getRunning($genId);
        if ($genRunning) {
            return $this->respond($genRunning);
        } else {
            return $this->failNotFound('No running.');
        }
    }

}
