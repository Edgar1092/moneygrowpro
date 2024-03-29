import { Injectable } from '@angular/core';
import { HttpClient, HttpParams } from '@angular/common/http';
import { BehaviorSubject } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AccionService {

  blogs$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  blogs2$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  MGP$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  ciclos$: BehaviorSubject<any[]> = new BehaviorSubject<any[]>([]);
  
  constructor(private http: HttpClient) {
  }
  get(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/get`, { params: parseParams })
      .subscribe(preguntas => {
        this.blogs$.next(preguntas);
      });
  }

  getMGP(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/getMGP`, { params: parseParams })
      .subscribe(preguntas => {
        this.MGP$.next(preguntas);
      });
  }
  getAccionmgp(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/acionesMGP`, { params: parseParams })
      .subscribe(preguntas => {
        this.blogs2$.next(preguntas);
      });
  }
  getReferidos(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/get/referidos`, { params: parseParams })
      .subscribe(preguntas => {
        this.blogs$.next(preguntas);
      });
  }
  getHistorico(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/getHistorico`, { params: parseParams })
      .subscribe(preguntas => {
        this.blogs$.next(preguntas);
      });
  }

  getSolicitudes(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/getSolicitudes`, { params: parseParams })
      .subscribe(preguntas => {
        this.blogs$.next(preguntas);
      });
  }

  getCiclo(params?) {
    let parseParams = new HttpParams();
    if (params) {
      Object.keys(params).forEach(p => {
        parseParams = parseParams.append(p, params[p]);
      });
    }
    this.http
      .get<any[]>(`accion/getCiclo`, { params: parseParams })
      .subscribe(preguntas => {
        this.ciclos$.next(preguntas);
      });
  }

  totalciclo() {
    return this.http.get<any[]>(`accion/getCiclo`);
  }
  
  // get(params) {
  //   this.http.post<any[]>(`accion/get`, params ).subscribe(blogs => {
  //     this.blogs$.next(blogs);
  //   });
  // }

  show(index: number) {
    let params = {id : index}
    return this.http.post(`accion/getAccion`, params);
  }

  obtenermesa(index: number) {
    let params = {idUsuario : index}
    return this.http.post(`accion/obtenerMesas`, params);
  }

  consultarReferidos(index: number) {
    let params = {idAccion : index}
    return this.http.post(`accion/consultarReferidos`, params);
  }


  

  

  verificar(index: number) {
    let params = {id : index}
    return this.http.post(`accion/verificar`, params);
  }

  add(params) {
    return this.http.post(`accion/create`, params);
  }

  addmanualMGP(params){
    return this.http.post(`accion/createManualmgp`, params);
  }
  addmatrixMGP(params) {
    return this.http.post(`accion/createMGP`, params);
  }

  addMatrix2021(params){
    return this.http.post(`accion/create2021`, params);
  }
  
  addMGP(params) {
    return this.http.post(`accion/actualizarMGP`, params);
  }

  
  solicitudRetiro(params) {
    return this.http.post(`accion/solicitudRetiro`, params);
  }

  
  aprobar(params) {
    return this.http.post(`accion/aprobar`, params);
  }

  rechazar(params) {
    return this.http.post(`accion/rechazar`, params);
  }

  aprobarMGP(params) {
    return this.http.post(`accion/aprobarMGP`, params);
  }

  rechazarMGP(params) {
    return this.http.post(`accion/rechazarMGP`, params);
  }

  delete(id) {
    let params = {id : id}
    return this.http.post(`accion/delete`,params);
  }
}
