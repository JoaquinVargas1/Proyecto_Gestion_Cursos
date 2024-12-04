<nav id="sidebar">
    <div class="sidebar-header">
        <h3><img src="../Assets/img/logo.png" class="img-fluid"/><span>Sistema gestión de cursos y alumnos</span></h3>
    </div>

    <ul class="list-unstyled components">
        <li class="dropdown"></li>

        <!-- Curso -->
        <li id="cursos">
            <a href="../cursos/mostrar"><i class="material-icons">school</i><span>Cursos</span></a>
        </li>

        <!-- Alumnos -->
        <li id="alumnos">
            <a href="../alumnos/mostrar"><i class="material-icons">sentiment_very_satisfied</i><span>Alumnos</span></a>
        </li>

        <!-- Profesores -->
        <li id="profesores">
            <a href="../profesores/mostrar"><i class="material-icons">psychology</i><span>Profesores</span></a>
        </li>

        <!-- Categorías -->
        <li id="categorias">
            <a href="../categorias/mostrar"><i class="material-icons">dynamic_feed</i><span>Categorías</span></a>
        </li>
    </ul>
</nav>

<script>
    // Función para resaltar la pestaña activa
    document.addEventListener("DOMContentLoaded", function() {
        // Obtener el nombre del archivo actual (sin la ruta completa)
        const currentPage = window.location.pathname.split('/').pop();

        // Detectar el nombre de la página y agregar clase 'active'
        if (currentPage === "mostrar") {
            // Verifica la URL completa de la página actual para añadir la clase correspondiente
            if (window.location.pathname.includes("cursos")) {
                document.getElementById("cursos").classList.add("active");
            } else if (window.location.pathname.includes("alumnos")) {
                document.getElementById("alumnos").classList.add("active");
            } else if (window.location.pathname.includes("profesores")) {
                document.getElementById("profesores").classList.add("active");
            } else if (window.location.pathname.includes("categorias")) {
                document.getElementById("categorias").classList.add("active");
            }
        }
    });
</script>
