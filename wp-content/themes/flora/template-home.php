<?php
/**
 *  Template Name: Home Page
 *
 *
 */
get_header();
?>
<!-- Banner Section -->
<div class="wo-banner" data-aos="fade-down">
  <div class="bd-example">
    <div id="carouselExampleCaptions" class="slide" > 
      <!--<ol class="carousel-indicators">
                     <li data-target="#carouselExampleCaptions" data-slide-to="0" class=""></li>
                     <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active"></li>
                     <li data-target="#carouselExampleCaptions" data-slide-to="2" class=""></li>
                     </ol>-->
      <div class="carousel-inner">
        <div class="carousel-item active"> <img class="d-block w-100 dek-banner-1"  alt="homebanner" src="<?php echo get_field('banner');?>" data-holder-rendered="true"> <img class="mobile-banner-1" src="<?php echo get_field('mobile_banner');?>" alt="">
          <div class="carousel-caption d-md-block">
            <h1 class="font-50 font-wei-300 line-height-75">Your
              <div id="app" class="bg-saffron pd-3" style="display:inline;"></div>
              Partners <br>
              Today &amp; Tomorrow. </h1>
            <a href="#" class="btn wo-btn mg-top-15">READ MORE</a> </div>
        </div>
        </a> </div>
    </div>
  </div>
</div>
<div class="clearfix"></div>

<!-- Usp Section -->

<div class="bd-example wo-usp">
  <div class="row">
    <?php if( have_rows('top_icons') ):  $i=0; ?>
    <?php while( have_rows('top_icons') ): the_row(); 

                                // Get sub field values.
                                $image = get_sub_field('icon_image');
                                $title = get_sub_field('icon_title');
                                $content = get_sub_field('icon_content');

                                if($i==0){

                                    $color="btn-blue pg-top-30";

                                }
                                else{
                                    $color="bg-saffron pg-top-10 pg-bottom-10";

                                }

                                ?>
    <div class="col-xs-12 col-md-6 col-sm-6 col-lg-3 <?php echo $color;?>  pg-left-15 pg-right-15 bd-right-1 usp-wp">
      <div class="media"> <img class="align-self-end mr-3" src="<?php echo esc_url( $image['url'] ); ?>" alt="icons">
        <div class="media-body pg-left-15">
          <h3 class="mt-0 wt-clo font-25 font-wei-400 line-height-35 pg-top-20"><?php echo esc_attr(  $title ); ?></h3>
          <p class="mb-0 font-18 wt-clo font-wei-400"><?php echo esc_attr( $content ); ?></p>
        </div>
      </div>
    </div>
    <?php $i++; endwhile; ?>
    <?php endif; wp_reset_postdata();?>
    <div class="clearfix"></div>
  </div>
</div>
<!-- Solution Section -->

<section class="pg-top-40 pg-bottom-120 pt-md-11 sec-3 bg-vt-sec1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-6 order-md-2">
        <div class="row">
          <?php

                                                $args = array(

                                                'post_type' => 'solutions'
                                                );

                                                // Custom query.
                                                $query = new WP_Query( $args );

                                                // Check that we have query results.
                                                if ( $query->have_posts() ) {

                                                echo '<div class="row">';


                                                // Start looping over the query results.
                                                while ( $query->have_posts() ) {
                                                $img = get_field('solution_icon');

                                                $query->the_post();


                                                ?>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="box-part text-left pg-top-20 pg-bottom-20 mg-top-30 mg-bottom-0"> <img class="pg-bottom-20" src="<?php the_field('solution_icon');?>" alt="">
              <div class="shadow-box"><img class="pg-bottom-20 text-right" src="<?php bloginfo('template_url');?>/images/box-shadow.png" alt=""></div>
              <div class="title">
                <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10"><?php echo get_the_title(get_the_ID());?></h3>
              </div>
              <div class="text">
                <p class="text-left pg-top-10 bl-clo mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30"><?php echo substr(get_the_content(),0,40).'..';?></p>
              </div>
              <a class="saffron-clo" href="<?php echo get_permalink();?>">READ MORE</a> </div>
          </div>
          <?php
                                                        
                                                            }
                                                    
                                                        echo '</div>';
                                                    
                                                    }
                                                    
                                                    // Restore original post data.
                                                    wp_reset_postdata();
                                                    ?>
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6 order-md-1 aos-init aos-animate" data-aos="fade-up">
        <?php if( have_rows('our_solutions') ):  $i=0; ?>
        <?php while( have_rows('our_solutions') ): the_row(); 

                                            // Get sub field values.
                                            $solutions_title = get_sub_field('solutions_title');
                                            $solutions_sub_title = get_sub_field('solutions_sub_title');
                                            $solution_image = get_sub_field('solution_image');
                                            $solutions_content = get_sub_field('solutions_content');
                                            $solutions_button = get_sub_field('solutions_button');
                                            $solutions_button_link = get_sub_field('solutions_button_link');

                                 

                                            ?>
        <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo $solutions_title;?></span>
        <h2 class="display-3 text-center text-md-left font-30 font-wei-300 bl-clo line-height-40 pg-top-5"> <?php echo $solutions_sub_title;?></h2>
        <img src="<?php echo esc_url($solution_image['url']);?>" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0 aos-init aos-animate" alt="<?php echo $solution_image['alt'];?>" data-aos="fade-up" data-aos-delay="100">
        <p><?php echo $solutions_content;?> </p>
        <div class="text-center text-md-left"> <a class="btn wo-btn mg-top-15" href="<?php echo esc_url($solutions_button_link);?>"><?php echo $solutions_button;?></a> </div>
      </div>
      <?php $i++; endwhile; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- About us Section -->

