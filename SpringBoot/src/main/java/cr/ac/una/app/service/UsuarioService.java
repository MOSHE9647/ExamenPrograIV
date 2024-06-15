package cr.ac.una.app.service;

import java.util.Date;
import java.util.List;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.stereotype.Service;

import cr.ac.una.app.data.UsuarioData;
import cr.ac.una.app.model.Response;
import cr.ac.una.app.model.Usuario;
import jakarta.transaction.Transactional;
import jakarta.validation.ConstraintViolationException;

/**
 * 
 * @author Isaac Herrera
 */

@Service
public class UsuarioService {

    @Autowired
    private UsuarioData usuarioData;

    @Autowired
    private PasswordEncoder passwordEncoder;

    public List<Usuario> obtenerListaUsuarios() {
        return usuarioData.findAll();
    }

    @Transactional
    public Response<Usuario> obtenerUsuarioPorID(Integer UsuarioID) {
        try {
            Optional<Usuario> optionalUsuario = usuarioData.findById(UsuarioID);

            if (optionalUsuario.isPresent()) {
                Usuario usuario = optionalUsuario.get();
                return new Response<>("Usuario Encontrado", "Usuario encontrado con éxito", Response.SUCCESS, usuario);
            } else {
                return new Response<>("Error", "Usuario no encontrado con id: " + UsuarioID, Response.ERROR, null);
            }
        } catch (Exception e) {
            return new Response<>("Error", "Se produjo un error al intentar buscar el usuario", Response.ERROR, null);
        }
    }

    @Transactional
    public Response<Usuario> crearNuevoUsuario(Usuario usuario) {
        try {
            verificarEmail(usuario);
            verificarPassword(usuario.getPassword());

            // Encriptar la contraseña antes de guardarla
            String hashedPassword = passwordEncoder.encode(usuario.getPassword());
            usuario.setPassword(hashedPassword);

            usuario.setFechaCreacion(new Date());

            Usuario savedUsuario = usuarioData.save(usuario);
            return new Response<>(
                "Usuario Creado",
                "El usuario se ha creado correctamente",
                Response.SUCCESS,
                savedUsuario
            );
        } catch (ConstraintViolationException e) {
            return new Response<>(
                "Error de Validación",
                e.getMessage(),
                Response.ERROR,
                null
            );
        } catch (Exception e) {
            return new Response<>(
                "Error",
                "Se produjo un error al intentar crear el usuario",
                Response.ERROR,
                null
            );
        }
    }

    @Transactional
    public Response<Usuario> actualizarUsuario(Usuario usuario) {
        Integer id = usuario.getId();
        try {
            Optional<Usuario> existingUsuario = usuarioData.findById(id);

            if (existingUsuario.isPresent()) {
                Usuario updatedUsuario = existingUsuario.get();
                if (!updatedUsuario.getEmail().equals(usuario.getEmail())) {
                    verificarEmail(usuario);
                }
                verificarPassword(usuario.getPassword());

                // Verificar si la contraseña ya está encriptada
                if (!usuario.getPassword().startsWith("$2a$")) {
                    verificarPassword(usuario.getPassword()); // Validar la estructura de la contraseña antes de encriptarla
                    // Encriptar la contraseña antes de guardarla
                    String hashedPassword = passwordEncoder.encode(usuario.getPassword());
                    updatedUsuario.setPassword(hashedPassword);
                } else {
                    updatedUsuario.setPassword(usuario.getPassword()); // La contraseña ya está encriptada, guardarla tal cual
                }

                updatedUsuario.setNombre(usuario.getNombre());
                updatedUsuario.setApellido(usuario.getApellido());
                updatedUsuario.setCedula(usuario.getCedula());
                updatedUsuario.setTelefono(usuario.getTelefono());
                updatedUsuario.setDireccion(usuario.getDireccion());
                updatedUsuario.setEmail(usuario.getEmail());
                updatedUsuario.setTipo(usuario.getTipo());
                updatedUsuario.setPassword(usuario.getPassword());
                updatedUsuario.setEstado(usuario.isEstado());

                Usuario savedUsuario = usuarioData.save(updatedUsuario);
                return new Response<>(
                    "Usuario Actualizado",
                    "El usuario se ha actualizado correctamente",
                    Response.SUCCESS,
                    savedUsuario
                );
            } else {
                return new Response<>(
                    "Error",
                    "Usuario no encontrado con id: " + id,
                    Response.ERROR,
                    null
                );
        }
        } catch (ConstraintViolationException e) {
            return new Response<>(
                "Error de Validación",
                e.getMessage(),
                Response.ERROR,
                null
            );
    } catch (Exception e) {
            return new Response<>(
                "Error",
                "Se produjo un error al intentar actualizar el usuario",
                Response.ERROR,
                null
            );
        }
    }

    @Transactional
    public Response<Void> deleteUsuarioLogico(Integer id) {
        try {
            Optional<Usuario> optionalUsuario = usuarioData.findById(id);

            if (optionalUsuario.isPresent()) {
                Usuario usuario = optionalUsuario.get();
                usuario.setEstado(false); // Marcar como inactivo
                usuarioData.save(usuario);
                return new Response<>(
                    "Usuario Inactivo", 
                    "El usuario ha sido marcado como inactivo", 
                    Response.SUCCESS, 
                    null
                );
            } else {
                return new Response<>(
                    "Error", 
                    "Usuario no encontrado con id: " + id, 
                    Response.ERROR, 
                    null
                );
            }
        } catch (Exception e) {
            return new Response<>(
                "Error", 
                "Se produjo un error al intentar desactivar el usuario", 
                Response.ERROR, 
                null
            );
        }
    }

    @Transactional
    public Response<Void> deleteUsuarioFisico(Integer id) {
        try {
            Optional<Usuario> optionalUsuario = usuarioData.findById(id);

            if (optionalUsuario.isPresent()) {
                usuarioData.deleteById(id);
                return new Response<>(
                    "Usuario Eliminado", 
                    "El usuario ha sido eliminado de la base de datos", 
                    Response.SUCCESS, 
                    null
                );
            } else {
                return new Response<>(
                    "Error", 
                    "Usuario no encontrado con id: " + id, 
                    Response.ERROR, 
                    null
                );
            }
        } catch (Exception e) {
            return new Response<>(
                "Error", 
                "Se produjo un error al intentar eliminar el usuario", 
                Response.ERROR, 
                null
            );
        }
    }

    private void verificarEmail(Usuario usuario) {
        if (usuarioData.existsByEmail(usuario.getEmail())) {
            throw new ConstraintViolationException("El correo electrónico ya está registrado", null);
        }
    }

    private void verificarPassword(String password) {
        if (password == null || password.length() < 8) {
            throw new ConstraintViolationException("La contraseña debe tener al menos 8 caracteres", null);
        }
    }

}