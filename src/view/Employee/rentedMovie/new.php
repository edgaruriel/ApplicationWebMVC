<?php
include_once(dirname(__FILE__)."/../../../controller/ClientController.php");
include_once(dirname(__FILE__)."/../../../controller/MovieController.php");
include_once(dirname(__FILE__)."/../../../services/SessionService.php");
validateSession();

$clienteController = new ClientController();
$movieController = new MovieController();

$allClients = $clienteController->getAll();
$allMovies = $movieController->getAll();
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <script src="../../../../public/js/employee/rentedMovie/new.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../../public/css/main.css" media="screen" />
</head>
<body>
<div class="nav">
	<a href="../client/index.php" class="nav-button">Catalogo de clientes</a>
	<a href="../cash/index.php" class="nav-button">Corte de caja del d&iacute;a</a>
	<a href="../rentedMovie/index.php" class="nav-button">Rentar pelicula</a>
	<a href="../../../services/LoginService.php?logOut" class="exit-button right"><span class="icon fa-off"></span></a>
</div>
<div class="container center">
	<div class="header">Nueva Renta</div>
	<div class="form-group">
		<label><span>Cliente:</span></label>
		<select id="client" name="client">
			<option value="">Seleccione un cliente</option>
			<?php foreach ($allClients as $client):?>
			<option value="<?php echo $client->getId()?>"><?php echo $client->getName();?></option>
			<?php endforeach;?>
		</select>
		
		<label><span>Fecha de devoluci&oacute;n</span></label>
		<input type="date" id="devolutionDate" name="devolutionDate"/>

		<label><span>Pelicula:</span></label>
		<select id="movie" name="movie">
			<option value="">Seleccione una pelicula</option>
			<?php foreach ($allMovies as $movie):?>
			<option value="<?php echo $movie->getId();?>"><?php echo $movie->getTitle().' ('.$movie->getYear().')'.' Disponibles '.($movie->getTotalUnits() - $movie->getRentedUnits());?></option>
			<?php endforeach;?>
		</select>
		<input type="hidden" id="allMovie" name="allMovie" value='<?php echo json_encode($allMovies);?>'/>
		<label><span>N&uacute;mero de peliculas a rentar:</span></label>
		<input type="number" id="numberMovie" name="number" />

		<button onclick="addMovie();" class="verde"><span class="icon fa-plus"></span>Agregar pelicula</button>
	</div>
		<hr>
		<h3>Lista de peliculas agregadas</h3>
		<table id="selectedMoviesTable" name="selectedMoviesTable" class="tableMovie">
			<thead>
				<tr>
					<th>Titulo</th>
					<th>A&ntilde;o</th>
					<th>Unidades</th>
					<th>Opciones</th>
				</tr>
			</thead>
			<tbody id="tbodyMovieList">
				
			</tbody>
		</table>
	
	<button onclick="rentedMovies();" class="verde right">Rentar</button>
	<a id="btn_cancelar" value="Cancelar" href="index.php" class="button azul left"><span class="icon fa-times"></span>Cancelar</a>
	<br><br><br>
</div>
</body>
</html>