<?php if( have_rows('about_us') ): ?>
<?php while( have_rows('about_us') ): the_row(); ?>
<section class="pg-top-60 pg-bottom-40 pt-md-11 sec-4 about-bg-sec2">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-7 col-lg-7 order-md-1 aos-init aos-animate" data-aos="fade-up"> <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo get_sub_field('about_title');?></span> 
        <!-- Heading -->
        <h2 class="display-3 text-center text-md-left font-30 font-wei-300 bl-clo line-height-40 pg-top-5"><?php echo get_sub_field('about_sub_title');?>.</h2>
        <!-- Text -->
        <p class="pg-top-10 bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30"> <?php echo get_sub_field('about_content');?> </p>
        <!-- Buttons -->
        <div class="text-center text-md-left"> <a href="<?php echo get_sub_field('about_button_link');?>" class="btn wo-btn mg-top-15"><?php echo get_sub_field('about_button');?></a> </div>
      </div>
      <div class="col-12 col-md-5 col-lg-5"> 
        <!-- Image --> 
        <img src="<?php echo get_sub_field('about_us_image');?>" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0 aos-init aos-animate" alt="about us" data-aos="fade-up" data-aos-delay="100"> </div>
    </div>
  </div>
</section>
<?php endwhile; ?>
<?php endif; ?>

<!-- Calculator  -->

