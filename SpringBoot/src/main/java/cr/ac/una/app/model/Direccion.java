package cr.ac.una.app.model;

import static cr.ac.una.app.utils.AppConstants.*;

import org.apache.commons.lang3.StringUtils;

import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Table;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.Size;
import lombok.Data;

/**
 * Esta clase representa la informacion relacionada
 * a los datos especificos de la direccion en la que
 * vive un usuario.
 * 
 * @author Isaac Herrera
 */

@Data // <- Genera los Getters y Setters
@Entity // <- Indica que es una Entidad de JPA
@Table(name = TB_DIRECCIONES) // <- Asigna el Nombre de la Tabla
public class Direccion {

    // Generacion del ID de la Direccion en la Base de Datos:
    @Id                                                 // <- Indica que este va a ser el ID
    @GeneratedValue(strategy = GenerationType.IDENTITY) // <- Asigna la propiedad Autoincremental al ID
    @Column(name = DIRECCION_ID)                        // <- Indica el Nombre de la Columna en la Tabla
    private Integer ID;

    // Atributos relacionados a la direccion del usuario:
    // <- NotBlank verifica que el campo no este vacio ni sea nulo ->//
    // <- Size asigna una cantidad maxima de caracteres al atributo ->//
    @Column(name = PROVINCIA, nullable = false)
    @NotBlank(message = "El campo 'Provincia' no puede estar vacio")
    private String provincia;

    @Column(name = CANTON, nullable = false)
    @NotBlank(message = "El campo 'Canton' no puede estar vacio")
    private String canton;

    @Column(name = DISTRITO, nullable = false)
    @NotBlank(message = "El campo 'Distrito' no puede estar vacio")
    private String distrito;

    @Column(name = BARRIO, nullable = false)
    @NotBlank(message = "El campo 'Barrio' no puede estar vacio")
    private String barrio;

    @Column(name = INFO)
    @Size(max = 255, message = "El campo 'Informacion Adicional' debe tener maximo {max} caracteres")
    private String informacionAdicional;

    // Metodo toString para mostrar la informacion
	@Override
	public String toString() {
		StringBuilder info = new StringBuilder();
		info.append(distrito + ", ");
		info.append(canton + ", ");
		info.append(provincia);
		return info.toString();
	}

	public String mostrarDireccionCompleta() {
		StringBuilder info = new StringBuilder();
		if (StringUtils.isNotBlank(informacionAdicional)) {
			info.append(informacionAdicional + ", ");
		}
		info.append(barrio + ", ");
		info.append(distrito + ", ");
		info.append(canton + ", ");
		info.append(provincia);
		return info.toString();
	}

}