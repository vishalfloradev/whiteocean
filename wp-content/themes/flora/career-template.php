<?php
/**
 *  Template Name: Career Page
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
<?php
$career_top_content = get_field('career_top_content');
$main_title=$career_top_content['title'];
$main_sub_title=$career_top_content['sub_title'];
$main_content=$career_top_content['content'];
$main_image=$career_top_content['image'];
 ?>
<section class="pg-top-60 pt-md-11 sec-4 about-bg-sec2 car-sec-1">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up"><span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase"><?php echo $main_sub_title; ?></span>
        <h2 class="display-3 text-center text-md-left font-30 font-wei-400 bl-clo line-height-40 pg-top-5"><?php echo $main_title; ?></h2>
        <div class="bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-300 line-height-30"> <?php echo $main_content; ?> </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6">
        <?php $image = wp_get_attachment_image_src( $main_image, 'full' ); ?>
        <?php $alt_text = get_post_meta($main_image , '_wp_attachment_image_alt', true); ?>
        <img src="<?php echo $image[0]; ?>" class="img-fluid mw-md-150 mw-lg-130 mb-6 mb-md-0 aos-init aos-animate" alt="<?php echo $alt_text; ?>" data-aos="fade-up" data-aos-delay="100"></div>
    </div>
  </div>
</section>
  <?php if( have_rows('career_post') ): ?>
          <?php $i=0; while( have_rows('career_post') ): the_row();
          
      if($i%2 == 0)
       {
         ?>
       <section class="pt-md-11 bg-vt-sec3 pg-top-100 pg-bottom-100 mg-top-50 sec-4 car-sec-2">
  <div class="container">
    <div class="row align-items-center">
         <?php
       }

       else
       {
        ?>
        <section class="pt-md-11 about-bg-sec2 pg-top-50 pg-bottom-50 sec-4 car-sec-3"> <div class="container"> <div class="row align-items-center"> 
        <?php
       }
?>   
                
      <div class="col-12 col-md-6 col-lg-6 aos-init aos-animate fix-top-wo" data-aos="fade-up"><span class="font-wei-blod font-16 wt-clo bg-saffron pd-2 text-uppercase">careers</span>
        <h2 class="display-3 text-center text-md-left font-30 font-wei-400 bl-clo line-height-40 pg-top-5"> <?php the_sub_field('name') ?></h2>
        <p class="text-md-left mb-6 mb-lg-8 blue-light-clo font-18 font-wei-300 line-height-30">Posted on : <?php the_sub_field('date') ?></p>
        <div class="text-center text-md-left">
      
          <label class="btn-bs-file btn wo-btn">Submit Resume
           <input type="file" name="file" id="file" />
   <br />
   <span id="uploaded_image"></span>
        
        </div>
      </div>
      <div class="col-12 col-md-6 col-lg-6 aos-init aos-animate" data-aos="fade-up">
        <h2 class="display-3 text-center text-md-left font-30 font-wei-400 bl-clo line-height-40 pg-top-5">Overview</h2>
        <div class="bl-clo text-md-left mb-6 mb-lg-8 bl-clo font-18 font-wei-300 line-height-30">
        <?php the_sub_field('content') ?>
        </div>
        <div class="bs-example accordion-wo m-auto">
          <div class="accordion" id="accordionExample">
            <div class="card">
              <div class="card-header" id="headingOne">
          
                 <h2 class="mb-0">
                  <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne"><i class="fa fa-plus"></i> Responsibilities</button>
                </h2>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                <?php the_sub_field('responsibilities') ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingTwo">
                <h2 class="mb-0">
                   <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-plus"></i> Qualifications</button>
                </h2>
              </div>
              <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                 <?php the_sub_field('qualifications') ?>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="card-header" id="headingThree">
                <h2 class="mb-0">
                  <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree"><i class="fa fa-plus"></i> Requirement</button>
                </h2>
              </div>
             <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
        <?php the_sub_field('requirement') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

 <?php $i++; endwhile; 
				  wp_reset_postdata();
				   endif; ?> 

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
?><script type="text/javascript">
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show")
	}
	$ = jQuery, $(function() {
		$("#main_navbar").bootnavbar()
	});
	var rangeSlider = function() {
		var n = $(".range-slider"),
			e = $(".range-slider__range"),
			t = $(".range-slider__value");
		n.each(function() {
			t.each(function() {
				var n = $(this).prev().attr("value");
				$(this).html(n)
			}), e.on("input", function() {
				$(this).next(t).html(this.value)
			})
		})
	};
	rangeSlider(), document.addEventListener("touchmove", function(n) {
		n.preventDefault()
	}, !1), $(window).scroll(function() {
		$(this).scrollTop() >= 50 ? $("#return-to-top").fadeIn(200) : $("#return-to-top").fadeOut(200)
	}), $("#return-to-top").click(function() {
		$("body,html").animate({
			scrollTop: 0
		}, 500)
	}), $(document).ready(function() {
		$(".collapse.show").each(function() {
			$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus")
		}), $(".collapse").on("show.bs.collapse", function() {
			$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus")
		}).on("hide.bs.collapse", function() {
			$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus")
		})
	});
	
$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"<?php echo get_template_directory_uri(); ?>/email.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },   
    success:function(data)
    {
     $('#uploaded_image').html(data);
    }
   });
  }
 });
});
	</script>




