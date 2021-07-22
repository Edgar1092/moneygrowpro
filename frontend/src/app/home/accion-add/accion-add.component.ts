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
  selector: 'app-accion-add',
  templateUrl: './accion-add.component.html',
  styleUrls: ['./accion-add.component.scss'],
  animations: [
    trigger('openClose', [
                state('open', style({height: '100%', opacity: 1})),
                state('closed', style({height: 0, opacity: 0})),
                transition('* => *', [animate('100ms')])
            ]),
 ]
})
export class AccionAddComponent implements OnInit {
  formBlog: FormGroup;
  page=1;
  per_page=30;
  blogToEdit$: BehaviorSubject<any> = new BehaviorSubject<any>(null);
  imagen
  nombreImagen
  usersReferido$: Observable<any[]>;
  urlImagen
  dataUsuario
 idUser;
 total = 0;
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
    this.formBlog = this.fb.group({
      idUsuarioFk: [''],
      plataforma: ['', Validators.required],
      referenciaPago: ['', Validators.required],
      matrix:['', Validators.required]

    });

    this.usersReferido$ = this.userService.usersReferido$;
    console.log('esto viene de respuesta',this.usersReferido$)
    this.usersReferido$.subscribe(users => {
      if (users) {
        this.dataUsuario=JSON.parse(JSON.stringify(users)).data;
        this.total = users.length;

        
      }
      
    });
    this.formBlog = this.fb.group({
      usuario: [''],
      usuarioDueno:[''],
      referenciaPago: [''],
      plataforma: [''],



    });
   }

  ngOnInit() {
    let usuario= JSON.parse(localStorage.getItem('user'));
    let idUser2=usuario.id;
    this.userService.getReferido({idReferido:idUser2});
  }
  add() {
    let usuario= JSON.parse(localStorage.getItem('user'));
    this.idUser=usuario.id;
    this.formBlog.controls['usuarioDueno'].setValue(this.idUser);
   
    if (this.formBlog.valid) {
      let d = this.formBlog.value;

        this.AccionService.addMatrix2021(this.formBlog.value).subscribe(response => {
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
