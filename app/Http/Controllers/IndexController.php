<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Cotizacion;
use App\CotizacionesCliente;
use App\PaqueteCotizaciones;
use App\User;
use Illuminate\Http\Request;
use ConsoleTVs\Charts\Facades\Charts;


class IndexController extends Controller
{
    //
    public function index()
    {
//        $chart = Charts::multi('bar', 'material')
//        // Setup the chart settings
//        ->title("My Cool Chart")
//        // A dimension of 0 means it will take 100% of the space
//        ->dimensions(0, 400) // Width x Height
//        // This defines a preset of colors already done:)
//        ->template("material")
//        // You could always set them manually
//        // ->colors(['#2196F3', '#F44336', '#FFC107'])
//        // Setup the diferent datasets (this is a multi chart)
//        ->dataset('Element 1', [5,20,100])
//        ->dataset('Element 2', [15,30,80])
//        ->dataset('Element 3', [25,10,40])
//        // Setup what the values mean
//        ->labels(['One', 'Two', 'Three']);
        $mes='Septiembre';
        $chart = Charts::create('percentage', 'justgage')
            ->title('$68000')
            ->elementLabel($mes)
            ->values([25500,0,68000])
            ->colors(['#7F8429'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart1 = Charts::create('percentage', 'justgage')
            ->title('$60000')
            ->elementLabel($mes)
            ->values([30500,0,60000])
            ->colors(['#e09e37'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart2 = Charts::create('percentage', 'justgage')
            ->title('$1600')
            ->elementLabel($mes)
            ->values([500,0,1600])
            ->colors(['#3097D1'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart3 = Charts::create('percentage', 'justgage')
            ->title('$34000')
            ->elementLabel($mes)
            ->values([10500,0,34000])
            ->colors(['#e91e63'])
            ->responsive(true)
            ->height(250)
            ->width(0);

        $chart4 = Charts::create('percentage', 'justgage')
            ->title('$38000')
            ->elementLabel($mes)
            ->values([30500,0,38000])
            ->colors(['#ff0000'])
            ->responsive(true)
            ->height(250)
            ->width(0);

        return view('admin.index',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);
    }

public function inicio()
{
    $mes='Septiembre';
    $chart = Charts::create('percentage', 'justgage')
        ->title('$68000')
        ->elementLabel($mes)
        ->values([25500,0,68000])
        ->colors(['#7F8429'])
        ->responsive(true)
        ->height(250)
        ->width(0);
    $chart1 = Charts::create('percentage', 'justgage')
        ->title('$60000')
        ->elementLabel($mes)
        ->values([30500,0,60000])
        ->colors(['#e09e37'])
        ->responsive(true)
        ->height(250)
        ->width(0);
    $chart2 = Charts::create('percentage', 'justgage')
        ->title('$1600')
        ->elementLabel($mes)
        ->values([500,0,1600])
        ->colors(['#3097D1'])
        ->responsive(true)
        ->height(250)
        ->width(0);
    $chart3 = Charts::create('percentage', 'justgage')
        ->title('$34000')
        ->elementLabel($mes)
        ->values([10500,0,34000])
        ->colors(['#e91e63'])
        ->responsive(true)
        ->height(250)
        ->width(0);

    $chart4 = Charts::create('percentage', 'justgage')
        ->title('$38000')
        ->elementLabel($mes)
        ->values([30500,0,38000])
        ->colors(['#ff0000'])
        ->responsive(true)
        ->height(250)
        ->width(0);
    return view('admin.login',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);
}
    public function ventas()
    {
        $mes='Septiembre';
        $chart = Charts::create('percentage', 'justgage')
            ->title('$68000')
            ->elementLabel($mes)
            ->values([25500,0,68000])
            ->colors(['#7F8429'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart1 = Charts::create('percentage', 'justgage')
            ->title('$60000')
            ->elementLabel($mes)
            ->values([30500,0,60000])
            ->colors(['#e09e37'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart2 = Charts::create('percentage', 'justgage')
            ->title('$1600')
            ->elementLabel($mes)
            ->values([500,0,1600])
            ->colors(['#3097D1'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart3 = Charts::create('percentage', 'justgage')
            ->title('$34000')
            ->elementLabel($mes)
            ->values([10500,0,34000])
            ->colors(['#e91e63'])
            ->responsive(true)
            ->height(250)
            ->width(0);

        $chart4 = Charts::create('percentage', 'justgage')
            ->title('$38000')
            ->elementLabel($mes)
            ->values([30500,0,38000])
            ->colors(['#ff0000'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        return view('admin.ventas',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);

    }
    public function ventas_now()
    {
        $mes='Septiembre';
        $chart = Charts::create('percentage', 'justgage')
            ->title('$68000')
            ->elementLabel($mes)
            ->values([25500,0,68000])
            ->colors(['#7F8429'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart1 = Charts::create('percentage', 'justgage')
            ->title('$60000')
            ->elementLabel($mes)
            ->values([30500,0,60000])
            ->colors(['#e09e37'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart2 = Charts::create('percentage', 'justgage')
            ->title('$1600')
            ->elementLabel($mes)
            ->values([500,0,1600])
            ->colors(['#3097D1'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        $chart3 = Charts::create('percentage', 'justgage')
            ->title('$34000')
            ->elementLabel($mes)
            ->values([10500,0,34000])
            ->colors(['#e91e63'])
            ->responsive(true)
            ->height(250)
            ->width(0);

        $chart4 = Charts::create('percentage', 'justgage')
            ->title('$38000')
            ->elementLabel($mes)
            ->values([30500,0,38000])
            ->colors(['#ff0000'])
            ->responsive(true)
            ->height(250)
            ->width(0);
        return view('admin.ventas',['chart' => $chart,'chart1' => $chart1,'chart2' => $chart2,'chart3' => $chart3,'chart4' => $chart4]);

    }
    public function logeo(Request $request){
        $txt_codigo=$request->input('txt_codigo');
        $txt_password=$request->input('txt_password');



        return view('admin.book.services',['cotizacion'=>$cotizacion,'productos'=>$productos,'proveedores'=>$proveedores,'hotel_proveedor'=>$hotel_proveedor]);

    }
    public function contabilidad(){
        $cotizacion=Cotizacion::where('confirmado_r','ok')->get();
        return view('admin.contabilidad.index1',['cotizacion'=>$cotizacion]);
    }
    public function reservas(){
        $paquete_cotizacion = PaqueteCotizaciones::where('estado', 2)->get();
        $cot_cliente = CotizacionesCliente::with('cliente')->where('estado', 1)->get();
        $cliente = Cliente::get();
        $cotizacion_cat=Cotizacion::where('estado',2)
            ->whereBetween('categorizado',['C','S'])->get();
        return view('admin.book.book1', ['paquete_cotizacion'=>$paquete_cotizacion, 'cot_cliente'=>$cot_cliente, 'cliente'=>$cliente,'cotizacion_cat'=>$cotizacion_cat]);
    }


    public function crear(Request $request){
        return view('admin.crear-usuario');

    }
    public function crearp(Request $request){
        $email=$request->input('txt_codigo');
        $contrasena=$request->input('txt_password');
        $tipo=$request->input('tipo');

        $user=new User();
        $user->name='freddy';
        $user->email=$email;
        $user->tipo_user=$tipo;
        $user->password=bcrypt($contrasena);
        $user->save();
        return view('admin.crear-usuario');

    }
}
