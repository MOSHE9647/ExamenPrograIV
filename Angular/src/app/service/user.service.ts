import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { NotificationService } from './notification.service';

@Injectable({
    providedIn: 'root'
})
export class UserService {

    constructor(private http: HttpClient, private notification: NotificationService) { }

    getUsers(): Observable<User[]> {
        return this.http.get<User[]>('https://your-api-url/users');
    }

    getUserById(id: number): Observable<User> {
        return this.http.get<User>(`https://your-api-url/users/${id}`);
    }

    createUser(user: User): Observable<User> {
        return this.http.post<User>('https://your-api-url/users', user);
    }

    updateUser(user: User): Observable<User> {
        return this.http.put<User>(`https://your-api-url/users/${user.id}`, user);
    }

    deleteUser(id: number): Observable<any> {
        return this.http.delete(`https://your-api-url/users/${id}`);
    }
}

interface ApiResponse {
  success: boolean;
  title: string;
  message: string;
  type: string;
  data: User | null;
}