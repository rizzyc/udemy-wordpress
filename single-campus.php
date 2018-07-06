<?php
get_header();
    while(have_posts()) {
        the_post(); 
        pageBanner(array());
        ?>
       
  <div class="container container--narrow page-section">
<div class="metabox metabox--position-up metabox--with-home-link">
    <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link( 'campus' ) ?>"><i class="fa fa-home" aria-hidden="true"></i> All Campuses</a><span class="metabox__main"><?php the_title( ); ?></span></p>
</div>
    <div class="generic-content">
        <?php the_content( ); ?>
    </div>        
    <div class="acf-map">
    <?php $mapLocation = get_field('map_location'); ?>
        <div data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>" class="marker"> 
            <h3><?php the_title(); ?></h3>
        <?php echo $mapLocation['address'] ?>
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

