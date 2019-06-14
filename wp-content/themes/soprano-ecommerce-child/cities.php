<?php
    global $wp_query;
    $page = 1;

    if ( get_locale() == 'es_ES'){
        $locale = "Locale: es\r\n";
    }

    $ip=$_SERVER['REMOTE_ADDR'];
    $hour=date("H");
    // $hour='17';
    $day=date("j");
    $month=date("n");
    $ip=str_replace(".","",$ip);
    $seed=($ip+$hour+$day+$month);

    if( isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged']!=0 ){

        $page = $wp_query->query_vars['paged'];
    }

    $citiesURL = URL_RIOJAWINE_API . "/cities.json?with_wineries=false&order=5&seed=" . $seed;

    $urlParameters = [];

    if( isset( $wp_query->query_vars['term'] ) && !empty( $wp_query->query_vars['term'] ) ){

        $citiesURL .= '&search=' . urlencode(esc_html($wp_query->query_vars['term']));

        $urlParameters[] = 'term='. urlencode(esc_html($wp_query->query_vars['term']));
    }

    if( count($urlParameters) ){

        $urlParams = '/?' . implode('&', $urlParameters);
    }

    // url contra la que atacamos
    $ch = curl_init($citiesURL);
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

    // $jsonObject = json_decode(file_get_contents( $citiesURL ) );

	if( isset( $wp_query->query_vars['term'] ) && !empty($wp_query->query_vars['term']) ){ 
		$text_result = count( $jsonObject->data ) == 1 ? pll__(" resultado") : pll__(" resultados"); ?>
		<div class="row">
			<p class="search-result-wineries"><strong><?php echo count( $jsonObject->data ) . ' ' . $text_result; ?></strong> <?php echo pll_e("de la búsqueda del término")?> "<strong><?php echo esc_html($wp_query->query_vars['term']); ?></strong>" <a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Municipios' ) ) ); ?>"><?php echo pll_e("Volver al listado completo")?></a></p>
			
		</div><?php
    }

	

    if( count($jsonObject->data) ){

    $current_page = $page;
    if( $page > count($jsonObject->data)/6 ){ $current_page = 1; }

    ?>
    <div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 cities-list">
        <?php
        $limit = 6;
        $start = $limit*($page-1);
        $finish = ($start + $limit) > count($jsonObject->data) ? count($jsonObject->data) : ($start + $limit);

        for ( $i = $start; $i<$finish; $i++ ){

			$wineryData = $jsonObject->data[$i];?>

        <div class="winery-item">
				<h2><a href="<?php echo get_permalink() . $wineryData->City->url_friendly; ?>"><?php echo mb_strtoupper($wineryData->City->name) ?></a></h2>
        	<div class="thumbnail">
                <?php
                $file = $wineryData->City->placeholder;
                $file_headers = @get_headers($file);

                $placeholder = $wineryData->City->placeholder;
                if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
                    $exists = false;
                    $winery_logo_class='winery-no-logo';
                    $placeholder = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
                }

                if( ( !empty($wineryData->City->lat) && !empty($wineryData->City->lng))
                    && $wineryData->City->lat != "91.000000000000000" && $wineryData->City->lng != "181.000000000000000" ){
                    $locations[] = ["name" => $wineryData->City->name, "image" => $winery_placeholder, "phone" => $wineryData->City->phone, "lat"=>$wineryData->City->lat, "lng"=>$wineryData->City->lng, "is_exact"=> true];
                }
                ?>
        		<a href="<?php echo get_permalink() . $wineryData->City->url_friendly; ?>"><img class="list-wineries-img" src="<?php echo $placeholder ?>" width="150" /></a>
        	</div>
        	<div class="detail">

                <ul>
        			<li><strong><?php echo pll_e("Zona")?></strong><span>
       		               <?php echo empty(trim($wineryData->City->zone_name))? '-' : $wineryData->City->zone_name; ?>

                       </span></li>
        		    <li><strong><?php echo pll_e("Teléfono")?></strong>
                        <span>
                            <?php
                            if(empty(trim($wineryData->City->phone))){
                                echo '-';
                            } else {?>
                                <a href="tel:<?php echo $wineryData->City->phone ?>" title="<?php echo $wineryData->City->phone ?>"><?php echo $wineryData->City->phone ?></a>
                            <?php } ?>
                        </span>
                    </li>
        			<li><strong><?php echo pll_e("Email")?></strong>
                        <span>
                            <?php
                            if(empty(trim($wineryData->City->email))){
                                echo '-';
                            } else {?>
                                <a href="mailto:<?php echo $wineryData->City->email ?>" title="<?php echo $wineryData->City->email ?>" target="_blank"><?php echo $wineryData->City->email ?></a>
                            <?php } ?>
                        </span>
                    </li>
        		</ul>
        	</div>
        	<div class="rioja_button_container">
        	      <a class="btn btn-primary outline" href="<?php echo get_permalink() . $wineryData->City->url_friendly; ?>"><?php echo pll_e('Más info'); ?></a>
        	</div>
        </div>
	    <?php

        // $locations[] = ["name" => $wineryData->City->name, "image" => $placeholder, "phone" => $wineryData->City->phone, "lat"=>$wineryData->City->lat, "lng"=>$wineryData->City->lng, "is_exact"=> true];
    }
    ?>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 sticky-map">

        <div class="sticky-map" id="mapa" style=" width: 100%">
             <input id="pac-input" class="controls" type="hidden" placeholder="">
             <div style="clear:both"></div>
             <div id="map_canvas"></div>
        </div>

        <script>var LOCATIONS = <?php echo json_encode($locations); ?>;</script>
        <script src="<?php echo get_stylesheet_directory_uri() . '/js/list-locations.js' ?>" ></script>
        <script src="https://maps.googleapis.com/maps/api/js?v=3&callback=drawMap&libraries=places&key=<?php echo GOOGLE_API_KEY ?>" async defer></script>
    </div>
</div>
<?php } ?>

<div class="row pagination">
    <?php echo custom_paginate($limit, $page, ceil(count($jsonObject->data)/$limit), $urlParams ); ?>
</div>
