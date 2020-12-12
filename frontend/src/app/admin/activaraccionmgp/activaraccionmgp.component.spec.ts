import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ActivaraccionmgpComponent } from './activaraccionmgp.component';

describe('ActivaraccionmgpComponent', () => {
  let component: ActivaraccionmgpComponent;
  let fixture: ComponentFixture<ActivaraccionmgpComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ActivaraccionmgpComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ActivaraccionmgpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
