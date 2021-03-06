<?php

/**
 *  Template Name: About Us
 *
 *

 */
get_header();

?>
     <!-- Banner Section -->
     <div class="wo-breadcrumbs mg-bottom-35">

	
<ol class="breadcrumb breadcrumbs-title">
<li class="breadcrumb-item active"><?php echo get_the_title();?></li>
</ol>

</div>


<section class="pg-top-60 pt-md-11 sec-4 about-bg-sec2">
         <div class="container">
            <div class="row align-items-center">



<?php if( have_rows('upperbox') ): ?>
    <?php while( have_rows('upperbox') ): the_row(); ?>
               <div class="col-12 col-md-6 col-lg-6 order-md-1 aos-init aos-animate" data-aos="fade-up">
                  <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo get_sub_field('sub_title');?></span> 
                  <!-- Heading -->
                  <?php echo get_sub_field('content_box');?>
																
																
																
																<div class="text-center text-md-left"> </div>
               </div>
               <div class="col-12 col-md-6 col-lg-6">
                  <!-- Image --> 
                  <img src="<?php echo get_sub_field('image_');?>" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0 aos-init aos-animate" alt="about us" data-aos="fade-up" data-aos-delay="100"> 
               </div>
													
													
           
    <?php endwhile; ?>											
    <?php endif; ?>											
													
				
													
            </div>
    
         </div>
      </section>


      <section class="pg-top-30 pg-bottom-40 pt-md-11 sec-4">
         <div class="container">
            <div class="row align-items-center">
	<div class="col-12 col-md-12 col-lg-12">
													
																		

                            <section class="pg-top-30 pg-bottom-40 pt-md-11 sec-4">
                            <div class="container">
                            <div class="row align-items-center">
                            <div class="col-12 col-md-12 col-lg-12">

                            <?php echo get_field('lower_content');?>
                            </div>



                            </div>	</div>
                            </section>

                            </div>



                            </div>	</div>
                            </section>


                            <section class="pt-md-11 bg-vt-sec3 pg-top-100 pg-bottom-100 sec-4">
         <div class="container">
            <div class="row align-items-center">
													<div class="col-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up">
                  <span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo get_field('team_title');?></span> 
                  <!-- Heading -->
                  <h2 class="display-3 text-center text-md-left font-30 font-wei-300 bl-clo line-height-40 pg-top-5"><?php echo get_field('team_sub_title');?></h2>
                  <!-- Text -->
    <?php
                  $text=str_ireplace('<p>','',get_field('team_text'));
                  $utext=str_ireplace('</p>','',$text);  
                  
          ?>        
                  <p class="bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30"> <?php echo $utext;?> </p>
                  <!-- Buttons --> 
                  
															<!--	<ul class="inner-ol image-team">
																<li><a href="#"><img src="images/wo-team-1.jpg" alt=""/></a></li>
																	<li><a href="#"><img src="images/wo-team-2.jpg" alt=""/></a></li>
																																
																</ul>-->
																<div class="row">
														<div class="col-xs-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up"><a href="#"><img class="w-100" src="<?php echo get_field('team_left_image');?>" alt=""></a></div>
														<div class="col-xs-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up"><a href="#"><img class="w-100" src="<?php echo get_field('team_right_image');?>" alt=""></a></div>
																</div>
																<!--<div class="text-center text-md-left"> <a href="#" class="btn wo-btn mg-top-15">READ MORE</a> </div>-->
               </div>
													 <div class="col-12 col-md-6 col-lg-6 pg-top-50">
                  <!-- Image --> 
                 <?php echo get_field('team_video');?>
               </div>
               
              
	
            </div>
										
										<div class="row align-items-center pg-top-40">
											 <div class="col-12 col-md-12 col-lg-12">
										<p class="bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-400 line-height-30">
                                        
                                        <?php echo get_field('team_bottom_text');?>
                                        </p>
											</div>
										</div>

         </div>
      </section>


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
						<h4 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100"><?php the_sub_field('title_testi');?></h4>
						<p class="testimonial font-20 font-wei-300 font-italic bl-clo pg-top-0"><?php the_sub_field('sub_title');?></p>
						<p class="overview font-20 font-wei-300 bl-clo"><b><?php the_sub_field('name');?></b><br> <?php the_sub_field('postion');?></p>
					</div>
                    <?php $i++; endwhile; ?>


<?php endif; ?>		
				<!-- Carousel controls -->
				<a class="carousel-control left carousel-control-prev" href="#myCarousel" data-slide="prev">
					<svg class="carousel-control-prev-icon" width="25px" height="25px" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.641 511.641" style="enable-background:new 0 0 511.641 511.641;" xml:space="preserve">
                        <g>
                           <path d="M148.32,255.76L386.08,18c4.053-4.267,3.947-10.987-0.213-15.04c-4.16-3.947-10.667-3.947-14.827,0L125.707,248.293
                              c-4.16,4.16-4.16,10.88,0,15.04L371.04,508.667c4.267,4.053,10.987,3.947,15.04-0.213c3.947-4.16,3.947-10.667,0-14.827
                              L148.32,255.76z"></path>
                        </g>
                     </svg>
				</a>
				<a class="carousel-control right carousel-control-next" href="#myCarousel" data-slide="next">
			<svg class="carousel-control-next-icon" width="25px" height="25px" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 511.995 511.995" style="enable-background:new 0 0 511.995 511.995;" xml:space="preserve">
                        <g>
                           <path d="M381.039,248.62L146.373,3.287c-4.083-4.229-10.833-4.417-15.083-0.333c-4.25,4.073-4.396,10.823-0.333,15.083
                              L358.56,255.995L130.956,493.954c-4.063,4.26-3.917,11.01,0.333,15.083c2.063,1.979,4.729,2.958,7.375,2.958
                              c2.813,0,5.604-1.104,7.708-3.292L381.039,263.37C384.977,259.245,384.977,252.745,381.039,248.62z"></path>
                        </g>
                     </svg>
				</a>
			</div>
		</div>
	</div>
</div>




 </section>







<!-- contact form section -->









<section class="pt-md-11 pg-top-140 pg-bottom-30 wo-insta-post subscribe-area">
            <div class="container">
               <div class="row align-items-center">
                  <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase m-auto">Newsletter</span>
                  <h5 class="display-3 text-center font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100">Interested to know more </h5>
                  <div class="col-md-12 newsletter-forms pg-top-30">
                     <?php echo do_shortcode('[contact-form-7 id="141" title="Contact form 1"]');?>
                  </div>
               </div>
            </div>
         </section>
<?php
get_footer();