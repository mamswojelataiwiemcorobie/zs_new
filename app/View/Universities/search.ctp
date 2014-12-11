<div id="searchpage" class="row <?php if ($tid == '2'):?>znajdz-szkole-policealna<?php elseif ($tid == '3'):?>znajdz-szkole-jezykowa<?php endif;?>">
	<div class="col-md-8 l">
		<?php echo $this->Form->create('University',array('action'=>'search/'.$tid,'class'=>'form-inline input-append', 'role'=>'form', 'type' => 'GET'));?>
			<input type="text" name="keywords" placeholder="Type something…" class="input-medium">
			<button class="btn" type="submit" >Search</button>
			<button class="btn" type="button">Options</button>
		<?php echo $this->Form->end();?>
		
		<?php if (!isset($uczelnie_nosearch)):?>
		<div class="znajdz-paginacja-c{if !isset($uczelnie_wyniki) || $uczelnie_wyniki|@count == 0} no-data{/if}"><div class="znajdz-paginacja">
			<h1 class="smalltitle"><br>
				<span>Wyniki wyszukiwania</span>
			</h1>
			<?php if (!isset($uczelnie_wyniki_brak)):?>
			<?php
				echo $this->Paginator->counter(array(
				  'format' => __('Strona {:page} z {:pages}, Znaleziono {:count} wyników')
				));
				switch ($tid) {
					case 1:
						$r = 'szkoly-wyzsze'; break;
					case 2:
						$r = 'Szkoły-policealna'; break;
					case 3:
						$r = 'Szkoły-językowa'; break;
				}
				$action = '/'.$r.'-'. $tid .'.html/';
				if (isset($this->request->query['keywords'])) {
					$action = $action + $this->request->query['keywords'];				}
				$this->Paginator->options(array(

				    'url' =>array(
				        'controller' => 'wyszukiwarka',
				        'action' => $action
				    )
				    
				));
			?>
			<ul class="pagination pagination-lg">
				<?php
				  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
				  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
				  echo $this->Paginator->next('&raquo;',array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
				?>
			</ul><?php endif;?>
		</div></div><?php endif;?>
		<?php if (!isset($uczelnie_wyniki_brak)):?>
		<?php if (count($uczelnie_wyniki) > 0) echo $this->element('wyniki_promo');?>
		<?php if (isset($uczelnie_wyniki_demo)):?><div class="znajdz-wyniki-low">
			<?php foreach ($uczelnie_wyniki_demo as $uw):?><hr/>
			<div class="item-low">
				<div class="header">
					<a href="/uczelnia/<?php echo $slug=Inflector::slug($uw['University']['nazwa'],'-').'-'.  $uw['University']['id'];?>.html" class="title"><?php echo $uw['University']['nazwa'];?></a>
					<span class="url"><?php echo $uw['UniversitiesParameter']['www'];?></span>
				</div>
				<address><?php echo $uw['UniversitiesParameter']['adres'];?><br/><?php if ($uw['UniversitiesParameter']['telefon']):?>tel: <?php echo $uw['UniversitiesParameter']['telefon']; endif;?></address>
			</div>
			<?php endforeach;?>
			<hr/>
		</div><?php endif;?>
		<?php else:?><div class="no-data-info">Nie znaleziono żadnych uczelni o podanych kryteriach.</div>
		<?php endif;?>
		<?php if (!isset($uczelnie_nosearch)):?>
		<div class="znajdz-paginacja-c znajdz-paginacja-c-footer"><div class="znajdz-paginacja">
			<?php if (!isset($uczelnie_wyniki_brak)):?>
				<ul class="pagination pagination-lg">
					<?php
					  echo $this->Paginator->prev('&laquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&laquo;</a>', array('class' => 'prev disabled', 'tag' => 'li', 'escape' => false));
					  echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentLink' => true, 'currentClass' => 'active', 'currentTag' => 'a'));
					  echo $this->Paginator->next('&raquo;', array('tag' => 'li', 'escape' => false), '<a href="#">&raquo;</a>', array('class' => 'next disabled', 'tag' => 'li', 'escape' => false));
					?>
				</ul>
			<?php endif;?>
		</div></div><?php endif;?>
	</div>
	<div class="col-md-4 r"><?php echo $this->element('column_right');?></div>
	<div class="cl"></div>
</div>