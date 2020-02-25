<?php
/**
 * The template for displaying the 404 template in the Twenty Twenty theme.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();
?>
<div class="wo-breadcrumbs mg-bottom-35">

	
<ol class="breadcrumb breadcrumbs-title">
<li class="breadcrumb-item active">Page Not Found</li>
</ol>

</div>
<section class="pg-top-60 pg-bottom-40 pt-md-11 sec-4 about-bg-sec2">
  <div class="container">
    <div class="row align-items-center">
    <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/02/404-PC_31daffa.png" class="" alt="about us" data-aos="fade-up" data-aos-delay="100" style="margin:0 auto; width:50%;">
    <h1 class="entry-title"><?php _e( 'Page Not Found', 'twentytwenty' ); ?></h1>
    <div class="intro-text"><p><?php _e( 'The page you were looking for could not be found. It might have been removed, renamed, or did not exist in the first place.', 'twentytwenty' ); ?></p></div>
    </div>
    </div>
    </section>
<!-- contact form section -->

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
?>
<style>
h1.entry-title {
    width: 100%;
    margin-top: 20px;
	text-align:center;
}
.intro-text {
    width: 600px;
    text-align: center;
    margin: 0 auto;
}
</style>