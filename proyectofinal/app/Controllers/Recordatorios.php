<?php

namespace App\Controllers;

use App\Models\CitasModel;
use App\Models\RecordatoriosModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;

class Recordatorios extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $recordatoriosModel = new RecordatoriosModel();
        $data['recordatorios'] = $recordatoriosModel->findAll();
        return view('recordatorios/index',$data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {

        
        $citasModel = new CitasModel();
        $data['recordatorios']=$citasModel->findAll();
        return view('recordatorios/nuevo',$data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas =[
            'id_C' =>'required|is_not_unique[citas.id_P]',
            'tipoRecordatorio' => 'required',
            'FechaHoraEnvio' => 'required',
            'Estado' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['id_C','tipoRecordatorio','FechaHoraEnvio','Estado']);

        $recordatoriosModel = new RecordatoriosModel();
        $recordatoriosModel->insert([
            'id_C' =>$post['id_C'],
            'tipoRecordatorio' => $post['tipoRecordatorio'],
            'FechaHoraEnvio' =>$post['FechaHoraEnvio'],
            'Estado' => $post['Estado']
        ]);
        return redirect()->to('recordatorios');
    }

    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        
        if($id == null){
            return redirect()->route('recordatorios');
        }
        $citasModel = new CitasModel();
        $data['citas']=$citasModel->findAll();
        $recordatoriosModel = new RecordatoriosModel();
        $data['recordatorios'] = $recordatoriosModel->find($id);
        return view('recordatorios/editar',$data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $reglas =[
            'id_C' =>'required',
            'tipoRecordatorio' => 'required',
            'FechaHoraEnvio' => 'required',
            'Estado' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['id_C','tipoRecordatorio','FechaHoraEnvio','Estado']);

        $pacientes = new RecordatoriosModel();
        $pacientes->update($id ,[
            'id_C' =>$post['id_C'],
            'tipoRecordatorio' => $post['tipoRecordatorio'],
            'FechaHoraEnvio' =>$post['FechaHoraEnvio'],
            'Estado' => $post['Estado']
        ]);
        return redirect()->to('recordatorios');
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        if(!$this->request->is('delete') || $id == null){
            return redirect()->route('recordatorios');
        }
        $recordatoriosModel = new RecordatoriosModel();
        $recordatoriosModel->delete($id);
        return redirect()->to('recordatorios');
    }
}
