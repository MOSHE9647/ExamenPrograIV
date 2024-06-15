package cr.ac.una.app.config;

import cr.ac.una.app.model.Response;
import lombok.extern.slf4j.Slf4j;
import org.springframework.http.HttpStatus;
import org.springframework.validation.FieldError;
import org.springframework.web.bind.MethodArgumentNotValidException;
import org.springframework.web.bind.annotation.ExceptionHandler;
import org.springframework.web.bind.annotation.ResponseStatus;
import org.springframework.web.bind.annotation.RestControllerAdvice;

/**
 * Clase encargada del manejo y respuesta hacia errores
 * que puedan ser generados como excepciones por la clase
 * 'MethodArgumentNotValidException' de la dependecia
 * Validation de SpringBoot.
 * 
 * @author Isaac Herrera
 */

@Slf4j
@RestControllerAdvice
public class CustomValidateExceptionHandler {

    @ExceptionHandler(MethodArgumentNotValidException.class)
    @ResponseStatus(HttpStatus.BAD_REQUEST)
    public Response<?> handleValidationExceptions(MethodArgumentNotValidException ex) {
        // Crear el objeto Response para manejar los errores de validación
        Response<?> errorResponse = new Response<>();

        // Log de los errores de validación
        log.error("Errores de validación: ");
        ex.getBindingResult().getAllErrors().forEach(error -> {
            log.error(error.getDefaultMessage());
        });

        // Obtener el primer mensaje de error de validación
        FieldError fieldError = (FieldError) ex.getBindingResult().getAllErrors().get(0);
        String message = fieldError.getDefaultMessage();

        // Configurar el objeto Response con el mensaje de error
        errorResponse.setTitulo("Error de Validación");
        errorResponse.setTipo(Response.ERROR);
        errorResponse.setMensaje(message);

        return errorResponse;
    }
}