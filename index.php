<?php
require_once("funcions.php");
$mysqli = conecta();
$buscador = "";
if(isset($_POST['buscador'])){
    $buscador = $mysqli->real_escape_string($_POST['buscador']);
}
$orderBy = 'descripcio_cat asc';
$orden = "";
if (isset($_POST['orden'])){
$orden = $_POST['orden'];
    switch ($orden){
        case "nombre_ascendente":
            $orderBy = 'descripcio_cat asc';
            break;
        case "nombre_descendente":
            $orderBy = 'descripcio_cat desc';
            break;
    }
}
$numResultados = 1;
if (isset($_POST['numResultados'])){
    $numResultados = $_POST['numResultados'];
    $sql = "select count(*) as totalResultados FROM allotjament WHERE descripcio_cat LIKE '%$buscador%' or descripcio_esp LIKE '%$buscador%' or descripcio_eng LIKE 
      '%$buscador%'";
    $resultadoTotal = $mysqli->query($sql) or die($sql);
    if ($row = $resultadoTotal->fetch_assoc()){
        $total = $row['totalResultados'];
        $totalPorPagina = ceil($total/$numResultados);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/popper.min.js"></script>
	<title>Index</title>
</head>
<body>
<div id="carouselId" class="carousel slide anchura" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselId" data-slide-to="0" class="active"></li>
    <li data-target="#carouselId" data-slide-to="1"></li>
    <li data-target="#carouselId" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <img src="img/allotjament/ODR97F0.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
            <img src="img/allotjament/2854.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
            <img src="img/allotjament/3034.jpg" alt="Third slide">
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<div>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark fiked-top">
    <ul class="nav navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="#">Nav 1 <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Nav 2</a>
        </li>
        <li class="nav-item">
            <form class="form-inline" action="" method="post">
                <input type="text" id="buscador" name="buscador" value="<?=$buscador?>">
                <button type="button" name="bBuscador" class="btn btn-primary">Buscar</button>
                <select name="orden" id="orden" onchange="this.form.submit()">
                    <option value="nombre_ascendente" <?php echo($orden == 'nombre_ascendente'?'selected':'');?>>nombre ascendente</option>
                    <option value="nombre_descendente" <?php echo($orden == "nombre_descendente"?"selected":"");?>>nombre descendente</option>

                </select>
                <select name="numResultados" id="numResultado" onchange="this.form.submit()">
                    <option value="1" <?php echo($numResultados == 1?'selected':'');?>>1</option>
                    <option value="2" <?php echo($numResultados == 2?'selected':'');?>>2</option>
                    <option value="3" <?php echo($numResultados == 3?'selected':'');?>>3</option>
                </select>
            </form>
        </li>
        <li class="nav-item">
            <button type="submit" class="btn btn-info">Login</button>
        </li>

    </ul>
</nav>
    
</div>

<div id="destacados">

</div>
<div id="generar">
    <table
    <table class="table">
        <thead>
        <tr>
            <th>Descripcio en catala</th>
            <th>Descripcion en castellano</th>
            <th>English description</th>
        </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT * FROM allotjament WHERE descripcio_cat LIKE '%$buscador%' or descripcio_esp LIKE '%$buscador%' or descripcio_eng LIKE 
      '%$buscador%' order by $orderBy limit 0,$numResultados";
$resultado  = $mysqli->query($sql) or die($sql);
while($row = $resultado->fetch_assoc()) {
    echo "<tr>
            <td>".$row["descripcio_cat"]."</td>
            <td>".$row["descripcio_esp"]."</td>
            <td>".$row["descripcio_eng"]."</td>
            </tr>";
}

 ?></tbody>
    </table>
</div>
<div>
    <form id="">

    </form>
</div>
</body>
</html>