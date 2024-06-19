import { CommonModule } from '@angular/common';
import { Component, Output, EventEmitter } from '@angular/core';
import { ReactiveFormsModule, FormControl, FormGroup, Validators, AbstractControl } from '@angular/forms';

import { User } from '../../models/user.model';
import { ToastrService } from 'ngx-toastr';

@Component({
	selector: 'app-add-user-form',
	standalone: true,
	imports: [CommonModule, ReactiveFormsModule],
	templateUrl: './add-user-form.component.html',
	styles: []
})
export class AddUserFormComponent {

	@Output() save = new EventEmitter<User>();
	@Output() cancel = new EventEmitter<void>();

	constructor (private toast: ToastrService) {}

	userForm = new FormGroup({
		estado: new FormControl(true, Validators.required),
		nombre: new FormControl('', Validators.required),
		apellido: new FormControl('', Validators.required),
		cedula: new FormControl('', Validators.required),
		telefono: new FormControl('', Validators.required),
		direccion: new FormGroup({
			provincia: new FormControl('', Validators.required),
			canton: new FormControl('', Validators.required),
			distrito: new FormControl('', Validators.required),
			barrio: new FormControl('', Validators.required),
			informacionAdicional: new FormControl('')
		}),
		email: new FormControl('', [Validators.required, Validators.email]),
		tipo: new FormControl('', Validators.required),
		password: new FormControl('', Validators.required)
	}, { validators: this.passwordMatchValidator });

	onSave(): void {
		if (this.userForm.valid) {
			const formValue = this.userForm.value;
			const user: User = {
				estado: formValue.estado!,
				nombre: formValue.nombre!,
				apellido: formValue.apellido!,
				cedula: formValue.cedula!,
				telefono: formValue.telefono!,
				direccion: {
					provincia: formValue.direccion?.provincia!,
					canton: formValue.direccion?.canton!,
					distrito: formValue.direccion?.distrito!,
					barrio: formValue.direccion?.barrio!,
					informacionAdicional: formValue.direccion?.informacionAdicional ?? ''
				},
				email: formValue.email!,
				tipo: formValue.tipo!,
				password: formValue.password!
			};
			this.save.emit(user);
		}
	}

	onCancel(): void {
		this.cancel.emit();
	}

	passwordMatchValidator(control: AbstractControl): { [key: string]: boolean } | null {
		const password = control.get('password')?.value;
		const confirmPassword = control.get('confirmPassword')?.value;
		if (password !== confirmPassword) {
			return { 'mismatch': true };
		}
		return null;
	}

	// Notificaciones dentro del Componente:
	showToast(message: string, title: string, type: string): void {
		if (type === 'success') { this.toast.success(message, title); }
		if (type === 'warning') { this.toast.warning(message, title); }
		if (type === 'error') { this.toast.error(message, title); }
	}

}