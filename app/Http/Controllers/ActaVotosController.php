<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\actavotos; //modelo
    use App\Http\Requests\actavotosFormRequest;//request
    
    //añadir siempre
    use App\Http\Requests;
    use Illuminate\Support\Facades\Redirect;
    
    //usa la bd
    use DB;
class ActaVotosController extends Controller
{
  
        public function __construct()
        {
    
        }
    
    
        public function index(Request $request)
        {
            if ($request)
            {
                $query = trim($request->get('searchText'));
                $actavotos = DB::table('ActaVotos as c')    
                ->join('Mesa as p', 'p.id','=','c.idMesa')
                ->where('c.id','LIKE','%'.$query.'%')
                ->orderBy('c.id','ASC')
                ->paginate(5);
                return view('actavotos.index', ["actavotos" => $actavotos, "searchText" => $query]);
            }
        }
    
    
        public function create()
        {
         return view("candidato.create");
        }
    
    
       /* public function store (PrivilegioFormRequest $request)
        {
            $privilegio = new Privilegio;
            $privilegio->NOMBRE = trim($request->get('nombre'));
            $privilegio->save();
    
            return Redirect::to('privilegio'); 
        }*/
    
    
      /*  public function show($id)
        {
            //return view("cliente.zona.show", ["zona" => Zona::findOrFail($id)]);
        }*/
    
    
        public function edit($id)
        {
            return view("candidato.edit", ["candidato" => Candidatoo::findOrFail($id)]);
        }
    
    
        public function update(PrivilegioFormRequest $request, $id)
        {
        
            $candidato = Candidato::findOrFail($id);
            $candidato->nombre= $request->get('nombre');
         
            $candidato->update();
            return Redirect::to('candidato');
            
        }
    
    
        public function destroy($id)
        {
            
            $candidato = Candidato::findOrFail($id);
            $candidato->delete();
            return Redirect::to('candidato');
            
        }
    }
    
    
    
    
    

