<?php
/*
Template Name: FichaBodega
*/
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
define( 'WineryDataTypeExtended', 1 );
define( 'WineryDataTypeNormal', 2 );
define( 'WineryDataTypeBasic', 3 );

define('INSTALACIONES_CATEGORY_ID',3);
define('TIPOS_VISITA',5);
define('SERVICIOS_TURISTICOS_CATEGORY_ID',4);
define('TIPOLOGIAS_CATEGORY_ID',6);

global $wp_query;

if ( get_locale() == 'es_ES'){
    $locale = "Locale: es\r\n";
}

// // Crear un flujo
// $options = array(
// 'http'=>array(
// 'method'=>"GET",
// 'header'=>"Locale: es\r\n"
// )
// );
// $context = stream_context_create($options);

// Abre el fichero usando las cabeceras HTTP establecidas arriba
// $jsonObject = json_decode( file_get_contents( URL_RIOJAWINE_API . "/companies/".$wp_query->query_vars['company_url'].'.json', false, $context) );

$urlWS = URL_RIOJAWINE_API . "/companies/".$wp_query->query_vars['company_url'].'.json';

$ch = curl_init($urlWS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          $locale,
       ));
//obtenemos la respuesta
$response = curl_exec($ch);
// Se cierra el recurso CURL y se liberan los recursos del sistema
curl_close($ch);
if(!$response) { $jsonObject = false;
}else{ $jsonObject = json_decode($response); }

$wineryData = $jsonObject->data;
$winery = $wineryData->Company;

// $imagesJsonObject = json_decode(file_get_contents( URL_RIOJAWINE_API . "/companies/images/" . $winery->id . '.json', false, $context));

$urlWS = URL_RIOJAWINE_API . "/companies/images/" . $winery->id . '.json';

$ch = curl_init($urlWS);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          $locale,
       ));
//obtenemos la respuesta
$response = curl_exec($ch);
// Se cierra el recurso CURL y se liberan los recursos del sistema
curl_close($ch);
if(!$response) { $jsonObject = false;
}else{ $jsonObject = json_decode($response); }

