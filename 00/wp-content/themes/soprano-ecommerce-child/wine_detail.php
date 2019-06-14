<?php
/*
Template Name: FichaBodega
*/
! defined( 'ABSPATH' ) AND exit( 'Forbidden!' );

global $wp_query;

if ( get_locale() == 'es_ES'){
    $locale = "Locale: es\r\n";
}

// Abre el fichero usando las cabeceras HTTP establecidas arriba
// $jsonObject = json_decode( file_get_contents('http://api.riojawine.com/wines/'.$wp_query->query_vars['wine_url'].'.json', false, $context) );

$url_WS = URL_RIOJAWINE_API . "/wines/".$wp_query->query_vars['wine_url'].'.json';

// url contra la que atacamos
$ch = curl_init($url_WS);
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

$wineData = $jsonObject->data;

// var_dump($wineryData);
$wine = $wineData->Wine;
$wineType  =  $wineData->WineType;
$grapes =  $wineData->Grape;
$wineTranslation = $wineData->WineTranslation[0];

//--------------- Bodega ------------------
// Abre el fichero usando las cabeceras HTTP establecidas arriba
// $jsonObject = json_decode( file_get_contents('http://api.riojawine.com/wineries/'.$wp_query->query_vars['winery_url'].'.json', false, $context) );

// $wineryData = $jsonObject->data;
$winery = $wineData->Winery;
//----------------------------------------

//--------------- Otros Vinos ------------------

// $winesJsonObject = json_decode(file_get_contents("http://api.riojawine.com/wineries/wines/" . $winery->id . '.json', false, $context));

$url_WS = URL_RIOJAWINE_API . "/wines/".$winery->id.'.json';

// url contra la que atacamos
$ch = curl_init($url_WS);
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
    $winesJsonObject = false;
}else{
    $winesJsonObject = json_decode($response) ;
}

$wines = $winesJsonObject->data;

//----------------------------------------
?>

<!-- seccion SLIDE FULLSCREEN bodega -->
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
                        <li class="current"><span><?php echo $wine->name; ?></span></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12 wine_detail">
            <h1><?php echo $wine->name;?></h1>
            <h2><?php echo $winery->name;?></h2>
            <p>
            <?php echo $wineTranslation->text; ?>
            </p>

            <div class="caracteristicas-vino">
               <div class="datos-vol-grape">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-tipo.png" alt=" " /><p><?php echo pll_e('Tipo:'); ?> <?php echo $wineType->name; ?></p>
				</div>
               <div class="datos-vol-grape">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-volumen.png" alt=" " /><p><?php echo pll_e('Alcohol: Vol.'); ?> <?php echo $wine->alcohol; ?>%</p>
				</div>
               <div class="datos-vol-grape">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-variedades.png" alt=" " /><p><?php echo pll_e('Tipos de uva:'); ?> <?php
                $grapeNames = array();
                foreach ($grapes as $key => $grape) {
                    $grapeNames[] = $grape->name;
                }
                echo implode(', ', $grapeNames);
                ?></p>
				</div>
               <div class="datos-vol-grape">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-anada.png" alt=" " /><p><?php echo pll_e('Añada:'); ?> <?php echo $wine->year;?></p>
				</div>

                <div class="datos-vol-grape">
                    <p><?php echo pll_e('Ver ficha de cata:'); ?></p>
 				</div>

            </div>

            <div class="rioja_button_container" style="text-align:left">
            <a href="javascript: history.go(-1)" class="btn btn-primary outline" target="_self"><?php echo pll_e('Volver'); ?></a>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
           	<div class="wine-detail-image">
            <?php
            $file = $wine->url_image;
            $file_headers = @get_headers($file);

            $wine_placeholder = $wine->url_image;
            if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

                $file = $wine->url_label;
                $file_headers = @get_headers($file);

                $wine_placeholder = $wine->url_label;
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {

                    $exists = false;
                    $wine_placeholder= get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
                // $url_logo = get_stylesheet_directory_uri() . '';
                }

            }
            ?>
            <img src="<?php echo $wine_placeholder; ?>" alt="<?php echo $wine->name;?>" class=" ">
            </div>
        </div>
    </div>
</div>
<!-- seccion SLIDE FULLSCREEN bodega -->



<!-- seccion CONOCE NUESTROS VINOS-->
<?php if(count($wines) > 1 ){ ?>
<div id="seccion-vinos" class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

        <!-- items vinos-->
        <!-- titulo-->
        <div class="container">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <h2 class="ante-title"><?php echo pll_e('OTROS VINOS DE'); ?></h2>
            <h3 class="pro-title"><?php echo $winery->name; ?></h3>

            </div>
        </div>
        <!-- titulo-->

        <div class="container">
            <div class="row">

                <?php
                foreach ($wines as $key => $item) {

                    if( $item->Wine->id == $wine->id ) continue;

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
                            <img src="<?php echo $item->Wine->url_label; ?>" alt="<?php echo $item->Wine->name; ?>" class="image-item">
                            <div class="overlay"></div>
                            <div class="boton-overlay"><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ) . $wineryData->Winery->url_friendly . '/' . $item->Wine->url_friendly; ?>" class="btn btn-primary ghost" title="<?php echo pll_e('Ver ficha del vino'); ?>"><?php echo pll_e('Ver ficha del vino'); ?></a></div>
                        </div>
                        <div class="caracteristicas-vino">
                            <div class="datos-vol-grape">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-volumen.png" alt=" " />
                                <p><?php echo pll_e('Alcohol: Vol.'); ?> <?php echo $item->Wine->alcohol; ?>%</p>
                            </div>
                            <div class="datos-vol-grape">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img_bodegas/icon-variedades.png" alt=" " />
                                <p><?php echo pll_e('Tipos de uva:'); ?> <?php echo implode(', ', $grapeNames); ?></p>
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
<?php } ?>
<!-- items vinos-->
<!-- seccion CONOCE NUESTROS VINOS-->
