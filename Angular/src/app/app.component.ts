import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { NotificationService } from './service/notification.service';

@Component({
	selector: 'app-root',
	standalone: true,
	imports: [RouterOutlet],
	template: `
		<button (click)="showMessage()">Show Toast</button>
	`,
	// templateUrl: './app.component.html',
	styleUrl: './app.component.css'
})
export class AppComponent {
	
	constructor(private notification: NotificationService) { }

	showMessage() {
		this.notification.showMessage('Prueba', 'Prueba exitosa', 'success');
	}
	
}
