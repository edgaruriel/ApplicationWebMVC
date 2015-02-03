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
    <link rel="stylesheet" type="text/css" href="../../../../public/css/rentedMovie/new.css" media="screen" />
</head>
<body>
<div class="container" style="width: 27%; height: auto;">
	<div style="text-align: right;">
		<h3>Seleccione un cliente</h3>
		<label>Cliente:</label>
		<select id="client" name="client">
			<option value="">Clientes</option>
			<?php foreach ($allClients as $client):?>
			<option value="<?php echo $client->getId()?>"><?php echo $client->getName();?></option>
			<?php endforeach;?>
		</select>
		<br>
		<h3>Fecha de devoluci&oacute;n</h3>
		<input type="date" id="devolutionDate" name="devolutionDate"/>
		<br>
		<hr>
		<h3>Seleccione una pelicula y n&uacute;mero de piezas</h3>
		<label>Peliculas:</label>
		<select id="movie" name="movie">
			<option value="">Peliculas</option>
			<?php foreach ($allMovies as $movie):?>
			<option value="<?php echo $movie->getId();?>"><?php echo $movie->getTitle().' ('.$movie->getYear().')'.' Disponibles '.($movie->getTotalUnits() - $movie->getRentedUnits());?></option>
			<?php endforeach;?>
		</select>
		<input type="hidden" id="allMovie" name="allMovie" value='<?php echo json_encode($allMovies);?>'/>
		<br>
		<br>
		<label>N&uacute;mero de peliculas</label>
		<input type="number" id="numberMovie" name="number" />
		<br>
		<br>
		<button onclick="addMovie();">Agregar pelicula</button>
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
	
	<button onclick="rentedMovies();">Rentar</button>
	<a id="btn_cancelar" value="Cancelar" href="index.php">Cancelar</a>
	</div>
</div>
</body>
</html>