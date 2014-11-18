<?php
	echo $this->Html->css('table_chr1.css');
	echo $this->Html->css('table_nowrap.css');
?>
<style type="text/css">
.my_class{
	//position:absolute; 
    //left:0;
}
	.dataTables_length label select {
	width: 60px !important;
	}
	.cc{
		margin-left: 5px;
		float: none !important;
	}
	@media screen and (min-width: 530px) {
	    #lab {
	        display: none !important;
	    }
	}
	@media screen and (max-width: 385px) {
	    table{
	        font-size: 13px;
	    }
	    .first, .previous, .next, .last, .paginate_active, .paginate_button{
	    	font-size: 15px !important;
	    	padding: 5px 10px !important;
	    }
	}
.red{
    background-color: #f54828 !important;
    color: #fff !important;
}
.z{
    z-index: 1 !important;
}

</style>




<?php

// Original PHP code by Chirp Internet: www.chirp.com.au
// Please acknowledge use of this code by including this header.
// http://www.the-art-of-web.com/php/truncate/

function trunc($string, $limit, $break=".", $pad="...")
{
	$string = substr($string, 0, $limit).$pad; 

	return $string;
}

?>
<?php
	//responsive

	echo $this->Html->css('/css/display/reset.css');
	echo $this->Html->css('/css/display/rwd-table.css');

	//echo $this->Html->script('/js/display/jquery-ui.widget.min.js');
	//echo $this->Html->script('/js/display/rwd-table.js');
	//echo $this->Html->script('http://code.jquery.com/jquery-1.11.0.min.js');
?>
<script type="text/javascript">

	//document.getElementById('tUni_next').innerHTML="";
	//datatables-responsive:

$(document).ready ( function () {
	$('.table-menu-btn').click(function(){
	    $('#s').toggleClass( "table-menu-hidden z" );
	    $('.table-menu-btn').toggleClass( "red" );
	});
});
</script>

<div class="table-wrapper">
	<div class="table-menu-wrapper">
		<a class="table-menu-btn">Pokaż</a>
		<div id="s" class="table-menu table-menu-hidden">
		<ul class="display-table-ul">
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-1" value="co-1" checked="checked">
				<label for="toggle-col-1">Last Trade</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-2" value="co-2" checked="checked">
			 	<label for="toggle-col-2">
				Trade Time</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-3" value="co-3" checked="checked">
			 	<label for="toggle-col-3">
				Change</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-4" value="co-4" checked="checked">
				<label for="toggle-col-4">
				Prev Close</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-5" value="co-5" checked="checked">
				<label for="toggle-col-5">
				Open</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-6" value="co-6" checked="checked">
				<label for="toggle-col-6">
				Bid</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-7" value="co-7" checked="checked">
				<label for="toggle-col-7">
				Ask</label>
			</li>
			<li>
				<input type="checkbox" name="toggle-cols" id="toggle-col-8" value="co-8" checked="checked">
				<label for="toggle-col-8">
				1y Target Est</label>
			</li>
		</ul>
	</div>
</div>




	<div id="lab">
		<label> Wybierz:<select id="sel" style=" display: inline; float: right; " class="cc">
				<option value="1">Publiczna</option>
				<option value="2">Miasto</option>
				<option value="3">Typ Szkoły</option>
			</select>
		</label>
	</div>

<div class="span12">
	<table id="tUni" class="table table-bordered table-striped dataTable has-columns-hidden">
		<thead>
			<tr>
				<th data-class="expand">Nazwa</th>
				<th>Publiczna</th>
				<th data-hide="phone">Miasto</th>
				<th data-hide="phone,tablet">Typ szkoły</th>

				<!-- <th>Ocena / Śr. w naszym rankingu</th> -->
			</tr>
		</thead>
		 <tbody>
		 
		</tbody>
	<?php unset($university); ?>
	</table>
</div>