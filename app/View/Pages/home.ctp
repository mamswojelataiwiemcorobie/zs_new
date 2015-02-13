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
  <div class="row intro-note">
        <div class="col-md-12 text-center">
          <h1>Szukasz <span class="colortext">uczelni</span> lub kierunku studiów?</h1>
          <p>
          Zostań Studentem to serwis w którym znajdziesz aktualne informacje o wszystkich szkołach wyższych, policealnych i językowych w Polsce.        </p>
        </div>
  </div>
  <!-- Recent projects - szkoły wyższe -->
  <?php echo $this->element('home_uni_logos_slider', array(), array('cache' => true)); ?>  
  <!-- /szkoly end-->

  <section class="home-features topspace30">
    <div class="container animated fadeInUpNow notransition fadeInUp">
      <!-- <h1 class="small text-center">WHAT THEY SAY</h1>
      <div class="br-hr type_short">
        <span class="br-hr-h">
        <i class="icon-pencil"></i>
        </span>
      </div> -->
      <div id="cbp-qtrotator" class="cbp-qtrotator">
        <div class="cbp-qtcontent" style="transition: opacity 700ms ease; -webkit-transition: opacity 700ms ease;">
          <img src="/img/Albert_Einstein_Head.jpg" alt="Albert Einstein">
          <blockquote>
            <p class="bigquote">
              <i class="icon-quote-left colortext quoteicon"></i> Fakty nie są najważniejsze. Zresztą, aby je poznać, nie trzeba studiować na uczelni - można się ich nauczyć z książek. Istota kształcenia w szkole wyższej nie polega zatem na wpajaniu wiedzy faktograficznej, lecz na ćwiczeniu umysłu w dochodzeniu do tego, czego nie da się znaleźć w podręcznikach.
            </p>
            <footer>Albert Einstein</footer>
          </blockquote>
        </div>
        <div class="cbp-qtcontent cbp-qtcurrent" style="transition: opacity 700ms ease; -webkit-transition: opacity 700ms ease;">
          <img src="/img/Antoni_Kepinski.jpg" alt="">
          <blockquote>
            <p class="bigquote">
              <i class="icon-quote-left colortext quoteicon"></i> Naukę i technikę można uważać za kontynuatorki magii.
            </p>
            <footer>Antoni Kępiński</footer>
          </blockquote>
        </div>
      <span class="cbp-qtprogress" style="transition: none; -webkit-transition: none; width: 0%;"></span></div>
      <br>
      
    </div>
  </section>

  <!-- Wp_posts -->
  <?php echo $this->element('recent_post'); ?>

  <!-- KIERUNKI ================================================== -->
    <?php echo $this->element('losoweKierunki'); ?>
    <!-- /.kierunki end-->

<!-- PARTNERZY slider ================================================= -->
    <section class="service-box topspace30" id="service-top">
		  <div class="nasi-partnerzy">
		    <h2>NASI PARTNERZY</h2>
		    <div class="slider">
		    	<div class="col-md-12">
					<div class="list_carousel">
						<div class="caroufredsel_wrapper">
							<ul id="carousel-projects_services">
								<li>
									<div class="featured-projects">
										<div class="featured-projects-image">
											<a href="http://www.sp.edu.pl/"><div class="wrap"><img src="/images/loga/smart_prospects.jpg" class="imgOpa" alt="Smart Projects" /></div></a>
										</div>
									</div>
								</li>
								<li>
									<div class="featured-projects">
										<div class="featured-projects-image">
											<a href="http://www.interia.pl/"><div class="wrap"><img src="/images/loga/interia-logo-2-0.svg" class="imgOpa" alt="Interia" /></div></a>
										</div>
									</div>
								</li>
								<li>
									<div class="featured-projects">
										<div class="featured-projects-image">
											<a href="http://www.notatek.pl/"><div class="wrap"><img src="/images/loga/logo-fb-new.jpg" class="imgOpa" alt="Notatek" /></div></a>
										</div>
									</div>
								</li>
								<li>
									<div class="featured-projects">
										<div class="featured-projects-image">
											<a href="http://www.youngtalentmanagement.pl/YTM/Young_Talent_Management.html">
                      <div class="wrap">
												<img src="/images/loga/YTM.jpg" class="imgOpa" alt="Young_Talent_Management" />
                      </div>
											</a>
										</div>
									</div>
								</li>
								<li>
									<div class="featured-projects">
										<div class="featured-projects-image">
											<a href="http://www.happinate.com/">
                      <div class="wrap">
												<img src="/images/loga/logo-happinate.png" class="imgOpa " alt="Happinate" />
                        </div>
											</a>
										</div>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
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