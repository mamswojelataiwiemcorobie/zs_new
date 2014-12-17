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
		<div class="gmap-add-info">

			<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_province">
				<div>
					<label for="company_province">Województwo</label>
					<div class="content"><select id="company_province" name="company[province]">
						<option value="0"></option>
						<option value="mazowieckie">Mazowieckie</option>
						<option value="lubelskie">Lubelskie</option>
						<option value="zachodniopomorskie">Zachodniopomorskie</option>
						<option value="łódzkie">Łódzkie</option>
						<option value="małopolskie">Małopolskie</option>
						<option value="warmińsko-mazurskie">Warmińsko-Mazurskie</option>
						<option value="świętokrzyskie">Świętokrzyskie</option>
						<option value="dolnośląskie">Dolnośląskie</option>
						<option value="pomorskie">Pomorskie</option>
						<option value="podkarpackie">Podkarpackie</option>
						<option value="opolskie">Opolskie</option>
						<option value="wielkopolskie">Wielkopolskie</option>
						<option value="kujawsko-pomorskie">Kujawsko-Pomorskie</option>
						<option value="lubuskie">Lubuskie</option>
						<option selected="selected" value="śląskie">Śląskie</option>
						<option value="podlaskie">Podlaskie</option>
					</select></div>
				</div>
			</div>


			<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_city">
				<div>
					<label for="company_city">Miasto</label>
					<div class="content"><input type="text" id="company_city" value="Chorzów" name="company[city]"></div>
				</div>
			</div>

			<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_street">
				<div>
					<label for="company_street">Ulica</label>
					<div class="content"><input type="text" id="company_street" value="Józefa Maronia" name="company[street]"></div>
				</div>
			</div>

			<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_building_number">
				<div>
					<label for="company_building_number">Building number</label>
					<div class="content"><input type="text" id="company_building_number" value="44" name="company[building_number]"></div>
				</div>
			</div>

			<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_post_code">
				<div>
					<label for="company_post_code">Post code</label>
					<div class="content"><input type="text" id="company_post_code" value="41-506" name="company[post_code]"></div>
				</div>
			</div>
			
		</div>
	</div>
	</div>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	<script src="/js/sf_widget_gmap_address.js" type="text/javascript"></script>
</div>