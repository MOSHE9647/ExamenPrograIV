export interface ApiResponse<T> {
    success: boolean;
    title: string;
    message: string;
    type: string;
    data: T;
}