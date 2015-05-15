<?php 
$losowe = $this->requestAction(array('controller' => 'courses',
											'action' => 'losowyKierunek'));
							?>	
<section class="service-box topspace30" id="service-top">
	<div class="bgarea-semitransparent">
		<div class="row">
		    <div class="col-md-4 text-center animated fadeInLeftNow notransition fadeInLeft">
				<div class="icon-box-top">
					<a href="/kierunek/<?php echo strtolower(Inflector::slug($losowe[0]['Course']['nazwa'],'-')).'-'.  $losowe[0]['Course']['id'];?>.html"><i class="fontawesome-icon medium circle-white center icon-rocket"></i></a>
					<h1><?php echo $losowe[0]['Course']['nazwa']?></h1>
					<p><?php echo $this->Text->truncate(
												    strip_tags($losowe[0]['Course']['opis1']),
												    202,
												    array(
												        'ellipsis' => '...',
												        'exact' => false
												    )
												);?>
					</p>
					<p class="fontupper">
						<a href="/kierunek/<?php echo strtolower(Inflector::slug($losowe[0]['Course']['nazwa'],'-')).'-'.  $losowe[0]['Course']['id'];?>.html" class="readmore">więcej <i class="icon-double-angle-right"></i></a>
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
						<a href="/kierunek/<?php echo strtolower(Inflector::slug($losowe[1]['Course']['nazwa'],'-')).'-'.  $losowe[1]['Course']['id'];?>.html" class="readmore">więcej <i class="icon-double-angle-right"></i></a>
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
						<a href="/kierunek/<?php echo strtolower(Inflector::slug($losowe[2]['Course']['nazwa'],'-')).'-'.  $losowe[2]['Course']['id'];?>.html" class="readmore">więcej <i class="icon-double-angle-right"></i></a>
					</p>            
	        	</div>
	        </div>
		</div>
	</div>
</section>