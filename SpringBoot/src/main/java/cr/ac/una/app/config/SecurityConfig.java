package cr.ac.una.app.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.crypto.bcrypt.BCryptPasswordEncoder;

/**
 * Clase para la configuracion del algoritmo
 * para encriptacion de contraseñas
 * @author Isaac Herrera
 */

@Configuration
public class SecurityConfig {
 
    @Bean
    BCryptPasswordEncoder passwordEncoder() {
        return new BCryptPasswordEncoder();
    }

}