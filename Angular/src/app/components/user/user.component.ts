import { Component, OnInit } from '@angular/core';
import { UserService } from '../../service/user.service';
import { UsersTableComponent } from "../users-table/users-table.component";
import { CommonModule } from '@angular/common';
import { User } from '../../models/user.model';
import { ApiResponse } from '../../models/api.response.model';

@Component({
	selector: 'app-user',
	standalone: true,
	templateUrl: './user.component.html',
	styles: [],
	imports: [UsersTableComponent, CommonModule]
})
export class UserComponent implements OnInit {

	users: User[] = [];
	selectedUser: User | undefined;
	isAddFormVisible: boolean = false;
	isEditFormVisible: boolean = false;
	isInfoFormVisible: boolean = false;

	constructor(private userService: UserService) { }

	ngOnInit(): void {
		this.loadUsers();
	}

	// Funciones para manejo del HTML:
	toggleAddFormVisibility(): void {
		this.isAddFormVisible = !this.isAddFormVisible;
		this.isEditFormVisible = false;
		this.isInfoFormVisible = false;
		this.selectedUser = undefined;
	}

	toggleEditFormVisibility(user: User): void {
		this.isEditFormVisible = !this.isEditFormVisible;
		this.isAddFormVisible = false;
		this.isInfoFormVisible = false;
		this.selectedUser = user;
	}

	toggleInfoFormVisibility(user: User): void {
		this.isInfoFormVisible = !this.isInfoFormVisible;
		this.isEditFormVisible = false;
		this.isAddFormVisible = false;
		this.selectedUser = user;
	}

	hideForm(): void {
		this.isInfoFormVisible = false;
		this.isEditFormVisible = false;
		this.isAddFormVisible = false;
		this.selectedUser = undefined;
	}

	// Funciones relacionadas a las API:
	loadUsers(): void {
		this.userService.getUsers({}).subscribe((response: ApiResponse<User | User[]>) => {
			if (response.success) {
				this.users = response.data as User[];
				this.userService.showToast(response.message, response.title, response.type);
			} else {
				this.userService.showToast(response.message, response.title, response.type);
				console.error(response.message);
			}
		})
	}

	createUser(user: User): void {
		if (this.isAddFormVisible) {
			this.userService.createUser(user).subscribe((response: ApiResponse<User>) => {
				if (response.success) {
					this.userService.showToast(response.message, response.title, response.type);
					console.log('Usuario creado con éxito:', response.data);
					this.loadUsers();
					this.isAddFormVisible = false;
				} else {
					this.userService.showToast(response.message, response.title, response.type);
					console.error(response.message);
				}
			});
		}
	}

	updateUser(user: User): void {
		if (this.isEditFormVisible && this.selectedUser) {
			this.userService.updateUser(user).subscribe((response: ApiResponse<User>) => {
				if (response.success) {
					this.userService.showToast(response.message, response.title, response.type);
					console.log('Usuario actualizado con éxito:', response.data);
					this.loadUsers();
					this.isEditFormVisible = false;
					this.selectedUser = undefined;
				} else {
					this.userService.showToast(response.message, response.title, response.type);
					console.error(response.message);
				}
			});
		}
	}

	deleteUser(userId: number, logical: boolean = false): void {
		this.userService.deleteUser(userId, logical).subscribe((response: ApiResponse<any>) => {
			if (response.success) {
				this.userService.showToast(response.message, response.title, response.type);
				console.log('Usuario eliminado con éxito');
				this.loadUsers();
			} else {
				this.userService.showToast(response.message, response.title, response.type);
				console.error(response.message);
			}
		});
	}

}