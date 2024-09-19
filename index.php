<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnos Crod</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js"
    crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/Registros.css">
</head>
<body>  
    <header>
        <div class="header__superior">
        </div>

        <div class="container__menu">

            <div class="menu">
                <input type="checkbox" id="check__menu">
                <label id="#label__check" for="check__menu">
                    <i class="fas fa-bars icon__menu"></i>
                </label>
                <nav>
                    <ul>
                        <li><a href="" id="selected">REGISTROS</a></li>
                    </ul>
                </nav>
            </div>
            
        </div>
    </header>
    <main>
    <article>
    <h2>Registros de Alumnos
        <div class="product-card">
            <a href="./html/registrar_Alumnos.html" class="btn">+ Nuevo</a>
        </div>
    </h2>
    <br>
    <div class="tablaR">
        <table class="table">
            <thead class="disCo">
                <tr>
                    <th scope="col">N</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conexion=new mysqli("localhost","root","","escuela");
                $conexion->set_charset("utf8");   /* Permitir caracteres */
                

                include "./mysql/conexion.php";
                $sql = $conexion->query("select * from alumnos");
                while ($datos = $sql->fetch_object()) { ?>
                <tr>
                    <td><?= $datos->Id_Alumno ?></td>
                    <td><?= $datos->Foto ?></td>
                    <td><?= $datos->Nombre ?></td>
                    <td><?= $datos->Fecha_N ?></td>
                    <td>
                        <a href="./php/Modificar_Alumno.php?id=<?= $datos->Id_Alumno ?>"><img src="./img/Modificacion.png" alt="Modificacion"></a>
                        <a href="./php/Eliminar_Alumno.php?id=<?= $datos->Id_Alumno ?>" onclick="return confirmar('¿Estás seguro de que deseas eliminar este Alumno?');"><img src="./img/Baja.png" alt="Baja"></a>
                    </td>
                </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</article>           
    </main>
</body>
</html>