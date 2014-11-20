<?php 
$losowe = $this->requestAction(array('controller' => 'courses',
											'action' => 'losowyKierunek'));
							?>	
<section class="service-box topspace30" id="service-top">
	<div class="container">
		<div class="row">
		    <div class="col-md-4 text-center animated fadeInLeftNow notransition fadeInLeft">
				<div class="icon-box-top">
					<i class="fontawesome-icon medium circle-white center icon-rocket"></i>
					<h1><?php echo $losowe[0]['Course']['nazwa']?></h1>
					<p><?php echo $this->Text->truncate(
												    $losowe[0]['Course']['opis1'],
												    202,
												    array(
												        'ellipsis' => '...',
												        'exact' => false
												    )
												);?>
					</p>
					<p class="fontupper">
						<a href="#" class="readmore">Read More <i class="icon-double-angle-right"></i></a>
					</p>
				</div>
			</div>
			<div class="col-md-4 text-center animated fadeInLeftNow notransition">
	        	<div class="icon-box-top">
	            	<i class="fontawesome-icon medium circle-white center icon-book"></i>            
	            	<h1><?php echo $losowe[1]['Course']['nazwa']?></h1>
					<p><?php echo $this->Text->truncate(
												    $losowe[1]['Course']['opis1'],
												    202,
												    array(
												        'ellipsis' => '...',
												        'exact' => false
												    )
												);?>
					</p>
					<p class="fontupper">
						<a href="#" class="readmore">Read More <i class="icon-double-angle-right"></i></a>
					</p>        
	          </div>
	        </div>
	        <div class="col-md-4 text-center animated fadeInLeftNow notransition">
	        	<div class="icon-box-top">
	        		<i class="fontawesome-icon medium circle-white center icon-arrow-right"></i>            
	            	<h1><?php echo $losowe[2]['Course']['nazwa']?></h1>
					<p><?php echo $this->Text->truncate(
												    $losowe[2]['Course']['opis1'],
												    202,
												    array(
												        'ellipsis' => '...',
												        'exact' => false
												    )
												);?>
					</p>
					<p class="fontupper">
						<a href="#" class="readmore">Read More <i class="icon-double-angle-right"></i></a>
					</p>            
	        	</div>
	        </div>
		</div>
	</div>
</section>