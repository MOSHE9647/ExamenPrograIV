import { ComponentFixture, TestBed } from '@angular/core/testing';

import { InfoUserFormComponent } from './info-user-form.component';

describe('InfoUserFormComponent', () => {
  let component: InfoUserFormComponent;
  let fixture: ComponentFixture<InfoUserFormComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [InfoUserFormComponent]
    })
    .compileComponents();

    fixture = TestBed.createComponent(InfoUserFormComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
