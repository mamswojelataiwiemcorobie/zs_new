		function string_to_slug(str) {
			  str = str.replace(/^\s+|\s+$/g, ''); // trim
			  str = str.toLowerCase();
			  
			  // remove accents, swap ñ for n, etc
			  var from = "ąàáäâęèéëêìíïîłńòóöôùúüûñç·/_,:;";
			  var to   = "aaaaaeeeeeiiiilnoooouuuunc------";
			  for (var i=0, l=from.length ; i<l ; i++) {
				str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
			  }
	
			  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
				.replace(/\s+/g, '-') // collapse whitespace and replace by -
				.replace(/-+/g, '-'); // collapse dashes
	
			  return str;
		};
		function trunc(string, limit){
			if (string.length > limit){
				string = string.substr( 0, limit)+"..."; 
			}
				return string;
		};
		//datatables-responsive:
		var responsiveHelper;
		var breakpointDefinition = {
			tablet: 1024,
			phone : 480
		};
		var tableContainer = $('#tUni');

		var oTable;
		$(function(){
			'use strict';
			$('#tUni').dataTable({
				"sAjaxSource": "/universities/index.json",

				"iDisplayLength": 10,
				//"bJQueryUI": true,

				"bProcessing": true,
				"sPaginationType": "full_numbers",
				"aaSorting": [[0,'asc']],
				"oLanguage": {
					"sProcessing":   "Proszę czekać...",
					"sLengthMenu":   "Pokaż _MENU_ pozycji",
					//"sZeroRecords":  "Nie znaleziono żadnych pasujących indeksów",
					"sZeroRecords":  "",
					"sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
					"sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
					"sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
					"sInfoPostFix":  "",
					"sSearch":       "Szukaj:",
					"sUrl":          "",
					"oPaginate": {
						"sFirst":    "<<",
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">>"
					}
				},
				//datatables-responsive:
				"sDom":'<"row"<"span6"l><"span6"f>r>t<"row"<"span6"i><"span6"p>>',
				"bAutoWidth"     : false,
				

				"aoColumns":[
					{ "sClass": "my_class" }, 
					null,//{ "sWidth": "10%" },
					null,
					null,
					null,
					null,
					
					{"bVisible": false, "bSearchable": false},//null,//{"bVisible": false, "bSortable": false, "bSearchable": false},
					{"bVisible": false, "bSearchable": false},//null//{"bVisible": false, "bSearchable": false},
					//{"bVisible": false, "bSearchable": false},
					{"bVisible": false, "bSearchable": true},

				],
				"fnCreatedRow": function(nRow, aData, iDataIndex){
					//$('td:eq(1)', nRow).html('<img style="width:100px;" src="img/uczelnie/'+aData[1]+'">');
					$('td:eq(1)', nRow).html('<img style="width:100px;" src="img/uczelnie_min/'+aData[1].slice(0,-4)+'.png">');
					$('td:eq(2)', nRow).html('<a href="uczelnia/'+string_to_slug(aData[2])+'-'+aData[7]+'" title="'+aData[2]+'">'+ aData[2],40 + '</a>');
					//$('td:eq(0)', nRow).html(trunc(aData[0],40));
					if ( aData[3] == "1" ){
						$('td:eq(3)', nRow).html("\u2714"); //lub 2713
						$('td:eq(3)', nRow).css('color', '#00bb00'); 
					}else{
						$('td:eq(3)', nRow).html("\u2718");
						$('td:eq(3)', nRow).css('color', '#ff0000');
					};
					$('td:eq(5)', nRow).html('<p title="'+aData[5]+'">'+ aData[5],40 + '</p>');

				},
				"fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
					//nTd.setAttribute("iRow", 'v');
					//nTd.setAttribute("iCol", 'v');
					//$(nTd).setAttribute("iCol", 'v');
				},
			}).yadcf([
			 // {column_number : 2, filter_default_label: "Wybierz miasto"},
			 // {column_number : 3, filter_default_label: "Wybierz typ szkoły"}
			]);
			/*
			$(window).load(function() {
				$('#tUni').dataTable().fnSetColumnVis( 0, false);
				//$('#tUni').dataTable().fnSe
			}).load();
			*/
			
			if (document.title=="Ranking uniwersytetów"){
			if (window.innerWidth<1000){
				var sort_nr=0;
				var min_sort;
				var max_cols;
				var counted=3;
				$(window).ready(function() {
					$("#counted").html(counted);
				});			

				$("#display-menu input").change(function(){
					sort_nr=sort_nr+1;
					$(this).attr('sort', sort_nr);
					//alert($(this).attr('sort'));

					var now_min_sort=1000;
					var now_sort;
					$("#display-menu input:checked").each(function() {
						//alert($(this).attr('sort') + ' < ' + now_min_sort);
						if ($(this).attr('sort')<now_min_sort){
							now_sort=$(this);
							now_min_sort=$(this).attr('sort');
							//alert(now_min_sort.attr('value') + ' ' + now_min_sort.attr('sort'));
						}
					});
					//alert("xxx" +now_sort.attr('value') + ' ' + now_sort.attr('sort'));

					max_cols=$('.display-table-ul').attr('cols');
					if ($("#display-menu input:checked").length>max_cols){
						now_sort.attr('checked', false);
						$('#tUni').dataTable().fnSetColumnVis(now_sort.attr('value'), false);
					}

					var chkArray = [];
					$("#display-menu input:not(:checked)").each(function() {
						chkArray.push($(this).val());
					});
					$.map(chkArray, function(val, i) {
						$('#tUni').dataTable().fnSetColumnVis( val, false);
					});

					var chkArray2 = [];
					$("#display-menu input:checked").each(function() {
						chkArray2.push($(this).val());
					});
					$.map(chkArray2, function(val, i) {
						$('#tUni').dataTable().fnSetColumnVis( val, true);
					});

					$("#counted").html(chkArray2.length);
					//alert(chkArray);

				});

				$(window).bind("load resize", function() {
					for (var i = 3; i > 1; i--) {
						$('#tUni').dataTable().fnSetColumnVis( i, true);
						$('input[value=' + i + ']').attr('checked', true);
					}
					var array = [];
					var cols = Math.round(($(window).width()-333)/150);
					//alert(cols);
					if (cols==0){
						cols=1
					}
					//alert($(window).width() + ' ' + cols);
					$('.display-table-ul').attr('cols', cols);
					//alert($('.display-table-ul').attr('cols'));
					for (var i = 3; i > cols; i--) {
						$('#tUni').dataTable().fnSetColumnVis( i, false);
						$('input[value=' + i + ']').attr('checked', false);

						array.push(i);
					}

					var chkArray2 = [];
					$("#display-menu input:checked").each(function() {
						chkArray2.push($(this).val());
					});
					$("#counted").html(chkArray2.length);
					//$(window).width() < 530) {
				});
			}
			}

			//KIERUNKI
			$('#tKierunki').dataTable({
				"sAjaxSource": "/courses/index.json",
				
				
				"bLengthChange": true, 
				"sPaginationType": "full_numbers",
				//"iDisplayLength": 100,
				//"bServerSide": true,
				//"sDom": 'CRTfrtip',
				"oLanguage": {
					"sProcessing":   "Proszę czekać...",
					"sLengthMenu":   "Pokaż _MENU_ pozycji",
					//"sZeroRecords":  "Nie znaleziono żadnych pasujących indeksów",
					"sZeroRecords":  "",
					"sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
					"sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
					"sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
					"sInfoPostFix":  "",
					"sSearch":       "Szukaj:",
					"sUrl":          "",
					"oPaginate": {
						"sFirst":    "<<", 
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">>"
					}
				},
				"bAutoWidth": false,
				"bProcessing": true,
				"aaSorting": [[6,'asc']],
				"aoColumns":[
					{ "sClass": "my_class" }, 
					null,//{ "sWidth": "10%" },
					null,
					null,
					
					{"bVisible": false, "bSearchable": false},
				],
				"fnCreatedRow": function(nRow, aData, iDataIndex){
					$('td:eq(1)', nRow).html('<a href="kierunek/'+string_to_slug(aData[1])+'-'+aData[6]+'" title="'+aData[1]+'">'+ trunc(aData[1],40) + '</a>');
					$('td:eq(3)', nRow).html('<p title="'+aData[3]+'">'+ trunc(aData[3],40) + '</p>');
				}
				}).yadcf([
				  {column_number : 2, filter_default_label: "Wybierz typ"}
			]);
			
			//MIASTA
			$('#cities').dataTable({
				"sAjaxSource": "/cities/index.json",
				//"sServerMethod": "POST",
				"iDisplayLength": 10,
				"bProcessing": true,
				"bLengthChange": true, 
				"oLanguage": {
					"sProcessing":   "Proszę czekać...",
					"sLengthMenu":   "Pokaż _MENU_ pozycji",
					//"sZeroRecords":  "Nie znaleziono żadnych pasujących indeksów",
					"sZeroRecords":  "",
					"sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
					"sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
					"sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
					"sInfoPostFix":  "",
					"sSearch":       "Szukaj:",
					"sUrl":          "",
					"oPaginate": {
					   "sFirst":    "<<",
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">>"
					}
				},
				"bAutoWidth": false,
				"bServerSide": true,
				
				
				//"sDom": 'CRTfrtip',
				"sPaginationType": "full_numbers",
				"aaSorting": [[0,'asc']],
				//"aoColumnDefs": [{ "sTitle": "Nr", "aTargets": [0 ] }],	

				"aoColumns":[
					
					null, //{ "sWidth": "15%" },
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					null,
					{"bVisible": false, "bSortable": true, "bSearchable": false},
					
					
					
				],
				
				"fnCreatedRow": function(nRow, aData, iDataIndex){
					$('td:eq(1)', nRow).html('<img style="width:50px;" src="img/miasta/'+aData[1]+'">');
					$('td:eq(2)', nRow).html('<a href="miasto/'+string_to_slug(aData[2])+'-'+aData[12]+'" title="'+aData[2]+'">'+ trunc(aData[2],40) + '</a>');
				}
			});
			
			
			//UCZELNIE
			$('#tUniKierunki').dataTable({
				"sAjaxSource": "/CourseonUniversities/index.json",
				"bProcessing": true,
				"bLengthChange": true, 
				"sPaginationType": "full_numbers",
				"oLanguage": {
					"sProcessing":   "Proszę czekać...",
					"sLengthMenu":   "Pokaż _MENU_ pozycji",
					//"sZeroRecords":  "Nie znaleziono żadnych pasujących indeksów",
					"sZeroRecords":  "",
					"sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
					"sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
					"sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
					"sInfoPostFix":  "",
					"sSearch":       "Szukaj:",
					"sUrl":          "",
					"oPaginate": {
						"sFirst":    "<<",
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">>"
					}
				},
				"bAutoWidth"     : false,
				"aaSorting": [[0,'asc']], 

				"aoColumns":[
					//{"bVisible": false, "bSortable": false, "bSearchable": false},
					{ "sWidth": "20%" },
					{ "sWidth": "15%" },
					{ "sWidth": "15%" },
					{ "sWidth": "5%" },
					{ "sWidth": "14%" },
					{"bVisible": false, "bSortable": false, "bSearchable": false},
				],
				"fnCreatedRow": function(nRow, aData, iDataIndex){
					$('td:eq(0)', nRow).html('<a href="kierunekuczelni/'+string_to_slug(aData[0])+'-'+aData[7]+'" title="'+aData[0]+'">'+ aData[1],25 + '</a>');
					//$('td:eq(2)', nRow).html('<p title="'+aData[2]+'">'+ aData[2],25 + '</p>');

				}
			}).yadcf([
				{column_number : 0, filter_default_label: "Wybierz uczelnie"},
				{column_number : 1, filter_default_label: "Wybierz kierunek"},
				{column_number : 3, filter_default_label: "Wybierz typ"},
				//{column_number : 5, filter_default_label: "Wybierz tryb"}
			]);	
			if (document.title=="Ranking kierunków na poszczególnych uniwersytetach"){
				if (window.innerWidth<1200){
				var sort_nr=0;
				var min_sort;
				var max_cols;
				var counted=4;
				$(window).ready(function() {
					$("#counted").html(counted);
				});

			

				$("#display-menu input").change(function(){
					sort_nr=sort_nr+1;
					$(this).attr('sort', sort_nr);
					//alert($(this).attr('sort'));

					var now_min_sort=1000;
					var now_sort;
					$("#display-menu input:checked").each(function() {
						//alert($(this).attr('sort') + ' < ' + now_min_sort);
						if ($(this).attr('sort')<now_min_sort){
							now_sort=$(this);
							now_min_sort=$(this).attr('sort');
							//alert(now_min_sort.attr('value') + ' ' + now_min_sort.attr('sort'));
						}
					});
					//alert("xxx" +now_sort.attr('value') + ' ' + now_sort.attr('sort'));

					max_cols=$('.display-table-ul').attr('cols');
					if ($("#display-menu input:checked").length>max_cols){
						now_sort.attr('checked', false);
						$('#tUniKierunki').dataTable().fnSetColumnVis(now_sort.attr('value'), false);
					}

					var chkArray = [];
					$("#display-menu input:not(:checked)").each(function() {
						chkArray.push($(this).val());
					});
					$.map(chkArray, function(val, i) {
						$('#tUniKierunki').dataTable().fnSetColumnVis( val, false);
					});

					var chkArray2 = [];
					$("#display-menu input:checked").each(function() {
						chkArray2.push($(this).val());
					});
					$.map(chkArray2, function(val, i) {
						$('#tUniKierunki').dataTable().fnSetColumnVis( val, true);
					});

					$("#counted").html(chkArray2.length);
					//alert(chkArray);

				});

				$(window).bind("load resize", function() {
					for (var i = 4; i > 1; i--) {
						$('#tUniKierunki').dataTable().fnSetColumnVis( i, true);
						$('input[value=' + i + ']').attr('checked', true);
					}
					var array = [];
					var cols = Math.round(($(window).width()-333)/150);
					if (cols==0){cols=1};
					//alert($(window).width() + ' ' + cols);
					$('.display-table-ul').attr('cols', cols);
					//alert($('.display-table-ul').attr('cols'));
					for (var i = 4; i > cols; i--) {
						$('#tUniKierunki').dataTable().fnSetColumnVis( i, false);
						$('input[value=' + i + ']').attr('checked', false);

						array.push(i);
					}

					var chkArray2 = [];
					$("#display-menu input:checked").each(function() {
						chkArray2.push($(this).val());
					});
					$("#counted").html(chkArray2.length);
					//$(window).width() < 530) {
				});
			}}	
			$('#tZawody').dataTable({
				"sAjaxSource": "/professions/index.json",
				"bLengthChange": true, 
				"sPaginationType": "full_numbers",
				"oLanguage": {
					"sProcessing":   "Proszę czekać...",
					"sLengthMenu":   "Pokaż _MENU_ pozycji",
					//"sZeroRecords":  "Nie znaleziono żadnych pasujących indeksów",
					"sZeroRecords":  "",
					"sInfo":         "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
					"sInfoEmpty":    "Pozycji 0 z 0 dostępnych",
					"sInfoFiltered": "(filtrowanie spośród _MAX_ dostępnych pozycji)",
					"sInfoPostFix":  "",
					"sSearch":       "Szukaj:",
					"sUrl":          "",
					"oPaginate": {
						"sFirst":    "<<",
						"sPrevious": "<",
						"sNext":     ">",
						"sLast":     ">>"
					}
				},
				"bAutoWidth" : false,
				"bProcessing": true,
				"bServerSide": true,
				"aaSorting": [[2,'dsc']], 
				"aoColumns":[
					null,
					{ "sWidth": "60%" },
					{ "sWidth": "40%" },
				],
				"fnCreatedRow": function(nRow, aData, iDataIndex){
					$('td:eq(1)', nRow).html('<a href="zawod/'+string_to_slug(aData[1])+'-'+aData[0]+'">'+ aData[1] +'</a>');
				}
			});
		});
		$(document).ready ( function () {
			$('#display-button').click(function(){
				$('#display-menu').toggleClass( "display-table-menu-hidden" );
			});
			$(document).click(function(event) {
				if (!$(event.target).is(".display")) {
					$('#display-menu').addClass( "display-table-menu-hidden" );
				}
			});
		});