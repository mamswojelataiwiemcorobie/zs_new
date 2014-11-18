<section class="intro-note topspace10">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <h1>Znajdź polskie <span class="colortext">uczelnie </span>które mają podpisane umowy w ramach programu erasmus+.</h1>
          <p>Możesz wyszukać zarówno po kraju jak i mieście i konkretnej szkole wyższej.</p>
        </div>
      </div>
    </div>
   </section>
    <!-- /.intro-note end-->

<div id="erasmus">

	<!--<h1 id='sss'>Gdzie na Erasmusa?</h1>-->



	<?php

	//echo $this->Session->flash();

	if (!isset($this->request->data['Exchange'])){

		echo $this->Form->create();

		echo $this->Form->input('kraj', array(	'options' => $kraje_v,

												'class' => 'form-control',

												'size' => 7, 

												'type' => 'select' ,

												'security' => false));

		echo $this->Form->input('miasto', array('class' => 'form-control',

												'size' => 7, 

												'type' => 'select' ,

												'security' => false));

		echo $this->Form->input('uczelnia', array('class' => 'form-control',

												'size' => 7, 

												'type' => 'select' ));

		echo $this->Form->submit('szukaj', array('div'=>true, 'name'=>'submit', 'id' => 'szukaj','class' => 'buttoncolor'));

	

		echo $this->element('uczelnie_erasmus', array("uczelnie_erasmus" => $uczelnie_erasmus));		



		echo $this->Form->end(); 

	}

	?>

	<div class="clearfix"></div>

</div>

<?php

$this->Js->get('#ExchangeKraj')->event('change', 

	$this->Js->request(array(

		'controller'=>'Exchanges',

		'action'=>'getByKraj'

		), array(

			'update'=>'#ExchangeMiasto',

			'async' => true,

			'method' => 'post',

			'dataExpression'=>true,

			'data'=> $this->Js->serializeForm(array(

				'isForm' => true,

				'inline' => true

				))

		))

	);

$this->Js->get('#ExchangeMiasto')->event('click', 

	$this->Js->request(array(

		'controller'=>'Exchanges',

		'action'=>'getByMiasto'

		), array(

			'update'=>'#ExchangeUczelnia',

			'async' => true,

			'method' => 'post',

			'dataExpression'=>true,

			'data'=> $this->Js->serializeForm(array(

				'isForm' => true,

				'inline' => true

				))

		))

	);

$this->Js->get('#ExchangeIndexForm')->event(

          'submit',

          $this->Js->request(

            array('controller'=>'Exchanges','action' => 'uczelnie_erasmus'),

            array(

                    'update' => '#lista_erasmusy',

                    'data'=> $this->Js->serializeForm(array(

				'isForm' => true,

				'inline' => true

				)),

                    'async' => true,    

                    'dataExpression'=>true,

                    'method' => 'POST'

                )

            )

        );

$this->Js->get('#ExchangeIndexForm')->event(

          'submit',

          $this->Js->request(

            array('controller'=>'Exchanges','action' => 'slider_exchanges'),

            array(

                    'update' => '#x',

                    'data'=> $this->Js->serializeForm(array(

				'isForm' => true,

				'inline' => true

				)),

                    'async' => true,    

                    'dataExpression'=>true,

                    'method' => 'POST'

                )

            )

        );

$this->Js->get('#ExchangeIndexForm')->event(

          'submit',

          $this->Js->request(

            array('controller'=>'Exchanges','action' => 'slider_exchanges'),

            array(

                    'update' => '#carousel-projects',

                    //'before ' => $this->Js->get('#divCheckbox')->each('$(this).css("visibility", "visible");'),

                    //'complete' => $this->Js->alert('hey you!'),

                    'data'=> $this->Js->serializeForm(array(

				'isForm' => true,

				'inline' => true

				)),

                    'async' => true,    

                    'dataExpression'=>true,

                    'method' => 'POST'

                )

            )

        );



?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<?php //czy poniĹĽĹĽsze nie daje konfliktu z Cakephp ??? spr! ?>

<script type="text/javascript">

	//<![CDATA[

		$('document').ready(function () {

			/*

			$("#szukaj").bind("click", function (event) {

				alert("hey you!");

				//$('#divCheckbox').css("visibility", "hidden");

				$('#divCheckbox').css("visibility", "visible");

				return false;

			});

			*/

			$("#ExchangeIndexForm").bind("submit", function (event) {

				//alert("hey you!");

				//$('#divCheckbox').css("visibility", "hidden");

				$('#divCheckbox').css("visibility", "visible");

				return false;

			});

		});

	//]]>

</script>



<div id="divCheckbox" style="visibility: hidden" >

	<section class="recent-projects-home topspace30 animated fadeInUpNow notransition fadeInUp">

		<div class="text-center smalltitle">

		</div>	

		<div class="col-md-12">

			<div id="carousel" class="list_carousel text-center">

				<div class="carousel_nav">

					<a class="prev" id="car_prev" href="#" style="display: block;"><span>prev</span></a>

					<a class="next" id="car_next" href="#" style="display: block;"><span>next</span></a>

				</div>

				<div class="clearfix">

				</div>

				<div class="caroufredsel_wrapper" style="display: block; text-align: center; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 1120px; height: 270px; margin: 0px; overflow: hidden;">

					<ul id="carousel-projects" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; z-index: 1; margin: 0px; width: 11760px; height: 270px;">

						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>



						

						<li class="li_" style="width: 270px;">

							<div class="boxcontainer" style="height:270px">

								<img src="http://szkolywyzsze.edu.pl/img/uczelnie_min/empty.png" alt="">				<div class="roll" style="opacity: 0;">

								<div class="wrapcaption">

									<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>						<i class="icon-link captionicons"></i>

								</div>

							</div>

							<h1></h1>

							<a href="/uczelnia/Wyzsza-Szkola-Bezpieczenstwa-Publicznego-i-Indywidualnego-Apeiron-349"></a>			</div>

						</li>

					

					</ul>

				</div>

			</div>

		</div>

	</section>

</div>

<?php

		//pr($this->request->data); 

?>





