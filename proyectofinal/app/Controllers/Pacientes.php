<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PacientesModel;

class Pacientes extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pacientesModel = new PacientesModel();
        $data['pacientes'] = $pacientesModel->findAll();
        return view('pacientes/index', $data);
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
        return view('pacientes/nuevo');
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $reglas =[
            'nombre' =>'required',
            'Email' => 'valid_email',
            'telefono' => 'required',
            'FechaNacimiento' => 'required',
            'genero' => 'required',
            'direccion' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['nombre','Email','telefono','FechaNacimiento','genero','direccion']);

        $pacientes = new PacientesModel();
        $pacientes->insert([
            'nombre' =>trim( $post['nombre']),
            'Email' =>$post['Email'],
            'telefono' => $post['telefono'],
            'FechaNacimiento' => $post['FechaNacimiento'],
            'genero' => $post['genero'],
            'direccion' => $post['direccion'],
        ]);
        return redirect()->to('pacientes');

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
            return redirect()->route('pacientes');
        }
        $pacientesModel = new PacientesModel();
        $data['pacientes'] = $pacientesModel->find($id);
        return view('pacientes/editar',$data);
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
            'nombre' =>'required',
            'Email' => 'valid_email',
            'telefono' => 'required',
            'FechaNacimiento' => 'required',
            'genero' => 'required',
            'direccion' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['nombre','Email','telefono','FechaNacimiento','genero','direccion']);

        $pacientes = new PacientesModel();
        $pacientes->update($id, [
            'nombre' =>$post['nombre'],
            'Email' =>$post['Email'],
            'telefono' => $post['telefono'],
            'FechaNacimiento' => $post['FechaNacimiento'],
            'genero' => $post['genero'],
            'direccion' => $post['direccion'],
        ]);
        return redirect()->to('pacientes');
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
            return redirect()->route('pacientes');
        }
        $pacientesModel = new PacientesModel();
        $pacientesModel->delete($id);
        return redirect()->to('pacientes');
    }
}
