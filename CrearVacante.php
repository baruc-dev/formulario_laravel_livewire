<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CrearVacante extends Component
{

    public $titulo;
    public $salario;
    public $categoria;
    public $ultimodia;
    public $descripcion;
    public $imagen;

    use WithFileUploads;

    protected $rules =
    [
        'titulo' => 'required|string',
        'salario' => 'required',
        'categoria' => 'required',
        'ultimodia' => 'required',
        'descripcion' => 'required',
        'imagen' => 'required|image|max:1024'
        

    ];


    public function crearVacante()
    {
        $datos = $this->validate();
    }

    public function render()
    {
        $salario = Salario::all();
        $categoria = Categoria::all();
        return view('livewire.crear-vacante',[
            'salarios' => $salario,
            'categorias' => $categoria
        ]);
    }
}
