// globals.js
const server = window.location.hostname;
const devDirectory = "";

function formatoFecha(fecha) {
    // Convierte la fecha al objeto Date
    var date = new Date(fecha);
    
    // Obtiene los componentes de la fecha
    var dia = date.getDate();
    var mes = date.getMonth() + 1; // Los meses comienzan desde 0
    var anio = date.getFullYear();
    
    // Agrega un cero inicial si el día o el mes son menores que 10
    dia = dia < 10 ? '0' + dia : dia;
    mes = mes < 10 ? '0' + mes : mes;
    
    // Formatea la fecha al formato DD-MM-YYYY
    var fecha_formateada = dia + '-' + mes + '-' + anio;
    
    return fecha_formateada;
}
