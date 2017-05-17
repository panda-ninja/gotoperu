<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    //
    public function autocomplete(Request $request)
    {
        if ($request->ajax()) {
            $rs = $request->get('txt_provider_0');
            $results = [];
            $proveedor = Proveedor::where('codigo', 'like', '%' . $rs . '%')
                ->orWhere('razon_social', 'like', '%' . $rs . '%')
//                ->orWhere('apellidos','like','%'.$dni.'%')
                ->get();
            foreach ($proveedor as $query) {
                $results[] = ['id' => $query->id, 'value' => $query->codigo.' '.$query->razon_social];
            }
            return response()->json($results);
        }

    }
}
