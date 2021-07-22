<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Accion;
use App\Models\accionesMGP;
use App\Models\accionesMGP2021;
use App\Models\Saldo;
use App\Models\Intensityfitness;
use App\Models\Corporacion;
use App\Models\Referido;
use App\Models\referidomgp;
use App\Models\referidomgp2021;
use App\Models\corporacionmgp;
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
                $result = Accion::leftjoin('users','users.id','=','accions.idUsuarioFk')
                ->select('users.id as idUser','users.*','accions.*')
                ->where('idUsuarioFk',$request->id)->paginate($per_page);
                $response =$result;
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : Accion::count();
            $result = Accion::leftjoin('users','users.id','=','accions.idUsuarioFk');
            $result->select('users.id as idUser','users.*','accions.*');

            if($request->search!=''){
                $result->where('users.email',$request->search);
            }
            $result->where('estatus','solicitando');
            $resultado=$result->paginate($per_page);
                $response = $resultado;  

            }
           
  
            if($response->isEmpty()){
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


    function getMGP(Request $request){
        try{
            $request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
                $result = accionesMGP2021::leftjoin('users','users.id','=','accionsmgp2021.idUsuarioFk')
                ->select('users.id as idUser','users.*','accionsmgp2021.*')
                ->where('idUsuarioFk',$request->id)->paginate($per_page);
            }else{
            $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
            $result = accionesMGP2021::leftjoin('users','users.id','=','accionsmgp2021.idUsuarioFk');
            $result->select('users.id as idUser','users.*','accionsmgp2021.*');

            if($request->search!=''){
                $result->where('users.email',$request->search);
            }
            $result->where('status',0);
            $resultado=$result->paginate($per_page);


            }
            $response = $resultado;  
  
            if($resultado->isEmpty()){
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

    function getAllReferidos(Request $request){
        try{
            $request->validate([
                'per_page'      =>  'nullable|integer',
                'page'          =>  'nullable|integer'
            ]);  
            if($request->id){
                $per_page = (!empty($request->per_page)) ? $request->per_page : User::count();
                $result = User::where('idReferido',$request->id)
                ->paginate($per_page);
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



           if($request->estatus=='rechazado' && $request->montoSolicitado!=''){
              
    
                // $saldo = Intensityfitness::create([
                    
                //     'entrada' =>0,
                //     'salida'     => $request->montoSolicitado,
                   
                // ]); 
    
                $actualizar=Solicitudretiro::find($request->id);
                $actualizar->estatus='rechazado';
                $actualizar->save();
                $mesanje='Procesado correctamente';
            
    
      $premio=$actualizar;

            }else{

            $arregloEnviarUpdate=array(
                'id'=>$request->id,
                'idUsuarioFk'=>$request->idUsuarioFk,
                'estatus'=>$request->estatus
            );
                $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

            }

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

   function updateMGP(Request $request){
    try{


// return json_decode($request);
        DB::beginTransaction(); 

        $arregloEnviarUpdate=array(
            'id'=>$request->id,
            'idUsuarioFk'=>$request->idUsuarioFk,
            'estatus'=>$request->estatus
        );
            // $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

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
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 4,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>1,
                                'salida'     => 0,
                                'concepto' => 'Bono impulsor de referido'
                               
                         
                            ]); 

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 1,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 1,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 10,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono consntructor de referido'
                               
                         
                            ]); 

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 42,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono productor de referido'
                               
                         
                            ]); 

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 84,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono emprendedor de referido'
                               
                         
                            ]);
                            
                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 438,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>2,
                                'salida'     => 0,
                                'concepto' => 'Bono capitalizacion de referido'
                               
                         
                            ]); 

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 2,
                               
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
                            
                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 5800,
                               
                            ]); 

                            $patrocinador = Saldo::create([
                                'idUserFk'    => $obtenerPAtrocinado->idReferido,
                                'idAccionFk'    => $actualizarfase->id,
                                'entrada' =>100,
                                'salida'     => 0,
                                'concepto' => 'Bono fundador de referido'
                               
                         
                            ]);
                            
                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 100,
                               
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

                            $saldo = Intensityfitness::create([
                                'idAccionEnvioFk'    => $actualizarfase->id,
                                'entrada' =>0,
                                'salida'     => 92,
                               
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
        $salida=DB::table("intensityfitness")->get()->sum("salida");

        $total=$ingreso-$salida;

        return response()->json($total,201);
    }

    function obtenerAcciones(Request $request){
        $cantidad=Accion::where('idUsuarioFk',$request->id)->where('estatus','aprobado')->count();
        $acciones=Accion::where('idUsuarioFk',$request->id)->where('estatus','aprobado')->get();
        $accionesMGP=accionesMGP::where('idUsuarioFk',$request->id)->where('estatus','!=','pagado')->where('estatus','!=','rechazado')->count();
        
        
        return response()->json([
            'cantidad' => $cantidad,
            'acciones' => $acciones,
            'accionesMGP' => $accionesMGP,
        ], 200); 
    }
    function obtenerNumeroUsuario(Request $request){
        $cantidad=User::count();
        

        

        return response()->json($cantidad); 
    }
    function solicitudRetiro(Request $request){

        $ingreso=DB::table("saldo")->where('idUserFk',$request->idUsuarioFk)->get()->sum("entrada");
        $salida=DB::table("saldo")->where('idUserFk',$request->idUsuarioFk)->get()->sum("salida");

        $total=$ingreso-$salida;
if(!Solicitudretiro::where('idUserFk',$request->idUsuarioFk)->where('estatus','solicitando')->exists()){
        if($total>=10){
            $retiro = Solicitudretiro::create([
                'idUserFk'    => $request->idUsuarioFk,
                'montoSolicitado'    => $request->montoSolicitar,
                'plataforma' =>$request->plataforma,
                'cuenta' =>$request->cuenta
            
        
            ]);
            $mesanje='Solicitud enviada';
        

            return response()->json([
                'msj' => $mesanje,
                'respuesta'=>0
                
            ], 200); 
        }else{

            $mesanje='No posee saldo suficiente';
        

            return response()->json([
                'msj' => $mesanje,
                'respuesta'=>1
                
            ], 200); 

        } 
       
}else{
    $mesanje='Posee una solicitud en proceso';
    return response()->json([
        'msj' => $mesanje,
        'respuesta'=>1
        
    ], 200);   
}  
  
    }

    function aprobarRechazarRetiro(Request $request){

        if($request->estatus=='aprobado'){

            $retiro = Saldo::create([
                'idUserFk'    => $request->idUserFk,
               
                'entrada' =>0,
                'salida'     => $request->montoSolicitado,
                'concepto' => 'Solicitud de retiro'
               
         
            ]); 

            // $saldo = Intensityfitness::create([
                
            //     'entrada' =>0,
            //     'salida'     => $request->montoSolicitado,
               
            // ]); 

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

        function rechazarAccionMGP(Request $request){
            
            try{
    
    
            // return json_decode($request);
                DB::beginTransaction(); 
                
                $rechazar=accionesMGP::find($request->id);
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
    

        // function acionesMGP(Request $request){
            
        //     try{
    
    
        //     // return json_decode($request);
        //         DB::beginTransaction(); 
                
        //         $rechazar=accionesMGP::where('idUsario',0)->get();
             
    
        //         DB::commit(); 
                
        //         return response()->json($rechazar,200);
    
    
    
        //     }catch (\Exception $e) {
        //         if($e instanceof ValidationException) {
        //             return response()->json($e->errors(),402);
        //         }
        //         DB::rollback(); // Retrocedemos la transaccion
        //         Log::error('Ha ocurrido un error en '.$this->NAME_CONTROLLER.': '.$e->getMessage().', Linea: '.$e->getLine());
        //         return response()->json([
        //             'message' => 'Ha ocurrido un error al tratar de guardar los datos.',
        //         ], 500);
        //     }
                
        //     }



            function acionesMGP(Request $request){
                try{
                    $request->validate([
                        'per_page'      =>  'nullable|integer',
                        'page'          =>  'nullable|integer'
                    ]);  
                    if($request->id){
                        $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
                        $result = accionesMGP::where('idUsuarioFk',0)->paginate($per_page);
                    }else{
                    $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
                    $result = accionesMGP::where('idUsuarioFk',0);
        
                    // if($request->search!=''){
                    //     $result->where('users.email',$request->search);
                    // }
                    // $result->where('estatus','solicitando');
                    $resultado=$result->paginate($per_page);
        
        
                    }
                    $response = $resultado;  
          
                    if($resultado->isEmpty()){
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

            function actualizarMGP(Request $request){
                try{
            
           
        // return json_decode($request);
                    DB::beginTransaction(); 

                    $rechazar=accionesMGP::find($request->id);
                    $rechazar->idUsuarioFk=$request->usuario;
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

           function createMGP(Request $request){
            try{
    
                DB::beginTransaction(); // Iniciar transaccion de la base de datos
    
              
                $user = accionesMGP::create([
                    'referenciaPago'    => $request->referenciaPago,
                    'plataforma'    => $request->plataforma,
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

        function matrixMPG(Request $request){

            try{

                            DB::beginTransaction(); 
                
                            // $arregloEnviarUpdate=array(
                            //     'id'=>$request->id,
                            //     'idUsuarioFk'=>$request->idUsuarioFk,
                            //     'estatus'=>$request->estatus
                            // );
                            //     $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

                    $activarAccion1=accionesMGP2021::find($request->id);
                    $activarAccion1->status=1;
                    $activarAccion1->save();

                    $activarAccion=referidomgp2021::where('idAccionFk',$request->id)->first();
                    $activarAccion->status=1;
                    $activarAccion->save();


                    $buscarfasedelquemerefirio=accionesMGP2021::where('id',$activarAccion->idAccionPerteneceFk)->first();


                   

                    $buscarmisperteneciente=referidomgp2021::where('idAccionPerteneceFk',$buscarfasedelquemerefirio->id)->get();

                if($buscarfasedelquemerefirio->idFaseFk==4){
                    $contadorActivos=0;
                    foreach ($buscarmisperteneciente as $key => $susReferidos) {
                        if($susReferidos->status==1){
                            $contadorActivos=$contadorActivos+1;
                        }
                    }
                if($contadorActivos==2){

                    $activarAccion2=accionesMGP2021::find($buscarfasedelquemerefirio->id);
                    $activarAccion2->idFaseFk=3;
                    $activarAccion2->save();


                    $sabersitengoalguienencima=referidomgp2021::
                    join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
                    ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
                    ->where('idAccionFk',$activarAccion2->id)
                    ->first();

                   $esteeselpadre=accionesMGP2021::find($sabersitengoalguienencima->idAccionPerteneceFk);

                  

                    if($sabersitengoalguienencima->idAccionPerteneceFk!=0){

                        

                        $buscaquefaseestaelqueestaporencima= referidomgp2021::
                        join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
                        ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
                        ->where('idAccionPerteneceFk',$esteeselpadre->id)
                        ->get();

                        
                        $contarfase=0;
                        foreach ($buscaquefaseestaelqueestaporencima as $key => $compararfases) {

                            

                            if($compararfases->idFaseFk==$esteeselpadre->idFaseFk){
                                $contarfase=$contarfase+1;
                            }
                            
                        }

                      

                        if($contarfase==2){
                            $activarAccion3=accionesMGP2021::find($esteeselpadre->id);
                            $activarAccion3->idFaseFk=2;
                            $activarAccion3->save();  

                            self::consultarsubir($activarAccion3->id);
                        }

                    }


                    

                }




}
            


                   

                    




        


                
                            DB::commit(); 
                            
                            return response()->json($activarAccion,200);
                
                  
                
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

        function consultarsubir($idsubio){

            $buscarmipadre=referidomgp2021::where('idAccionFk',$idsubio)->first();
        
            if($buscarmipadre->idAccionPerteneceFk!=0){
                $esteeselpadre=accionesMGP2021::find($buscarmipadre->idAccionPerteneceFk);
        
                if($esteeselpadre->idFaseFk!=1){
                    $buscaquefaseestaelqueestaporencima= referidomgp2021::
                                join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
                                ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
                                ->where('idAccionPerteneceFk',$esteeselpadre->id)
                                ->get();
        
                                $contarfase=0;
                                foreach ($buscaquefaseestaelqueestaporencima as $key => $compararfases) {
        
                                    
        
                                    if($compararfases->idFaseFk==$esteeselpadre->idFaseFk){
                                        $contarfase=$contarfase+1;
                                    }
        
                                }
        
                                if($contarfase==2){
                                    $activarAccion3=accionesMGP2021::find($esteeselpadre->id);
                                    $activarAccion3->idFaseFk=1;
                                    $activarAccion3->save(); 
                                    
                                    $corporacion = corporacionmgp::create([
                                        'idAccionEnvioFk'    => $activarAccion3->id,
                                        'entrada' =>5,
                                        'salida'     => 0,
                                       
                                    ]);

                               
                    
                                    $usuario = Saldo::create([
                                        'idUserFk'    => $activarAccion3->idUsuarioFk,
                                        'idAccionFk'    => $activarAccion3->id,
                                        'entrada' =>65,
                                        'salida'     => 0,
                                        'concepto' => 'finalizacion de mesa de trabajo'
                                       
                                 
                                    ]);

                                    $usuario = Saldo::create([
                                        'idUserFk'    => $activarAccion3->idUsuarioFk,
                                        'idAccionFk'    => $activarAccion3->id,
                                        'entrada' =>0,
                                        'salida'     => 10,
                                        'concepto' => 'nuevo cupo a otra mesa de trabajo'
                                       
                                 
                                    ]);

                                   
                        self::buscarfase4($activarAccion3->id,$activarAccion3->idUsuarioFk);



        
                                   
                                }


                      
                }
        
            
        
         }             
         }

         function buscarfase4($idpadre,$idusuario){
            $primerreferidodelqueacabadesubir=referidomgp2021::
            join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
            ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
            ->where('idAccionPerteneceFk',$idpadre)
            ->first();

            if($primerreferidodelqueacabadesubir->idFaseFk==4){

                
                $userAccion = accionesMGP2021::create([
                    'referenciaPago'    => 'activacion  automatica finalizacion de mesa',
                    'plataforma'    => 'activacion  automatica finalizacion de mesa',
                    'idUsuarioFk'     => $idusuario
                   
             
                ]);

                $user22 = referidomgp2021::create([
                    'idAccionFk'    => $userAccion->id,
                    'idUsarioFk'    => $idusuario,
                    'idUsuarioPerteneceFk'     => $primerreferidodelqueacabadesubir->idUsuarioFk,
                    'idAccionPerteneceFk' => $primerreferidodelqueacabadesubir->idAccions
                   
             
                ]);

               
                self::matrixMPGAUTOMATICA($userAccion->id);

            }else{
                self::buscarfase4($primerreferidodelqueacabadesubir->idAccions,$idusuario);
            }

        }
        function cobradores(Request $request){
            $listos=accionesMGP::where('estatus','ListoCobrar')->count();
            $activosTotal=accionesMGP::where('estatus','ListoCobrar')->orWhere('estatus','aprobado')->get();
            $contadorFinal=40;
            foreach($activosTotal as $pagadorestotale){
                $totales=referidomgp::where('idAccionPerteneceFk',$pagadorestotale->id)->count();
                $contadorFinal=$contadorFinal+$totales;
            }
       

            // return response()->json($listos,200);

            return response()->json([
                'listos' => $listos,
                'activosTotal' => $contadorFinal,
            ], 200);

        }

        function liberarCiclo(Request $request){
            $usuariospagar= accionesMGP::leftjoin('users','users.id','=','accionsmgp.idUsuarioFk')
            ->leftjoin('referidomgp','referidomgp.idAccionFk','=','accionsmgp.id')
            ->select('users.id as idUser','users.*','accionsmgp.id as idAccions','accionsmgp.*')
           ->where('estatus','ListoCobrar')
            ->orderBy('referidomgp.id','asc')
            ->get();
            foreach($usuariospagar as $pagados){

                $corporacion = corporacionmgp::create([
                    'idAccionEnvioFk'    => $pagados->idAccions,
                    'entrada' =>3,
                    'salida'     => 0,
                   
                ]);

                $usuario = Saldo::create([
                    'idUserFk'    => $pagados->idUser,
                    'idAccionFk'    => $pagados->idAccions,
                    'entrada' =>37,
                    'salida'     => 0,
                    'concepto' => 'Matrix mgp'
                   
             
                ]);

                $actualizarAccionmuerta=accionesMGP::find($pagados->id);
                $actualizarAccionmuerta->estatus='pagado';
                $actualizarAccionmuerta->save();

                //  var_dump($pagados);

            }
        }


        function obtenerSaldoMGP(Request $request){
            $ingreso=DB::table("corporacionmgp")->get()->sum("entrada");
            $salida=DB::table("corporacionmgp")->get()->sum("salida");
    
            $total=$ingreso-$salida;
    
            return response()->json($total,201);
        }

        function createManualmgp(Request $request){

            try{

                DB::beginTransaction(); 


                $user = accionesMGP::create([
                    'referenciaPago'    => 'Verificado por flavio',
                    'plataforma'    => 'verificado por flavio',
                     'estatus'=>'aprobado',
                    'idUsuarioFk'     => $request->idUsuarioFk
                   
             
                ]);
    


        $accionVacia=accionesMGP::leftjoin('users','users.id','=','accionsmgp.idUsuarioFk')
        ->leftjoin('referidomgp','referidomgp.idAccionFk','=','accionsmgp.id')
        ->select('users.id as idUser','users.*','accionsmgp.id as idAccions','accionsmgp.*')
        ->where('accionsmgp.id','!=',$user->id)
        ->where('contadorReferido','<',4)
        ->where('estatus','aprobado')
        ->orderBy('referidomgp.id','asc')
        ->first();
        
        $crearReferido=referidomgp::create([
            'idAccionFk'    => $user->id,
            'idUsarioFk'     => $request->idUsuarioFk,
            'idUsuarioPerteneceFk'    => $accionVacia->idUsuarioFk,
            'idAccionPerteneceFk'     => $accionVacia->idAccions
           
        ]);
        
        $contadorReferido=$accionVacia->contadorReferido+1;
        $accionVacia->contadorReferido=$contadorReferido;
       
            if($contadorReferido==4){
                $accionVacia->estatus='ListoCobrar';   
            }

            $accionVacia->save();


    
                DB::commit(); 
                
                return response()->json($accionVacia,200);
    
      
    
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



        function getCiclo(Request $request){
            try{
                // $request->validate([
                //     'per_page'      =>  'nullable|integer',
                //     'page'          =>  'nullable|integer'
                // ]);  referidomgp
                // if($request->id){
                //     $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
                //     $result = accionesMGP::leftjoin('users','users.id','=','accionsmgp.idUsuarioFk')
                //     ->select('users.id as idUser','users.*','accionsmgp.*')
                //     ->where('idUsuarioFk',$request->id)->paginate($per_page);
                // }else{
                 $per_page = (!empty($request->per_page)) ? $request->per_page : accionesMGP::count();
                $result = accionesMGP::leftjoin('users','users.id','=','accionsmgp.idUsuarioFk');
                $result->leftjoin('referidomgp','referidomgp.idAccionFk','=','accionsmgp.id');
                $result->select('users.id as idUser','users.*','accionsmgp.*');
    
                // if($request->search!=''){
                //     $result->where('users.email',$request->search);
                // }
                $result->where('estatus','aprobado');
                $result->orWhere('estatus','ListoCobrar');
                $result->orWhere('estatus','pagado');
                $result->orderBy('referidomgp.id','asc');
                $resultado=$result->paginate($per_page);
    
    
                // }
                $response = $resultado;  
      
                if($resultado->isEmpty()){
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

        function compraconSaldo(Request $request){
            $ingreso=DB::table("saldo")->where('idUserFk',$request->idUsuarioFk)->get()->sum("entrada");
            $salida=DB::table("saldo")->where('idUserFk',$request->idUsuarioFk)->get()->sum("salida");
    
            $total=$ingreso-$salida;

            if(Solicitudretiro::where('idUserFk',$request->idUsuarioFk)->where('estatus','solicitando')->exists()){
                return response()->json([
                    'msj' => 'Posee una solicitud de retiro pendiente',
                    'retorno'=>0,
                   
                ], 200); 
            }



            if($total>=10){

                $usuario = Saldo::create([
                    'idUserFk'    => $request->idUsuarioFk,
                    'entrada' =>0,
                    'salida'     => 10,
                    'concepto' => 'Compra con saldo de billetera'
                   
             
                ]);

                $user = accionesMGP::create([
                    'referenciaPago'    => 'Compra de saldo con billetera',
                    'plataforma'    => 'Compra de saldo con billetera',
                     'estatus'=>'aprobado',
                    'idUsuarioFk'     => $request->idUsuarioFk
                   
             
                ]);
                


                    $accionVacia=accionesMGP::leftjoin('users','users.id','=','accionsmgp.idUsuarioFk')
                    ->leftjoin('referidomgp','referidomgp.idAccionFk','=','accionsmgp.id')
                    ->select('users.id as idUser','users.*','accionsmgp.id as idAccions','accionsmgp.*')
                    ->where('accionsmgp.id','!=',$user->id)
                    ->where('contadorReferido','<',4)
                    ->where('estatus','aprobado')
                    ->orderBy('referidomgp.id','asc')
                    ->first();
                    
                    $crearReferido=referidomgp::create([
                        'idAccionFk'    => $user->id,
                        'idUsarioFk'     => $request->idUsuarioFk,
                        'idUsuarioPerteneceFk'    => $accionVacia->idUsuarioFk,
                        'idAccionPerteneceFk'     => $accionVacia->idAccions
                    
                    ]);
                    
                    $contadorReferido=$accionVacia->contadorReferido+1;
                    $accionVacia->contadorReferido=$contadorReferido;
                
                        if($contadorReferido==4){
                            $accionVacia->estatus='ListoCobrar';   
                        }

                        $accionVacia->save();

                        return response()->json([
                            'msj' => 'Accion Adquirida',
                            'retorno'=>1,
                           
                        ], 200); 

            }else{

                return response()->json([
                    'msj' => 'No posees saldo suficiente  para esta operacion',
                    'retorno'=>0,
                   
                ], 200); 

            }
    
           
        }


        function create2021(Request $request){
            try{
    
                DB::beginTransaction(); // Iniciar transaccion de la base de datos
    
              
           

              $busqueda= accionesMGP2021::
             
              where('idUsuarioFk',$request->usuarioDueno)
              ->where('status',1)
              ->where('idFaseFk','=',4)
              ->first();

              $contadorAsignados=referidomgp2021::where('idAccionPerteneceFk',$busqueda->id)->count();

            

              if($contadorAsignados<2){

                $user = accionesMGP2021::create([
                    'referenciaPago'    => $request->referenciaPago,
                    'plataforma'    => $request->plataforma,
                    'idUsuarioFk'     => $request->usuario
                   
             
                ]);

                $user22 = referidomgp2021::create([
                    'idAccionFk'    => $user->id,
                    'idUsarioFk'    => $request->usuario,
                    'idUsuarioPerteneceFk'     => $request->usuarioDueno,
                    'idAccionPerteneceFk' => $busqueda->id
                   
             
                ]);

                

              }else{
                $user22='ya posee 2 cupos reservados'; 
              }

            

         
                DB::commit(); // Guardamos la transaccion
                return response()->json($user22,201);
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



        function matrixMPGAUTOMATICA($idaccion){

            try{

                            DB::beginTransaction(); 
                
                            // $arregloEnviarUpdate=array(
                            //     'id'=>$request->id,
                            //     'idUsuarioFk'=>$request->idUsuarioFk,
                            //     'estatus'=>$request->estatus
                            // );
                            //     $premio=self::crearAccionCambiodeFase($arregloEnviarUpdate);

                    $activarAccion1=accionesMGP2021::find($idaccion);
                    $activarAccion1->status=1;
                    $activarAccion1->save();

                    $activarAccion=referidomgp2021::where('idAccionFk',$idaccion)->first();
                    $activarAccion->status=1;
                    $activarAccion->save();


                    $buscarfasedelquemerefirio=accionesMGP2021::where('id',$activarAccion->idAccionPerteneceFk)->first();

                    $buscarmisperteneciente=referidomgp2021::where('idAccionPerteneceFk',$buscarfasedelquemerefirio->id)->get();

                if($buscarfasedelquemerefirio->idFaseFk==4){
                    $contadorActivos=0;
                    foreach ($buscarmisperteneciente as $key => $susReferidos) {
                        if($susReferidos->status==1){
                            $contadorActivos=$contadorActivos+1;
                        }
                    }
                if($contadorActivos==2){

                    $activarAccion2=accionesMGP2021::find($buscarfasedelquemerefirio->id);
                    $activarAccion2->idFaseFk=3;
                    $activarAccion2->save();


                    $sabersitengoalguienencima=referidomgp2021::
                    join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
                    ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
                    ->where('idAccionFk',$activarAccion2->id)
                    ->first();

                   $esteeselpadre=accionesMGP2021::find($sabersitengoalguienencima->idAccionPerteneceFk);

                  

                    if($sabersitengoalguienencima->idAccionPerteneceFk!=0){

                        

                        $buscaquefaseestaelqueestaporencima= referidomgp2021::
                        join('accionsmgp2021','accionsmgp2021.id','=','referidomgp2021.idAccionFk')
                        ->select('referidomgp2021.id as idReferidomgp','referidomgp2021.*','accionsmgp2021.id as idAccions','accionsmgp2021.*')
                        ->where('idAccionPerteneceFk',$esteeselpadre->id)
                        ->get();

                        
                        $contarfase=0;
                        foreach ($buscaquefaseestaelqueestaporencima as $key => $compararfases) {

                            

                            if($compararfases->idFaseFk==$esteeselpadre->idFaseFk){
                                $contarfase=$contarfase+1;
                            }
                            
                        }

                      

                        if($contarfase==2){
                            $activarAccion3=accionesMGP2021::find($esteeselpadre->id);
                            $activarAccion3->idFaseFk=2;
                            $activarAccion3->save();  

                            self::consultarsubir($activarAccion3->id);
                        }

                    }


                    

                }




}
            


                   

                    




        


                
                            DB::commit(); 
                            
                            return response()->json($activarAccion,200);
                
                  
                
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