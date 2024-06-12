<?php

namespace App\Controllers;

use App\Models\GenSetsModel;
use App\Models\GenTypesModel;
use App\Models\RefuelsModel;

class Refuels extends BaseController
{

    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(RefuelsModel::class);

        $data = [
            'refuels' => $model->getRefuels(),
            'title' => 'Заправки генераторів',
        ];
        return view('templates/header', $data)
            . view('refuels/index', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        // todo - додати меседж
        $validationRules = [
            'refuelGenId'   => 'required|integer',
            'refuelDate'   => 'required|min_length[9]|integer',
            'refuelLitres' => 'required|greater_than[0]|numeric',
            //'refuelLitresBefore' => 'required|greater_than[0]|numeric',
            'refuelLitresAfter' => 'required|greater_than[0]|numeric',
        ];
        if ($this->validate($validationRules)) {
            // save refuels to Refuels table
            $model = model(RefuelsModel::class);
            $data = [
                'genId'   => $this->request->getPost('refuelGenId'),
                'date'   => $this->request->getPost('refuelDate'),
                'litres' => $this->request->getPost('refuelLitres'),
                'litresBefore' => $this->request->getPost('refuelLitresBefore'),
                'litresAfter' => $this->request->getPost('refuelLitresAfter'),
            ];
            $model->save($data);
            // update genLitres after refuels to Gen table
            $genModel = model(GenSetsModel::class);
            $genData = [
                'genId'   => $this->request->getPost('refuelGenId'),
                'genLitres' => $this->request->getPost('refuelLitresAfter'),
            ];
            $genModel->save($genData);
            return $this->response->setJSON(['success' => 'Заправка генератора успішно додано']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }


}
