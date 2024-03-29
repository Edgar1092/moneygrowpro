import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  users$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  ciclos$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  usersReferido$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  constructor(private http: HttpClient) {
    this.get();
  }

  get(params?) {
    this.http.get<any[]>(`users`, { params }).subscribe(users => {
      this.users$.next(users);
    });
  }

  getReferido(params?) {
    this.http.get<any[]>(`userReferido`, { params }).subscribe(users => {
      this.usersReferido$.next(users);
    });
  }

  // getUser(params?) {
  //   this.http.get<any[]>(`users`, { params }).subscribe(users => {
  //     this.ciclos$.next(users);
  //   });
  // }

  getUser() {
    return this.http.get(`users`);
  }

  show(index: number) {
    return this.http.get(`users/${index}`);
  }

    obtenerNumeroUsuario(params) {
    return this.http.post(`accion/obtenerNumeroUsuario`, params);
  }

  add(params: {
    email: string;
    first_name: string;
    last_name: string;
    password: string;
    'office_id[]': number[];
    'roles[]': string[];
    avatar?: string;
  }) {
    return this.http.post(`users`, params);
  }

  update(
    id: number,
    params: {
      email: string;
      first_name: string;
      last_name: string;
      password: string;
      'office_id[]': number[];
      'roles[]': string[];
      avatar?: string;
    }
  ) {
    return this.http.put(`users/${id}`, params);
  }

  delete(id: number) {
    return this.http.delete(`users/${id}`);
  }
  countReferidos(id: number) {
    let param
    param={id:id};
    return this.http.post(`referidos`,param);
  }

  cobradores(){
    let param
    param={id:1};
    return this.http.post(`accion/cobradores`,param);
  }

  liberarCiclo(){
    let param
    param={id:1};
    return this.http.post(`accion/liberarCiclo`,param);
  }

  obtenerSaldo(id: number) {
    let param
    param={id:id};
    return this.http.post(`accion/obtenerSaldo`,param);
  }
  obtenerSaldoCorporacion(id: number) {
    let param
    param={id:id};
    return this.http.post(`accion/obtenerSaldoCorporacion`,param);
  }
  obtenerSaldoMGP(){
    let param
    param={id:1};
    return this.http.post(`accion/obtenerSaldoMGP`,param);
  }

  compraconSaldo(param){
    return this.http.post(`accion/compraconSaldo`,param);
  }
  obtenerSaldoIntensity(id: number) {
    let param
    param={id:id};
    return this.http.post(`accion/obtenerSaldoIntensity`,param);
  }
  obtenerAcciones(id: number) {
    let param
    param={id:id};
    return this.http.post(`accion/obtenerAcciones`,param);
  }
  obtenerPatrocinador(id: number) {
    let param
    param={id:id};
    return this.http.post(`patrocinador`,param);
  }
}
