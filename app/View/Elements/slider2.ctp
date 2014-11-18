
<section class="pageheader-default text-center">
  <div class="semitransparentbg">
    <!--
      <h1 class="animated fadeInLeftBig notransition">Page Not Found</h1>
      <p class="animated fadeInRightBig notransition container page-description">
      	
        The page you requested could not be found,<br />
        either contact your <i>webmaster</i> or try again.
    
      </p>
    -->
    <h1 class="animated fadeInLeftBig notransition" style="line-height: 100%; word-wrap:break-word;">
    <?php
      if (isset($title_for_slider2)){
        echo $title_for_slider2;
      }else if ($title_for_layout =='Errors'){
      }else{
        echo $title_for_layout;
      }
    ?> 
    </h1> 

    <?php if ($title_for_layout =='Errors') : ?>
      <section class="pageheader-default text-center">
        <div class="semitransparentbg" style='padding-bottom: 0px;'>
          <h1 class="animated fadeInLeftBig notransition" style="line-height: 100%; word-wrap:break-word;">404 Page Not Found</h1>
          <!--<p class="animated fadeInRightBig notransition container page-description">
          Upss... 
					 <br>
					 Strona o takim adresie nie istnieje.
          </p>-->
        </div>
      </section>
    <?php endif ?>
  </div>
</section>