<section class="pt-md-11 sec-5 pg-top-80 pg-bottom-100 bg-vt-sec3">
  <div class="container">
    <div class="row align-items-center"> <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto">calculator</span>
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100">Lorem Ipsum is simply dummy text of the</h5>
      <div class="col-12 col-md-12 col-lg-12 aos-init aos-animate pg-top-40" data-aos="fade-up">
        <nav>
          <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist"> <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Mutual Fund</a> <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">SIP</a> <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Goal SIP</a> </div>
        </nav>
        <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
          <div class="row">
          <div class="col-12 col-md-7 col-lg-7 aos-init aos-animate pg-top-40" data-aos="fade-up">
  <form id="contactForm" method="post" action=" ">
  
    <div class="range-slider">
    <span class="simbol-cal">₹</span> 
      <div class="range-cad-1"><span class="font-18 font-wei-400 pull-left">Initial amount (contribution) :</span> </div>
    <input class="range__text font-18 font-wei-400" id="initial" type="number" name="initial" value="1000" required/>
       <?php // echo '<input class="font-18 font-wei-400" id="initial" type="number" name="initial" value="" required/>'; ?>
      
    </div>
    <div class="range-slider">
    <span class="simbol-cal">%</span> 
      <div class="range-cad-1"><span class="font-18 font-wei-400 pull-left">Annual interest rate :</span> </div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="0" max="20">
     <?php echo '<input class="range-slider__value font-18 font-wei-400" id="rate" type="text" name="rate" value="" />' ?>
    </div>
     <div class="range-slider">
     <span class="simbol-cal">Yrs</span> 
      <div class="range-cad-1"><span class="font-18 font-wei-400 pull-left">How many years?</span></div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="1" max="30">
       <?php echo '<input class="range-slider__value font-18 font-wei-400" id="years" type="number" name="years" value="" min="1" required/>' ?>
       <?php echo '<input type="hidden" name="n" id="n" value="1"/>' ?>
    </div>
    <div class="range-slider">  <input id="btnSubmit" type="button" name="submit" value="Calculate" class="btn wo-btn mg-top-15"/> 
    </div>
 
  </form>
 </div>
 <div class="col-12 col-md-5 col-lg-5">
    <div class="wo-sip bg-light-black">
    <div class="final-res">
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="html-year-val">Monthly SIP Amount</div></h5>
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="htm-amo-val">₹00000.00</div></h5>
      </div>
    </div>
  </div>
  </div>
           </div>
          <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">     <div class="row">
          <div class="col-12 col-md-7 col-lg-7 aos-init aos-animate pg-top-40" data-aos="fade-up">
  <form id="sip-contactForm" method="post" action=" ">
  
    <div class="range-slider">
     <span class="simbol-cal">₹</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">Initial amount (contribution) :</span> </div>
    <input class="range__text font-18 font-wei-400" id="sip-initial" type="number" name="initial" value="1000" required/> 
    </div>
    <div class="range-slider">
     <span class="simbol-cal">%</span> 
      <div class="range-cad-1">  <span class="font-18 font-wei-400 pull-left">Annual interest rate :</span> </div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="0" max="20">
     <?php echo '<input class="range-slider__value font-18 font-wei-400" id="sip-rate" type="text" name="rate" value="" />' ?>
    </div>
     <div class="range-slider">
      <span class="simbol-cal">M</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">Number of compounding periods per year?</span></div>
      
      
      <div class="form-check form-check-inline">
		 <input class="form-check-input font-18 font-wei-400" type="radio" checked id="sip-n" name="sip-n" value="12" >
		<label class="form-check-label font-18 font-wei-400" for="inlineRadio2">Monthly</label>
		</div>
        <div class="form-check form-check-inline">
		 <input class="form-check-input font-18 font-wei-400" type="radio" id="sip-n" name="sip-n" value="4" >
		<label class="form-check-label font-18 font-wei-400" for="inlineRadio2">Quarterly</label>
		</div>

    </div>
     <div class="range-slider">
      <span class="simbol-cal">Yrs</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">How many years?</span></div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="1" max="30">
       <?php echo '<input class="range-slider__value font-18 font-wei-400" id="sip-years" type="number" name="years" value="" min="1" required/>' ?>
    </div>
    <div class="range-slider">  <input id="sip-btnSubmit" type="button" name="submit" value="Calculate" class="btn wo-btn mg-top-15"/> 
    </div>
 
  </form>
 </div>
 <div class="col-12 col-md-5 col-lg-5">
    <div class="wo-sip bg-light-black">
    <div class="sip-final-res">
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="html-year-val">Monthly SIP Amount</div></h5>
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="htm-amo-val">₹00000.00</div></h5>
      </div>
    </div>
  </div>
  </div></div>
          <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">   <div class="row">
          <div class="col-12 col-md-7 col-lg-7 aos-init aos-animate pg-top-40" data-aos="fade-up">
  <form id="goal-contactForm" method="post" action=" ">
  
    <div class="range-slider">
     <span class="simbol-cal">₹</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">Initial amount (contribution) :</span> </div>
    <input class="range__text font-18 font-wei-400" id="goal-initial" type="number" name="initial" value="1000" required/>
       <?php // echo '<input class="font-18 font-wei-400" id="initial" type="number" name="initial" value="" required/>'; ?>
      
    </div>
    <div class="range-slider">  <span class="simbol-cal">%</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">Annual interest rate :</span> </div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="0" max="20">
     <?php echo '<input class="range-slider__value font-18 font-wei-400" id="goal-rate" type="text" name="rate" value="" />' ?>
    </div>
     <div class="range-slider">
      <span class="simbol-cal">Yrs</span> 
      <div class="range-cad-1"> <span class="font-18 font-wei-400 pull-left">How many years?</span></div>
      <input class="range-slider__range font-18 font-wei-400" type="range" value="1" min="1" max="30">
       <?php echo '<input class="range-slider__value font-18 font-wei-400" id="goal-years" type="number" name="years" value="" min="1" required/>' ?>
       <?php echo '<input type="hidden" name="n" id="goal-n" value="1"/>' ?>
    </div>
    <div class="range-slider">  <input id="goal-btnSubmit" type="button" name="submit" value="Calculate" class="btn wo-btn mg-top-15"/> 
    </div>
 
  </form>
 </div>
 <div class="col-12 col-md-5 col-lg-5">
    <div class="wo-sip bg-light-black">
    <div class="goal-final-res">
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="html-year-val">Monthly SIP Amount</div></h5>
      <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><div class="htm-amo-val">₹00000.00</div></h5>
      </div>
    </div>
  </div>
  </div> </div>
        </div>
      </div>
        
    </div>
  </div>
