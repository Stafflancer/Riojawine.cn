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
    //     $jsonObject = json_decode(file_get_contents( URL_RIOJAWINE_API . "/wineries.json?order=5&seed=" . $seed));
        $page = $wp_query->query_vars['paged'];
    }

    $urlWineriesWS = URL_RIOJAWINE_API . "/wineries.json?order=5&seed=" . $seed;

    $urlParameters = [];

    if( isset( $wp_query->query_vars['term'] ) && !empty($wp_query->query_vars['term']) ){

        $urlWineriesWS .= '&search='.urlencode(esc_html($wp_query->query_vars['term']));

        $urlParameters[] = 'term='. urlencode(esc_html($wp_query->query_vars['term']));

    }

    if( isset( $wp_query->query_vars['wineries_types'] ) && $wp_query->query_vars['wineries_types']!=0 ){

        $urlWineriesWS .= '&attributes='.$wp_query->query_vars['wineries_types'];

        $urlParameters[] = 'wineries_types=' . $wp_query->query_vars['wineries_types'];
    }

    if( count($urlParameters) ){

        $urlParams = '/?' . implode('&', $urlParameters);
    }

    // url contra la que atacamos
    $ch = curl_init($urlWineriesWS);
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

    // $jsonObject = json_decode(file_get_contents( $urlWineriesWS ));

    if( isset( $wp_query->query_vars['term'] ) && !empty($wp_query->query_vars['term']) ){ 
		$text_result = count( $jsonObject->data ) == 1 ? pll__(" resultado") : pll__(" resultados"); ?>
		<div class="row">
			<p class="search-result-wineries"><strong><?php echo count( $jsonObject->data ) . ' ' . $text_result; ?></strong> <?php echo pll_e("de la búsqueda del término")?> "<strong><?php echo esc_html($wp_query->query_vars['term']); ?></strong>"</p>
		</div><?php
    }

    if( count($jsonObject->data) ){

    $current_page = $page;
    if( $page > count($jsonObject->data)/6 ){ $current_page = 1; }

	echo '<div class="row">';

    	echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 wineries-list">';
		$limit = 6;
		$start = $limit*($current_page-1);
		$finish = ($start + $limit) > count($jsonObject->data) ? count($jsonObject->data) : ($start + $limit);

		for ( $i = $start; $i<$finish; $i++ ){

			$wineryData = $jsonObject->data[$i];?>

			<div class="winery-item">
			<h2><?php echo mb_strtoupper($wineryData->Winery->name) ?></h2>
				<div class="thumbnail">
					<?php
					$file = $wineryData->Winery->placeholder;
					$file_headers = @get_headers($file);

					$winery_placeholder = $wineryData->Winery->placeholder;
					if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
						$exists = false;
						$winery_placeholder= get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
						// $url_logo = get_stylesheet_directory_uri() . '';
					}

                    if( ( !empty($wineryData->Winery->lat) && !empty($wineryData->Winery->lng))
                        && $wineryData->Winery->lat != "91.000000000000000" && $wineryData->Winery->lng != "181.000000000000000" ){
                        $locations[] = ["name" => $wineryData->Winery->name, "image" => $winery_placeholder, "phone" => $wineryData->Winery->phone, "lat"=>$wineryData->Winery->lat, "lng"=>$wineryData->Winery->lng, "is_exact"=> true];
                    }
					?>
					<img class="list-wineries-img" src="<?php echo $winery_placeholder ?>" width="150" />
				</div>
				<div class="detail">
					<ul>
						<li><strong><?php echo pll_e("Zona")?></strong><span><?php echo empty(trim($wineryData->Winery->zone_name)) ? '-' : $wineryData->Winery->zone_name; ?></span></li>
						<li><strong><?php echo pll_e("Teléfono")?></strong>
							<span>
								<?php
								if(empty(trim($wineryData->Winery->phone))){
									echo '-';
								} else {?>
									<a href="tel:<?php echo $wineryData->Winery->phone ?>" title="<?php echo $wineryData->Winery->phone ?>"><?php echo $wineryData->Winery->phone ?></a>
								<?php } ?>
							</span>
						</li>

						<li><strong><?php echo pll_e("Email")?></strong>
							<span>
								<?php
								if(empty(trim($wineryData->Winery->email))){
									echo '-';
								} else {?>
									<a href="mailto:<?php echo $wineryData->Winery->email ?>" title="<?php echo $wineryData->Winery->email ?>" target="_blank"><?php echo $wineryData->Winery->email ?></a>
								<?php } ?>
							</span>
						</li>
					</ul>
				</div>
				<div class="rioja_button_container">
					  <a class="btn btn-primary outline" href="<?php echo get_permalink() . $wineryData->Winery->url_friendly; ?>"><?php echo pll_e('Ver Ficha'); ?></a>
				</div>
			</div>
			<?php
		}
		echo '</div>';

		echo '<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 sticky-map">';
		?>
			<div class="sticky-map" id="mapa" style=" width: 100%">
				 <input id="pac-input" class="controls" type="hidden" placeholder="">
				 <div style="clear:both"></div>
				 <div id="map_canvas"></div>
			</div>

            <script>var LOCATIONS = <?php echo json_encode($locations); ?>;</script>
            <script src="<?php echo get_stylesheet_directory_uri() . '/js/list-locations.js' ?>" ></script>
            <script src="https://maps.googleapis.com/maps/api/js?v=3&callback=drawMap&libraries=places&key=<?php echo GOOGLE_API_KEY ?>" async defer></script>

		<?php
		echo '</div>';

    echo '</div>';
    }
?>

<div class="row pagination">
    <?php echo custom_paginate($limit, $page, ceil(count($jsonObject->data)/$limit), $urlParams ); ?>
</div>
