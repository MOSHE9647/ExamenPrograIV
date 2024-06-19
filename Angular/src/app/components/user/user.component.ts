import { Component, OnInit } from '@angular/core';
import { User } from "../../models/user.model";
import { UserService } from '../../service/user.service';
import { response } from 'express';
import { ApiResponse } from '../../models/api.response.model';

@Component({
	selector: 'app-user',
	standalone: true,
	imports: [],
	templateUrl: './user.component.html',
	styleUrl: './user.component.css'
})
export class UserComponent implements OnInit {

	user: User | null = null;
	users: User[] = [];

	constructor(private userService: UserService) {}

	ngOnInit(): void {
		this.loadAllUsers();
	}

	loadAllUsers(): void {
		this.userService.getUsers({}).subscribe((response: ApiResponse<User | User[]>) => {
			if (response.success) {
				this.users = response.data as User[];
				console.log(this.users);
			} else {
				console.error(response.message);
			}
		})
	}

}