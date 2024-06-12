<?php

namespace App\Controllers;

use App\Models\FuncModel;
use App\Models\ServicesModel;
use App\Models\ServiceTypesModel;

class Services extends BaseController
{
    public function index()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        $model = model(ServicesModel::class);

        $data = [
            'services' => $model->getServices(),
            'title' => 'Обслуговування генераторів',
        ];

        $modelTypes = model(ServiceTypesModel::class);
        $modelFunc = model(FuncModel::class);

        $serviceTypes = $modelTypes->getServiceTypes();
        //todo check if return false
        $data['serviceTypes'] = $modelFunc->convertArray($serviceTypes);

        return view('templates/header', $data)
            . view('services/index', $data)
            . view('templates/footer');
    }

    public function create()
    {
        $user = auth()->user();
        if (!$user)
            return redirect()->to('login');

        // todo - додати меседж
        $validationRules = [
            'serviceGenId'   => 'required|integer',
            'serviceDate'   => 'required|min_length[9]|integer',
        ];
        if ($this->validate($validationRules)) {
            // save service to service table
            $model = model(ServicesModel::class);
            $data = [
                'genId'   => $this->request->getPost('serviceGenId'),
                'serviceDate'   => $this->request->getPost('serviceDate'),
                'serviceWorks' => serialize($this->request->getPost('serviceWorks')),
            ];
            if ($this->request->getPost('serviceDesc'))
            $data['serviceDesc'] = $this->request->getPost('serviceDesc');

            $model->save($data);
            return $this->response->setJSON(['success' => 'Сервіс генератора успішно додано']);
        } else {
            return $this->response->setJSON(['success' => false, 'errors' => $this->validator->getErrors()]);
        }
    }
}
