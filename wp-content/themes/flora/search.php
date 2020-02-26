<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<!-- Banner Section -->

<div class="wo-breadcrumbs mg-bottom-35">
  <ol class="breadcrumb breadcrumbs-title">
    <li class="breadcrumb-item active"><?php printf( __( 'Search Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?></li>
  </ol>
</div>
<section class="pg-top-40 pg-bottom-120 pt-md-11 sec-3">
  <div class="container">
    <div class="row">
    
<?php
		if ( have_posts() ) :
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
?>
<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
              <div class="box-part text-left pg-top-20 pg-bottom-20 mg-top-30 mg-bottom-0" style="background:#F3FAFB; height:88%;"> 
                <div class="shadow-box"><img class="pg-bottom-20 text-right" src="<?php echo get_template_directory_uri(); ?>/images/box-shadow.png" alt=""></div>
                <div class="title">
                  <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10"><?php echo get_the_title();?></h3>
                </div>
                <div class="text">
                  <p class="text-left pg-top-10 bl-clo mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30"><?php echo strip_tags(substr(get_the_content(),0,70));?></p>
                </div>
                <a class="saffron-clo" href="<?php echo get_permalink();?>">READ MORE</a> </div>
            </div>
<?php
				
			endwhile; // End of the loop.
		else :
			?>
<p style="text-align:center;">
  <?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyseventeen' ); ?>
</p>
<?php
		endif;
		?>
           
    </div>
  </div>
</section>
<section class="pt-md-11 pg-top-140 pg-bottom-30 wo-insta-post subscribe-area">
  <div class="container">
    <div class="row align-items-center"> <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto">Newsletter</span>
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100">Interested to know more </h5>
      <div class="col-md-12 newsletter-forms pg-top-30"> <?php echo do_shortcode('[contact-form-7 id="141" title="Contact form 1"]');?> </div>
    </div>
  </div>
</section>
<?php
get_footer();

