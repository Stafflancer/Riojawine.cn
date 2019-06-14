<?php
/*
Template Name: FichaBodega
*/
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

define('GRUPOS_MAXIMOS_CATEGORY_ID',2);
define('INSTALACIONES_CATEGORY_ID',3);
define('SERVICIOS_TURISTICOS_CATEGORY_ID',4);
define('TIPOS_VISITA',5);
define('TIPOLOGIAS_CATEGORY_ID',6);

global $wp_query;

if ( get_locale() == 'es_ES'){
    $locale = "Locale: es\r\n";
}

// Crear un flujo
// $options = array(
// 'http'=>array(
// 'method'=>"GET",
// 'header'=>"Locale: es\r\n"
// )
// );
// $context = stream_context_create($options);

// url contra la que atacamos
$ch = curl_init(URL_RIOJAWINE_API. "/cities/" . $wp_query->query_vars['city_url'].'.json');
//a true, obtendremos una respuesta de la url, en otro caso,
//true si es correcto, false si no lo es
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//establecemos el verbo http que queremos utilizar para la petición
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//enviamos el array data
// curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          $locale,
       ));
//obtenemos la respuesta
$response = curl_exec($ch);
// Se cierra el recurso CURL y se liberan los recursos del sistema
curl_close($ch);
if(!$response) {
    $jsonObject = false;
}else{
    $jsonObject = json_decode($response) ;
}

// Abre el fichero usando las cabeceras HTTP establecidas arriba
// $jsonObject = json_decode( file_get_contents(URL_RIOJAWINE_API. "/cities/" . $wp_query->query_vars['city_url'].'.json', false, $context) );

$cityData = $jsonObject->data;
$city = $cityData->City;

