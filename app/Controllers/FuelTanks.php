<?php

namespace App\Controllers;

use App\Models\FuelTanksModel;

class FuelTanks extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(FuelTanksModel::class);
        $data = [
            'fuelTanks' => $model->getFuelTanks(),
            'title' => 'Типи баків генераторів',
            ];
        if ($user->can('FuelTanks.create'))
            $data['url'] = '<button class="ui green button" onclick="openCreateModal()">Додати</button>';

        if ($user->can('FuelTanks.edit'))
            $data['edit'] = true;

        return view('templates/header', $data)
             . view('fuelTanks/index', $data)
             . view('fuelTanks/modal')
             . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');
        if (!$user->can('FuelTanks.create', 'FuelTanks.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'fueltank_name'   => 'required|max_length[30]',
            'fueltank_litres' => 'required|greater_than[0]|integer',
        ];

        if ($this->validate($validationRules)) {
            $model = model(FuelTanksModel::class);
            $data = [
                'fueltank_name'   => $this->request->getPost('fueltank_name'),
                'fueltank_litres' => $this->request->getPost('fueltank_litres'),
                'description' => $this->request->getPost('description'),
            ];
            $model->save($data);
            return $this->response->setJSON(['success' => 'Тип баку успішно додано']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

    public function edit()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');
        if (!$user->can('FuelTanks.create', 'FuelTanks.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'id'     => 'required|greater_than[0]|integer',
            'fueltank_name'   => 'required|max_length[30]',
            'fueltank_litres' => 'required|greater_than[0]|integer',
        ];

        if ($this->validate($validationRules)) {
            $model = model(FuelTanksModel::class);
            $data = [
                'id'   => $this->request->getPost('id'),
                'fueltank_name'   => $this->request->getPost('fueltank_name'),
                'fueltank_litres' => $this->request->getPost('fueltank_litres'),
                'fueltank_description' => $this->request->getPost('fueltank_description'),
            ];
            $model->replace($data);
            return $this->response->setJSON(['success' => 'Тип баку успішно оновлено']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

}