$images = $jsonObject->data;

    // Atributos
    $groupedAttributes = [];
    foreach( $wineryData->Attribute as $attribute ){

        if( !isset( $groupedAttributes[ $attribute->AttributeCategory->id ] ) ){
            $groupedAttributes[ $attribute->AttributeCategory->id ]['name'] =  $attribute->AttributeCategory->AttributeCategoryTranslation[0]->name;
        }

        $groupedAttributes[ $attribute->AttributeCategory->id ]['items'][] =  $attribute->AttributeTranslation[0]->name;
    }

    // //Vinos
    // $groupedWines = [];
    // foreach ($wines as $key => $item) {
    //
    //     if( !isset( $groupedWines[ $item->WineryType->id ] ) ){
    //         $groupedWines[ $item->WineType->id ]['name'] =  $item->WineType->name;
    //         $groupedWines[ $item->WineType->id ]['color'] =  $item->WineType->color;
    //     }
    //
    //     $groupedWines[ $item->WineType->id ]['items'][] =  $item->Wine->name;
    // }
    // var_dump($groupedAttributes);
    /* <?php bloginfo('template_url'); ?>/public/images/fichabodega */
    ?>

    <!-- SECCION: SLIDE FULL SCREEN BODEGA -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 banner-full-bodega" style="background: url('<?php bloginfo('template_url'); ?>/public/images/fichabodega/bodega.jpg') no-repeat center center; background-size: cover;">
            <div class="capa_negra_banner"></div>
			<h1><?php echo $winery->name; ?></h1>
        </div>
    </div>
    <!-- SECCION: SLIDE FULL SCREEN BODEGA -->
    <!-- SECCION: MENU BODEGA -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 content-menu-bodega">
            <div class="container no-padding">
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 no-padding">
                    <ul class="menu-bodega">
                		<li><a href="#seccion-descripcion" title="<?php echo pll_e('Descripción'); ?>"><?php echo pll_e('Descripción'); ?></a></li>
                		<li><a href="#seccion-servicios" title="<?php echo pll_e('Servicios e Instalaciones'); ?>"><?php echo pll_e('Servicios e Instalaciones'); ?></a></li>
                		<li><a href="#seccion-galeria" title="<?php echo pll_e('Galería'); ?>"><?php echo pll_e('Galería'); ?></a></li>
                		<li><a href="#seccion-vinos" title="<?php echo pll_e('Vinos'); ?>"><?php echo pll_e('Vinos'); ?></a></li>
                		<li><a href="#seccion-actividades" title="<?php echo pll_e('Actividades'); ?>"><?php echo pll_e('Actividades'); ?></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- SECCION: MENU BODEGA -->
    <!-- SECCION: INFO BODEGA -->
    <div class="container">
		<div class="vc_row wpb_row vc_row-fluid">
			<div class="wpb_column vc_column_container vc_col-sm-12">
				<div class="vc_column-inner ">
					<div class="wpb_wrapper">
						<style>#breadcrumb-5b9f6a964d2df li::after { content: "/" }</style>
						<ol class="wwp-vc-breadcrumbs " id="breadcrumb-5b9f6a964d2df">
							<li class="visited"><a href="/">Home</a></li>
							<?php
							if ( get_locale() == 'es_ES'){
							?>
								<li class="visited"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Espacios culturales' ) ) ); ?>"><?php echo pll_e('Espacios culturales'); ?></a></li>
							<?php
							}else{
							?>
								<li class="visited"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Cultural spaces' ) ) ); ?>"><?php echo pll_e('Espacios culturales'); ?></a></li>
							<?php
							}
							?>
							<li class="current"><span><?php echo $winery->name; ?></span></li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	
        <div id="seccion-descripcion" class="row">
            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 description-winery-col">
                <img class="logo-bodega" src="<?php echo $winery->url_logo; ?>" />
                <h5 class="b-description_readmore js-description_readmore">“<?php echo $winery->text; ?>”</h5>
				<script>
                    jQuery(function() {
                      jQuery('.js-description_readmore').moreLines({
                        linecount: 5,
                        baseclass: 'b-description',
                        basejsclass: 'js-description',
                        classspecific: '_readmore',
                        buttontxtmore: '<?php echo pll_e('Leer más'); ?>',
                        buttontxtless: '<?php echo pll_e('Leer menos'); ?>',
                        animationspeed: 250
                      });
                    });
                  </script>

				<?php if( strlen($winery->text) > 140  ){ ?>
                <div class="c-description_readmore js-description_readmore">
                    <?php echo $winery->full_text; ?>
                    <!-- <br />
                    <a href="#nogo" class="leer-mas" title="Leer más">Leer más</a> -->
                </div>

                <script>
                    jQuery(function() {
                      jQuery('.js-description_readmore').moreLines({
                        linecount: 8,
                        baseclass: 'c-description',
                        basejsclass: 'js-description',
                        classspecific: '_readmore',
                        buttontxtmore: '<?php echo pll_e('Leer más'); ?>',
                        buttontxtless: '<?php echo pll_e('Leer menos'); ?>',
                        animationspeed: 250
                      });
                    });
                  </script>
              <?php }else{ ?>
                  <?php echo $winery->full_text; ?>
              <?php } ?>

            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="card-bodega shadow-on">
                    <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/mapa-rioja-alta-ficha-bodega.png" />
                    <ul class="datos-bodega">
                        <!-- <li><strong>Zona producción</strong> <span><?php //echo $winery->zone_name; ?> - <?php //echo $winery->city; ?></span></li> -->
                        <li><strong><?php echo pll_e('Ubicación'); ?></strong>
							<span>
								<?php
								if(empty(trim($winery->address))){
									echo '-';
								} else {?>
									<?php echo $winery->address; ?>
								<?php } ?>
							</span>
						</li>
                        <li><strong><?php echo pll_e('E-mail'); ?></strong>
							<span>
								<?php
								if(empty(trim($winery->email))){
									echo '-';
								} else {?>
									<a href="mailto:<?php echo $winery->email; ?>" title="<?php echo $winery->email; ?>" target="_blank"><?php echo $winery->email; ?></a>
								<?php } ?>
							</span>
						</li>
                        <li><strong><?php echo pll_e('Teléfono'); ?></strong>
							<span>
								<?php
								if(empty(trim($winery->phone))){
									echo '-';
								} else {?>
									<a href="tel:<?php echo $winery->phone; ?>" title="<?php echo $winery->phone; ?>"><?php echo $winery->phone; ?></a>
								<?php } ?>
							</span>
						</li>
                        <li><strong><?php echo pll_e('Web'); ?></strong>
							<span>
								<?php
								if(empty(trim($winery->url))){
									echo '-';
								} else {?>
									<a href="<?php echo $winery->url; ?>" title="<?php echo $winery->url; ?>" target="_blank"><?php echo $winery->url; ?></a>
								<?php } ?>
							</span>
						</li>
                        <!-- <li><strong>Tienda online</strong><span>-</span></li> -->
                    </ul>
                    <!-- <a href="#nogo" class="btn btn-primary" title="Visita nuestra bodega">Visita nuestra bodega</a> -->
                </div>
                <p class="en-redes"><?php echo $winery->name; ?> <?php echo pll_e('en las redes sociales'); ?></p>
                <ul class="social-bodega">
				<?php
				if(!empty(trim($winery->facebook))){
				?>
                    <li><a href="<?php echo $winery->facebook; ?>" title="<?php echo $winery->name; ?> en Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } else {
				?>
					<li><i class="fa fa-facebook disabled"></i></li>
				<?php } ?>
				<?php
				if(!empty(trim($winery->twitter))){
				?>
                    <li><a href="<?php echo $winery->twitter; ?>" title="<?php echo $winery->name; ?> en Twitter" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php } else {
				?>
					<li><i class="fa fa-twitter disabled"></i></li>
				<?php } ?>
				<?php
				if(!empty(trim($winery->youtube))){
				?>
                    <li><a href="<?php echo $winery->youtube; ?>" title="<?php echo $winery->name; ?> en Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>
				<?php } else {
				?>
					<li><i class="fa fa-youtube disabled"></i></li>
				<?php } ?>
				<?php
				if(!empty(trim($winery->instagram))){
				?>
                    <li><a href="<?php echo $winery->instagram; ?>" title="<?php echo $winery->name; ?> en Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php } else {
				?>
					<li><i class="fa fa-instagram disabled"></i></li>
				<?php } ?>
				<?php
				if(!empty(trim($winery->tripadvisor))){
				?>
                    <li><a href="<?php echo $winery->tripadvisor; ?>" title="<?php echo $winery->name; ?> en Trip Advisor" target="_blank"><i class="fa fa-tripadvisor"></i></a></li>
				<?php } else {
				?>
					<li><i class="fa fa-tripadvisor disabled"></i></li>
				<?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- SECCION: INFO BODEGA -->
    <!-- SECCION: SERVICIOS E INSTALCIONES BODEGA -->
    <div id="seccion-servicios" class="row">
        <!-- titulo-->
        <div class="container">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="ante-title"><?php echo pll_e('VEN A VISITARNOS'); ?></h2>
                <h3 class="pro-title"><?php echo pll_e('Servicios e Instalaciones'); ?></h3>
            </div>
        </div>
        <!-- titulo-->
    </div>


    <div class="row content-servicios">
       <!-- listas de servicios e instalaciones-->
       <div class="container" style="background:#fff">
          <div class="row">
             <!-- columna 1-->
             <div class="servicios-bodega">
                <p class="list-title"><?php echo pll_e('Tipo Bodega'); ?></p>
                <ul class="caracteristicas-bodega">
                    <?php
                    $items = $groupedAttributes[ TIPOLOGIAS_CATEGORY_ID ]['items'];
                    foreach ($items as $key => $value) { ?>
                        <li><?php echo $value; ?></li><?php
                    }
                    ?>
                   <!-- <li>Aquitectura contemporánea</li>
                   <li>Entorno de viñedos</li>
                   <li>Atractivos singulares</li> -->
                </ul>
                <p class="list-title"><?php echo pll_e('Visitas'); ?></p>
                <ul class="caracteristicas-bodega">
                    <?php
                    $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
                    foreach ($items as $key => $value) { ?>
                        <li><?php echo $value; ?></li><?php
                    }
                    ?>
                   <!-- <li>Visitas de lunes a sábado</li>
                   <li>25 personas por visita</li>
                   <li>Inglés y castellano</li>
                   <li>Accesible para discapacitados</li>
                   <li>WIFI</li>
                   <li>Pago con tarjeta</li> -->
                </ul>
             </div>
             <!-- columna 1-->
             <!-- columna 2-->
             <div class="servicios-bodega">
                <p class="list-title"><?php echo pll_e('Servicios turísticos'); ?></p>
                <ul class="caracteristicas-bodega">
                    <?php
                    $items = $groupedAttributes[ SERVICIOS_TURISTICOS_CATEGORY_ID ]['items'];
                    foreach ($items as $key => $value) { ?>
                        <li><?php echo $value; ?></li><?php
                    }
                    ?>
                   <!-- <li>Visita a bodega con desgustación</li>
                   <li>Experiencias singulares </li>
                   <li>Catas / Degustaciones de vinos</li>
                   <li>Comidas bajo petición</li>
                   <li>Visitas exclusivas VIP</li>
                   <li>Visitas o actividades de viñedo</li>
                   <li>Tienda </li>
                   <li>Cursos de cata </li>
                   <li>Restaurante abierto al público</li> -->
                </ul>
             </div>
             <!-- columna 2-->
             <!-- columna 3-->
             <div class="servicios-bodega">
                <p class="list-title"><?php echo pll_e('Instalaciones'); ?></p>
                <ul class="caracteristicas-bodega">
                    <?php
                    $items = $groupedAttributes[ INSTALACIONES_CATEGORY_ID ]['items'];
                    foreach ($items as $key => $value) { ?>
                        <li><?php echo $value; ?></li><?php
                    }
                    ?>
                   <!-- <li>Aquitectura contemporánea</li>
                   <li>Entorno de viñedos</li>
                   <li>Atractivos singulares</li> -->
                </ul>
             </div>
             <!-- columna 3-->
          </div>
       </div>
    </div>
    <!-- SECCION: SERVICIOS E INSTALCIONES BODEGA -->

    <?php
    if( count($images) ){
    ?>
    <!-- SECCION: GALERIA IMAGENES BODEGA -->
    <!-- elementos galeria-->
    <div id="seccion-galeria" class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- titulo-->
            <div class="container">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="ante-title"><?php echo $winery->name; ?> <?php echo pll_e('EN IMÁGENES'); ?></h2>
                    <h3 class="pro-title"> <?php echo pll_e('Galería'); ?></h3>
                </div>
            </div>
            <!-- titulo-->

            <div class="container">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    	            <div class="grid gallery-magnific">
                        <div class="grid-sizer"></div>
    <?php
    // TRAMPEO DE ARRYA DE GALERIA

    $i=0;

    for($i=0; $i<12; $i++){

        if( isset( $images[$i] ) ){

            $image = $images[$i];

            // var_dump($image);

            if( $i == 0 || $i == 8 ){
                ?>
                <div class="grid-item grid-item--width2 grid-item--height2 gallery-item">
                <?php
            }
            else if( ($i >= 1 && $i <=6) || $i == 10 || $i == 11 ){
                ?>
                <div class="grid-item ">
                <?php
            }
            else if( $i == 7 ){
                ?>
                <div class="grid-item grid-item--width2">
                <?php
            }
            else if( $i == 9 ){
                ?>
                <div class="grid-item grid-item--height2">
                <?php
            }

            if( get_class($image) == 'stdClass' ){ ?>
                <a href="<?php echo $image->CompanyImage->url_image; ?>">
                    <img src="<?php echo $image->CompanyImage->url_image; ?>" title="<?php echo $image->CompanyImage->name; ?>" /><?php

            }else{ ?>
                <a href="<?php echo $image['url_video']; ?>" class="mfp-iframe">
                    <img src="<?php echo $image['url_image']; ?>" title="<?php echo $image['name']; ?>" />
                    <div class="es-video"></div><?php
            }

            ?>
            <div class="overlay"></div>
            </a></div>
            <?php

        }

    }
    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- elementos galeria-->
    <!-- SECCION: GALERIA IMAGENES BODEGA -->
    <!-- SECCION: GALERIA VINOS BODEGA -->
    <?php
    }
    ?>

    <?php /* ?>
    <div id="seccion-vinos" class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- items vinos-->
            <!-- titulo-->
            <div class="container">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="ante-title">VINOS DE <?php echo $winery->name; ?></h2>
                    <h3 class="pro-title">Conoce nuestros vinos</h3>
                    <p class="intro-conoce">Denominación de Origen desde 1925 y primera Denominación de Origen Calificada desde 1991, los vinos Rioja son internacionalmente reconocidos y comercializados en más de 100 países diferentes.</p>
                </div>
            </div>
            <!-- titulo-->
            <div class="container">
                <div class="row">
    <?php
    foreach ($wines as $key => $item) {

        $grapes = $item->Grape;
        $grapeNames = array();

        foreach ($grapes as $key => $grape) {

            $grapeNames[] = $grape->name;
        }
        ?>
                    <!-- item vino-->
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 ficha-vino">
                        <p class="titulo-vino"><?php echo $item->Wine->name; ?></p>
                        <div class="imagen-vino">
                            <div class="velo-gris"></div>
                            <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/imagenes-bodega/vino-ejemplo.jpg" alt="Nombre vino" class="image-item">
                            <div class="overlay"></div>
                            <div class="boton-overlay"><a href="#nogo" class="btn btn-primary ghost" title="Visita nuestra bodega">Ver ficha del vino</a></div>
                        </div>
                        <div class="caracteristicas-vino">
                            <div class="datos-vol-grape">
                                <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/icon-volumen.png" alt=" " />
                                <p>Alcohol: Vol. <?php echo $item->Wine->alcohol; ?>%</p>
                            </div>
                            <div class="datos-vol-grape">
                                <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/icon-variedades.png" alt=" " />
                                <p>Tipos de uva: <?php echo implode(', ', $grapeNames); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- item vino-->
    <?php
    } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- items vinos-->
    <!-- SECCION: GALERIA VINOS BODEGA -->
    <?php */ ?>
    <!-- SECCION: MAPA UBICACION BODEGA -->
    <div id="seccion-actividades" class="row">
        <!-- titulo-->
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 contiene-filtros">
            <div class="contiene-filtros-group">
                <h2 class="ante-title"><?php echo pll_e('ACTIVIDADES'); ?></h2>
                <h3 class="pro-title"><?php echo pll_e('Lugares'); ?><br /><?php echo pll_e('de interés'); ?></h3>
                <div class="checkbox checkbox-custom municipios-vino">
                    <input id="checkboxmunicipios" checked="" type="checkbox">
                    <label for="checkboxmunicipios"> <?php echo pll_e('Municipios del vino'); ?> </label>
                </div>
                <div class="checkbox checkbox-custom restaurantes-cercanos">
                    <input id="checkboxrestaurantes" checked="" type="checkbox">
                    <label for="checkboxrestaurantes"> <?php echo pll_e('Restaurantes'); ?> </label>
                </div>

                <div class="checkbox checkbox-custom alojamientos-cercanos">
                    <input id="checkboxalojamientos" checked="" type="checkbox">
                    <label for="checkboxalojamientos"> <?php echo pll_e('Alojamientos'); ?> </label>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 no-padding">

            <input id="lat" type="hidden" value="<?php echo $winery->lat;?>">
            <input id="lng" type="hidden" value="<?php echo $winery->lng;?>">

            <div id="mapa" style=" width: 100%">
                 <input id="pac-input" class="controls" type="hidden" placeholder="">
                 <div style="clear:both"></div>
                 <div id="map_canvas" style="height:800px;width:100%"></div>
            </div>

            <script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=initialize&libraries=places&key=<?php echo GOOGLE_API_KEY ?>"></script>
            <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8238.536823846713!2d-2.8508138713765354!3d42.574198742708425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd454b924ef7dcbb%3A0x787ffa5ea69b298e!2sLa+Rioja!5e0!3m2!1ses!2ses!4v1525880835774" width="100%" height="800" frameborder="0" style="border:0" allowfullscreen></iframe> -->
        </div>
        <!-- titulo-->
    </div>
    <!-- SECCION: MAPA UBICACION BODEGA -->
    <!-- ANCLAS ANIMADAS-->
    <script>
    jQuery(function(){

         jQuery('a[href*=#]').click(function() {

         if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
             && location.hostname == this.hostname) {

                 var $target = jQuery(this.hash);
				 var $header = jQuery("#sp-header");

                 $target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');

                 if ($target.length) {

					 var headerSize = $header.outerHeight() + $header.offset().top;

                     var targetOffset = $target.offset().top - headerSize;

                     jQuery('html,body').animate({scrollTop: targetOffset}, 1000);

                     return false;

                }

           }

       });

    });

    </script>
    <!-- ANCLAS ANIMADAS-->
