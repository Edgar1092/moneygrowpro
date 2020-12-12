import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AccionmgpAddComponent } from './accionmgp-add.component';

describe('AccionmgpAddComponent', () => {
  let component: AccionmgpAddComponent;
  let fixture: ComponentFixture<AccionmgpAddComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AccionmgpAddComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AccionmgpAddComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
