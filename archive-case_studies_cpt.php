<?php get_header(); ?>
<section>
  <div class='container-fluid'>
    <div class='row flex-md'>
      
      <div class="col-sm-9 p-x-0 cs-content-col">
        <h1 class="entry-title">Case Studies</h1>
        <div id="case-studies">
          


          <?php //begin by printing featured case studies
          $args1 = array(
            'post_type' => array( 'case_studies_cpt' ),
            'posts_per_page' => -1,
            'orderby' => 'date',
            'tax_query' => array(
              array(
                'taxonomy' => 'case_studies_featured',
                'terms' => 'featured-cs',
                'operator' => 'IN'
              )
            )
          ); 
          $cs_featured_query = new WP_Query($args1);
          if($cs_featured_query->have_posts()): while($cs_featured_query->have_posts()): $cs_featured_query->the_post(); ?>

          <div class="case-study-row <?php the_field('display'); ?>">
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
          <?php endwhile; endif; ?>



          <?php //next loop through any posts not marked as featured
          $args2 = array(
            'post_type' => array( 'case_studies_cpt' ),
            'posts_per_page' => -1,
            'orderby' => 'date',
            'tax_query' => array(
              array(
                'taxonomy' => 'case_studies_featured',
                'terms' => 'featured-cs',
                'operator' => 'NOT IN'
              )
            )
          ); 
          $cs_query = new WP_Query($args2);
          if($cs_query->have_posts()): while($cs_query->have_posts()): $cs_query->the_post(); ?>

          <div class="case-study-row <?php the_field('display'); ?>">
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
          <?php endwhile; endif; ?>



        </div>
        <?php echo term_description(); ?>
      </div>

      <div class="col-sm-3 p-0 cs-sidebar-col">
        <?php get_sidebar('case-studies'); ?>
      </div>

    </div>
  </div>
</section>


<?php get_footer(); ?>