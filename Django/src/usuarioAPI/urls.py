from django.urls import path
from .views import *

urlpatterns = [
    path('usuarios/get', UsuarioListAPI.as_view(), name='usuarios-list'),
    path('usuarios/get<int:id>', UsuarioDetailAPI.as_view(), name='usuarios-detail'),
    path('usuarios/create', UsuarioCreateAPI.as_view(), name='usuarios-create'),
    path('usuarios/update', UsuarioUpdateAPI.as_view(), name='usuarios-update'),
    path('usuarios/delete', UsuarioDeleteAPI.as_view(), name='usuarios-delete')
]