// $eventsJsonObject = json_decode(file_get_contents(URL_RIOJAWINE_API. "/cities/events/" . $city->id . '.json', false, $context));
$events = $cityData->Events;
//
// $wineriesJsonObject = json_decode(file_get_contents(URL_RIOJAWINE_API. "/cities/wineries/" . $city->id . '.json', false, $context));
$wineries = $cityData->Wineries;
//
// $imagesJsonObject = json_decode(file_get_contents(URL_RIOJAWINE_API. "/cities/images/" . $city->id . '.json', false, $context));
$images = $cityData->Images;

    if( empty($city->placeholder) ){

        $city_placeholder = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
    }else{

        $city_placeholder = $city->placeholder;
    }

    ?>

    <!-- SECCION: SLIDE FULL SCREEN MUNICIPIO -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 banner-full-bodega" style="background: url('<?php echo $city_placeholder; ?>') no-repeat center center; background-size: cover;">
			<div class="capa_negra_banner"></div>
            <h1><?php echo $city->name; ?><br />
            <span class="euskera"><?php echo $city->name_euskera; ?></span>
        </h1>
        </div>
    </div>
    <!-- SECCION: SLIDE FULL SCREEN MUNICIPIO -->

    <!-- SECCION: MENU MUNICIPIO -->
    <div class="row">
       <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 content-menu-municipio">
          <div class="container no-padding">
             <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 no-padding">
                <ul class="menu-municipio">
                   <li><a href="#seccion-descripcion" title="Descripción"><?php pll_e('Descripción'); ?></a></li>
                   <li><a href="#seccion-galeria" title="Galería"><?php pll_e('Galería'); ?></a></li>
                   <li><a href="#seccion-bodegas" title="Bodegas"><?php pll_e('Bodegas'); ?></a></li>
                   <li><a href="#seccion-actividades" title="Actividades"><?php pll_e('Actividades'); ?></a></li>
                </ul>
             </div>
          </div>
       </div>
    </div>
    <!-- SECCION: MENU MUNICIPIO -->


    <!-- SECCION: INFO MUNICIPIO -->
    <div class="container">
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper">
                        <style>#breadcrumb-5b9f6a964d2df li::after { content: "/" }</style>
                        <ol class="wwp-vc-breadcrumbs " id="breadcrumb-5b9f6a964d2df">
                            <li class="visited"><a href="/">Home</a></li>
                            <li class="visited"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Municipios' ) ) ); ?>"><?php echo pll_e('Municipios'); ?></a></li>
                            <li class="current"><span><?php echo $city->name; ?></span></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div id="seccion-descripcion" class="row">

            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12 description-winery-col">
			<?php if(!empty(trim($city->full_text))){ ?>
                <?php if( strlen($city->full_text) > 140  ){ ?>
                    <div class="b-description_readmore js-description_readmore">
                        <p>
                         <strong><?php pll_e('Descripción del municipio'); ?></strong><br />
                         <?php echo $city->full_text; ?>
                     </p>
                   </div>
                   <script>
                   jQuery(function() {
                     jQuery('.js-description_readmore').moreLines({
                       linecount: 5,
                       baseclass: 'b-description',
                       basejsclass: 'js-description',
                       classspecific: '_readmore',
                       buttontxtmore: "Leer m&aacute;s",
                       buttontxtless: "Leer menos",
                       animationspeed: 250
                     });
                   });
                 </script>
                <?php }else{ ?>
                    <p>
                     <strong><?php pll_e('Descripción del municipio'); ?></strong><br />
                    <?php echo $city->full_text; ?>
                    </p>
                <?php } ?>
			<?php } ?>

                <p>
				<?php if(!empty(trim($city->situation))){ ?>
                   <strong><?php pll_e('Situación'); ?></strong><br />
                   <?php echo $city->situation; ?><br /><br />
				<?php } ?>
				<?php if(!empty(trim($city->surface))){ ?>
                   <strong><?php pll_e('Superficie'); ?></strong><br />
                   <?php echo $city->surface; ?><br /><br />
				<?php } ?>
				<?php if(!empty(trim($city->altitude))){ ?>
                   <strong><?php pll_e('Altitud'); ?></strong><br />
                   <?php echo $city->altitude; ?><br /><br />
				<?php } ?>
				<?php if(!empty(trim($city->weather))){ ?>
                   <strong><?php pll_e('Climatología'); ?></strong><br />
                   <?php echo $city->weather; ?><br /><br />
				<?php } ?>
				<?php if(!empty(trim($city->enoturistic_resources))){ ?>
                   <strong><?php pll_e('Recursos Enoturísticos'); ?></strong><br />
                   <?php echo $city->enoturistic_resources; ?><br /><br />
				<?php } ?>
                </p>

            </div>

            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                <div class="card-bodega shadow-on">
                    <div class="mapa-municipio">
                        <input id="map_canvas_city_lat" type="hidden" value="<?php echo $city->lat;?>">
                        <input id="map_canvas_city_lng" type="hidden" value="<?php echo $city->lng;?>">

                        <div class="sticky-map" id="mapa" style=" width: 100%">
                             <!-- <input id="pac-input1" class="controls" type="hidden" placeholder=""> -->
                             <div style="clear:both"></div>
                             <div id="map_canvas_city"></div>
                        </div>

                        <script src="https://maps.googleapis.com/maps/api/js?v=3&callback=initialize&libraries=places&key=<?php echo GOOGLE_API_KEY ?>" async defer></script>
                    </div>

                    <ul class="datos-municipio">
                        <li><strong><?php pll_e('Teléfono');?></strong>
							<span>
								<?php
								if(empty(trim($city->phone))){
									echo '-';
								} else {?>
									<a href="tel:<?php echo $city->phone; ?>" title="<?php echo $city->phone; ?>"><?php echo $city->phone; ?></a>
								<?php } ?>
							</span>
						</li>
                        <li><strong><?php pll_e('E-mail');?></strong>
							<span>
								<?php
								if(empty(trim($city->email))){
									echo '-';
								} else {?>
									<a href="mailto:<?php echo $city->email; ?>" title="<?php echo $city->email; ?>" target="_blank"><?php echo $city->email; ?></a>
								<?php } ?>
							</span>
						</li>
                        <li><strong><?php pll_e('Web');?></strong>
							<span>
								<?php
								if(empty(trim($city->url))){
									echo '-';
								} else {?>
									<a href="<?php echo $city->url; ?>" title="<?php echo $city->url; ?>" target="_blank"><?php echo $city->url; ?></a>
								<?php } ?>
							</span>
						</li>
                    </ul>

                </div>

            </div>

        </div>
    </div>
    <!-- SECCION: INFO MUNICIPIO -->




    <?php if( count($wineries) ){ ?>

    <!-- SECCION: BODEGAS MUNICIPIO -->
    <div id="seccion-bodegas" class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <!-- items vinos-->
            <!-- titulo-->
            <div class="container">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h2 class="ante-title"><?php pll_register_string('BODEGAS DE %s', 'BODEGAS DE %s'); echo sprintf(pll__('BODEGAS DE %s'), $city->name); ?></h2>
                    <h3 class="pro-title"><?php pll_e('Conoce nuestras bodegas'); ?></h3>
                </div>
            </div>
            <!-- titulo-->
            <div class="container">
                <div class="row">
    <?php
    foreach ($wineries as $key => $item) { ?>

                    <!-- item vino-->
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12 ficha-bodega-municipio">
                        <p class="titulo-bodega"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ) . $item->Winery->url_friendly; ?>" title="<?php echo pll_e('Ver bodega'); ?>"><?php echo $item->Winery->name; ?></a></p>
                        <div class="imagen-bodega">
                            <?php
                            $file = $item->Winery->placeholder;
        					$file_headers = @get_headers($file);

        					$winery_placeholder = $item->Winery->placeholder;
        					if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
        						$exists = false;
        						$winery_placeholder= get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
        						// $url_logo = get_stylesheet_directory_uri() . '';
        					}
                            ?>
                            <div class="velo-gris"></div>
                            <img src="<?php echo $winery_placeholder ?>" alt="<?php echo $item->Winery->name; ?>" class="image-item">
                            <div class="overlay"></div>
                            <div class="boton-overlay"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ) . $item->Winery->url_friendly; ?>" class="btn btn-primary ghost" title="<?php echo pll_e('Ver bodega'); ?>"><?php echo pll_e('Ver bodega'); ?></a></div>
                        </div>
                        <div class="caracteristicas-vino">
                            <!-- <p class="intro-municipio"><?php //echo $item->Winery->text; ?></p> -->
                            <!-- <p><strong><?php // pll_e('Horario'); ?></strong><br />
                            <?php //echo $item->Winery->schedule; ?>
                            </p> -->
                            <!-- <p><strong><?php pll_e('Dirección'); ?></strong><br />
                            <?php //echo $item->Winery->address; ?>
                            <?php //echo $item->Winery->postal_code; ?>, <?php //echo $item->Winery->city; ?> (La Rioja)
                            </p> -->
                            <p><strong><?php  pll_e('Teléfono'); ?></strong><br />
                                <?php
                                if(empty(trim($item->Winery->phone))){
                                    echo '-';
                                } else {?>
                                    <a href="tel:<?php echo $item->Winery->phone ?>" title="<?php echo $item->Winery->phone ?>"><?php echo $item->Winery->phone ?></a>
                                <?php } ?>
                            </p>
                             <p><strong><?php  pll_e('Email'); ?></strong><br />
                                 <?php
                                 if(empty(trim($item->Winery->email))){
                                     echo '-';
                                 } else {?>
                                     <a href="mailto:<?php echo $item->Winery->email ?>" title="<?php echo $item->Winery->email ?>" target="_blank"><?php echo $item->Winery->email ?></a>
                                 <?php } ?>
                            </p>
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
    <!-- SECCION: BODEGAS MUNICIPIO -->
    <?php }  ?>



    <!-- SECCION: GALERIA IMAGENES MUNICIPIO -->
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
                    <h2 class="ante-title"><?php pll_register_string('%s EN IMAGENES', '%s EN IMAGENES'); echo sprintf(pll__('%s EN IMAGENES'), $city->name); ?></h2>
                    <h3 class="pro-title"><?php pll_e('Galería'); ?></h3>
                </div>
            </div>
            <!-- titulo-->

            <div class="container">
                 <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 galeria-municipio gallery-magnific">
                     <?php
                     foreach($images as $image){ ?>
                    <div class="item-galeria-municipio gallery-item">
                        <a href="<?php echo $image->CityImage->url_image; ?>">
                            <img src="<?php echo $image->CityImage->url_image; ?>" title="<?php echo $image->CityImage->name; ?>" />
                            <div class="overlay"></div>
                        </a>
                    </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <!-- elementos galeria-->
    <!-- SECCION: GALERIA IMAGENES MUNICIPIO -->
    <?php
}
    ?>

    <?php if( count($events) ){ ?>

    <!-- SECCION: ACTIVIDADES MUNICIPIO 2 -->
    <div id="seccion-actividades-municipio" class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">


    <div class="container no-padding">
    <div class="row">
    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12">
    <h2 class="ante-title"><?php pll_e('ACTIVIDADES'); ?></h2>
    <h3 class="pro-title"><?php pll_e('Actividades del Municipio'); ?></h3>
    </div>

    <?php foreach( $events as $event ){ ?>

    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12">
    <div class="row">

    <!-- item actividad-->
    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12">
    <div class="imagen-bodega">
    <div class="velo-gris"></div>
    <img src="<?php echo $event->Event->image; ?>" alt="<?php echo $event->EventTranslation[0]->title; ?>" class="image-item">
    <div class="overlay"></div>
    <!-- <div class="boton-overlay"><a href="#nogo" class="btn btn-primary ghost" title="Ver actividad">Ver actividad</a></div> -->
    </div>
    <div class="caracteristicas-vino">
    <p><strong><?php pll_e('Horario'); ?></strong><br />
        <?php foreach( $event->EventSchedule as $schedule ){
            if( !empty(trim($schedule->start)) ){
                $start = date_create($schedule->start);
                echo date_format($start, 'd/m/Y H:i');
            }
            echo " - ";
            if( !empty(trim($schedule->finish)) ){
                $finish = date_create($schedule->finish);
                echo date_format($finish, 'd/m/Y H:i');
            }
            echo "<br>";

        } ?>
    </p>
    </div>
    </div>
    <!-- item actividad-->

    <?php } ?>



    </div>
    </div>


    </div>
    </div>





    </div>
    </div>

    <!-- SECCION: ACTIVIDADES MUNICIPIO 2-->
    <?php } ?>



    <!-- SECCION: MAPA UBICACION MUNICIPIO -->
    <div id="seccion-actividades" class="row">
        <!-- titulo-->
        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 contiene-filtros">
            <div class="contiene-filtros-group">
                <h2 class="ante-title"><?php pll_e('ACTIVIDADES'); ?></h2>
                <h3 class="pro-title"><?php pll_e('Lugares de interés'); ?></h3>
                <!-- <div class="checkbox checkbox-custom municipios-vino">
                    <input id="checkboxmunicipios" checked="" type="checkbox">
                    <label for="checkboxmunicipios"> Municipios del vino </label>
                </div> -->
                <div class="checkbox checkbox-custom restaurantes-cercanos">
                    <input id="checkboxrestaurantes" checked="" type="checkbox">
                    <label for="checkboxrestaurantes"> <?php pll_e('Restaurantes'); ?> </label>
                </div>

                <div class="checkbox checkbox-custom alojamientos-cercanos">
                    <input id="checkboxalojamientos" checked="" type="checkbox">
                    <label for="checkboxalojamientos"> <?php pll_e('Alojamientos'); ?> </label>
                </div>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12 no-padding">

            <input id="lat" type="hidden" value="<?php echo $city->lat;?>">
            <input id="lng" type="hidden" value="<?php echo $city->lng;?>">

            <div id="mapa" style=" width: 100%">
                 <input id="pac-input" class="controls" type="hidden" placeholder="">
                 <div style="clear:both"></div>
                 <div id="map_canvas" style="height:800px;width:100%"></div>
            </div>

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
