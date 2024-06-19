import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { User } from '../../models/user.model';

@Component({
	selector: 'app-info-user-form',
	standalone: true,
	imports: [],
	templateUrl: './info-user-form.component.html',
	styles: []
})
export class InfoUserFormComponent implements OnInit {

	@Input() user: User | undefined;
	@Output() cancel = new EventEmitter<void>();
	formattedFechaCreacion: string | null = null;


	ngOnInit(): void {
		if (this.user && this.user.fechaCreacion) {
			this.formattedFechaCreacion = this.formatFechaCreacion(this.user.fechaCreacion);
		}
	}

	onCancel(): void {
		this.cancel.emit();
	}

	formatFechaCreacion(fechaCreacion: Date): string {
		return new Date(fechaCreacion).toISOString().slice(0, 19).replace('T', ' ');
	}

}