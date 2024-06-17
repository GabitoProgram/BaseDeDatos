<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DoctoresModel;

class Doctores extends BaseController
{
    protected $helpers = ['form'];
    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $doctoresModel = new DoctoresModel();
        $data['doctores'] = $doctoresModel->findAll();
        return view('doctores/index',$data);
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
        return view('doctores/nuevo');
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
            'especialidad' => 'required',
            'Email' => 'valid_email',
            'telefono' => 'required',
            'horariosConsulta' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['nombre','especialidad','Email','telefono','horariosConsulta']);

        $pacientes = new DoctoresModel();
        $pacientes->insert([
            'nombre' =>trim( $post['nombre']),
            'especialidad' => $post['especialidad'],
            'Email' =>$post['Email'],
            'telefono' => $post['telefono'],
            'horariosConsulta' => $post['horariosConsulta'],
        ]);
        return redirect()->to('doctores');
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
            return redirect()->route('doctores');
        }
        $doctoresModel = new DoctoresModel();
        $data['doctores'] = $doctoresModel->find($id);
        return view('doctores/editar',$data);
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
            'especialidad' => 'required',
            'Email' => 'valid_email',
            'telefono' => 'required',
            'horariosConsulta' => 'required'
        ];
        if(!$this->validate($reglas)){
            return redirect()->back()->withInput()->with('error',$this->validator->listErrors());
        }

        $post= $this->request->getPost(['nombre','especialidad','Email','telefono','horariosConsulta']);

        $doctores = new DoctoresModel();
        $doctores->update($id, [
            'nombre' =>trim( $post['nombre']),
            'especialidad' => $post['especialidad'],
            'Email' =>$post['Email'],
            'telefono' => $post['telefono'],
            'horariosConsulta' => $post['horariosConsulta'],
        ]);
        return redirect()->to('doctores');
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
            return redirect()->route('doctores');
        }
        $doctoresModel = new DoctoresModel();
        $doctoresModel->delete($id);
        return redirect()->to('doctores');
    }
}
