<?php
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );
define( 'WineryDataTypeExtended', 1 );
define( 'WineryDataTypeNormal', 2 );
define( 'WineryDataTypeBasic', 3 );

define('GRUPOS_MAXIMOS_CATEGORY_ID',2);
define('INSTALACIONES_CATEGORY_ID',3);
define('SERVICIOS_TURISTICOS_CATEGORY_ID',4);
define('TIPOS_VISITA',5);
define('TIPOLOGIAS_CATEGORY_ID',6);

global $wp_query;

if ( get_locale() == 'es_ES'){
    $locale = "Locale: es\r\n";
}

pll_register_string("First", "First");
pll_register_string("Previous", "Previous");
pll_register_string("Page", "Page");
pll_register_string("Next", "Next");
pll_register_string("Last", "Last");

$__first = pll__("First");
$__previous  = pll__("Previous");
$__page = pll__("Page");
$__next  = pll__("Next");
$__last  = pll__("Last");
// $first = pll__("First");
// echo "*" . $first. "*";

// $jsonObject = callAPI('GET', URL_RIOJAWINE_API. "/wineries/" . $wp_query->query_vars['winery_url'].'.json', null, $locale);
// $wineryData = $jsonObject->data;
// $winery = $wineryData->Winery;

$ch = curl_init(URL_RIOJAWINE_API. "/wineries/" . $wp_query->query_vars['winery_url'].'.json');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
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

$wineryData = $jsonObject->data;
$winery = $wineryData->Winery;

//--------------------------------------------------

$wines = $wineryData->Wines;

//--------------------------------------------------

$images = $wineryData->Images;

//--------------------------------------------------

// Atributos
$groupedAttributes = [];
foreach( $wineryData->Attribute as $attribute ){

    if( !isset( $groupedAttributes[ $attribute->AttributeCategory->id ] ) ){
        $groupedAttributes[ $attribute->AttributeCategory->id ]['name'] =  $attribute->AttributeCategory->AttributeCategoryTranslation[0]->name;
    }

    $groupedAttributes[ $attribute->AttributeCategory->id ]['items'][] =  $attribute->AttributeTranslation[0]->name;
}

//Vinos
$groupedWines = [];
foreach ($wines as $key => $item) {

    if( !isset( $groupedWines[ $item->WineryType->id ] ) ){
        $groupedWines[ $item->WineType->id ]['name'] =  $item->WineType->name;
        $groupedWines[ $item->WineType->id ]['color'] =  $item->WineType->color;
    }

    $groupedWines[ $item->WineType->id ]['items'][] =  $item->Wine->name;
}

if( empty($winery->placeholder) ){

    $winery_placeholder = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
}else{

    $winery_placeholder = $winery->placeholder;
}
?>

