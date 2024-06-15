package cr.ac.una.app.utils;

/**
 * Clase para el almacenamiento de las
 * Variables (principalmente relacionadas
 * a la base de datos) que van a ser utilizadas
 * dentro del Proyecto
 * @author Isaac Herrera
 */
public class AppConstants {

    private AppConstants() {
        throw new 
            UnsupportedOperationException("La clase 'AppConstants' [Variables] no se puede instanciar.");
    }

    // VARIABLES PARA LAS TABLAS DE LA BD //
    public static final String TB_DIRECCIONES = "tbdirecciones";
    public static final String TB_USUARIOS = "tbusuarios";
    
    // VARIABLES DE LA CLASE USUARIO //
    public static final String USUARIO_ID = "UsuarioID";
    public static final String CREATED_AT = "FechaCreacion";
    public static final String CEDULA = "Cedula";
    public static final String NOMBRE = "Nombre";
    public static final String APELLIDO = "Apellido";
    public static final String TELEFONO = "Telefono";
    public static final String ESTADO = "Estado";
    public static final String TIPO = "Tipo";
    public static final String CORREO = "Email";
    public static final String PASSWORD = "Password";

    // VARIABLES DE LA CLASE DIRECCION //
    public static final String DIRECCION_ID = "DireccionID";
    public static final String PROVINCIA = "Provincia";
    public static final String CANTON = "Canton";
    public static final String DISTRITO = "Distrito";
    public static final String BARRIO = "Barrio";
    public static final String INFO = "InformacionAdicional";

}