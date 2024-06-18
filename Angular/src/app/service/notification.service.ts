import { Injectable } from '@angular/core';
import { NotificationComponent } from "../components/notification/notification.component";

@Injectable({
	providedIn: 'root'
})
export class NotificationService {
	
	constructor(private notification: NotificationComponent) { }

	showMessage(title: string, message: string, type:string) {
		this.notification.title = title;
		this.notification.message = message;
		this.notification.type = type;
		this.notification.showNotification();
	}

}