</section>

<!-- Case study section -->

<section class="pg-top-60 pt-md-11 pg-bottom-30 sec-3 about-bg-sec2">
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-6 col-lg-6">
        <div class="row">
          <?php

            $args = array(

            'post_type' => 'casestudy'
            );

            // Custom query.
            $query = new WP_Query( $args );

            // Check that we have query results.
            if ( $query->have_posts() ) {




            // Start looping over the query results.
            while ( $query->have_posts() ) {
            $img = get_field('solution_icon');

            $query->the_post();


            ?>
          <div class="col-12 col-md-12 col-lg-11 aos-init aos-animate mg-bottom-30" data-aos="fade-up">
            <figure class="effect-steve">
              <?php the_post_thumbnail('full');?>
              <figcaption>
                <h3 class="font-25 font-wei-400"><?php echo get_the_title();?></h3>
                <p><?php echo substr(get_the_content(),0,40).'..';?></p>
                <a class="saffron-clo" href="<?php echo get_permalink();?>">READ MORE</a> </figcaption>
            </figure>
          </div>
          <?php

                }

                }

                // Restore original post data.
                wp_reset_postdata();
                ?>
        </div>
      </div>
      <?php if( have_rows('case_study') ): ?>
      <?php while( have_rows('case_study') ): the_row(); ?>
      <div class="col-12 col-md-6 col-lg-6 mo-wo-center"> <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo get_sub_field('case_study_title');?></span> 
        <!-- Heading -->
        <h4 class="display-3 text-center text-md-left font-30 font-wei-300 bl-clo line-height-40 pg-top-5"><?php echo get_sub_field('case_study_sub_title');?></h4>
        <img src="<?php echo get_sub_field('case_study_image');?>" class="mg-top-15 mg-bottom-30 img-fluid aos-init aos-animate" alt="case study" data-aos="fade-up" data-aos-delay="100">
        <p class="pg-top-10 bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30"> <?php echo get_sub_field('case_study_content');?> </p>
        <div class="text-center text-md-left"> <a href=" <?php echo get_sub_field('case_study_button_link');?> " class="btn wo-btn mg-top-15"> <?php echo get_sub_field('case_study_button');?> </a> </div>
      </div>
    </div>
  </div>
  <?php  endwhile; endif;?>
</section>
<section class="team wo-blog pt-md-11 sec-5 pg-top-80 pg-bottom-120 bg-vt-sec3 text-center">
  <div class="container">
    <div class="grid">
      <?php if( have_rows('blog') ): ?>
      <?php while( have_rows('blog') ): the_row(); ?>
      <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto"><?php echo get_sub_field('blog_title');?></span>
      <h4 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><?php echo get_sub_field('blog_sub_title');?></h4>
      <p class="pg-top-10 bl-clo text-center mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30 w-100"> <?php echo get_sub_field('blog_content');?></p>
      <?php  endwhile; endif;?>
      <div class="row align-items-center mg-top-40">
        <?php

$args = array(

'post_type' => 'post'
);

// Custom query.
$query = new WP_Query( $args );

// Check that we have query results.
if ( have_posts() ) :

// Start looping over the query results.
while ( $query->have_posts() ) :

$query->the_post();

