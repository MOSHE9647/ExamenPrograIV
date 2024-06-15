package cr.ac.una.app.model;

import lombok.Data;
import com.fasterxml.jackson.annotation.JsonInclude;
import com.fasterxml.jackson.annotation.JsonProperty;

/**
 * Esta clase representa la respuesta que se
 * le va a devolver al usuario después de
 * llamar a una de las API's desde JS.
 * 
 * El objeto genérico se utiliza en caso de tener
 * que devolver algo además de solo el mensaje del
 * servidor.
 * 
 * @param <T> el tipo del objeto genérico
 * 
 * @author Isaac Herrera
 */

@Data //<- Genera los setters, getters y demás info
@JsonInclude(JsonInclude.Include.NON_NULL) //<- Ignora valores nulos durante la serialización
public class Response<T> {
	
	// Variables para indicar el tipo de respuesta:
	public static final String ERROR = "error";
	public static final String WARNING = "warning";
	public static final String SUCCESS = "success";

	@JsonProperty("title")
	private String titulo;  //<- Título de la Respuesta
	
	@JsonProperty("message")
	private String mensaje; //<- Mensaje a mostrar
	
	@JsonProperty("type")
	private String tipo;  //<- Tipo de respuesta
	
	@JsonProperty("data")
	private T object;  //<- Objeto genérico

	/**
     * Método para determinar si la respuesta fue un éxito.
     * @return true si la respuesta fue un éxito, false de lo contrario.
     */
	public boolean isSuccess() {
		return SUCCESS.equals(tipo);
	}

	// Constructores
	public Response() {
	
	}

	public Response(String titulo, String mensaje, String tipo, T object) {
		this.titulo = titulo;
		this.mensaje = mensaje;
		this.tipo = tipo;
		this.object = object;
	}

}
