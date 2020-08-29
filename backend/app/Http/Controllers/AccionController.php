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


function crearAccionCambiodeFase($activarAcciondeFase){

  
   

//accion que voy activar por que ya la pague
        $user = Accion::find($activarAcciondeFase['id']);
   
        $user->estatus  = $activarAcciondeFase['estatus'];

//obtener datos del usuario dueño de la accion q voy activar
        $datosUser= User::where('id',$user->idUsuarioFk)->first(); 

         if($activarAcciondeFase['estatus']=='aprobado'){

            
             if($datosUser->idReferido!=''){

              

                 $usuerio=User::find($activarAcciondeFase['idUsuarioFk']);
                     $usuerio->premiun=1;
                     $usuerio->save();

                 $acciones=Accion::where('idUsuarioFk',$datosUser->idReferido)->where('estatus','aprobado')->get();
                 $accionesConseguidas=[];
                 foreach($acciones as $accion){
                  
                  
                  //AQUI EMPIEZA LA ASIGNACION SI TENGO REFERIDO Y ESTA LLENO O NO SU ACCION
                    
                     $referidoporAccion1=Referido::where('idAccionReferidoFk',$accion->id)->count();

                     if($referidoporAccion1<4){

                        

                         $premio=Referido::create([
                             'idAccionFk'    => $user->id,
                             'idUserReferidoFk'    => $accion->idUsuarioFk,
                             'idUsuarioDuenoFk'     => $datosUser->id,
                             'idAccionReferidoFk'     => $accion->id,
                         
                     
                         ]); 
                      

                         $contarAccionreferido=Referido::where('idAccionReferidoFk',$accion->id)->count();
              

                         if($contarAccionreferido>=4){

                              
                        
                             $actAccion=Accion::find($accion->id);
                            

                             $llamado=self::cambiodefase($actAccion);
                             
                          
                         }

                         $user->save();
                    
              
                         return $premio;

                     }else{
                        
                         $referidoporAccion=Referido::where('idAccionReferidoFk',$accion->id)->get();
                         if(count($referidoporAccion)>0){
                             foreach($referidoporAccion as $referidoporAccion2){

                                 array_push($accionesConseguidas,$referidoporAccion2);
                             }
                         }
     
                        
                     }
                     
              
                 }//AQUI MUERE EL FOREACH DE ACCIONES
        

        //   echo 'arreglo antes del count ---------------->'.json_encode($accionesConseguidas);
                 
                 if(count($accionesConseguidas)>0){

                    // echo 'arreglo despues del count ---------------->'.json_encode($accionesConseguidas);  

                      $resultadoMultimatrix=self::multimatrix($accionesConseguidas);


                   

                      
                     $premio=Referido::create([
                         'idAccionFk'    => $user->id,
                         'idUserReferidoFk'    => $resultadoMultimatrix->idUsuarioDuenoFk,
                         'idUsuarioDuenoFk'     => $datosUser->id,
                         'idAccionReferidoFk'     => $resultadoMultimatrix->idAccionFk,
                     
                 
                     ]); 
                     $contarAccionreferido=Referido::where('idAccionReferidoFk',$resultadoMultimatrix->idAccionFk)->count();
               
                     if($contarAccionreferido>=4){
                        
                         $actAccion=Accion::find($resultadoMultimatrix->idAccionFk);
                   

                         $consultarReferido=self::cambiodefase($actAccion);
                     }
                     $user->save();
             //CIERRA EL PROCESO DE ASIGNACION A LAS MATRIX
             
          
                     return $premio;
                    
                 }
             }else{
                     $usuerio=User::find($activarAcciondeFase['idUsuarioFk']);
                     $usuerio->premiun=1;
                     $usuerio->save();


                     $randonTodos = DB::table('referido AS rf1')
                                 ->leftjoin('accions as ac1','ac1.id','=','rf1.idAccionFk')
                                 ->select(DB::raw('rf1.*,ac1.*, (SELECT COUNT(*) FROM referido  AS rf2 WHERE rf2.idAccionReferidoFk=rf1.idAccionFk) AS cantidad'))
                                 ->where('ac1.idFaseFk',1)->where('ac1.idUsuarioFk','!=',$usuerio->id)->where('ac1.estatus','aprobado')->orderBy('cantidad','desc')
                                 ->get();
                     $arregloCantidad=array();

                     foreach($randonTodos as $randon){
                       
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

                 $contarAccionreferido=Referido::where('idAccionReferidoFk',$arregloCantidad[0]->idAccionFk)->count();

                 if($contarAccionreferido>=4){
                     $actAccion=Accion::find($arregloCantidad[0]->idAccionFk);
            
                     self::cambiodefase($actAccion);
                 }

                 $user->save();
               
      
                 return $premio;

             }
            
         }

}


      // Modificar usuarios
      function update(Request $request){
        try{
    
   
// return json_decode($request);
            DB::beginTransaction(); 

            $arregloEnviarUpdate=array(
                'id'=>$request->id,
                'idUsuarioFk'=>$request->idUsuarioFk,
                'estatus'=>$request->estatus
            );
                $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

            DB::commit(); 
            
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

   
        // echo "lo que sigue abajo es el arreglo".json_encode($arreglo);
        foreach($arreglo as $arr){

               $contar=Referido::where('idAccionReferidoFk',$arr->idAccionFk)->count();
         
            if($contar<4){
              
                return $arr;
            }else{
                
                $referidoporAccion=Referido::where('idAccionReferidoFk',$arr->idAccionFk)->get();
                foreach($referidoporAccion as $referidoporAccion1){
                    array_push($arregloMatrix,$referidoporAccion1); 
                }
                
            }
            // return self::multimatrix($arregloMatrix); 
        }
        // return false;

        return self::multimatrix($arregloMatrix); 


    }

    function cambiodefase($arreglo){
       
      
        // $consultarReferido=Referido::where('idAccionFk',$arreglo->id)->first();
        //  if(!empty($consultarReferido)){

            $consultarpordebajodeAccionrecibida=Referido::
            leftjoin('accions','accions.id','=','referido.idAccionReferidoFk')
            ->where('idAccionReferidoFk',$arreglo->id)->get();

            if(count($consultarpordebajodeAccionrecibida)>0 && $arreglo->idFaseFk<7){
            
                $cantidadFasesiguales=0;
                foreach($consultarpordebajodeAccionrecibida as $predecesores){

                    if($arreglo->idFaseFk == $predecesores->idFaseFk){
                        $cantidadFasesiguales++;

                        
                    }
        
                }
      
                if($cantidadFasesiguales==4){
                    
                    
                    $actualizarfase=Accion::find($arreglo->id);
                    $actualizarfase->idFaseFk=$actualizarfase->idFaseFk+1;

                    // echo 'la mate en '.$actualizarfase; 
                    $actualizarfase->save();

                    if($actualizarfase->idFaseFk<7){

                        $Accions = Accion::create([
                            'referenciaPago'    => 'creada por cambio de fase '.$actualizarfase->idFaseFk,
                            'idFaseFk'    => 1,
                            'estatus' =>'aprobado',
                            'idUsuarioFk'     => $actualizarfase->idUsuarioFk
                           
                     
                        ]); 
                           
                        $arregloEnviarUpdate=array(
                            'id'=>$Accions->id,
                            'idUsuarioFk'=>$actualizarfase->idUsuarioFk,
                            'estatus'=>'aprobado'
                        );

                        $crearAccion=self::crearAccionCambiodeFase($arregloEnviarUpdate);

                    }

                 $consultarReferido=Referido::where('idAccionFk',$arreglo->id)->first();
                if(!empty($consultarReferido)){

                    $contultarPredecesor=Accion::find($consultarReferido->idAccionReferidoFk);

                    $llamarfuncion=self::cambiodefase($contultarPredecesor);
                 }else{
                     return false;
                 }
                    

                    
                }else{
                
                    return false;
                }

            }
        // }
 
        return true;
    }
}
