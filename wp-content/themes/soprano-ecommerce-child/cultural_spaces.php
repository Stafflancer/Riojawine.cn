<?php
    global $wp_query;
    $page = 1;

    if ( get_locale() == 'es_ES'){
        $locale = "Locale: es\r\n";
    }

    if( isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged']!=0 ){

        $page = $wp_query->query_vars['paged'];
    }

    $getdata = http_build_query(
        array(
            'attributes'=>[58],
            'page' => $page
         )
    );

    $urlWS = URL_RIOJAWINE_API . "/companies.json?" . $getdata;

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

	?>
	<div class="row">
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 cultural-spaces-list">
		<?php
			$limit = 6;
			$start = $limit*($page-1);
			$finish = ($start + $limit) > count($jsonObject->data) ? count($jsonObject->data) : ($start + $limit);

			foreach( $jsonObject->data as $companyData ){ ?>

				<div class="winery-item">
					<h2><?php echo mb_strtoupper($companyData->Company->name) ?></h2>
					<div class="thumbnail">
						<?php
						$file = $companyData->Company->url_logo;
						$file_headers = @get_headers($file);


						$company_placeholder = $companyData->Company->url_logo;
						if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
							$exists = false;
							$company_placeholder = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
                        }
						?>
						<img class="list-companies-img" src="<?php echo $company_placeholder ?>" width="150" />
					</div>

					<div class="detail">
						<ul>
							<li><strong><?php echo pll_e("Ubicación")?></strong><span><?php echo empty(trim($companyData->Company->city)) ? '-' : $companyData->Company->city;  ?></span></li>
							<li><strong><?php echo pll_e("Teléfono")?></strong>
								<span>
									<?php
									if(empty(trim($companyData->Company->phone))){
										echo '-';
									} else {?>
										<a href="tel:<?php echo $companyData->Company->phone ?>" title="<?php echo $companyData->Company->phone ?>"><?php echo $companyData->Company->phone ?></a>
									<?php } ?>
								</span>
							</li>
							<li><strong>Email</strong>
								<span>
									<?php
										if(empty(trim($companyData->Company->email))){
											echo '-';
										} else {?>
											<a href="mailto:<?php echo $companyData->Company->email ?>" title="<?php echo $companyData->Company->email ?>" target="_blank"><?php echo $companyData->Company->email ?></a>
									<?php } ?>
								</span>
							</li>
						</ul>
					</div>
					<div class="rioja_button_container">
						  <a class="btn btn-primary outline" href="<?php echo get_permalink() . $companyData->Company->url_friendly; ?>"><?php echo pll_e("Ver Ficha")?></a>
					</div>

				</div>
				<?php
                $locations[] = ["name" => $companyData->Company->name, "image" => $company_placeholder, "phone" => $companyData->Company->phone, "lat"=>$companyData->Company->lat, "lng"=>$companyData->Company->lng, "is_exact"=> true];
			}
		?>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 sticky-map">
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

    <div class="row pagination">
    <?php echo custom_paginate($limit, $jsonObject->current_page, $jsonObject->total_pages, [] ); ?>
    </div>
