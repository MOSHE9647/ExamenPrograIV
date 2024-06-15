package cr.ac.una.app.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import cr.ac.una.app.model.Response;
import cr.ac.una.app.model.Usuario;
import cr.ac.una.app.service.UsuarioService;
import jakarta.validation.Valid;

/**
 * 
 * @author Isaac Herrera
 */

@RestController
@RequestMapping(path = "/api/v1/usuarios")
public class UsuarioController {
    
    @Autowired
    private UsuarioService usuarioService;

    @GetMapping(path = "/getAll")
    public ResponseEntity<Response<List<Usuario>>> getAllUsuarios() {
        List<Usuario> usuarios = usuarioService.obtenerListaUsuarios();
        Response<List<Usuario>> response = new Response<>("Listado de Usuarios", "Usuarios obtenidos con éxito", Response.SUCCESS, usuarios);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @GetMapping(path = "/getActive")
    public ResponseEntity<Response<List<Usuario>>> getActiveUsuarios() {
        List<Usuario> usuarios = usuarioService.obtenerListaUsuariosPorEstado(true);
        Response<List<Usuario>> response = new Response<>("Listado de Usuarios", "Usuarios obtenidos con éxito", Response.SUCCESS, usuarios);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @GetMapping(path = "/getInactive")
    public ResponseEntity<Response<List<Usuario>>> getInactiveUsuarios() {
        List<Usuario> usuarios = usuarioService.obtenerListaUsuariosPorEstado(false);
        Response<List<Usuario>> response = new Response<>("Listado de Usuarios", "Usuarios obtenidos con éxito", Response.SUCCESS, usuarios);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @GetMapping(path = "/get")
    public ResponseEntity<Response<Usuario>> getUsuarioById(@RequestParam(name = "id") Integer usuarioID) {
        Response<Usuario> response = usuarioService.obtenerUsuarioPorID(usuarioID);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @PostMapping(path = "/create")
    public ResponseEntity<Response<Usuario>> createUsuario(@Valid @RequestBody Usuario usuario) {
        Response<Usuario> response = usuarioService.crearNuevoUsuario(usuario);
        return new ResponseEntity<>(response, HttpStatus.CREATED);
    }

    @PutMapping(path = "/update")
    public ResponseEntity<Response<Usuario>> updateUsuario(@Valid @RequestBody Usuario usuario) {
        Response<Usuario> response = usuarioService.actualizarUsuario(usuario);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @DeleteMapping(path = "/delete/logical")
    public ResponseEntity<Response<Void>> deleteUsuarioLogico(@RequestParam(name = "id") Integer usuarioID) {
        Response<Void> response = usuarioService.deleteUsuarioLogico(usuarioID);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

    @DeleteMapping(path = "/delete/physical")
    public ResponseEntity<Response<Void>> deleteUsuarioFisico(@RequestParam(name = "id") Integer usuarioID) {
        Response<Void> response = usuarioService.deleteUsuarioFisico(usuarioID);
        return new ResponseEntity<>(response, HttpStatus.OK);
    }

}