<!-- SECCION: SLIDE FULL SCREEN BODEGA -->
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 banner-full-bodega" style="background: url('<?php echo $winery_placeholder; ?>') no-repeat center center; background-size: cover;">
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
                    <?php if(strlen($winery->text) || strlen($winery->full_text) ){ ?><li><a href="#seccion-descripcion" title="Descripción"><?php echo pll_e('Descripción'); ?></a></li><?php } ?>
                    <?php if( count($groupedAttributes) ){ ?><li><a href="#seccion-servicios" title="Servicios e Instalaciones"><?php echo pll_e('Servicios e Instalaciones'); ?></a></li><?php } ?>
                    <?php if( count($images) ){ ?><li><a href="#seccion-galeria" title="Galería"><?php echo pll_e('Galería'); ?></a></li><?php } ?>
                    <?php if( count($wines) ){ ?><li><a href="#seccion-vinos" title="Nuestos vinos"><?php echo pll_e('Vinos'); ?></a></li><?php } ?>
                    <?php if( !empty($winery->lat) && !empty($winery->lng) ){ ?><li><a href="#seccion-actividades" title="Actividades"><?php echo pll_e('Actividades'); ?></a></li><?php } ?>
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
							<li class="visited"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ); ?>"><?php echo pll_e('Las Bodegas'); ?></a></li>
						<?php
						}else{
						?>
							<li class="visited"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Wineries' ) ) ); ?>"><?php echo pll_e('Las Bodegas'); ?></a></li>
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


                <h5 class="b-description_readmore js-description_readmore">
                <?php if(strlen($winery->text)){ ?>
                    “<?php echo $winery->text; ?>”
                <?php } ?>
                </h5>
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
                <?php
                if( strpos(strtolower($winery->zone_name), 'alta') !== false ){ ?>
                    <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/mapa-rioja-alta-ficha-bodega.png" /><?php

                }else if( strpos(strtolower($winery->zone_name), 'alavesa') !== false ){ ?>
                    <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/mapa-rioja-alavesa-ficha-bodega.png" /><?php

                }else if( strpos(strtolower($winery->zone_name), 'oriental') !== false || strpos($winery->zone_name, 'baja') !== false ){ ?>
                    <img src="<?php echo WP_CONTENT_URL; ?>/uploads/custom-img/mapa-rioja-oriental-ficha-bodega.png" /><?php

                }
                ?>

                <ul class="datos-bodega">
                    <li><strong><?php echo pll_e('Zona producción'); ?></strong> <span><?php echo $winery->zone_name; ?><?php //echo empty($winery->city) ? '' : '-' . $winery->city; ?></span></li>
                    <li><strong><?php echo pll_e('Ubicación'); ?></strong> <span><?php echo $winery->address; ?></span></li>
                    <li><strong><?php echo pll_e('E-mail'); ?></strong> <span><a href="mailto:<?php echo $winery->email; ?>" title="E-mail de <?php echo $winery->name; ?>" target="_blank"><?php echo $winery->email; ?></a></span></li>
                    <li><strong><?php echo pll_e('Teléfono'); ?></strong> <span><a href="tel:<?php echo $winery->phone; ?>" title="Teléfono de <?php echo $winery->name; ?>"><?php echo $winery->phone; ?></a></span></li>
                    <li><strong><?php echo pll_e('Web'); ?></strong> <span><a href="<?php echo $winery->url; ?>" title="Web de <?php echo $winery->name; ?>. Abre ventana nueva. La información ofrecida no es responsabilidad del Consejo Regulador." target="_blank"><?php echo $winery->url; ?></a></span></li>

                    <?php if( !empty($winery->url_shop) ){ ?>
                    <li><strong><?php echo pll_e('Tienda online'); ?></strong> <span><a href="<?php echo $winery->url_shop; ?>" title="Abre ventana nueva. La información ofrecida no es responsabilidad del Consejo Regulador." target="_blank"> <?php echo $winery->name; ?></a></span></li>
                    <?php } ?>
                </ul>
                <?php if( !empty( $winery->url_visits ) ){ ?>
                <a href="<?php echo $winery->url_visits; ?>" class="btn btn-primary" title="Visita nuestra bodega"><?php echo pll_e('Visita nuestra bodega'); ?></a>
                <?php } ?>
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

<?php if( count($groupedAttributes) ){ ?>
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
            <?php
            $items = $groupedAttributes[ TIPOLOGIAS_CATEGORY_ID ]['items'];
            if(count($items)){
            ?>
            <p class="list-title"><?php echo pll_e('Tipo Bodega'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php

                foreach ($items as $key => $value) { ?>
                    <li><?php echo $value; ?></li><?php
                }
                ?>
               <!-- <li>Aquitectura contemporánea</li>
               <li>Entorno de viñedos</li>
               <li>Atractivos singulares</li> -->
            </ul>
            <?php } ?>
            <?php
            $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
            if(count($items)){
            ?>
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
            <?php } ?>
         </div>
         <!-- columna 1-->
         <!-- columna 2-->
         <div class="servicios-bodega">
             <?php
             $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
             if(count($items)){
             ?>
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
            <?php } ?>
            <?php
            $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
            if(count($items)){
            ?>
            <p class="list-title"><?php echo pll_e('Idiomas'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php
                $languages = $wineryData->Language;
                // var_dump($languages);
                foreach ($languages as $key => $language) { ?>
                    <li><?php echo $language->LanguageTranslation[0]->name; ?></li><?php
                }
                ?>
            </ul>
            <?php } ?>
            <?php
            $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
            if(count($items)){
            ?>
            <p class="list-title"><?php echo pll_e('Capacidad de los grupos'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php
                $items = $groupedAttributes[ GRUPOS_MAXIMOS_CATEGORY_ID ]['items'];
                foreach ($items as $key => $value) { ?>
                    <li><?php echo $value; ?></li><?php
                }
                ?>
            </ul>
            <?php } ?>
            <?php
            $items = $groupedAttributes[ TIPOS_VISITA ]['items'];
            if(count($items)){
            ?>
            <p class="list-title"><?php echo pll_e('Días de visita'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php
                if ($winery->visit_monday==1 || $winery->visit_tuesday==1 || $winery->visit_wednesday==1 || $winery->visit_thursday==1 || $winery->visit_friday==1 || $winery->visit_saturday==1 || $winery->visit_sunday==1){
                    // Opciones (Lunes a Viernes, Lunes a Sabado, Lunes a Domingo, Martes a Domingo, Martes a Sabado)
                    $long_schedule = false;
                    if ($winery->visit_monday==1 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==1){
                        echo pll_e('De Lunes a Domingo');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==1 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==0){
                        echo pll_e('De Lunes a Sábado');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==1 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==0 && $winery->visit_sunday==0){
                        echo pll_e('De Lunes a Viernes');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==1){
                        echo pll_e('De Martes a Domingo');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==0){
                        echo pll_e('De Martes a Sábado');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==1 && $winery->visit_wednesday==1 && $winery->visit_thursday==1 && $winery->visit_friday==1 && $winery->visit_saturday==0 && $winery->visit_sunday==0){
                        echo pll_e('De Martes a Viernes');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==0 && $winery->visit_wednesday==0 && $winery->visit_thursday==0 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==1){
                        echo pll_e('De Viernes a Domingo');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==0 && $winery->visit_wednesday==0 && $winery->visit_thursday==0 && $winery->visit_friday==0 && $winery->visit_saturday==1 && $winery->visit_sunday==1){
                        echo pll_e('De Sábado a Domingo');
                        $long_schedule = true;
                    } else if ($winery->visit_monday==0 && $winery->visit_tuesday==0 && $winery->visit_wednesday==0 && $winery->visit_thursday==0 && $winery->visit_friday==1 && $winery->visit_saturday==1 && $winery->visit_sunday==0){
                        echo pll_e('De Viernes a Sábado');
                        $long_schedule = true;
                    }
                    ?>
                    <?php
                    if (!$long_schedule){
                        echo "<strong>".pll_e('Días Sueltos:')."</strong> ";
                                $coma = false;
                                if ($winery->visit_monday==1){
                                    $coma = true;
                                    echo pll_e('Lunes');
                                }
                                if ($winery->visit_tuesday==1){
                                    if ($coma){ echo ", "; }
                                    $coma=true;
                                    echo pll_e('Martes');
                                }
                                if ($winery->visit_wednesday==1){
                                    if ($coma){ echo ", "; }
                                    $coma=true;
                                    echo pll_e('Miércoles');
                                }
                                if ($winery->visit_thursday==1){
                                    if ($coma){ echo ", "; }
                                    $coma=true;
                                    echo pll_e('Jueves');
                                }
                                if ($winery->visit_friday==1){
                                    if ($coma){ echo ", "; }
                                    $coma=true;
                                    echo pll_e('Viernes');
                                }
                                if ($winery->visit_saturday==1){
                                    if ($coma){ echo ", "; }
                                    $coma=true;
                                    echo pll_e('Sábado');
                                }
                                if ($winery->visit_sunday==1){
                                    if ($coma){ echo ", "; }
                                    echo pll_e('Domingo');
                                }

                   } ?>

            <?php

            } ?>

            </ul>
            <?php } ?>
            <?php if ( !empty($winery->visit_price) ){ ?>
            <p class="list-title"><?php echo pll_e('Precio de la Visita'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php echo pll_e('Desde'); ?>
                <?php
                echo $winery->visit_price . "€";
                ?>
            </ul>
            <?php } ?>
         </div>
         <!-- columna 2-->
         <!-- columna 3-->
         <div class="servicios-bodega">
            <?php
            $items = $groupedAttributes[ INSTALACIONES_CATEGORY_ID ]['items'];
            if( count($items) ){
            ?>
            <p class="list-title"><?php echo pll_e('Instalaciones'); ?></p>
            <ul class="caracteristicas-bodega">
                <?php

                foreach ($items as $key => $value) { ?>
                    <li><?php echo $value; ?></li><?php
                }
                ?>
               <!-- <li>Aquitectura contemporánea</li>
               <li>Entorno de viñedos</li>
               <li>Atractivos singulares</li> -->
            </ul>
        <?php } ?>
         </div>
         <!-- columna 3-->
      </div>
   </div>
</div>
<!-- SECCION: SERVICIOS E INSTALACIONES BODEGA -->
<?php } ?>

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
                <h2 class="ante-title"><?php pll_register_string("%s EN IMAGENES", "%s EN IMÁGENES"); echo sprintf(pll__("%s EN IMAGENES"), $winery->name); ?> <?php //echo $winery->name; ?> <!-- EN IMÁGENES --></h2>
                <h3 class="pro-title"><?php echo pll_e('Galería'); ?></h3>
            </div>
        </div>
        <!-- titulo-->

        <div class="container">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="grid gallery-magnific">
                    <div class="grid-sizer"></div>
<?php
// TRAMPEO DE ARRAY DE GALERIA

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
            <a href="<?php echo $image->WineryImage->url_image; ?>">
                <img src="<?php echo $image->WineryImage->url_image; ?>" title="<?php echo $image->WineryImage->name; ?>" /><?php

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
<?php
}
?>

<?php if( count($wines) ){ ?>

<!-- SECCION: GALERIA VINOS BODEGA -->
<div id="seccion-vinos" class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <!-- items vinos-->
        <!-- titulo-->
        <div class="container">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2 class="ante-title"><?php pll_register_string("VINOS DE %s", "VINOS DE %s"); echo sprintf(pll__("VINOS DE %s"), $winery->name); ?> <!--VINOS DE --> <?php //echo $winery->name; ?></h2>
                <h3 class="pro-title"><?php echo pll_e('Conoce nuestros vinos'); ?></h3>
                <!-- <p class="intro-conoce">Denominación de Origen desde 1925 y primera Denominación de Origen Calificada desde 1991, los vinos Rioja son internacionalmente reconocidos y comercializados en más de 100 países diferentes.</p> -->
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
                        <?php
                        $file = $item->Wine->url_image;
                        $file_headers = @get_headers($file);

                        $wine_placeholder = $item->Wine->url_image;
                        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

                            $file = $item->Wine->url_label;
                            $file_headers = @get_headers($file);

                            $wine_placeholder = $item->Wine->url_label;
                            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

                                $exists = false;
                                $wine_placeholder= get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
                            // $url_logo = get_stylesheet_directory_uri() . '';
                            }

                        }
                        ?>
                        <img src="<?php echo $wine_placeholder; ?>" alt="<?php echo $item->Wine->name; ?>" class="image-item">
                        <div class="overlay"></div>
						<?php
						if ( get_locale() == 'es_ES'){
						?>
							<div class="boton-overlay"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ) . $wineryData->Winery->url_friendly . '/' . $item->Wine->url_friendly; ?>" class="btn btn-primary ghost" title="<?php echo pll_e('Ver ficha del vino'); ?>"><?php echo pll_e('Ver ficha del vino'); ?></a></div>
						<?php
						}else{
						?>
							<div class="boton-overlay"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Wineries' ) ) ) . $wineryData->Winery->url_friendly . '/' . $item->Wine->url_friendly; ?>" class="btn btn-primary ghost" title="<?php echo pll_e('Ver ficha del vino'); ?>"><?php echo pll_e('Ver ficha del vino'); ?></a></div>
						<?php
						}
						?>                    
					</div>
                    <div class="caracteristicas-vino">
                        <div class="datos-vol-grape">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-volumen.png" alt=" " />
                            <p>Vol. <?php echo $item->Wine->alcohol; ?>%</p>
                        </div>
                        <div class="datos-vol-grape">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-variedades.png" alt=" " />
                            <p><?php echo implode(', ', $grapeNames); ?></p>
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
<?php } ?>

<!-- SECCION: MAPA UBICACION BODEGA -->
<div id="seccion-actividades" class="row">
    <!-- titulo-->
    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12 contiene-filtros">
        <div class="contiene-filtros-group">
            <h2 class="ante-title"><?php echo pll_e('ACTIVIDADES'); ?></h2>
            <h3 class="pro-title"><?php echo pll_e('Lugares'); ?><br /><?php echo pll_e('de interés'); ?></h3>

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

        <script src="https://maps.googleapis.com/maps/api/js?v=3&callback=initialize&libraries=places&key=<?php echo GOOGLE_API_KEY ?>"></script>

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
