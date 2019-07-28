<sidebar id="sidebar" class="case-studies-sidebar">
  <div class='link-wrap'>
  	<p id="filter-cs">Filter Case Studies</p>
  	<h3>Industry</h3>


  	<?php 
    if(is_singular('case_studies_cpt')){ $cs_single = true; } else { $cs_single = false; }
      //list all terms
      $terms = get_terms( 'case_studies_industries', array(
          'hide_empty' => false,
          'parent' => 0
      ) );
      foreach ($terms as $term) {
      $term_children = get_term_children($term->term_id, 'case_studies_industries');
      if($term_children): ?><div class='m-b-10'></div><?php endif; ?>
         <div>
            <a 
            <?php if(!$cs_single){ //if we're on a post single page, navigate back to archive page and use URL params to filter ?>
              class="tax-filter-control"
              href="#/"
            <?php } else { //otherwise filtering is controlled in ajax-filter.js file ?>
              href="/case-studies?id=<?php echo $term->term_id; ?>&tax=case_studies_industries"
            <?php } ?>
            data-cat-id="<?php echo $term->term_id; ?>" 
            data-tax-name="case_studies_industries">
              <?php echo $term->name; ?>
            </a>
         </div>
         <?php 
         if($term_children): ?>
          <?php foreach ($term_children as $child) {
          ?><div>
            <a 
            <?php if(!$cs_single){ ?>
              class="tax-filter-control child"
              href="#/"
            <?php } else { ?>
              href="/case-studies?id=<?php echo $child; ?>&tax=case_studies_industries"
            <?php } ?>
            data-cat-id="<?php echo $child; ?>" 
            data-tax-name="case_studies_industries">
              <?php $cterm = get_term_by('id', $child, 'case_studies_industries'); echo $cterm->name; ?>
            </a>
         </div>
          <?php } ?>
          <div class='m-b-10'></div>
          <?php endif;
         ?>
      <?php } 
      ?>
  	<h3>Service</h3>
  	<?php 
      $terms = get_terms( 'case_studies_services', array(
          'hide_empty' => false,
          'parent' => 0
      ) );
      foreach ($terms as $term) {
         $term_children = get_term_children($term->term_id, 'case_studies_services'); 
         if($term_children): ?><div class='m-b-10'></div><?php endif; ?>
         <div>
            <a 
            <?php if(!$cs_single){ ?>
              class="tax-filter-control"
              href="#/"
            <?php } else { ?>
              href="/case-studies?id=<?php echo $term->term_id; ?>&tax=case_studies_services"
            <?php } ?> 
            data-cat-id="<?php echo $term->term_id; ?>" 
            data-tax-name="case_studies_services">
              <?php echo $term->name; ?>
            </a>
         </div>
         <?php 
         if($term_children): ?> 
          <?php foreach ($term_children as $child) {
          ?><div>
            <a 
            <?php if(!$cs_single){ ?>
              class="tax-filter-control child"
              href="#/"
            <?php } else { ?>
              href="/case-studies?id=<?php echo $child; ?>&tax=case_studies_services"
            <?php } ?>
            data-cat-id="<?php echo $child; ?>" 
            data-tax-name="case_studies_services">
              <?php $cterm = get_term_by('id', $child, 'case_studies_services'); echo $cterm->name; ?>
            </a>
         </div>
          <?php } ?>
          <div class='m-b-10'></div>
          <?php endif;
         ?>
      <?php }


      get_search_form();


      ?>
    </div>
</sidebar>