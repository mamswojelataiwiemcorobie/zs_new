<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

?>


<!-- Studeo
================================================== -->
  <!-- Recent projects - szkoły wyższe -->
  <?php echo $this->element('home_uni_logos_slider', array(), array('cache' => true)); ?>  
  <!-- /szkoly end-->

  <section class="home-features topspace30">
    <div class="container animated fadeInUpNow notransition fadeInUp">
      <h1 class="small text-center">WHAT THEY SAY</h1>
      <div class="br-hr type_short">
        <span class="br-hr-h">
        <i class="icon-pencil"></i>
        </span>
      </div>
      <div id="cbp-qtrotator" class="cbp-qtrotator">
        <div class="cbp-qtcontent" style="transition: opacity 700ms ease; -webkit-transition: opacity 700ms ease;">
          <img src="http://wowthemes.net/demo/biscaya/img/demo/avatar.jpg" alt="">
          <blockquote>
            <p class="bigquote">
              <i class="icon-quote-left colortext quoteicon"></i> Lorem ipsum dolor sit adipiscing elit. Praesent tempus eleifend risus ut congue eset nec lacus. Lorem ipsum dolor sit adipiscing elit. Praesent tempus eleifend risus ut congue eset nec lacus. Praesent dignissim sem sapien, a vulputate enim auctor vitae. Duis non lorem porta, adipiscing eros sit amet, tempor sem.
            </p>
            <footer>John Doe / Owner of <a href="#">calypso.com</a></footer>
          </blockquote>
        </div>
        <div class="cbp-qtcontent cbp-qtcurrent" style="transition: opacity 700ms ease; -webkit-transition: opacity 700ms ease;">
          <img src="http://wowthemes.net/demo/biscaya/img/demo/avatar.jpg" alt="">
          <blockquote>
            <p class="bigquote">
              <i class="icon-quote-left colortext quoteicon"></i> Lorem ipsum dolor sit adipiscing elit. Praesent tempus eleifend risus ut congue eset nec lacus. Lorem ipsum dolor sit adipiscing elit. Praesent tempus eleifend risus ut congue eset nec lacus. Praesent dignissim sem sapien, a vulputate enim auctor vitae. Duis non lorem porta, adipiscing eros sit amet, tempor sem.
            </p>
            <footer>Pino Caruso / Director of <a href="#">hisweb.com</a></footer>
          </blockquote>
        </div>
      <span class="cbp-qtprogress" style="transition: none; -webkit-transition: none; width: 0%;"></span></div>
      <br>
      
    </div>
  </section>



  <!-- Recent projects - policealne -->
  <?php echo $this->element('home_poli_logos_slider', array(), array('cache' => true)); ?>

  <!-- Wp_posts -->
  <?php echo $this->element('recent_post', array(), array('cache' => true)); ?>

  <!-- KIERUNKI ================================================== -->
    <?php echo $this->element('losoweKierunki', array(), array('cache' => true)); ?>
    <!-- /.kierunki end-->

<!-- PARTNERZY slider ================================================= -->
    <section class="service-box topspace30" id="service-top">
	    <div class="container">
		  <div class="nasi-partnerzy">
		    <div class="header">NASI PARTNERZY</div>
		    <div class="slider"></div>
		  </div>
		</div>
	</section>

  <!-- Bla bla -->
  <section class="home-features topspace30">
    <div class="container animated fadeInUpNow notransition fadeInUp">
        <div class="row">
          <div class="col-md-4">
            <h4><i class="icon icon-microphone">
            </i>STUDIA</h4>
            <div class="bottomspace30">
               Zanim zaczniesz studia i wybierzesz swój wymarzony kierunek, dowiedz się jaki charakter ma wybrana przez Ciebie szkoła wyższa. Czy jest to uniwersytet, politechnika, szkoła pedagogiczna, akademia? Czy oferuje kierunki inżynierskie czy licencjackie? Dzięki wszechstronnej wyszukiwarce, bez problemu znajdziesz to, czego szukasz.
            </div>
          </div>
          <div class="col-md-4">
            <h4><i class="icon icon-anchor">
            </i>SZKOŁY POLICEALNE</h4>
            <div class="bottomspace30">
               Szkoły policealne oferują kursy przygotowujące do wykonywania konkretnego zawodu. Nauka trwa zwykle dwa lata i kończy się egzaminem zawodowym. Spośród setek możliwych, możesz bez problemu wybrać dokładnie taki kurs, jaki najbardziej Ci odpowiada: chcesz zostać detektywem, kosmetyczką lub księgową?
            </div>
          </div>
          <div class="col-md-4">
            <h4><i class="icon icon-user"></i>INFORMATOR</h4>
            Pierwsza edycja informatora „Zostań Studentem” spotkała się z niezwykle ciepłym odbiorem. To kilkudziesięciostronicowe wydawnictwo zapoczątkowało zupełnie nową jakość informatorów – coraz mniej podobnych do książki telefonicznej, a coraz bardziej do kolorowego magazynu o tematyce uniwersyteckiej.<br>
          </div>
        </div>
         <?php echo $this->element('top', array(), array('cache' => true)); ?>
    </div>
  </section>  