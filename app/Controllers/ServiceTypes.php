<?php

namespace App\Controllers;

use App\Models\ServiceTypesModel;

class ServiceTypes extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(ServiceTypesModel::class);
        $data = [
            'serviceTypes' => $model->getServiceTypes(),
            'title' => 'Типи сервісу',
            ];

        if ($user->can('ServiceTypes.create'))
                 $data['url'] = '<button class="ui green button" onclick="openCreateModal()">Додати</button>';

        if ($user->can('ServiceTypes.edit'))
            $data['edit'] = true;

        return view('templates/header', $data)
             . view('serviceTypes/index', $data)
             . view('serviceTypes/modal')
             . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');
        if (!$user->can('ServiceTypes.create', 'ServiceTypes.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'servicetype_name'   => 'required|max_length[100]',
        ];
        if ($this->validate($validationRules)) {
            $model = model(ServiceTypesModel::class);
            $data = [
                'servicetype_name'   => $this->request->getPost('servicetype_name'),
                'servicetype_description' => $this->request->getPost('servicetype_description'),
            ];
            $model->save($data);
            // return redirect()->to(site_url('GenTypes'))->with('success', 'Тип генератору успішно додано');
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
        if (!$user->can('ServiceTypes.create', 'ServiceTypes.edit'))
            return $this->response->setJSON(['success' => false, 'errors' => 'не має дозволу']);

        // todo - додати меседж
        $validationRules = [
            'id'     => 'required|greater_than[0]|integer',
            'servicetype_name'   => 'required|max_length[100]',
        ];
        if ($this->validate($validationRules)) {
            $model = model(ServiceTypesModel::class);
            $data = [
                'id'   => $this->request->getPost('id'),
                'servicetype_name'   => $this->request->getPost('servicetype_name'),
                'servicetype_description' => $this->request->getPost('servicetype_description'),
            ];
            $model->replace($data);
            // return redirect()->to(site_url('GenTypes'))->with('success', 'Тип генератору успішно додано');
            return $this->response->setJSON(['success' => 'Тип генератору успішно оновлено']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }

}
