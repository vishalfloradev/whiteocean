<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
    <li class="breadcrumb-item active"><?php echo get_the_title();?></li>
  </ol>
</div>
<?php
$post_type = get_post_type();

if($post_type == 'solutions')
{
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
<section class="pg-top-20 pt-md-11 about-bg-sec2 solu-1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up"> <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase">solution</span> 
        <!-- Heading -->
        <h2 class="display-3 text-center text-md-left font-30 font-wei-400 bl-clo line-height-40 pg-top-5"><?php echo get_the_title(get_the_ID());?></h2>
        <!-- Text -->
        <div class="bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-300 line-height-30">
          <?php the_field('shot_content');?>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6"> 
        <!-- Image -->
        <?php the_post_thumbnail( 'full' ); ?>
      </div>
    </div>
  </div>
</section>
<?php
        	endwhile; // End of the loop.
			wp_reset_postdata();
			?>
<section class="pt-md-11 bg-vt-sec3 pg-top-100 pg-bottom-100 mg-top-50 mg-bottom-50 solu-2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-12"> <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase">
        <?php the_field('solution_usp_sub_title', 'option');?>
        </span> 
        <!-- Heading -->
        <h2 class="display-3 text-center text-md-left font-30 font-wei-400 bl-clo line-height-40 pg-top-5 w-100">
          <?php the_field('solution_usp_title', 'option');?>
        </h2>
        <div class="row">
          <?php if( have_rows('solution_usp', 'option') ): ?>
          <?php $i=0; while( have_rows('solution_usp', 'option') ): the_row(); ?>
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
            <div class="box-part text-left pg-top-20 pg-bottom-20 mg-top-30 mg-bottom-0"> <img class="pg-bottom-20" src="<?php the_sub_field('image'); ?>" alt="<?php the_sub_field('name');?>" alt="">
              <div class="shadow-box"> <img class="pg-bottom-20 text-right" src="<?php echo get_template_directory_uri(); ?>/images/box-shadow.png" alt="<?php the_sub_field('name');?>"></div>
              <div class="title">
                <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10">
                  <?php the_sub_field('name');?>
                </h3>
              </div>
              <div class="text">
                <p class="text-left pg-top-10 bl-clo mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30">
                  <?php the_sub_field('content');?>
                </p>
              </div>
            </div>
          </div>
          <?php $i++; endwhile;
		   wp_reset_postdata(); ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="pg-top-0 pt-md-11 about-bg-sec2 solu-3">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-12 aos-init aos-animate" data-aos="fade-up">
        <?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
the_content();
			endwhile; // End of the loop.
			wp_reset_postdata();
			?>
      </div>
    </div>
  </div>
</section>
<?php }
else
{
    ?>
<section class="pg-top-20 pt-md-11 about-bg-sec2 solu-1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-12 col-lg-12">
    <?php
    while ( have_posts() ) :
				the_post();
				the_content();
	?>
<?php 
	endwhile; 
			wp_reset_postdata();
			?>
			</div>
			</div>
			</div>
			</section>
			<?php
}
?>
<section class="pt-md-11 sec-4 about-bg-sec2">
  <div class="container">
  <div class="row align-items-center">
    <div class="col-md-12 col-center m-auto">
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <?php if( have_rows('testimonials_section', 'option') ): ?>
          <?php $i=0; while( have_rows('testimonials_section', 'option') ): the_row(); ?>
          <div class="item carousel-item <?php if($i==0) echo "active";?> ">
            <div class="img-box mg-bottom-30"><img src="<?php the_sub_field('photo'); ?>" alt="<?php the_sub_field('name');?>"></div>
            <span class="ext-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto">TESTIMONIALS</span>
            <h4 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100">
              <?php the_sub_field('title_testi');?>
            </h4>
            <p class="testimonial font-20 font-wei-300 font-italic bl-clo pg-top-0">
              <?php the_sub_field('sub_title');?>
            </p>
            <p class="overview font-20 font-wei-300 bl-clo"><b>
              <?php the_sub_field('name');?>
              </b><br>
              <?php the_sub_field('postion');?>
            </p>
          </div>
          <?php $i++; endwhile; ?>
          <?php endif; ?>
          <!-- Carousel controls --> 
          <a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev"> <svg class="carousel-control-prev-icon" width="25px" height="25px" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.641 511.641" style="enable-background:new 0 0 511.641 511.641;" xml:space="preserve">
          <g>
            <path d="M148.32,255.76L386.08,18c4.053-4.267,3.947-10.987-0.213-15.04c-4.16-3.947-10.667-3.947-14.827,0L125.707,248.293
                              c-4.16,4.16-4.16,10.88,0,15.04L371.04,508.667c4.267,4.053,10.987,3.947,15.04-0.213c3.947-4.16,3.947-10.667,0-14.827
                              L148.32,255.76z"></path>
          </g>
          </svg> </a> <a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next"> <svg class="carousel-control-next-icon" width="25px" height="25px" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.995 511.995" style="enable-background:new 0 0 511.995 511.995;" xml:space="preserve">
          <g>
            <path d="M381.039,248.62L146.373,3.287c-4.083-4.229-10.833-4.417-15.083-0.333c-4.25,4.073-4.396,10.823-0.333,15.083
                              L358.56,255.995L130.956,493.954c-4.063,4.26-3.917,11.01,0.333,15.083c2.063,1.979,4.729,2.958,7.375,2.958
                              c2.813,0,5.604-1.104,7.708-3.292L381.039,263.37C384.977,259.245,384.977,252.745,381.039,248.62z"></path>
          </g>
          </svg> </a> </div>
      </div>
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


