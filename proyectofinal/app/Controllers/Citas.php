<?php

namespace App\Controllers;

use App\Models\CitasModel;
use App\Models\DoctoresModel;
use App\Models\PacientesModel;
use App\Controllers\BaseController;

class Citas extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $citasModel = new CitasModel();
        $data['citas'] = $citasModel->findAll();
        return view('citas/index',$data);
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
    {   $doctoresModel = new DoctoresModel();
        $data['doctores']=$doctoresModel->findAll();
        $pacientesModel = new PacientesModel();
        $data['pacientes']=$pacientesModel->findAll();
        return view('citas/nuevo',$data);
        return view('citas/nuevo');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas =[
            'id_P' =>'required|is_not_unique[pacientes.id_P]',
            'id_D' => 'required|is_not_unique[doctores.id_D]',
            'fechaHora' => 'required',
            'estado' => 'required',
            'motivo' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['id_P','id_D','fechaHora','estado','motivo']);

        $citasModel = new CitasModel();
        $citasModel->insert([
            'id_P' =>$post['id_P'],
            'id_D' => $post['id_D'],
            'fechaHora' =>$post['fechaHora'],
            'estado' => $post['estado'],
            'motivo' => $post['motivo'],
        ]);
        return redirect()->to('citas');
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
            return redirect()->route('citas');
        }
        $doctoresModel = new DoctoresModel();
        $data['doctores']=$doctoresModel->findAll();
        $pacientesModel = new PacientesModel();
        $data['pacientes']=$pacientesModel->findAll();
        $citasModel = new CitasModel();
        $data['citas'] = $citasModel->find($id);
        return view('citas/editar',$data);
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
            'id_P' =>'required',
            'id_D' => 'required',
            'fechaHora' => 'required',
            'estado' => 'required',
            'motivo' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['id_P','id_D','fechaHora','estado','motivo']);

        $pacientes = new CitasModel();
        $pacientes->update($id, [
            'id_P' =>$post['id_P'],
            'id_D' => $post['id_D'],
            'fechaHora' =>$post['fechaHora'],
            'estado' => $post['estado'],
            'motivo' => $post['motivo'],
        ]);
        return redirect()->to('citas');
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
            return redirect()->route('citas');
        }
        $citasModel = new CitasModel();
        $citasModel->delete($id);
        return redirect()->to('citas');
    }
}
