import { Component, EventEmitter, Input, Output } from '@angular/core';
import { User } from '../../models/user.model';

@Component({
	selector: 'app-info-user-form',
	standalone: true,
	imports: [],
	templateUrl: './info-user-form.component.html',
	styles: []
})
export class InfoUserFormComponent {

	@Input() user: User | undefined;
	@Output() cancel = new EventEmitter<void>();

	onCancel(): void {
		this.cancel.emit();
	}
	
}