<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\cuadro;
use Illuminate\Http\Request;
use App\Http\Resources\v1\cuadroResource;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\DB;

class cuadroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $cuadros = cuadroResource::collection(cuadro::all());

        return $cuadros;
    }

    public function search(Request $request)
    {
        $cuadros = cuadroResource::collection(DB::table('cuadros')
            ->whereRaw($this->getWhere($request->filters))
            ->get());

        return $cuadros;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>'required',
            'pais'=>'required',
            'autor'=>'required'
        ]);

        $cuadro = new cuadro([
            'nombre' => $request->get('nombre'),
            'pais' => $request->get('pais'),
            'autor' => $request->get('autor')
        ]);
        if ($cuadro->save()) {
            return new cuadroResource($cuadro);
        }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cuadro  $cuadro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cuadro $cuadro)
    {
        $cuadro->nombre = $request->nombre;
        $cuadro->pais = $request->pais;
        $cuadro->autor = $request->autor;
        if($cuadro->save) {
            return new cuadroResource($cuadro);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cuadro  $cuadro
     * @return \Illuminate\Http\Response
     */
    public function destroy(cuadro $cuadro)
    {
        if($cuadro->delete()){
            return new cuadroResource($cuadro);
        }
    }

    public function getWhere($filtro){
        
        $result = true;
        // return $filtro;

        $sepa = '';
        if (! empty($filtro)){
            $result = "";
            $campos = $filtro;
            foreach ($campos as $clave => $valor){
                $result = $result . $sepa . $clave . '="' . $valor . '"';
                $sepa = ' and '; 
            }
        }

        return $result;
    } 
}
