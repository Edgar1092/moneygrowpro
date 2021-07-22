<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accion;
use App\Models\Saldo;
use App\Models\Intensityfitness;
use App\Models\Corporacion;
use App\Models\Referido;
use App\Models\Solicitudretiro;
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
            $result = Accion::where('estatus','solicitando')->paginate($per_page);
            }
            $response = $result;  
  
            if($result->isEmpty()){
                return response()->json([
                    'msj' => 'No se encontraron registros.',
                    'data'=>[],
                    'total'=>0
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

    function getHistorico(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : Saldo::count();
                $result = Saldo::where('idUserFk',$request->id)->paginate($per_page);
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : Saldo::count();
            $result = Saldo::paginate($per_page);
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
    function getSolicitudes(Request $request){
        try{
        	$request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : Solicitudretiro::count();
                $result = Solicitudretiro::leftjoin('users','users.id','=','solicitudretiro.idUserFk')->select('users.id as idUsuario','users.*','solicitudretiro.*')->where('estatus','solicitando')->paginate($per_page);
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : Solicitudretiro::count();
            $result = Solicitudretiro::leftjoin('users','users.id','=','solicitudretiro.idUserFk')->select('users.id as idUsuario','users.*','solicitudretiro.*')->where('estatus','solicitando')->paginate($per_page);
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
                'plataforma'    => $request->plataforma,
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

            
             if($datosUser->idReferido!='' || $datosUser->idReferido!=0){

                $cuantasAccionesyPAgo=Accion::where('idUsuarioFk',$datosUser->id)->where('estatus','aprobado')->count();
                // echo 'entre aqui'.$cuantasAccionesyPAgo;
                  
              

                 $usuerio=User::find($activarAcciondeFase['idUsuarioFk']);
                     $usuerio->premiun=1;
                     $usuerio->save();

                 $acciones=Accion::where('estatus','aprobado')->get();
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

                         if($cuantasAccionesyPAgo==0){
                       
                            $patrocinador = Saldo::create([
                                'idUserFk'    => $datosUser->idReferido,
                                'idAccionFk'    => $user->id,
                                'entrada' =>1,
                                'salida'     => 0,
                                'concepto' => 'Bono por referido'
                               
                         
                            ]);
    
                        }
              
                         return $premio;

                     }
                    //  else{
                        
                    //      $referidoporAccion=Referido::where('idAccionReferidoFk',$accion->id)->where('idUsuarioDuenoFk','!=',$user->idUsuarioFk)->get();
                    //      if(count($referidoporAccion)>0){
                    //          foreach($referidoporAccion as $referidoporAccion2){

                    //              array_push($accionesConseguidas,$referidoporAccion2);
                    //          }
                    //      }
     
                        
                    //  }
                     
              
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
            leftjoin('accions','accions.id','=','referido.idAccionFk')
            ->where('referido.idAccionReferidoFk',$arreglo->id)->get();

            if(count($consultarpordebajodeAccionrecibida)>0 && $arreglo->idFaseFk<8){
            
                $cantidadFasesiguales=0;
                foreach($consultarpordebajodeAccionrecibida as $predecesores){

                    if($arreglo->idFaseFk == $predecesores->idFaseFk){
                        $cantidadFasesiguales++;

                        
                    }
        
                }
    //   echo json_encode($consultarpordebajodeAccionrecibida).'  hasta aqui llega <br>';
                if($cantidadFasesiguales==4){
                    
                    
                    $actualizarfase=Accion::find($arreglo->id);
                    $actualizarfase->idFaseFk=$actualizarfase->idFaseFk+1;

                    
                    $actualizarfase->save();

                   

                    if($actualizarfase->idFaseFk<8){

                        $obtenerPAtrocinado=User::where('id',$actualizarfase->idUsuarioFk)->first();
                       
                        if(($actualizarfase->idFaseFk)==2){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono Arranque'
                               
                         
                            ]); 

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>6,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==3){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>4,
                                'salida'     => 0,
                                'concepto' => 'Bono impulsor'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>1,
                                'salida'     => 0,
                                'concepto' => 'Bono impulsor de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>16,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>1,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==4){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>10,
                                'salida'     => 0,
                                'concepto' => 'Bono constructor'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono consntructor de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>48,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==5){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>42,
                                'salida'     => 0,
                                'concepto' => 'Bono productor'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono productor de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>144,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==6){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>84,
                                'salida'     => 0,
                                'concepto' => 'Bono emprendedor'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono emprendedor de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>486,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==7){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>438,
                                'salida'     => 0,
                                'concepto' => 'Bono capitalizacion'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono capitalizacion de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>1500,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                               
                            ]); 
                        }

                        if(($actualizarfase->idFaseFk)==8){
                            
                            $saldo = Saldo::create([
                                'idUserFk'    => $actualizarfase->idUsuarioFk,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>5800,
                                'salida'     => 0,
                                'concepto' => 'Bono fundador'
                               
                         
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>100,
                                'salida'     => 0,
                                'concepto' => 'Bono fundador de referido'
                               
                         
                            ]); 

                            $intensity = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 0,
                               
                            ]); 

                            $corporacion = Corporacion::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>92,
                                'salida'     => 0,
                               
                            ]); 
                        }
                        if($actualizarfase->idFaseFk !=2){
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


    function obtenerSaldo(Request $request){
        $ingreso=DB::table("saldo")->where('idUserFk',$request->id)->get()->sum("entrada");
        $salida=DB::table("saldo")->where('idUserFk',$request->id)->get()->sum("salida");

        $total=$ingreso-$salida;

        return response()->json($total,201);
    }

    function obtenerSaldoCorporacion(Request $request){
        $ingreso=DB::table("corporacion")->get()->sum("entrada");

        $total=$ingreso;

        return response()->json($total,201);
    }

    function obtenerSaldoIntensity(Request $request){
        $ingreso=DB::table("intensityfitness")->get()->sum("entrada");

        $total=$ingreso;

        return response()->json($total,201);
    }

    function obtenerAcciones(Request $request){
        $cantidad=Accion::where('idUsuarioFk',$request->id)->where('estatus','aprobado')->count();
        $acciones=Accion::where('idUsuarioFk',$request->id)->where('estatus','aprobado')->get();

        

        return response()->json([
            'cantidad' => $cantidad,
            'acciones' => $acciones,
        ], 200); 
    }
    function obtenerNumeroUsuario(Request $request){
        $cantidad=User::count();
        

        

        return response()->json($cantidad); 
    }
    function solicitudRetiro(Request $request){

       
        $retiro = Solicitudretiro::create([
            'idUserFk'    => $request->idUsuarioFk,
            'montoSolicitado'    => $request->montoSolicitar,
            'plataforma' =>$request->plataforma
           
     
        ]); 
       
        
            $mesanje='Solicitud enviada';
        

        return response()->json([
            'msj' => $mesanje,
            
        ], 200); 
    }

    function aprobarRechazarRetiro(Request $request){

        if($request->estatus=='aprobado'){

            $retiro = Saldo::create([
                'idUserFk'    => $request->idUserFk,
               
                'entrada' =>0,
                'salida'     => $request->montoSolicitado,
                'concepto' => 'Solicitud de retiro'
               
         
            ]); 

            $actualizar=Solicitudretiro::find($request->id);
            $actualizar->estatus='aprobado';
            $actualizar->save();
            $mesanje='Procesado correctamente';
        

            return response()->json([
                'msj' => $mesanje,
                
            ], 200); 
        }else{
            $mesanje='Rechazado';
        

            return response()->json([
                'msj' => $mesanje,
                
            ], 400); 
        }

   
    }

    function rechazarAccion(Request $request){
            
        try{


        // return json_decode($request);
            DB::beginTransaction(); 
            
            $rechazar=Accion::find($request->id);
            $rechazar->estatus='rechazado';
            $rechazar->save();

            // $arregloEnviarUpdate=array(
            //     'id'=>$request->id,
            //     'idUsuarioFk'=>$request->idUsuarioFk,
            //     'estatus'=>$request->estatus
            // );
            //     $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

            DB::commit(); 
            
            return response()->json($rechazar,200);



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
}
