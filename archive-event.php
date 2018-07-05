<?php 
get_header(); 
pageBanner(array(
  'title' => 'All Events',
  'subtitle' => 'See what is going on in our universe'
));
?>      
  <div class="container container--narrow page-section">
  <?php
  while(have_posts()) {
    the_post(); 
    get_template_part( 'template-parts/content', 'event' );
  }
  echo paginate_links( );
  ?>
  <div class="section-break">
    <p>Looking for a recap of past events? <a href="<?php echo site_url( 'past-events') ?>">Check out our past events</a></p>
  </div>
  </div>
<?php
get_footer();
?>