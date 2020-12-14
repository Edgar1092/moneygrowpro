import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AccionmanualmgpComponent } from './accionmanualmgp.component';

describe('AccionmanualmgpComponent', () => {
  let component: AccionmanualmgpComponent;
  let fixture: ComponentFixture<AccionmanualmgpComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AccionmanualmgpComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AccionmanualmgpComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
