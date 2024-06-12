<?php

namespace App\Controllers;

use App\Models\GenSetsModel;
use App\Models\RunsModel;
use App\Models\RefuelsModel;

use App\Models\FuncModel;
use App\Models\ServicesModel;
use App\Models\ServiceTypesModel;

class GenSets extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(GenSetsModel::class);

        $data = [
            'genSetArray' => [
                'running' => $model->getGenSetsState('1'),
                'broken' => $model->getGenSetsState('2'),
                'normal' => $model->getGenSetsState(),
                ],
            'title' => 'Генератори',
        ];
        if ($user->can('GenSets.create'))
            $data['url'] = '<button class="ui green button" onclick="openCreateModal()">Додати</button>';

        if ($user->can('GenSets.edit'))
            $data['edit'] = true;

        return view('templates/header', $data)
             . view('genSets/index', $data)
             . view('genSets/modal')
             . view('templates/footer');
    }

    public function view($genId)
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $modelGen = model(GenSetsModel::class);
        $modelRun = model(RunsModel::class);
        $modelRefuel = model(RefuelsModel::class);
        $modelService = model(ServicesModel::class);

        $runs = $modelRun->getRuns($genId);
        $runs = $modelRun->parseRuns($runs);

        $data = [
            'genSet' => $modelGen->getGenSets($genId),
            'runs' => $runs,
            'refuels' => $modelRefuel->getRefuels($genId),
            'services' => $modelService->getServices($genId),
            'title' => 'Генератор',
        ];

        $modelTypes = model(ServiceTypesModel::class);
        $modelFunc = model(FuncModel::class);

        $serviceTypes = $modelTypes->getServiceTypes();
        //todo check if return false
        $data['serviceTypes'] = $modelFunc->convertArray($serviceTypes);

        return view('templates/header', $data)
            . view('genSets/view', $data)
            . view('genSets/modal')
            . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        // todo - додати меседж
        $validationRules = [
            'city'   => 'required|max_length[30]',
            'address' => 'required|max_length[30]',
            'genTypeId' => 'required|greater_than[0]|integer',
            'fuelTankId' => 'required|greater_than[0]|integer',
        ];

        if ($this->validate($validationRules)) {
            $model = model(GenSetsModel::class);
            $data = [
                'city'   => $this->request->getPost('city'),
                'address' => $this->request->getPost('address'),
                'genTypeId' => $this->request->getPost('genTypeId'),
                'fuelTankId' => $this->request->getPost('fuelTankId'),
            ];
            $model->save($data);
            return $this->response->setJSON(['success' => 'Генератор успішно додано']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

    public function edit()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        // todo - додати меседж
        $validationRules = [
            'genId'     => 'required|greater_than[0]|integer',
            'city'   => 'required|max_length[30]',
            'address' => 'required|max_length[30]',
            'genTypeId' => 'required|greater_than[0]|integer',
            'fuelTankId' => 'required|greater_than[0]|integer',
        ];
        if ($this->validate($validationRules)) {
            $model = model(GenSetsModel::class);
            $data = [
                'genId'   => $this->request->getPost('genId'),
                'city'   => $this->request->getPost('city'),
                'address' => $this->request->getPost('address'),
                'genTypeId' => $this->request->getPost('genTypeId'),
                'fuelTankId' => $this->request->getPost('fuelTankId'),
            ];
            $model->save($data);
            return $this->response->setJSON(['success' => 'Генератор успішно оновлено']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

}
