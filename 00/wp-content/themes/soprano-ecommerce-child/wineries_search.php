<?php
    global $wp_query;

    if( isset( $wp_query->query_vars['term'] ) ){

        if( isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged']!=0 ){
            $jsonObject = json_decode(file_get_contents(URL_RIOJAWINE_API . "/wineries.json?search=".urlencode(esc_html($wp_query->query_vars['term']))."&page=".$wp_query->query_vars['paged']) );
        }else{
            $jsonObject = json_decode(file_get_contents(URL_RIOJAWINE_API . "/wineries.json?search=".urlencode(esc_html($wp_query->query_vars['term'])) ) );
        }
    }
    ?>

	<div class="row">
		<p class="search-result-wineries"><strong><?php echo count( $jsonObject->data ) == 1 ? count( $jsonObject->data ) .  pll_e(" resultado") :  count( $jsonObject->data ) . pll_e(" resultados"); ?></strong> <?php echo pll_e("de la búsqueda del término")?> "<strong><?php echo esc_html($wp_query->query_vars['term']); ?></strong>"</p>
	</div>

    <?php
    if( count( $jsonObject->data ) ){
		?>
		<div class="row">
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
				<?php
				foreach( $jsonObject->data as $wineryData ){

                    $locations[] = ["name" => $wineryData->Winery->name, "lat"=>$wineryData->Winery->lat, "lng"=>$wineryData->Winery->lng, "is_exact"=> true]; ?>

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
							?>
							<img class="list-wineries-img" src="<?php echo $winery_placeholder ?>" width="150" />
						</div>
						<div class="detail">
							<ul>
								<li><strong><?php echo pll_e("Ubicación")?></strong><span><?php echo empty(trim($wineryData->Winery->city)) ? '-' : $wineryData->Winery->city; ?></span></li>
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
							  <a class="btn btn-primary outline" href="<?php echo esc_url( get_permalink( get_page_by_title( 'Bodegas' ) ) ) . $wineryData->Winery->url_friendly; ?>"><?php pll_e('Ver Ficha'); ?></a>
						</div>
					</div>
					<?php
				}
			?>
			</div>

			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 sticky-map">

                <div class="sticky-map" id="mapa" style=" width: 100%">
    				 <input id="pac-input" class="controls" type="hidden" placeholder="">
    				 <div style="clear:both"></div>
    				 <div id="map_canvas"></div>
    			</div>
                <script>
                var map;
                var bounds;
                var locations = <?php echo json_encode($locations); ?>;
                function drawMap() {
                      // var centerMap = new google.maps.LatLng(42.461938, -2.439179);

                      var myOptions = {
                        zoom: 9,
                        // center: centerMap,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: true,
                        fullscreenControl: false
                       }
                      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                      setMarkers(locations);

                      center = bounds.getCenter();
                      map.setCenter(center);
                  }
                  function setMarkers(locations) {
                      bounds = new google.maps.LatLngBounds();

                      for (i=0; i < locations.length; i++) {
                        var location = locations[i];

                        var marker = new google.maps.Marker({
                              position: new google.maps.LatLng(location.lat,  location.lng),
                              // icon: markerIcon,
                              title: location.name,
                              map: map
                            });

                        //extend the bounds to include each marker's position
                        bounds.extend(marker.position);
                      }

                      //now fit the map to the newly inclusive bounds
                      map.fitBounds(bounds);

                      zoomChangeBoundsListener =
                        google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
                            if ( this.getZoom() ){   // or set a minimum
                                this.setZoom(9);  // set zoom here
                            }
                    });

                    setTimeout(function(){google.maps.event.removeListener(zoomChangeBoundsListener)}, 2000);

                      //(optional) restore the zoom level after the map is done scaling
                        // var listener = google.maps.event.addListener(map, "idle", function () {
                        //     map.setZoom(12);
                        //     google.maps.event.removeListener(listener);
                        // });
                  }
                </script>
                <script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false&callback=drawMap&libraries=places&key=<?php echo GOOGLE_API_KEY ?>" async defer></script>
			</div>

		</div>

        <div class="row pagination">
		<?php
        // To generate links, we call the pagination function here.
        echo paginate_function(8, $jsonObject->current_page, $jsonObject->total_pages);
		?>
        </div>
	<?php
    }//else{ ?>

        <!--<p>Con esas palabras de búsqueda no se han encontrado ninguna Bodega</p>-->
	<?php

    //}

    function paginate_function($item_per_page, $current_page, $total_pages)
    {
        $pagination = '';
        if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
            $pagination .= '<ul>';

            $right_links    = $current_page + 3;
            $previous       = $current_page - 3; //previous link
            $next           = $current_page + 1; //next link
            $first_link     = true; //boolean var to decide our first link

            if($current_page > 1){
                $previous_link = ($previous==0)?1:$previous;
                $pagination .= '<li class="first"><a href="'. get_permalink() .'" data-page="1" title="Primero">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="'. get_permalink() .'page/'.$previous_link.'" data-page="'.$previous_link.'" title="Anterior">&lt;</a></li>'; //previous link
                    for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                        if($i > 0){
                            $pagination .= '<li><a href="'. get_permalink() .'page/'.$i.'" data-page="'.$i.'" title="Página'.$i.'">'.$i.'</a></li>';
                        }
                    }
                $first_link = false; //set first link to false
            }

            if($first_link){ //if current active page is first link
                $pagination .= '<li class="first active">'.$current_page.'</li>';
            }elseif($current_page == $total_pages){ //if it's the last active link
                $pagination .= '<li class="last active">'.$current_page.'</li>';
            }else{ //regular current link
                $pagination .= '<li class="active">'.$current_page.'</li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages){
                    $pagination .= '<li><a href="'. get_permalink() .'page/'.$i.'" data-page="'.$i.'" title="Página '.$i.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages){
                    $next_link = ($i > $total_pages)? $total_pages : $i;
                    $pagination .= '<li><a href="'. get_permalink() .'page/'.$next_link.'" data-page="'.$next_link.'" title="Siguiente">&gt;</a></li>'; //next link
                    $pagination .= '<li class="last"><a href="'. get_permalink() .'page/'.$total_pages.'" data-page="'.$total_pages.'" title="Último">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }
?>
