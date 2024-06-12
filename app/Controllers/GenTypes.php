<?php

namespace App\Controllers;

use App\Models\GenTypesModel;

class GenTypes extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(GenTypesModel::class);
        $data = [
            'genTypes' => $model->getGenTypes(),
            'title' => 'Типи генераторів',
            ];

        if ($user->can('GenTypes.create'))
                 $data['url'] = '<button class="ui green button" onclick="openCreateModal()">Додати</button>';

        if ($user->can('GenTypes.edit'))
            $data['edit'] = true;

        return view('templates/header', $data)
             . view('genTypes/index', $data)
             . view('genTypes/modal')
             . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');
        if (!$user->can('GenTypes.create', 'GenTypes.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'type_name'   => 'required|max_length[30]',
            'litresPerHour' => 'required|greater_than[0]|numeric',
            'phase' => 'required|greater_than[0]|integer',
            'powerKva' => 'required|greater_than[0]|numeric',
            'powerKw' => 'required|greater_than[0]|numeric',
        ];
        if ($this->validate($validationRules)) {
            $model = model(GenTypesModel::class);
            $data = [
                'type_name'   => $this->request->getPost('type_name'),
                'type_description' => $this->request->getPost('type_description'),
                'litresPerHour' => $this->request->getPost('litresPerHour'),
                'phase' => $this->request->getPost('phase'),
                'powerKva' => $this->request->getPost('powerKva'),
                'powerKw' => $this->request->getPost('powerKw'),
                'serviceParameters' => $this->request->getPost('serviceParameters'),
            ];
            $model->save($data);
            return $this->response->setJSON(['success' => 'Тип генератору успішно додано']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

    public function edit()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');
        if (!$user->can('GenTypes.create', 'GenTypes.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'id'     => 'required|greater_than[0]|integer',
            'type_name'   => 'required|max_length[30]',
            'litresPerHour' => 'required|greater_than[0]|numeric',
            'phase' => 'required|greater_than[0]|integer',
            'powerKva' => 'required|greater_than[0]|numeric',
            'powerKw' => 'required|greater_than[0]|numeric',
        ];
        if ($this->validate($validationRules)) {
            $model = model(GenTypesModel::class);
            $data = [
                'id'   => $this->request->getPost('id'),
                'type_name'   => $this->request->getPost('type_name'),
                'type_description' => $this->request->getPost('type_description'),
                'litresPerHour' => $this->request->getPost('litresPerHour'),
                'phase' => $this->request->getPost('phase'),
                'powerKva' => $this->request->getPost('powerKva'),
                'powerKw' => $this->request->getPost('powerKw'),
                'serviceParameters' => $this->request->getPost('serviceParameters'),
            ];
            $model->replace($data);
            return $this->response->setJSON(['success' => 'Тип генератору успішно оновлено']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

}
