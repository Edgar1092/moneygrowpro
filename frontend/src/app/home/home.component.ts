import { Component, OnInit } from '@angular/core';
import { UsersService } from 'app/shared/services/users.service';
import { Observable, from } from 'rxjs';
import { registerLocaleData } from '@angular/common';
import localeEs from '@angular/common/locales/es';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.scss']
})
export class HomeComponent implements OnInit {
users$: Observable<any[]>;
codigoReferido;
contadorReferidos;
Patrocinador;
posicion;
saldo
accionesConteo
  constructor(private userService: UsersService) { }

  ngOnInit() {
    registerLocaleData(localeEs, 'es');
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.codigoReferido=usuario.link;
    this.posicion=usuario.posicion;
    this.obtenerReferidos(usuario.id)
    this.obtenerPatrocinador(usuario.idReferido)
    this.obtenerSaldo(usuario.id)
    this.obtenerAcciones(usuario.id)
  }

  obtenerReferidos(idLogeado){
    
    this.contadorReferidos=this.userService.countReferidos(idLogeado);


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

  obtenerSaldo(idLogeado){
  
    this.userService.obtenerSaldo(idLogeado).subscribe((res)=>{
      console.log(res);
      this.saldo = res;

    },(error)=>{
      console.log(error);
    })
  }

  obtenerAcciones(idLogeado){
  
    this.userService.obtenerAcciones(idLogeado).subscribe((res)=>{
      console.log(res);
      this.accionesConteo = JSON.parse(JSON.stringify(res)).cantidad;

    },(error)=>{
      console.log(error);
    })
  }

}
