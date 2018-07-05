<?php 
get_header(); 
pageBanner(array(
  'title' => 'All Campuses',
  'subtitle' => 'Let\'s find a campus'
));
?>      

  <div class="container container--narrow page-section">
  <div class="acf-map">
  <?php
  while(have_posts()) {
    the_post(); 
    $mapLocation = get_field('map_location');
    ?>
      <div data-lat="<?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng']; ?>" class="marker"> 
      <h3><a href="<?php the_permalink( ) ?>"><?php the_title(); ?></a></h3>
      <?php echo $mapLocation['address'] ?>
      </div>    
  <?php  }  ?>
  </div>
<?php
get_footer();
?>