?>
        <div class="col-12 col-md-6 col-lg-4 aos-init aos-animate mg-bottom-30" data-aos="fade-up">
          <figure class="effect-steve">
            <?php the_post_thumbnail('full');?>
            <figcaption>
              <h2 class="font-25 font-wei-400"><?php echo get_the_title();?></h2>
              <p><?php echo substr(get_the_content(),0,70);?></p>
              <a class="saffron-clo" href="<?php echo get_permalink();?>">READ MORE</a>
              <div class="social-area blog-ico">
                <ul>
                  <li class="wo-fcb"> <a href="https://www.facebook.com/sharer.php?u=<?php echo get_permalink();?>"> <svg fill="white" version="1.1" id="Capa_1" width="18pt" height="18pt" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                    <g>
                      <g>
                        <path d="M288,176v-64c0-17.664,14.336-32,32-32h32V0h-64c-53.024,0-96,42.976-96,96v80h-64v80h64v256h96V256h64l32-80H288z"></path>
                      </g>
                    </g>
                    </svg> </a> </li>
                  <li> <a href="https://twitter.com/share?url=<?php echo get_permalink();?>"> <svg fill="white" viewBox="0 0 512.00096 512.00096" width="18pt" height="18pt" xmlns="http://www.w3.org/2000/svg">
                    <path d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0"></path>
                    <path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0"></path>
                    <path d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0"></path>
                    </svg> </a> </li>
                  <li> <a href="https://api.whatsapp.com/send?text=<?php echo get_permalink();?>"> <svg fill="white" height="18pt" viewBox="0 0 512 512" width="18pt" xmlns="http://www.w3.org/2000/svg">
                    <path d="m435.921875 74.351562c-48.097656-47.917968-112.082031-74.3242182-180.179687-74.351562-67.945313 0-132.03125 26.382812-180.445313 74.289062-48.5 47.988282-75.234375 111.761719-75.296875 179.339844v.078125.046875c.0078125 40.902344 10.753906 82.164063 31.152344 119.828125l-30.453125 138.417969 140.011719-31.847656c35.460937 17.871094 75.027343 27.292968 114.933593 27.308594h.101563c67.933594 0 132.019531-26.386719 180.441406-74.296876 48.542969-48.027343 75.289062-111.71875 75.320312-179.339843.019532-67.144531-26.820312-130.882813-75.585937-179.472657zm-180.179687 393.148438h-.089844c-35.832032-.015625-71.335938-9.011719-102.667969-26.023438l-6.621094-3.59375-93.101562 21.175782 20.222656-91.90625-3.898437-6.722656c-19.382813-33.425782-29.625-70.324219-29.625-106.71875.074218-117.800782 96.863281-213.75 215.773437-213.75 57.445313.023437 111.421875 22.292968 151.984375 62.699218 41.175781 41.03125 63.84375 94.710938 63.824219 151.152344-.046875 117.828125-96.855469 213.6875-215.800781 213.6875zm0 0"></path>
                    <path d="m186.152344 141.863281h-11.210938c-3.902344 0-10.238281 1.460938-15.597656 7.292969-5.363281 5.835938-20.476562 19.941406-20.476562 48.628906s20.964843 56.40625 23.886718 60.300782c2.925782 3.890624 40.46875 64.640624 99.929688 88.011718 49.417968 19.421875 59.476562 15.558594 70.199218 14.585938 10.726563-.96875 34.613282-14.101563 39.488282-27.714844s4.875-25.285156 3.414062-27.722656c-1.464844-2.429688-5.367187-3.886719-11.214844-6.800782-5.851562-2.917968-34.523437-17.261718-39.886718-19.210937-5.363282-1.941406-9.261719-2.914063-13.164063 2.925781-3.902343 5.828125-15.390625 19.3125-18.804687 23.203125-3.410156 3.894531-6.824219 4.382813-12.675782 1.464844-5.851562-2.925781-24.5-9.191406-46.847656-29.050781-17.394531-15.457032-29.464844-35.167969-32.878906-41.003906-3.410156-5.832032-.363281-8.988282 2.570312-11.898438 2.628907-2.609375 6.179688-6.179688 9.105469-9.582031 2.921875-3.40625 3.753907-5.835938 5.707031-9.726563 1.949219-3.890625.972657-7.296875-.488281-10.210937-1.464843-2.917969-12.691406-31.75-17.894531-43.28125h.003906c-4.382812-9.710938-8.996094-10.039063-13.164062-10.210938zm0 0"></path>
                    </svg> </a> </li>
                </ul>
              </div>
            </figcaption>
          </figure>
        </div>
        <?php endwhile; endif;?>
      </div>
    </div>
  </div>
