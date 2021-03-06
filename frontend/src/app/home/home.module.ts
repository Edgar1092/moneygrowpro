import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';

import { HomeRoutingModule } from './home-routing.module';
import { HomeComponent } from './home.component';
import { CursosComponent } from './cursos/cursos.component';
import { AccionListComponent } from './accion-list/accion-list.component';
import { AccionAddComponent } from './accion-add/accion-add.component';
import { SharedModule } from 'app/shared/shared.module';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HistoricoComponent } from './historico/historico.component';
import { RetiroComponent } from './retiro/retiro.component';
import { ReferidosComponent } from './referidos/referidos.component';
import { AccionMGPComponent } from './accion-mgp/accion-mgp.component';
import { AccionmgpAddComponent } from './accionmgp-add/accionmgp-add.component';
import { AccionmanualmgpComponent } from './accionmanualmgp/accionmanualmgp.component';

@NgModule({
  declarations: [HomeComponent, CursosComponent, AccionListComponent, AccionAddComponent, HistoricoComponent, RetiroComponent, ReferidosComponent, AccionMGPComponent, AccionmgpAddComponent, AccionmanualmgpComponent],
  imports: [CommonModule, HomeRoutingModule,SharedModule,FormsModule,
    ReactiveFormsModule,]
})
export class HomeModule {}
