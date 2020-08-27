<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accion;
use App\Models\Referido;
use DB;
use Auth;
use Exception;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Config;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AccionController extends Controller
{
    private $NAME_CONTROLLER = 'AccionController';
    // Obtener todos los usuarios //
    function getAll(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : Accion::count();
                $result = Accion::where('idUsuarioFk',$request->id)->paginate($per_page);
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : Accion::count();
            $result = Accion::paginate($per_page);
            }
            $response = $result;  
  
            if($result->isEmpty()){
                return response()->json([
                    'msj' => 'No se encontraron registros.',
                ], 200); 
            }
            return response()->json($response);
        }catch (\Exception $e) {
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

    function getAccion(Request $request){
        try{
            $users = Accion::
            // join('tb_status','tb_status.idStatus', '=', 'tb_users.idStatusKf')
            // ->join('tb_profiles','tb_profiles.idProfile', '=', 'tb_users.idProfileKf')
            // ->join('tb_companies','tb_companies.idCompany', '=', 'tb_users.idCompanyKf')
              where('id','=',$request->id)
             ->get();
            if($users->isEmpty()){
                return response()->json([
                    'msj' => 'No se encontraron registros.',
                ], 200); 
            }
            return response()->json($users);
        }catch (\Exception $e) {
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

    function verificar(Request $request){
        try{
            $users = Accion::
              where('idUsuarioFk','=',$request->id)->where('estatus','aprobado')
             ->count();
      
            return response()->json($users);
        }catch (\Exception $e) {
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

    function create(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos

          
            $user = Accion::create([
                'referenciaPago'    => $request->referenciaPago,
                'idFaseFk'    => 1,
                'idUsuarioFk'     => $request->idUsuarioFk
               
         
            ]);
            DB::commit(); // Guardamos la transaccion
            return response()->json($user,201);
        }catch (\Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json($e->errors(),402);
            }
            DB::rollback(); // Retrocedemos la transaccion
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

      // Modificar usuarios
      function update(Request $request){
        try{
    
       
       

           DB::beginTransaction(); // Iniciar transaccion de la base de datos

           $user = Accion::find($request->id);
      
           $user->estatus  = $request->estatus;

           $datosUser= User::where('id',$user->idUsuarioFk)->first();
   
            if($request->estatus=='aprobado'){

                if($datosUser->idReferido!=''){

                    $usuerio=User::find($request->idUsuarioFk);
                        $usuerio->premiun=1;
                        $usuerio->save();

                    // $usuarioReferente=User::where('link',$request->link2)->first();
                    // $user->idReferido=$usuarioReferente->id;
    
                    $acciones=Accion::where('idUsuarioFk',$datosUser->idReferido)->where('estatus','aprobado')->get();
                    $accionesConseguidas=array();
    
                    foreach($acciones as $accion){
                     
                        
                        $referidoporAccion1=Referido::where('idAccionReferidoFk',$accion->id)->count();
                       
                        if($referidoporAccion1<4){

                            $premio=Referido::create([
                                'idAccionFk'    => $user->id,
                                'idUserReferidoFk'    => $accion->idUsuarioFk,
                                'idUsuarioDuenoFk'     => $datosUser->id,
                                'idAccionReferidoFk'     => $accion->idAccionFk,
                            
                        
                            ]); 

                        }else{
                            $referidoporAccion=Referido::where('idAccionReferidoFk',$accion->id)->get();
                            array_push($accionesConseguidas,$referidoporAccion);
                        }
                        
                 
                    }
                    // var_dump('entro aqui'.$accionesConseguidas);
                  
                    if($accionesConseguidas>0){
                        
                        $resultadoMultimatrix=self::multimatrix($accionesConseguidas);

                       
                        $premio=Referido::create([
                            'idAccionFk'    => $user->id,
                            'idUserReferidoFk'    => $resultadoMultimatrix[0]->idUsuarioFk,
                            'idUsuarioDuenoFk'     => $datosUser->id,
                            'idAccionReferidoFk'     => $resultadoMultimatrix[0]->idAccionFk,
                        
                    
                        ]); 
                    }
                }else{
                        $usuerio=User::find($request->idUsuarioFk);
                        $usuerio->premiun=1;
                        $usuerio->save();

                        // $randonTodos= Accion::where('idFaseFk',1)->where('idUsuarioFk','!=',$usuerio->id)->where('estatus','aprobado')->get();

                        $randonTodos = DB::table('referido AS rf1')
                                    ->leftjoin('accions as ac1','ac1.id','=','rf1.idAccionFk')
                                    ->select(DB::raw('rf1.*,ac1.*, (SELECT COUNT(*) FROM referido  AS rf2 WHERE rf2.idAccionReferidoFk=rf1.idAccionFk) AS cantidad'))
                                    ->where('ac1.idFaseFk',1)->where('ac1.idUsuarioFk','!=',$usuerio->id)->where('ac1.estatus','aprobado')->orderBy('cantidad','desc')
                                    ->get();
                        $arregloCantidad=array();

                        // var_dump($randonTodos);
                        foreach($randonTodos as $randon){
                            // var_dump($randon->cantidad);
                            if($randon->cantidad<4){
                                array_push($arregloCantidad,$randon);
                            }
                        }

                    $premio=Referido::create([
                        'idAccionFk'    => $user->id,
                        'idUserReferidoFk'    => $arregloCantidad[0]->idUsuarioFk,
                        'idUsuarioDuenoFk'     => $usuerio->id,
                        'idAccionReferidoFk'     => $arregloCantidad[0]->idAccionFk,
                    
                
                    ]); 
                }
               
            }
       
           
         
  
           $user->save();
           DB::commit(); // Guardamos la transaccion

           return response()->json($premio,200);
       }catch (\Exception $e) {
           if($e instanceof ValidationException) {
               return response()->json($e->errors(),402);
           }
           DB::rollback(); // Retrocedemos la transaccion
           Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
           return response()->json([
               'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
           ], 500);
       }
   }

     // Eliminar usuarios
     function delete(Request $request){
        try{

            DB::beginTransaction(); // Iniciar transaccion de la base de datos
            $user = Accion::find($request->id);
            $user->delete();
            DB::commit(); // Guardamos la transaccion
            return response()->json("Pregunta eliminado",200);
        }catch (\Exception $e) {
            if($e instanceof ValidationException) {
                return response()->json($e->errors(),402);
            }
            DB::rollback(); // Retrocedemos la transaccion
            Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
            return response()->json([
                'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
            ], 500);
        }
    }

    function multimatrix($arreglo){
        $arregloMatrix=array();
    
        for ($i=0; $i < count($arreglo) ; $i++) { 
           
            $contar=Referido::where('idAccionReferidoFk',$arreglo[$i]->id)->count();
         
            if($contar<4){
              
                return $arreglo[$i];
            }else{
                
                $referidoporAccion=Referido::where('idAccionReferidoFk',$arreglo[$i]->id)->get();
                array_push($arregloMatrix,$referidoporAccion); 
            }
        }

        return self::multimatrix($arregloMatrix);

    }
}