</section>

<!-- Social Feed Section -->

<section class="pt-md-11 pg-top-60 pg-bottom-60 wo-insta-post about-bg-sec2">
  <div class="container">
    <div class="row align-items-center"> <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto">our Feed</span>
      <h4 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100 pg-bottom-40">Lorem Ipsum is simply dummy text</h4>
      <div class="col-12 col-md-4 col-lg-4"><img class="w-100" src="<?php bloginfo('template_url')?>/images/wo-insta-post-1.png" alt=""></div>
      <div class="col-12 col-md-4 col-lg-4"> <img class="w-100" src="<?php bloginfo('template_url')?>/images/wo-insta-post-2.png" alt=""></div>
      <div class="col-12 col-md-4 col-lg-4"> <img class="w-100" src="<?php bloginfo('template_url')?>/images/wo-insta-post-3.png" alt=""></div>
      <?php //echo do_shortcode('[ff id="1"]');?>
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
<script>
var app = document.getElementById('app');

var typewriter = new Typewriter(app, {
    loop: true,
    cursor:''
});

typewriter.typeString('Solution')
    .pauseFor(2500)
    .deleteAll()
    .typeString('Leadership')
    .pauseFor(2500)
    .deleteAll()
    .typeString('Insights')
    .pauseFor(2500)
    .start();
</script>

<script type="text/javascript">
         $=jQuery;    
         var rangeSlider = function(){
          var slider = $('.range-slider'),
              range = $('.range-slider__range'),
              value = $('.range-slider__value');
            
          slider.each(function(){
         
            value.each(function(){
              var value = $(this).prev().attr('value');
              $(this).val(value);
            });
         
            range.on('input', function(){
              $(this).next(value).val(this.value);
            });
          });
         };  
         rangeSlider();
         document.addEventListener('touchmove', function(event) {
         event.preventDefault();
         }, false);
         function myFunction() {
         document.getElementById("myDropdown").classList.toggle("show");
         }
		 
	$(document).ready(function() {	
   //$('#contactForm').submit(function() {
 $("#btnSubmit").click(function()  {
        var initial = $("input#initial").val();
        var rate = $("input#rate").val();
        var years = $("input#years").val();
        var nval=$("input#n").val();
		 var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		  $.ajax({
      			url: ajaxurl,
				data: {
							'action': 'example_ajax_request',
							'initial': initial,
							'rate':rate,
							'years':years,
							'nval':nval
						},
     // data: {action: example_ajax_request, initial: initial, rate: rate, years: years, nval: nval },
      success: function(data) {
		$(".final-res").empty();
		$(".final-res").html(data);
       }
    })
		
   }); 
   
   
   //$('#contactForm').submit(function() {
 $("#sip-btnSubmit").click(function()  {
        var initial = $("input#sip-initial").val();
        var rate = $("input#sip-rate").val();
        var years = $("input#sip-years").val();
        var nval=$("input[name='sip-n']:checked").val();
		  var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		  $.ajax({
      			url: ajaxurl,
				data: {
							'action': 'sip_example_ajax_request',
							'initial': initial,
							'rate':rate,
							'years':years,
							'nval':nval
						},
      success: function(result) {
		$(".sip-final-res").empty();
		$(".sip-final-res").html(result);
       }
    }) 
		
   }); 

$("#goal-btnSubmit").click(function()  {
        var initial = $("input#goal-initial").val();
        var rate = $("input#goal-rate").val();
        var years = $("input#goal-years").val();
        var nval=$("input#goal-n").val();
		 var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
		  $.ajax({
      			url: ajaxurl,
				data: {
							'action': 'goal_example_ajax_request',
							'initial': initial,
							'rate':rate,
							'years':years,
							'nval':nval
						},
     // data: {action: example_ajax_request, initial: initial, rate: rate, years: years, nval: nval },
      success: function(data) {
		$(".goal-final-res").empty();
		$(".goal-final-res").html(data);
       }
    })
		
   }); 

 }); 
      </script>