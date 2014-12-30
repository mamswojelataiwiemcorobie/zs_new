<div id="gmap-overflow" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

		<div class="gmap-main">
			<div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		        <h4 id="myModalLabel" class="gmap-header">Wpisz adres aby wyszukać, lub przeciągnij znacznik aby wybrać pozycję</h4>
		     </div>
			<div class="content">
				<div id="company_address" class="sf-gmap-widget">
					<div class="lft"><label for="company_address_address">Adres</label> <input style="width:300px" name="company[address][address]" value="" id="company_address_address" type="text"/></div>

					<div class="lft"><input value="Szukaj" id="company_address_lookup" type="submit"/></div>
					<div class="rgt"><input value="Zapisz pozycję" id="company_address_save" type="submit"/></div>
					<div class="cl"></div>

					<input name="company[address][longitude]" value="" id="company_address_longitude" type="hidden"/>
					<input name="company[address][latitude]" value="" id="company_address_latitude" type="hidden"/>
				</div>
				<div id="company_address_map" style="width: 100%; height: 300px; position: relative; background-color: rgb(229, 227, 223); overflow: hidden;"></div>
			</div>

		</div>
	</div>
	</div>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="/js/sf_widget_gmap_address.js" type="text/javascript"></script>
</div>