<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mr. Lucky | Producto</title>

	<?php include_once('partials/metas.php'); ?>
	<?php include_once('partials/styles.php'); ?>
</head>
<body>
	<?php include_once('partials/header.php'); ?>

	<section class="section-producto">
		<div class="img-produto text-center">
			<img src="img/foto-producto.png" class="img-fluid img-producto" loading="lazy" alt="">
		</div>
		<div class="container-fluid">
			<div class="row no-gutters">
				<div class="col-12 col-lg-6 px-3 py-5">
					<div class="row">
						<div class="col-lg-8 d-flex align-items-center">
							<div>
								<h2 class="h1 gris f800 text-center">Tomate Bola <br>Orgánico</h2>
								<div class="row my-5">
									<div class="col-6 col-xl text-center">
										<img src="img/icons/nutricion.png" class="img-fluid" loading="lazy" alt="">
										<p class="gris text-uppercase f600 my-3">
											Nutrición
										</p>
									</div>
									<div class="col-6 col-xl text-center">
										<img src="img/icons/usos.png" class="img-fluid" loading="lazy" alt="">
										<p class="gris text-uppercase f600 my-3">
											Usos
										</p>
									</div>
									<div class="col-6 col-xl text-center">
										<img src="img/icons/conservacion.png" class="img-fluid" loading="lazy" alt="">
										<p class="gris text-uppercase f600 my-3">
											Selección y conservación
										</p>
									</div>
									<div class="col-6 col-xl text-center">
										<img src="img/icons/ficha-tecnica.png" class="img-fluid" loading="lazy" alt="">
										<p class="gris text-uppercase f600 my-3">
											Ficha <br>técnica
										</p>
									</div>
								</div>
								<div class="text-center">
									<img src="img/foto-empaque.png" class="img-fluid" loading="lazy" alt="">
								</div>
							</div>
						</div>
						<div class="col-lg-4"></div>
					</div>
				</div>
				<div class="col-12 col-lg-6 bg-gris-claro d-flex align-items-center">
					<div class="row">
						<div class="col-lg-4"></div>
						<div class="col-lg-8 text-center py-5">
							<h3 class="verde text-center pacifico mb-5">Descripción</h3>
							<p class="azul-marino">
								<span class="azul-marino f600">El Tomate Bola Orgánico Mr. Lucky</span> es cosechado en invernadero, atendiendo los estándares de la certificadora CCOF.
							</p>
							<p class="azul-marino">
								Es un alimento alcalinizante, depurativo, diurético, digestivo y desinflamatorio.
							</p>
							<a href="#." class="button bg-verde text-white f600 text-uppercase mt-5 d-inline-block">
								Información Nutrimental
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include_once('partials/footer.php'); ?>
	<?php include_once('partials/scripts.php'); ?>
</body>
</html>