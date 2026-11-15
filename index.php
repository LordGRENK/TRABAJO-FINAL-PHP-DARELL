<?php require __DIR__ . '/buscador.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/customColors.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/index.css"  media="screen,projection"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Buscador de bienes raíces</title>
</head>

<body>

  <div class="contenedor">
    <div class="card rowTitulo">
      <h1>Buscador</h1>
    </div>
    <div class="colFiltros">
      <form action="index.php" method="get" id="formulario">
        <div class="filtrosContenido">
          <div class="tituloFiltros">
            <h5>Realiza una búsqueda personalizada</h5>
          </div>
          <div class="filtroCiudad input-field">
            <label for="selectCiudad">Ciudad:</label>
            <select name="ciudad" id="selectCiudad">
              <option value="">Elige una ciudad</option>
              <?php foreach (opciones($registros, 'Ciudad') as $opcion): ?>
                <option value="<?= escapar($opcion) ?>" <?= $ciudad === $opcion ? 'selected' : '' ?>><?= escapar($opcion) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtroTipo input-field">
            <label for="selectTipo">Tipo:</label><br>
            <select name="tipo" id="selectTipo">
              <option value="">Elige un tipo</option>
              <?php foreach (opciones($registros, 'Tipo') as $opcion): ?>
                <option value="<?= escapar($opcion) ?>" <?= $tipo === $opcion ? 'selected' : '' ?>><?= escapar($opcion) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="filtroPrecio">
            <label for="rangoPrecio">Precio:</label>
            <input type="text" id="rangoPrecio" name="precio" data-max="<?= $maximo ?>" data-from="<?= $desde ?>" data-to="<?= $hasta ?>" />
          </div>
          <div class="botonField">
            <input type="submit" class="btn white" value="Buscar" id="submitButton">
          </div>
        </div>
      </form>
    </div>

    <div class="colContenido">
      <div class="tituloContenido card">
        <h5>Resultados de la búsqueda:</h5>
        <div class="divider"></div>
        <form action="index.php" method="get"><button type="submit" name="todos" value="1" class="btn-flat waves-effect" id="mostrarTodos">Mostrar todos</button></form>
      </div>

      <?php if ($busqueda): ?>
        <section class="listado" aria-label="Propiedades encontradas">
          <p><?= !$todos && !$valido ? 'Ingresá un rango de precios válido.' : count($resultados).' propiedades encontradas.' ?></p>
          <?php foreach ($resultados as $registro): ?>
            <article class="card itemMostrado">
              <img src="img/home.jpg" alt="" loading="lazy">
              <div class="card-content card-stacked">
                <h5><?= escapar($registro['Tipo']) ?> · <?= escapar($registro['Ciudad']) ?></h5>
                <p><strong>Dirección:</strong> <?= escapar($registro['Direccion']) ?></p>
                <p><strong>Teléfono:</strong> <?= escapar($registro['Telefono']) ?></p>
                <p><strong>Código postal:</strong> <?= escapar($registro['Codigo_Postal']) ?></p>
                <p class="precioTexto"><?= escapar($registro['Precio']) ?></p>
              </div>
            </article>
          <?php endforeach; ?>
        </section>
      <?php endif; ?>
    </div>
  </div>

  <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
  <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
  <script type="text/javascript" src="js/index.js"></script>
</body>
</html>