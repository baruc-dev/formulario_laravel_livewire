<?php

namespace App\Livewire;

use App\Models\Categoria;
use App\Models\Salario;
use App\Models\Vacante;
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
        //almacenar la imagen

        $imagen = $this->imagen->store('public/vacantes');
        //esto de aqui se guarda en storage/app/public/vacantes
        $nombre_imagen = str_replace('public/vacantes/','', $imagen);
        //aqui estamos eliminando la direccion public/vacantes, la reemplazamos por algo vacio y le decimos de donde sacar esa ruta

        //crear la vacante

        Vacante::create([

        'titulo' => $datos['titulo'],
        'salario_id' => $datos['salario'],
        'categoria_id' => $datos['categoria'],
        'ultimodia' => $datos['ultimodia'],
        'descripcion' => $datos['descripcion'],
        'imagen' => $nombre_imagen,
        'user_id' => auth()->user()->id

        ]);

        //crear un mensaje 

        return redirect()->route('vacantes.index')->with('mensaje', 'subido correctamente');

        //redireccionando el usuario
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
