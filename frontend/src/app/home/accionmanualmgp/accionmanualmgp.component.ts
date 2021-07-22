import { Component, OnInit, ViewChild, ElementRef, ChangeDetectorRef } from '@angular/core';
import { FormGroup, FormBuilder, Validators, FormArray } from '@angular/forms';
import { RolesService } from 'app/shared/services/roles.service';
import { Observable, BehaviorSubject, of } from 'rxjs';
import { AccionService } from 'app/shared/services/accion.service';
import { ToastrService } from 'ngx-toastr';
import { ActivatedRoute, Router } from '@angular/router';
import { switchMap } from 'rxjs/operators';
import { state, trigger, transition, animate, style } from '@angular/animations';
import { UsersService } from 'app/shared/services/users.service';
@Component({
  selector: 'app-accionmanualmgp',
  templateUrl: './accionmanualmgp.component.html',
  styleUrls: ['./accionmanualmgp.component.scss']
})
export class AccionmanualmgpComponent implements OnInit {

  users$: Observable<any[]>;
  total = 0;
  p;
  idUsuarioFk
  usuarioAsignado
  itemsPerPage = '5';
  formBlog: FormGroup;
  page=1;
  per_page=30;
  blogToEdit$: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  imagen
  nombreImagen
  urlImagen
  dataUsuario
 idUser;
 idAccionvacia
 isOpen = true;

 toggle() {
   this.isOpen = !this.isOpen;
 }

  constructor(
    private fb: FormBuilder,
    private rolesService: RolesService,
    private AccionService: AccionService,
    private toast: ToastrService,
    private activatedRoute: ActivatedRoute,
    private router: Router,
    private userService: UsersService,
    private cd: ChangeDetectorRef,
  ) {
    this.users$ = this.userService.users$;
    this.users$.subscribe(users => {
      if (users) {
        this.dataUsuario=JSON.parse(JSON.stringify(users)).data;
        this.total = users.length;
      }
      
    });
 
   }

  ngOnInit() {
    this.idAccionvacia=this.activatedRoute.snapshot.params.id;
    this.userService.get();
  }
  add() {
    // let usuario= JSON.parse(localStorage.getItem('user'));
    // this.idUser=usuario.id;
    // this.formBlog.controls['id'].setValue(this.idAccionvacia);
   console.log('aqui van los ngmodel',{idUsuariodueno:this.idUsuarioFk,idUsuarioasignado:this.usuarioAsignado})
   
 
      this.AccionService.addmanualMGP({idUsuariodueno:this.idUsuarioFk,idUsuarioasignado:this.usuarioAsignado}).subscribe(response => {
        if (response) {
          
          this.toast.success(response['message']);
          this.router.navigate(['/home']);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      },(error)=>
      {
        let mensaje =error.error.errors;
        Object.keys(mensaje).forEach(key => {
          console.log(key)
          this.toast.error(mensaje[key][0]);
          console.log(mensaje[key][0])
         });
      });
   
  }

  aprobar() {
    if (this.formBlog.valid) {
      let d = this.formBlog.value;
  
      this.AccionService.aprobar(this.formBlog.value).subscribe(response => {
        if (response) {
          this.toast.success(response['message']);
          this.router.navigate(['/admin/parascore/list']);
        } else {
          this.toast.error(JSON.stringify(response));
        }
      });
    }
    // console.log(this.formBlog.value);
  }
}
