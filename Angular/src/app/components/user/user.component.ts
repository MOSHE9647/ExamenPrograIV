import { Component, Input } from '@angular/core';

@Component({
	selector: 'app-user',
	standalone: true,
	imports: [],
	templateUrl: './user.component.html',
	styleUrl: './user.component.css'
})
export class UserComponent {

	@Input() user: User = {
		id: 0,
		nombre: '',
		apellido: '',
		cedula: '',
		telefono: '',
		direccion: {
			id: 0,
			provincia: '',
			canton: '',
			distrito: '',
			barrio: '',
			informacionAdicional: ''
		},
		email: '',
		tipo: '',
		password: '',
		estado: true,
		fechaCreacion: null
	}

}