import { Component, Input, Output, EventEmitter } from '@angular/core';
import { CommonModule } from '@angular/common';
import { User } from '../../models/user.model';

@Component({
	selector: 'app-users-table',
	standalone: true,
	imports: [CommonModule],
	templateUrl: './users-table.component.html',
	styles:[]
})
export class UsersTableComponent {

	@Input() users: User[] = [];
	@Output() editUser = new EventEmitter<User>();
	@Output() infoUser = new EventEmitter<User>();
	@Output() deleteUser = new EventEmitter<number>();

	constructor() { }

	onInfoUser(user: User): void {
		this.infoUser.emit(user);
	}

	onEditUser(user: User): void {
		this.editUser.emit(user);
	}

	onDeleteUser(userID: number | undefined): void {
		this.deleteUser.emit(userID);
	}

}