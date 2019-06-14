<?php
    global $wp_query;

    $getdata = http_build_query(
        array(
            'attributes'=>[75]
         )
    );

    $options = array('http' =>
        array(
            'method'  => 'GET',
            'header'  => "Content-Type: text/xml\r\n",
            'timeout' => 60
        )
    );

    $context = stream_context_create($options);

    if( isset( $wp_query->query_vars['paged'] ) && $wp_query->query_vars['paged']!=0 ){
        $jsonObject = json_decode(file_get_contents( URL_RIOJAWINE_API . "/companies.json?".$getdata ."&page=".$wp_query->query_vars['paged'], false, $context));

    }else{
        $jsonObject = json_decode(file_get_contents( URL_RIOJAWINE_API . "/companies.json?".$getdata, false, $context));

    }
    foreach( $jsonObject->data as $companyData ){ ?>
        <div class="winery-item route-item">
			<h2><?php echo mb_strtoupper($companyData->Company->name) ?></h2>
        	<div class="thumbnail">
				<?php
				$file = $companyData->Company->url_logo;
				$file_headers = @get_headers($file);

				$url_logo = $companyData->Company->url_logo;
				if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
					$exists = false;
					$url_logo = get_stylesheet_directory_uri() . '/img_bodegas/imagenes-bodega/bodega.jpg';
				}
				 ?>
				<img class="list-companies-img" src="<?php echo $url_logo ?>" width="150" />
        	</div>

        	<div class="detail">
                <ul>
        			<li><strong><?php echo pll_e("Ubicación")?></strong><span><?php echo empty(trim($companyData->Company->city)) ? '-' : $companyData->Company->city; ?></span></li>
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
        			<li><strong><?php echo pll_e("Email")?></strong>
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
        	      <a class="btn btn-primary outline" href="<?php echo $companyData->Company->url; ?>" target="_blank"><?php echo pll_e("Ver Web")?></a>
        	</div>

        </div>
	    <?php
    }

    echo '<div class="row pagination">';
    // To generate links, we call the pagination function here.
    echo paginate_function(8, $jsonObject->current_page, $jsonObject->total_pages);
    echo '</div>';


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
                $pagination .= '<li class="first"><a href="'. get_permalink() .'" data-page="1" title="First">&laquo;</a></li>'; //first link
                $pagination .= '<li><a href="'. get_permalink() .'page/'.$previous_link.'" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                    for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                        if($i > 0){
                            $pagination .= '<li><a href="'. get_permalink() .'page/'.$i.'" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                        }
                    }
                $first_link = false; //set first link to false
            }

            if($first_link){ //if current active page is first link
                $pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
            }elseif($current_page == $total_pages){ //if it's the last active link
                $pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
            }else{ //regular current link
                $pagination .= '<li><a href="#" class="active">'.$current_page.'</a></li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages){
                    $pagination .= '<li><a href="'. get_permalink() .'page/'.$i.'" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages){
                    $next_link = ($i > $total_pages)? $total_pages : $i;
                    $pagination .= '<li><a href="'. get_permalink() .'page/'.$next_link.'" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                    $pagination .= '<li class="last"><a href="'. get_permalink() .'page/'.$total_pages.'" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }
?>
