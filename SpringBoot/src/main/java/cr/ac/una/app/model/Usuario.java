package cr.ac.una.app.model;

import static cr.ac.una.app.utils.AppConstants.*;

import java.util.Date;

import jakarta.persistence.CascadeType;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.OneToOne;
import jakarta.persistence.Table;
import jakarta.persistence.Temporal;
import jakarta.persistence.TemporalType;
import jakarta.validation.Valid;
import jakarta.validation.constraints.Email;
import jakarta.validation.constraints.NotBlank;
import jakarta.validation.constraints.NotNull;
import jakarta.validation.constraints.Pattern;
import lombok.Data;

/**
 * Esta clase representa la informacion general
 * que posee cada usuario, tanto como persona en
 * si, como para iniciar sesion en la aplicacion.
 * 
 * @author Isaac Herrera
 */

@Data                       // <- Genera los Getters y Setters
@Entity                     // <- Indica que es una Entidad de JPA
@Table(name = TB_USUARIOS)  // <- Asigna el Nombre de la Tabla
public class Usuario {

	// Variables estaticas para representar el Tipo de Usuario:
	public final static String ADMIN = "Administrador";
	public final static String NORMAL = "Estándar";

    // Generacion del ID del Usuario en la Base de Datos:
	@Id 												// <- Indica que este va a ser el ID
	@GeneratedValue(strategy = GenerationType.IDENTITY) // <- Asigna la propiedad Autoincremental al ID
	@Column(name = "UsuarioID") 						// <- Indica el Nombre de la Columna en la Tabla
	private Integer id;

	//<- Nullable indica si el campo puede, o no, ser nulo 			        ->//
	//<- NotNull indica que, el campo (numero u objeto), no puede ser nulo  ->//
	//<- NotBlank indica que el campo no puede estar vacio ni ser nulo      ->//
	//<- Pattern verifica que el numero de telefono tenga un formato valido ->//
	//<- Temporal le indica a JPA como debe guardarse la fecha en la BD     ->//
    @Temporal(TemporalType.TIMESTAMP)
    @Column(name = CREATED_AT, nullable = false, columnDefinition = "DATETIME")
    private Date fechaCreacion;

    @Column(name = ESTADO, nullable = false)
    @NotNull(message = "El campo 'Estado' no puede ser nulo")
    private boolean estado; //<- 1: Activo, 0: Inactivo

    @Column(name = NOMBRE, nullable = false)
	@NotBlank(message = "El campo 'Nombre' no puede estar vacio")
	private String nombre;

	@Column(name = APELLIDO, nullable = false)
	@NotBlank(message = "El campo 'Apellido' no puede estar vacio")
	private String apellido;

	@Column(name = CEDULA, nullable = false)
	@NotBlank(message = "El campo 'Cedula' no puede estar vacio")
	private String cedula;

	// El N° de Telefono debera tener el siguiente formato:
	// -> +506 1234 5678
	@Column(name = TELEFONO, nullable = false)
	@NotBlank(message = "El campo 'Telefono' no puede estar vacio'")
	@Pattern(regexp = "^\\+[0-9]{1,3}(?: [0-9]{4}){2,3}$", message = "Ingrese un número de teléfono válido (Ej: +506 1234 5678)")
	private String telefono;

	// Ajuste de relacion entre Direccion y Usuario:
	//<- OneToOne indica una relacion 1a1 entre las entidades Direcion y Usuario en la BD 		   ->//
	//<- Cascade indica que, si se borra un Usuario, tambien se borra la direccion relacionada     ->//
	//<- ReferencedColumn indica la columna a la que va a hacer Referencia en la tabla Direcciones ->//
	@OneToOne(cascade = CascadeType.ALL, orphanRemoval = true)
    @JoinColumn(name = DIRECCION_ID, referencedColumnName = DIRECCION_ID, nullable = false)
	@NotNull(message = "El campo 'Direccion' no puede ser nulo")
	@Valid
	private Direccion direccion;

	// Datos del usuario para iniciar sesion:
	//<- Unique indica que el campo debe ser unico 				   ->//
	//<- Email verifica que el campo se una direccion email valida ->//
	@Column(name = CORREO, unique = true, nullable = false)
	@NotBlank(message = "El campo 'Correo' no puede estar vacio")
	@Email(message = "El campo 'Correo Electronico' no es valido")
	private String email;
	
	@Column(name = TIPO, nullable = false)
	@NotBlank(message = "El campo 'Tipo' no puede estar vacío")
	private String tipo;
	
	@Column(name = PASSWORD, nullable = false)
	private String password;

    public Usuario() {
        this.estado = true;                 // <- Usuario activo por defecto
        this.fechaCreacion = new Date();    // <- Toma la fecha y hora actuales como Fecha de Creacion
    }

}