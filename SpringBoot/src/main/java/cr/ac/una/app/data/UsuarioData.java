package cr.ac.una.app.data;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import cr.ac.una.app.model.Usuario;

/**
 * 
 * @author Isaac Herrera
 */

@Repository
public interface UsuarioData extends JpaRepository<Usuario, Integer> {
    
    Optional<Usuario> findByEmail(String email);
    boolean existsByEmail(String email);
    
}