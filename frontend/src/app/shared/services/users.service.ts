import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable, BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UsersService {
  users$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  constructor(private http: HttpClient) {
    this.get();
  }

  get(params?) {
    this.http.get<any[]>(`users`, { params }).subscribe(users => {
      this.users$.next(users);
    });
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
