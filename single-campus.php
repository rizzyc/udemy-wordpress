<?php
get_header();
    while(have_posts()) {
        the_post(); 
        pageBanner(array());
        $relatedPrograms = new WP_Query(array(
            'posts_per_page' => -1,
            'post_type' => 'program',
            'orderby' => 'title',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'related_campus',
                    'compare' => 'LIKE',
                    'value' => '"' . get_the_ID() . '"'
                    )
                )
          ));
        if ($relatedPrograms->have_posts()) { 
            echo '<hr class="section-break"/>';
            echo '<h2>Programs available at this campus</h2>';
            echo '<ul class="professor-cards">';
            while($relatedPrograms->have_posts()) {
                $relatedPrograms->the_post(); ?>
                <li>
                  <a href="<?php the_permalink(); ?>"><?php the_title( ); ?></a>
                </li>                            
            <?php 
            }
            echo '</ul>';
                 }
        
        ?>
       
  <div class="container container--narrow page-section">

    <div class="generic-content">
      <div class="row group">
        <div class="one-third"><?php the_post_thumbnail('professorPortrait'); ?></div>
        <div class="two-thirds"><?php the_content(); ?></div>
      </div>
    <div class="acf-map">
        <?php      $mapLocation = get_field('map_location');     ?>
        <div data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>" class="marker"> 
        <h3><?php the_title(); ?></h3>
        <?php echo $mapLocation['address'] ?>
        </div>    
    </div>
    </div>        
        <?php
        $relatedPrograms = get_field('related_program');
        if($relatedPrograms) {
          // print_r($relatedPrograms); GOOD WAY TO LOOK INTO A PHP VARIABLE 
          echo '<hr class="section-break">';
          echo '<h2 class="headline headline--medium">Subject(s) Taught</h2>';
          echo '<ul class="link-list min-list">';
          foreach ($relatedPrograms as $program) { ?>
          <li><a href="<?php echo get_the_permalink($program); ?>"><?php echo get_the_title( $program ); ?></a></li>          
        <?php         
        }
        echo '</ul>';  
      }
        ?>
    </div>
    <?php }    
get_footer();
?>

