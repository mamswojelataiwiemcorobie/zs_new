$(function(){
	if ($('input.date').size() > 0) $('input.date').not('.hasDatepicker').datepicker({dateFormat:'dd/mm/yy'});
	if ($('.jsimageupload_single, .jsimageupload_multi').size() > 0) {
		imageupload.init();
	}
	$('.delimage').click(imageupload.delimage);
});

var imageupload = {
	init: function() {
		$('.jsimageupload_single').each(function(){
			$(this).append('<form class="imageform_single" method="post" enctype="multipart/form-data" action="/ajaximage.php">Wybierz zdjęcie z dysku <input type="file" name="photoimg" id="imageform_single" value="wybierz"/></form>');
			imageupload.prepare_upload_single($('#imageform_single'));
			imageupload.prepare_buttons();
		});
		$('.jsimageupload_multi').each(function(){
			$(this).append('<form class="imageform_multi" method="post" enctype="multipart/form-data" action="/ajaximage.php">Wybierz zdjęcie z dysku <input type="file" name="photoimg" id="imageform_multi" value="wybierz"/></form>');
			imageupload.prepare_upload_multi($('#imageform_multi'));
			imageupload.prepare_buttons();
		});
	},
	prepare_upload_multi: function(_input) {
		_input.live('change', function(){
			alert('hoho');
			_input.parent().after('<img src="/loader.gif"/>');
			$.getJSON( "/ajaximage.php", function( data ) { console.log(data);});
			$(".imageform_multi").ajaxForm(function(a,b,c){

				_input.parents('form').get(0).reset();
				
				$(_input.parent().get(0).nextSibling).remove();

				if (a.status && a.status == 1)  {
					_input.parent().parent().after('<div class="uimage"><input type="hidden" name="galeria[]" value="'+a.imagename+'"/><img src="/miniatura/200x200/uploads/'+a.imagename+'"/><div class="buttons"><span class="leftimage"> &laquo; </span><span class="delimage">usuń</span><span class="rightimage"> &raquo; </span></div></div>');
					imageupload.prepare_buttons();
				} else {
					alert('Błąd: '+a);
				}
			}).submit();
		});
	},
	prepare_upload_single: function(_input) {
		_input.live('change', function(){
			_input.parent().after('<img src="/loader.gif"/>');
			$(".imageform_single").ajaxForm(function(a,b,c){
				_input.parents('form').get(0).reset();
				$(_input.parent().get(0).nextSibling).remove();
				if (a.status && a.status == 1)  {
					var div = _input.parent().parent();
					div.nextAll().remove();
					div.after('<div class="uimage"><input type="hidden" name="logo" value="'+a.imagename+'"/><img src="/miniatura/200x200/uploads/'+a.imagename+'"/><div class="buttons"><span class="leftimage"> &laquo; </span><span class="delimage">usuń</span><span class="rightimage"> &raquo; </span></div></div>');
					imageupload.prepare_buttons();
				} else {
					alert('Błąd: '+a.msg);
				}
			}).submit();
		});
	},
	delimage: function(e) {
		if (!confirm('Czy na pewno chcesz usunąć?')) return;
		var tg = e.target.parentNode.parentNode;
		$(tg).remove();
	},
	leftimage: function(e) {
		var tg = e.target.parentNode.parentNode;
		if (tg.previousSibling && $(tg.previousSibling).hasClass('uimage')) $(tg).after(tg.previousSibling);
	},
	rightimage: function(e) {
		var tg = e.target.parentNode.parentNode;
		if (tg.nextSibling) $(tg).before(tg.nextSibling);
	},
	prepare_buttons: function() {
		$('.delimage').unbind('click',imageupload.delimage).bind('click',imageupload.delimage);
		$('.leftimage').unbind('click',imageupload.leftimage).bind('click',imageupload.leftimage);
		$('.rightimage').unbind('click',imageupload.rightimage).bind('click',imageupload.rightimage);
	}
}

function potwierdz_usuniecie() {
	return confirm('Czy na pewno chcesz usunąć?');
}


$(function(){
	$('.gmap-overflow-call').click(m_gmap.call);
	
	$('.remove-link').click(potwierdz_usuniecie);
});

function potwierdz_usuniecie() {
	return confirm('Czy na pewno chcesz usunąć?');
}

function zwin(classname){
	$('.'+classname).toggle();
	return false;
}

var m_gmap = {
	hasInstance:false,
	isHidden:true,
	currentTarget:false,
	gmapWidgetInstance:false,
	createInstance: function() {
		m_gmap.gmapWidgetInstance = new sfGmapWidgetWidget({
			longitude: "company_address_longitude",
			latitude: "company_address_latitude",
			address: "company_address_address",
			lookup: "company_address_lookup",
			map: "company_address_map",
			province: "company_province",
			city: "company_city",
			district: "company_district",
			street: "company_street",
			street_number: "company_building_number",
			post_code: "company_post_code"
		});
		$('#company_address_save').click(m_gmap.zapisz_pozycje);
		m_gmap.hasInstance = true;
	},
	call: function(e) {
		var pt = $(e.target).closest('body');
		
		//var adres = pt.find('.gmap-adres').val();
		var lon = pt.find('.gmap-lon').val();
		var lat = pt.find('.gmap-lat').val();
		//$('#company_address_address').val(adres);
		$('#company_address_longitude').val(lon);
		$('#company_address_latitude').val(lat);

		if (!m_gmap.hasInstance) {
			m_gmap.createInstance();
		} else m_gmap.gmapWidgetInstance.resetMarker();
		
		if (m_gmap.isHidden) m_gmap.show(e.target);
	},
	show: function(rel) {
		var go = $('#gmap-overflow');
		
        go.show();

		m_gmap.currentTarget = $(rel);
	},
	hide: function() {
		var go = $('#gmap-overflow');
		go.modal('hide');
		m_gmap.currentTarget = false;
		m_gmap.isHidden = true;
	},
	zapisz_pozycje: function(e) {
		var lon = Math.floor(parseFloat($('#company_address_longitude').val())*7200000)/7200000;
		var lat = Math.floor(parseFloat($('#company_address_latitude').val())*7200000)/7200000;
		var ct = m_gmap.currentTarget.closest('body');
		ct.find('.gmap-lon').val(lon);
		ct.find('.gmap-lat').val(lat);
		m_gmap.hide();
		e.preventDefault();
	},
}

function toggleCheckedlic(status) {
	$(".cc1").each( function() {
		$(this).attr("checked",status);
	})
}
function toggleCheckedmgr(status) {
	$(".cc2").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked3(status) {
	$(".cc3").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked4(status) {
	$(".cc4").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked5(status) {
	$(".cc5").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked6(status) {
	$(".cc6").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked7(status) {
	$(".cc7").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked8(status) {
	$(".cc8").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked9(status) {
	$(".cc9").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked10(status) {
	$(".cc10").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked11(status) {
	$(".cc11").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked12(status) {
	$(".cc12").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked13(status) {
	$(".cc13").each( function() {
		$(this).attr("checked",status);
	})
}

function toggleChecked14(status) {
	$(".cc14").each( function() {
		$(this).attr("checked",status);
	})
}