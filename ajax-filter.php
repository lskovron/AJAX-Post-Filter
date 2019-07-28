<?php

//admin ajax
add_action( 'wp_ajax_nopriv_gon_posts_filter', 'gon_posts_filter' );
add_action( 'wp_ajax_gon_posts_filter', 'gon_posts_filter' );

function gon_posts_filter() {

    global $post;

    ob_start();

    $filtered_category_featured = get_posts( array(

        'post_type' => array( 'case_studies_cpt' ),
        'posts_per_page' => -1,
        'tax_query' => array(
        	'relation' => 'AND',
			array(
				'taxonomy' => $_POST['tax'],
				'terms'    => $_POST['id']
			),
            array(
                'taxonomy' => 'case_studies_featured',
                'terms' => 'featured-cs',
                'operator' => 'IN'
            )
		),
        'orderby' => 'date'

    ) );

    // Start the loop
    foreach( $filtered_category_featured as $post ) : setup_postdata( $post ); if(get_field('display')): ?>

          <div class="case-study-row">
            <div class='cs-image'>
              <?php 
              if( get_field('business_logo') && get_field('display')==1 ){
                $cs_img = get_field('business_logo');
                $class = '';
              } else {
                $cs_ind = wp_get_post_terms( get_the_ID() , 'case_studies_industries' );
                $cs_ind = $cs_ind[0];
                $cat_tag = 'category_'.$cs_ind->term_id;
                $cs_img = get_field('industry_logo',$cat_tag);
                $class = 'cs-industry-logo';

              } ?>
              <img src="<?php echo $cs_img['url']; ?>" class="cs-logo img-responsive <?php echo $class; ?>">
            </div>
            <div class='cs-info'>
              <a href="<?php the_permalink(); ?>" style="text-decoration:none;"><h2><?php the_title(); ?></h2></a>
              <?php
              $industries = wp_get_post_terms( get_the_ID() , 'case_studies_industries' );
              $services = wp_get_post_terms( get_the_ID() , 'case_studies_services' );
              $terms = array_merge($industries,$services);
              $pipe = false;
              foreach ($terms as $term) { ?>
                <a href="<?php echo get_term_link($term); ?>" class="featured-link"><?php if($pipe){ echo ' | '; } echo $term->name; ?></a>

              <?php $pipe=true; } ?>
              <a href="<?php the_permalink(); ?>" class="button read-more"><span>Read More</span></a>
            </div>
          </div>

    <?php endif; endforeach; wp_reset_postdata();

    $filtered_category = get_posts( array(

        'post_type' => array( 'case_studies_cpt' ),
        'posts_per_page' => -1,
        'tax_query' => array(
        	'relation' => 'AND',
			array(
				'taxonomy' => $_POST['tax'],
				'terms'    => $_POST['id']
			),
            array(
                'taxonomy' => 'case_studies_featured',
                'terms' => 'featured-cs',
                'operator' => 'NOT IN'
            )
		),
        'orderby' => 'date'

    ) );

    // Start the loop
    foreach( $filtered_category as $post ) : setup_postdata( $post ); ?>

          <div class="case-study-row">
            <div class='cs-image'>
              <?php 
              if( get_field('business_logo') && get_field('display')==1 ){
                $cs_img = get_field('business_logo');
                $class = '';
              } else {
                $cs_ind = wp_get_post_terms( get_the_ID() , 'case_studies_industries' );
                $cs_ind = $cs_ind[0];
                $cat_tag = 'category_'.$cs_ind->term_id;
                $cs_img = get_field('industry_logo',$cat_tag);
                $class = 'cs-industry-logo';
              } ?>
              <img src="<?php echo $cs_img['url']; ?>" class="cs-logo img-responsive <?php echo $class; ?>">
            </div>
            <div class='cs-info'>
              <a href="<?php the_permalink(); ?>" style="text-decoration:none;"><h2><?php the_title(); ?></h2></a>
              <?php
              $industries = wp_get_post_terms( get_the_ID() , 'case_studies_industries' );
              $services = wp_get_post_terms( get_the_ID() , 'case_studies_services' );
              $terms = array_merge($industries,$services);
              $pipe = false;
              foreach ($terms as $term) { ?>
                <a href="<?php echo get_term_link($term); ?>" class="featured-link"><?php if($pipe){ echo ' | '; } echo $term->name; ?></a>

              <?php $pipe=true; } ?>
              <a href="<?php the_permalink(); ?>" class="button read-more"><span>Read More</span></a>
            </div>
          </div>

    <?php endforeach; wp_reset_postdata();

    $output = ob_get_contents();
    ob_end_clean();

    echo json_encode( $output );

    die();

}


?>

