<?php
	echo $this->Html->css('table_chr1.css');
	echo $this->Html->css('table_nowrap.css');
	

	//responsive

	echo $this->Html->css('/css/tab/datatables.responsive.css');

	echo $this->Html->script('/js/tab/lodash.min.js');
	echo $this->Html->script('/js/tab/jquery.min.js');
	echo $this->Html->script('/js/tab/jquery.dataTables.min.js');
	echo $this->Html->script('/js/tab/datatables.responsive.js');
	echo $this->Html->script('/js/tab/DT_bootstrap.js');
	echo $this->Html->script('/js/tab/dom-bootstrap2.js');

	//echo $this->Html->script('kendo_plugin.js');

	echo $this->Html->css('/css/kendo/result-light.css');
	echo $this->Html->css('/css/kendo/kendo.common.min.css');
	echo $this->Html->css('/css/kendo/kendo.blueopal.min.css');
	echo $this->Html->script('/js/kendo/jquery-1.8.3.js');
	echo $this->Html->script('/js/kendo/kendo.web.min.js');

	function trunc($string, $limit, $break=".", $pad="...")
	{
		$string = substr($string, 0, $limit).$pad; 
		return $string;
	}
?>
<style type="text/css">
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
	@media screen and (max-width: 365px) {
	    table{
	        font-size: 13px;
	    }
	}
</style>
<script type="text/javascript">
		//document.getElementById('tUni_next').innerHTML="";
		//datatables-responsive:
			// ===========================================================
// MultiSelectBox, Kendo Plugin
// -----------------------------------------------------------
(function ($) {
    var MultiSelectBox = window.kendo.ui.DropDownList.extend({

        init: function (element, options) {
            var me = this;
            // setup template to include a checkbox
            options.template = kendo.template(
                kendo.format('<input type="checkbox" name="{0}" value="#= {1} #" />&nbsp;<label for="{0}">#= {2} #</label>',
                    element.id + "_option_" + options.dataValueField,
                    options.dataValueField,
                    options.dataTextField
                )
            );
            // create drop down UI
            window.kendo.ui.DropDownList.fn.init.call(me, element, options);
            // setup change trigger when popup closes
            me.popup.bind('close', function () {
                var values = me.ul.find(":checked")
                    .map(function () { return this.value; }).toArray();
                // check for array inequality
                if (values < me.selectedIndexes || values > me.selectedIndexes) {
                    me._setText();
                    me._setValues();
                    me.trigger('change', {});
                }
            });
        },

        options: {
            name: "MultiSelectBox"
        },

        selectedIndexes: [],

        _accessor: function (vals, idx) { // for view model changes
            var me = this;
            if (vals === undefined) {
                return me.selectedIndexes;
            }
        },

        value: function (vals) {
            var me = this;
            if (vals === undefined) { // for view model changes
                return me._accessor();
            } else { // for loading from view model
                var checkboxes = me.ul.find("input[type='checkbox']");
                if (vals.length > 0) {
                    // convert to array of strings
                    var valArray = $(vals.toJSON())
                        .map(function() { return this + ''; })
                        .toArray();
                    checkboxes.each(function () {
                        this.checked = $.inArray(this.value, valArray) !== -1;
                    });
                    me._setText();
                    me._setValues();
                }
            }
        },

        _select: function(li) { }, // kills highlighting behavior
        _blur: function () { }, // kills popup-close-on-click behavior

        _setText: function () { // set text based on selections
            var me = this;
            var text = me.ul.find(":checked")
                .map(function () { return $(this).siblings("label").text(); })
                .toArray();
            me.text(text.toString().replace(/,/g, ', '));
        },
        _setValues: function () { // set selectedIndexes based on selection
            var me = this;
            var values = me.ul.find(":checked")
                .map(function () { return this.value; })
                .toArray();
            me.selectedIndexes = values;
        }

    });

    window.kendo.ui.plugin(MultiSelectBox);

})(jQuery);
// ===========================================================

// view model
// -----------------------------------------------------------
var testVM = kendo.observable({
    testItems: [1,3],
    testItemSource: new kendo.data.DataSource({
        data: [
            { Id: 1, Name: "Test 1" },
            { Id: 2, Name: "Test 2" },
            { Id: 3, Name: "Test 3" },
            { Id: 4, Name: "Test 4" }
        ]
    }),
});
// ===========================================================

$(document).ready(function () {
    kendo.bind($("#testView"), testVM);
});
// ===========================================================
// ===========================================================
$( "#testView" ).on( "click", function() {
  
    $( "#log" ).html('searchIDs');
});
</script>
<div id="testView">
    <input id="testItems" data-role="multiselectbox" data-text-field="Name" data-value-field="Id" data-bind="source: testItemSource, value: testItems" />
</div>
<div id="log">c</div>
<h1 id="t" style="display: inline;">Ranking uniwersytetów</h1>
	<div id="lab">
		<label> Wybierz:
		<select id="sel" style=" display: inline; float: right; " class="cc">
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