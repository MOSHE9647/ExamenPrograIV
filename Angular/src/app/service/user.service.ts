import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

import { ApiResponse } from "../models/api.response.model";
import { User } from "../models/user.model";

@Injectable({
    providedIn: 'root'
})
export class UserService {

    // URL de la Conexión a Django:
    baseURL = 'http://localhost:8000/usuarios';

    // Inyección de la Dependencia para Solicitudes HTTP:
    constructor(private http: HttpClient) { }

    // Obtiene un Usuario o Lista de Usuarios según los parametros recibidos:
    getUsers(params: { id?: number, active?: boolean, inactive?: boolean }): Observable<ApiResponse<User | User[]>> {
        // Variable para agregar parametros a la solicitud http:
        let httpParams = new HttpParams();

        // Verifica si se recibio algun parametro en la llamada a la funcion:
        if (params.id) { httpParams = httpParams.set('id', params.id.toString()); }
        if (params.active) { httpParams = httpParams.set('active', 'true'); }
        if (params.inactive) { httpParams = httpParams.set('inactive', 'true'); }

        // Hace el llamado HTTP a la API en Django con los parámetros según sea necesario:
        return this.http.get<ApiResponse<User | User[]>>(`${this.baseURL}/get`, { params: httpParams });
    }

    // Crea un nuevo Usuario en la BD:
    createUser(user: User): Observable<ApiResponse<User>> {
        return this.http.post<ApiResponse<User>>(`${this.baseURL}/create`, user);
    }

    // Actualiza un usuario existente:
    updateUser(user: User): Observable<ApiResponse<User>> {
        return this.http.put<ApiResponse<User>>(`${this.baseURL}/update`, user);
    }

    // Elimina un usuario de la BD, ya sea de forma lógica (estado = false) o permanente:
    deleteUser(userId: number, logical: boolean = false): Observable<ApiResponse<any>> {
        let params = new HttpParams().set('id', userId.toString());

        if (logical) { params = params.set('logical', 'true'); }
        
        return this.http.delete<ApiResponse<any>>(`${this.baseURL}/delete`, { params });
    }

}