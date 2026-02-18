<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mr. Lucky | Contacto</title>

	<?php include_once('partials/metas.php'); ?>
	<?php include_once('partials/styles.php'); ?>
</head>
<body>
	<?php include_once('partials/header.php'); ?>

	<img src="img/banner-contacto.jpg" loading="lazy" class="img-fluid w-100">

	<section class="section-contacto py-5">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-6 mb-4 mb-md-2">
					<p class="azul-marino">
						Ponte en contacto con nosotros, tus comentarios son MUY IMPORTANTES, nos dará mucho gusto resolver todas tus dudas.
					</p>

					<form action="" method="post" data-toggle="validator" data-disabled="false" data-focus="false">
						<div class="form-group">
							<input type="text" name="nombre" class="form-control" placeholder="*Nombre:" data-error="*Su nombre es requerido." required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="empresa" class="form-control" placeholder="*Empresa:" data-error="*Su empresa es requerida." required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="telefono" class="form-control" placeholder="Teléfono:">
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="*E-mail:" data-error="*Ingrese un correo válido" data-required-error="*Su correo es requerido." required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<input type="text" name="ciudad" class="form-control" placeholder="Ciudad y Estado:" data-error="*Su nombre es requerido." required>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<textarea name="comentarios" rows="5" class="form-control" placeholder="*Comentarios:" data-error="*Su comentario es requerido." required></textarea>
							<small class="help-block with-errors"></small>
						</div>
						<div class="form-group">
							<button class="btn btn-block btn-enviar" type="submit">
								Enviar
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>

	<section class="section-faq padding bg-gris-claro">
		<div class="container">
			<h3 class="text-center lila pacifico mb-5">Preguntas <br>frecuentes</h3>
			<div id="accordion" class="preguntas-frecuentes">
			    <div class="card">
			        <div class="card-header" id="heading01">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600" data-toggle="collapse" data-target="#collapse01" aria-expanded="true" aria-controls="collapse01">
			                    ¿Dónde se encuentra MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse01" class="collapse show" aria-labelledby="heading01" data-parent="#accordion">
			            <div class="card-body">
			                La produccion de los vegetales MR. Lucky se encuentran en el estado de Guanajuato. La planta de proceso está en Irapuato y los cultivos se encuentran en las zonas centro y norte del estado. Los Centros de distribución se encuentran ubicados en MTY, MEX, EDO MEX, GDL y CUN.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingTwo">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse02" aria-expanded="false" aria-controls="collapse02">
			                    ¿Qué variedades de vegetales maneja MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse02" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse03" aria-expanded="false" aria-controls="collapse03">
			                    ¿Dónde encuentro los vegetales MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse03" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse04" aria-expanded="false" aria-controls="collapse04">
			                    ¿Sus vegetales están listos para su consumo ó hay que desinfectarlos previamente?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse04" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse05" aria-expanded="false" aria-controls="collapse05">
			                    ¿Qué es un vegetal orgánico?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse05" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse06" aria-expanded="false" aria-controls="collapse06">
			                    ¿MR. LUCKY tiene vegetales orgánicos certificados? ¿Cuáles?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse06" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse07" aria-expanded="false" aria-controls="collapse07">
			                    ¿MR. LUCKY vende sus vegetales a alguien más?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse07" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse08" aria-expanded="false" aria-controls="collapse08">
			                    ¿Cuáles son las presentaciones y segmentos de mercado que abarcan los productos MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse08" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse09" aria-expanded="false" aria-controls="collapse09">
			                    ¿En qué zonas de México y USA tiene MR. LUCKY distribución?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse09" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
			                    ¿Cuál es la cobertura geográfica que tiene MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse10" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			    <div class="card">
			        <div class="card-header" id="headingThree">
			            <h5 class="mb-0">
			                <button class="btn btn-link gris f600 collapsed" data-toggle="collapse" data-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
			                    ¿Qué certificaciones avalan la calidad de los vegetales MR. LUCKY?
			                </button>
			            </h5>
			        </div>
			        <div id="collapse11" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
			            <div class="card-body">
			                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</section>

	<section class="section-noticias-recientes py-5">
		<div class="container">
			<h3 class="azul-cielo text-center pacifico mb-4">Noticias <br>más Recientes</h3>

			<div class="row">
				<div class="col-12 col-sm-6 col-md-3">
					<div class="card shadow p-2">
						<img src="img/noticias-01.jpg" class="img-fluid" loading="lazy" alt="">
						<span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0">Título 01</span>
						<small class="d-block gris py-1">04/10/2022</small>
						<p class="small">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						</p>
						<a href="#." class="btn btn-sm btn-link text-uppercase f600 text-left">
							Leer más...
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="card shadow p-2">
						<img src="img/noticias-02.jpg" class="img-fluid" loading="lazy" alt="">
						<span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0">Título 02</span>
						<small class="d-block gris py-1">04/10/2022</small>
						<p class="small">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						</p>
						<a href="#." class="btn btn-sm btn-link text-uppercase f600 text-left">
							Leer más...
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="card shadow p-2">
						<img src="img/noticias-03.jpg" class="img-fluid" loading="lazy" alt="">
						<span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0">Título 03</span>
						<small class="d-block gris py-1">04/10/2022</small>
						<p class="small">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						</p>
						<a href="#." class="btn btn-sm btn-link text-uppercase f600 text-left">
							Leer más...
						</a>
					</div>
				</div>
				<div class="col-12 col-sm-6 col-md-3">
					<div class="card shadow p-2">
						<img src="img/noticias-04.jpg" class="img-fluid" loading="lazy" alt="">
						<span class="bg-verde text-white text-uppercase f600 d-block px-2 py-0">Título 04</span>
						<small class="d-block gris py-1">04/10/2022</small>
						<p class="small">
							Lorem Ipsum is simply dummy text of the printing and typesetting industry.
						</p>
						<a href="#." class="btn btn-sm btn-link text-uppercase f600 text-left">
							Leer más...
						</a>
					</div>
				</div>
			</div>
			<div class="text-center mt-4">
				<a href="#." class="btn btn-sm btn-link f600 text-left azul-cielo">
					Ver más...
				</a>
			</div>
		</div>
	</section>

	<section class="section-descargables bg-gris-claro py-5">
		<div class="container">
			<h3 class="azul-marino text-center pacifico mb-4">Descargables</h3>


			<div class="text-center mt-4">
				<a href="#." class="btn btn-sm btn-link f600 text-left azul-cielo">
					Ver más...
				</a>
			</div>
		</div>
	</section>
	
	

	<?php include_once('partials/footer.php'); ?>
	<?php include_once('partials/scripts.php'); ?>
</body>
</html>