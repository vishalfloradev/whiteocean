</div>

<section id="footer" class="pg-top-100 pg-bottom-40">
         <div class="container">
            <div class="row text-center text-xs-center text-sm-left text-md-left">
               <div class="col-xs-12 col-lg-4 col-md-6 col-sm-6">
                  <h3 class="font-20"><?php echo get_field("footer_column1_title", "option");?></h3>
                  <address class="wt-clo font-wei-400 font-16">
				  <?php echo get_field("footer_address", "option");?> <br>
                     <div class="foundation_sm">
                        <ul>
                           <li><i class="fa fa-envelope-o" aria-hidden="true"></i><a href="mailto:<?php echo get_field("email_address", "option");?>"><?php echo get_field("email_address", "option");?></a></li>
                           <li><i class="fa fa-phone" aria-hidden="true"></i><a href="tel:<?php echo get_field("phone_number", "option");?> ">  <?php echo get_field("phone_number", "option");?> <br></a></li>
                        </ul>
                     </div>
                  </address>
                  <div class="social-area blog-ico">  
                     <ul>
                        <li class="wo-fcb">
                           <a href="<?php echo get_field("facebook", "option");?>">
                              <svg fill="white" version="1.1" id="Capa_1" width="18pt" height="18pt" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                 <g>
                                    <g>
                                       <path d="M288,176v-64c0-17.664,14.336-32,32-32h32V0h-64c-53.024,0-96,42.976-96,96v80h-64v80h64v256h96V256h64l32-80H288z"></path>
                                    </g>
                                 </g>
                              </svg>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo get_field("instagram", "option");?>">
                              <svg fill="white" viewBox="0 0 512.00096 512.00096" width="18pt" height="18pt" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0"></path>
                                 <path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0"></path>
                                 <path d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0"></path>
                              </svg>
                           </a>
                        </li>
                        <li>
                           <a href="<?php echo get_field("whatsapp", "option");?>">
                              <svg fill="white" height="18pt" viewBox="0 0 512 512" width="18pt" xmlns="http://www.w3.org/2000/svg">
                                 <path d="m435.921875 74.351562c-48.097656-47.917968-112.082031-74.3242182-180.179687-74.351562-67.945313 0-132.03125 26.382812-180.445313 74.289062-48.5 47.988282-75.234375 111.761719-75.296875 179.339844v.078125.046875c.0078125 40.902344 10.753906 82.164063 31.152344 119.828125l-30.453125 138.417969 140.011719-31.847656c35.460937 17.871094 75.027343 27.292968 114.933593 27.308594h.101563c67.933594 0 132.019531-26.386719 180.441406-74.296876 48.542969-48.027343 75.289062-111.71875 75.320312-179.339843.019532-67.144531-26.820312-130.882813-75.585937-179.472657zm-180.179687 393.148438h-.089844c-35.832032-.015625-71.335938-9.011719-102.667969-26.023438l-6.621094-3.59375-93.101562 21.175782 20.222656-91.90625-3.898437-6.722656c-19.382813-33.425782-29.625-70.324219-29.625-106.71875.074218-117.800782 96.863281-213.75 215.773437-213.75 57.445313.023437 111.421875 22.292968 151.984375 62.699218 41.175781 41.03125 63.84375 94.710938 63.824219 151.152344-.046875 117.828125-96.855469 213.6875-215.800781 213.6875zm0 0"></path>
                                 <path d="m186.152344 141.863281h-11.210938c-3.902344 0-10.238281 1.460938-15.597656 7.292969-5.363281 5.835938-20.476562 19.941406-20.476562 48.628906s20.964843 56.40625 23.886718 60.300782c2.925782 3.890624 40.46875 64.640624 99.929688 88.011718 49.417968 19.421875 59.476562 15.558594 70.199218 14.585938 10.726563-.96875 34.613282-14.101563 39.488282-27.714844s4.875-25.285156 3.414062-27.722656c-1.464844-2.429688-5.367187-3.886719-11.214844-6.800782-5.851562-2.917968-34.523437-17.261718-39.886718-19.210937-5.363282-1.941406-9.261719-2.914063-13.164063 2.925781-3.902343 5.828125-15.390625 19.3125-18.804687 23.203125-3.410156 3.894531-6.824219 4.382813-12.675782 1.464844-5.851562-2.925781-24.5-9.191406-46.847656-29.050781-17.394531-15.457032-29.464844-35.167969-32.878906-41.003906-3.410156-5.832032-.363281-8.988282 2.570312-11.898438 2.628907-2.609375 6.179688-6.179688 9.105469-9.582031 2.921875-3.40625 3.753907-5.835938 5.707031-9.726563 1.949219-3.890625.972657-7.296875-.488281-10.210937-1.464843-2.917969-12.691406-31.75-17.894531-43.28125h.003906c-4.382812-9.710938-8.996094-10.039063-13.164062-10.210938zm0 0"></path>
                              </svg>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
               <div class="col-xs-12 col-lg-4 col-md-6 col-sm-6">
			   <h3 class="font-20"><?php echo get_field("footer_column2_title", "option");?></h3>
                  <p class="wt-clo text-left mb-6 mb-lg-8 font-16 font-wei-400 line-height-30 w-100"> 
				  <?php echo get_field("about_us_intro", "option");?>
				</p>
                  <a href="<?php echo site_url('about-us');?>" class="btn wo-btn mg-top-15">READ MORE</a> 
               </div>
               <div class="col-xs-12 col-lg-4 col-md-6 col-sm-6 wo-links">
			   <h3 class="font-20"><?php echo get_field("footer_column_3_title", "option");?></h3>
                  <ul class="list-unstyled quick-links">
                     <li><a href="#" title="Design and developed by">Home</a></li>
                     <li><a href="#" title="Design and developed by">About</a></li>
                     <li><a href="#" title="Design and developed by">Solution</a></li>
                     <li><a href="#" title="Design and developed by">Career</a></li>
                     <li><a href="#" title="Design and developed by">Prorfolio Login</a></li>
                     <li><a href="#" title="Design and developed by">Contact Us</a></li>
                  </ul>
               </div>
            </div>
         </div>
      </section>

	<div class="footer-copyright text-center py-3 bg-grey-black font-wei-400 font-16 wt-clo">Copyright © 2019, White Ocean. All rights reserved. <a class="wt-clo" href="florafountain.com/">Website Designed and Developed by Flora Fountain.</a> </div>
	<a href="javascript:" id="return-to-top" style="display: inline;">

	<svg id="Capa_1" enable-background="new 0 0 551.13 551.13" height="20" fill="#FFFFFF" viewBox="0 0 551.13 551.13" width="20" xmlns="http://www.w3.org/2000/svg"><path d="m275.565 189.451 223.897 223.897h51.668l-275.565-275.565-275.565 275.565h51.668z"></path></svg>

	</a>

	<h3 class="arrow-scroll"><i class="icon-arrow-down"></i></h3>

	<style>.footer-copyright { width:100%}</style>
		<?php wp_footer(); ?>
<script type="application/javascript">
jQuery('#myFunction').click(function(){
         document.getElementById("myDropdownd").classList.toggle("show");
});	 
jQuery('#myFunctionm').click(function(){
         document.getElementById("myDropdownm").classList.toggle("show");
});	
</script>
	</body>
</html>
