<?php

/**
 *  Template Name: Contact us
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


<section class="pg-top-40 pg-bottom-20 pt-md-11 sec-3">
            <div class="container">
               <div class="row align-items-center"> 
                  <div class="col-12 col-md-12 col-lg-12 order-md-2">
                     <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                       <div class="media bg-light-blue pg-top-20 pg-bottom-20 pg-left-20">
																								<div class="media-img-center"><img class="align-self-center mr-3" src="<?php bloginfo('template_url');?>/images/wo-phone.png" alt="Generic placeholder image"> </div>
                     
                     <div class="media-body pg-left-15">
                        <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10">Phone</h3>
                        <p class="mb-0 font-18 bl-clo font-wei-400"><a href="tel:<?php echo get_field("phone_number", "option");?> ">  <?php echo get_field("phone_number", "option");?></a></p>
                     </div>
                  </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                    <div class="media bg-light-blue pg-top-20 pg-bottom-20 pg-left-20">
																						<div class="media-img-center"> <img class="align-self-center mr-3" src="<?php bloginfo('template_url');?>/images/wo-mobile.png" alt="Generic placeholder image"> </div>
                    
                     <div class="media-body pg-left-15">
                 <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10">Mobile</h3>
                        <p class="mb-0 font-18 bl-clo font-wei-400"><a href="tel:<?php echo get_field("whatsapp", "option");?> ">  <?php echo get_field("whatsapp", "option");?> </a></p>
                     </div>
                  </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                        <div class="media bg-light-blue pg-top-20 pg-bottom-20 pg-left-20">
																										<div class="media-img-center"><img class="align-self-center mr-3" src="<?php bloginfo('template_url');?>/images/wo-email.png" alt="Generic placeholder image"> </div>
                     
                     <div class="media-body pg-left-15">
    <h3 class="mt-0 bl-clo font-25 font-wei-400 line-height-35 pg-top-10">Send Mail</h3>
                        <p class="mb-0 font-18 bl-clo font-wei-400"><a href="mailto:<?php echo get_field("email_address", "option");?>"><?php echo get_field("email_address", "option");?></a></p>
                     </div>
                  </div>
                        </div>
              
                     </div> 
                  </div>
            
               </div>
            </div>
         </section> 
 

         <section class="pt-md-11 pg-bottom-30 wo-insta-post subscribe-area ctn">
            <div class="container">
               <div class="row align-items-center">
                 
                  <div class="col-md-12 newsletter-forms pg-top-30">
																			 <span class="text-center font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase">Contact Us</span>
                  <h5 class="display-3 text-left font-30 font-wei-300 bl-clo line-height-40 pg-top-5 w-100">Get in touch</h5>
                    <?php echo do_shortcode('[contact-form-7 id="189" title="Contact us form"]');?>
                  </div>
               </div>
            </div>
         </section>

                <section class="pt-md-11 bg-vt-sec3 pg-top-100 pg-bottom-100 sec-4">
                    <div class="container">
                    <div class="row align-items-center">
         <div class="col-12 col-md-7 col-lg-7">
                    <div class="mapouter text-left">
                    <div class="gmap_canvas"><?php echo get_field('map_iframe');?>
                    </div>
                    </div>
               </div>
                       <div class="col-12 col-md-5 col-lg-5">
                    <!-- Image --> 
                    <img src="<?php echo get_field('map_image');?>" alt="contact us" class="img-fluid">
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