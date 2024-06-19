import { CommonModule } from '@angular/common';
import { Component } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { User } from './models/user.model';
import { UserService } from './service/user.service';
import { ApiResponse } from './models/api.response.model';

@Component({
	selector: 'app-root',
	standalone: true,
	imports: [CommonModule, RouterOutlet],
	template: `
		<!-- <button (click)="showToast('Toast funcional', 'Éxito', 'success')">Show Toast</button>
		<button (click)="loadAllUsers()">Get Users</button> -->
		<router-outlet></router-outlet>
	`,
	styleUrl: './app.component.css'
})
export class AppComponent {
	
	user: User | null = null;
	users: User[] = [];

	constructor(private toast: ToastrService, private userService: UserService) {

	}
	
	showToast(message: string, title: string, type: string) {
		switch (type) {
			case 'success':
				this.toast.success(message, title);
				break;
			case 'warning':
				this.toast.warning(message, title);
				break;
			default:
				this.toast.error(message, title);
				break;
		}
	}

	loadAllUsers(): void {
		this.userService.getUsers({}).subscribe((response: ApiResponse<User | User[]>) => {
			if (response.success) {
				this.users = response.data as User[];
				console.log(this.users);
				this.showToast(response.message, response.title, response.type);
			} else {
				console.error(response.message);
				this.showToast(response.message, response.title, response.type);
			}
		})
	}

}