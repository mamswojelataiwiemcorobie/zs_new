<?php 
	$uczelnie_wyniki = $this->requestAction(array('controller' => 'universities',

												'action' => 'rekomendowane'));
?>		

<?php if (!isset($uczelnie_nosearch)):?>
	<div class="znajdz-paginacja-c{if !isset($uczelnie_wyniki) || $uczelnie_wyniki|@count == 0} no-data{/if}"><div class="znajdz-paginacja">
		<h1 class="smalltitle"><br>
			<span>REKOMENDOWANE</span>
		</h1>
		<?php if (!isset($uczelnie_wyniki_brak)):?>
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
	</div></div>
<?php endif;?>