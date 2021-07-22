import { Component, OnInit } from '@angular/core';
import { Observable, from } from 'rxjs';
import { AccionService } from 'app/shared/services/accion.service';
import swal from 'sweetalert2';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { UsersService } from 'app/shared/services/users.service';

@Component({
  selector: 'app-ciclos',
  templateUrl: './ciclos.component.html',
  styleUrls: ['./ciclos.component.scss']
})
export class CiclosComponent implements OnInit {

  ciclos;
  total = 0;
  dataUsuario
  ciclototal
  p=1;
  usuarios
  itemsPerPage = 40;
  formBlog: FormGroup;
  referes
  referes2
  contadorAccion
  constructor(private AccionService: AccionService, private toast: ToastrService, 
    private fb: FormBuilder,
    private activatedRoute: ActivatedRoute,
    private userService: UsersService,
    private router: Router,) {
   

    this.formBlog = this.fb.group({
      id: [''],
      idUsuarioFk: [''],
      estatus: [''],

    });
  }

  ngOnInit() {
    let param;

    if(this.p)
      { 
        param={page:this.p,per_page:this.itemsPerPage};
      }else{
        param={page:1,per_page:this.itemsPerPage};
      }
      this.loadInitialData(param);
      this.cargarUser()

     
  }

  cargarUser(){
    this.userService.getUser().subscribe(response => {
      console.log('esta es lka data',response)
     this.ciclos=JSON.parse(JSON.stringify(response)).data
    });
  }

  obtenerMesas(){

    console.log('entre a esta mierda',this.usuarios);
    this.AccionService.obtenermesa(this.usuarios).subscribe(response => {
      console.log('este es el resultado',response)
      this.contadorAccion=response;

      if(this.contadorAccion){
        this.contadorAccion.forEach((element,index) => {

          this.consultarReferidos(element.id,index)
          
        });
      }
       
    });

  }

  consultarReferidos(param,index){
    
    console.log('entre a esta mierda232',param);

    this.AccionService.consultarReferidos(param).subscribe(response => {
      console.log('esta es la respuesta',response)
      this.referes=response;
       this.contadorAccion[index]['referidos']=this.referes

       this.referes.forEach((element,index2) => {

         this.AccionService.consultarReferidos(element.idAccionFk).subscribe(response2 => {
           this.referes2=response2
          this.contadorAccion[index]['referidos'][index2]['referidos']=this.referes2

          console.log('holaaaa',this.referes2)

          this.referes2.forEach((element,index3) => {

            this.AccionService.consultarReferidos(element.idAccionFk).subscribe(response3 => {
             this.contadorAccion[index]['referidos'][index2]['referidos'][index3]['referidos']=response3
            })
          });

         })

    
       });



      console.log('nuevo arreglo',this.contadorAccion)
    });
  }

  

  delete(user: any) {
    const confirm = swal.fire({
      title: `Borrar al usuario ${user.first_name} ${user.last_name}`,
      text: 'Esta acción no se puede deshacer',
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Borrar',
      focusCancel: true
    });

    from(confirm).subscribe(r => {
      if (r['value']) {
        this.AccionService.delete(user.id).subscribe(response => {
          if (response) {
            this.toast.success(response['message']);
            this.AccionService.get();
          } else {
            this.toast.error(JSON.stringify(response));
          }
        });
      }
    });
  }

  // joinData(data: string[]): string {
  //   return data.map(o => o['name']).join(', ');
  // }

  loadInitialData(params){
    this.AccionService.getCiclo(params);

    this.AccionService.totalciclo().subscribe(response => {
      this.ciclototal=response

      // this.ciclototal.forEach((element,index) => {
      //   let a=index+1
      //   if(a==40){
      //     this.ciclototal[index]['espacio']=true;
      //   }else{
      //     this.ciclototal[index]['espacio']=false;
      //   }
      // });
      console.log('este response',response)
    });




    
  }



  // onFilter(filterParams) {
  //   this.AccionService.get(filterParams);
  // }

  perPage(itemsPerPage,page){
    this.p = page;
    this.itemsPerPage = itemsPerPage;
    let param={page:this.p,per_page:this.itemsPerPage};
    this.loadInitialData(param);

  }



}
