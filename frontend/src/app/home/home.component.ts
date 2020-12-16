import { Component, OnInit } from '@angular/core';
import { UsersService } from 'app/shared/services/users.service';
import { Observable, from } from 'rxjs';
import { registerLocaleData } from '@angular/common';
import localeEs from '@angular/common/locales/es';
import { ToastrService } from 'ngx-toastr';
import swal from 'sweetalert2';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
users$: Observable<any[]>;
codigoReferido;
contadorReferidos=0;
Patrocinador;
posicion;
listosTotal
saldo
mgp
intensity=0
corporacion=0
administrador
accionesConteo=0
accionesConteoMGP=0
usuarios=0
listosCobrar=0
nombreApellido;
  constructor(private userService: UsersService,private toast: ToastrService) { }

  ngOnInit() {
    registerLocaleData(localeEs, 'es');
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.nombreApellido=usuario.first_name+' '+usuario.last_name;
    this.codigoReferido=usuario.link;
    this.posicion=usuario.posicion;

    // console.log('administrador',JSON.parse(localStorage.getItem('user')).roles[0].id)
    if(JSON.parse(localStorage.getItem('user')).roles[0].id==1){
      this.obtenerNumeroUsuario(usuario.id);
      this.obtenerSaldoCorporacion(usuario.id)
      this.obtenerSaldoIntensity(usuario.id)
      this.obtenercobradores();
      this.obtenerSaldocorporacionMGP();
      this.administrador=1;
    }else{
      this.obtenerReferidos(usuario.id)
      this.obtenerPatrocinador(usuario.idReferido)
      this.obtenerSaldo(usuario.id)
      this.obtenerAcciones(usuario.id)
  
      this.administrador=0;
    }
  }

  obtenerReferidos(idLogeado){
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);


    this.userService.countReferidos(idLogeado).subscribe((res)=>{
      console.log(res);
       this.contadorReferidos = JSON.parse(JSON.stringify(res)).conteoReferidos;

    },(error)=>{
      console.log(error);
    })
  
  }
  obtenerPatrocinador(idLogeado){

  
    this.userService.obtenerPatrocinador(idLogeado).subscribe((res)=>{
      console.log(res);
       this.Patrocinador = JSON.parse(JSON.stringify(res)).patrocinador;

    },(error)=>{
      console.log(error);
    })
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);
  
  }
  obtenerNumeroUsuario(idLogeado){

  
    this.userService.obtenerNumeroUsuario(idLogeado).subscribe((res)=>{
      console.log(res);
      this.contadorReferidos = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
    
    // this.contadorReferidos=this.userService.countReferidos(idLogeado);
  
  }

  obtenerSaldo(idLogeado){
  
    this.userService.obtenerSaldo(idLogeado).subscribe((res)=>{
      console.log(res);
      this.saldo = res;

    },(error)=>{
      console.log(error);
    })
  }

  obtenerSaldoCorporacion(idLogeado){
    this.userService.obtenerSaldoCorporacion(idLogeado).subscribe((res)=>{
      console.log(res);
      this.corporacion = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
  }
  obtenercobradores(){
    this.userService.cobradores().subscribe((res)=>{
      console.log(res);
      this.listosCobrar = JSON.parse(JSON.stringify(res)).listos;
      this.listosTotal = JSON.parse(JSON.stringify(res)).activosTotal;
    },(error)=>{
      console.log(error);
    })
  }

  liberarciclo(){
    this.userService.liberarCiclo().subscribe((res)=>{
      console.log(res);
      this.listosCobrar = JSON.parse(JSON.stringify(res));

    },(error)=>{
      console.log(error);
    })
  }
  
  obtenerSaldoIntensity(idLogeado){
    this.userService.obtenerSaldoIntensity(idLogeado).subscribe((res)=>{
      console.log(res);
      this.intensity = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
  }

  obtenerSaldocorporacionMGP(){
    this.userService.obtenerSaldoMGP().subscribe((res)=>{
      console.log(res);
      this.mgp = parseFloat(JSON.parse(JSON.stringify(res)));

    },(error)=>{
      console.log(error);
    })
  }

  
  obtenerAcciones(idLogeado){
  
    this.userService.obtenerAcciones(idLogeado).subscribe((res)=>{
      console.log(res);
      this.accionesConteo = JSON.parse(JSON.stringify(res)).cantidad;
      this.accionesConteoMGP = JSON.parse(JSON.stringify(res)).accionesMGP;
console.log('aqui va',this.accionesConteoMGP)
    },(error)=>{
      console.log(error);
    })
  }

  // compraconSaldo


  // compraconSaldo(){
  //   let usuario= JSON.parse(localStorage.getItem('user'));
  //   let idUsuario=usuario.id

  //   this.userService.compraconSaldo({idUsuarioFk:idUsuario}).subscribe((res)=>{
  //     console.log(res);
  //     if(JSON.parse(JSON.stringify(res)).retorno==1){

  //       this.obtenerSaldo(idUsuario)
  //       this.obtenerAcciones(idUsuario)
  //       this.toast.success(JSON.parse(JSON.stringify(res)).msj);

  //     }else{
  //       this.toast.error(JSON.parse(JSON.stringify(res)).msj);
  //     }
     

      

  //   },(error)=>{
  //     console.log(error);
  //   })
  // }

  // compraconSaldo(user: any) {
  //   const confirm = swal.fire({
  //     title: `Borrar al usuario ${user.first_name} ${user.last_name}`,
  //     text: 'Esta acción no se puede deshacer',
  //     type: 'question',
  //     showConfirmButton: true,
  //     showCancelButton: true,
  //     cancelButtonText: 'Cancelar',
  //     confirmButtonText: 'Borrar',
  //     focusCancel: true
  //   });

  //   from(confirm).subscribe(r => {
  //     if (r['value']) {
       
           
  //     }
  //   });
  // }


  compraconSaldo(configuracion: any) {
    const confirm = swal.fire({
      title: `Desea comprar una accion en MGP`,
      text: 'Esta acción no se puede deshacer',
      type: 'question',
      showConfirmButton: true,
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Comprar',
      focusCancel: true
    });
  
    from(confirm).subscribe(r => {
      if (r['value']) {
        let usuario= JSON.parse(localStorage.getItem('user'));
        let idUsuario=usuario.id
        this.userService.compraconSaldo({idUsuarioFk:idUsuario}).subscribe(response => {
          if (JSON.parse(JSON.stringify(response)).retorno==1) {
                  this.obtenerSaldo(idUsuario)
              this.obtenerAcciones(idUsuario)
              this.toast.success(JSON.parse(JSON.stringify(response)).msj);
          } else {
            this.toast.error(JSON.parse(JSON.stringify(response)).msj);
          }
        });
      }
    });
  }

}
