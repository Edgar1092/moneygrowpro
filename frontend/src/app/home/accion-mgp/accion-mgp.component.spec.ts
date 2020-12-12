import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AccionMGPComponent } from './accion-mgp.component';

describe('AccionMGPComponent', () => {
  let component: AccionMGPComponent;
  let fixture: ComponentFixture<AccionMGPComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AccionMGPComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AccionMGPComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
