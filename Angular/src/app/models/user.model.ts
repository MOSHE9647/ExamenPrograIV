export interface User {
    id?: number,
    nombre: string,
    apellido: string,
    cedula: string,
    telefono: string,
    direccion: {
        id?: number,
        provincia: string,
        canton: string,
        distrito: string,
        barrio: string,
        informacionAdicional?: string
    },
    email: string,
    tipo: string,
    password: string,
    estado: boolean,
    fechaCreacion: Date | null
}