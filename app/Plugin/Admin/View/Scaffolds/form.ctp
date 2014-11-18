<?php
/**
 * Scaffold Form
 *
 * PHP 5
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the below copyright notice.
 *
 * @author     Yusuf Abdulla Shunan <shunan@maldicore.com>
 * @copyright  Copyright 2012, Maldicore Group Pvt Ltd. (http://maldicore.com)
 * @license    MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @since      CakePHP(tm) v 2.1.1
 */
?>
<?php
echo $this->Html->script('/js/tinymce/jscripts/tiny_mce/tiny_mce.js');
?>

<script type="text/javascript">
tinymce.init({
    selector: "textarea",


//  /*
        // General options
        mode : "textareas",
        theme : "advanced",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Example content CSS (should be your site CSS)
        content_css : "css/example.css",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

        // Replace values for the template plugin
        template_replace_values : {
                username : "Some User",
                staffid : "991234"
        }
//  */
  /*
mode : "textareas",
        theme : "advanced",
        plugins : "emotions,spellchecker,advhr,insertdatetime,preview", 
                
        // Theme options - button# indicated the row# only
        theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,fontselect,fontsizeselect,formatselect",
        theme_advanced_buttons2 : "cut,copy,paste,pasteplaintext,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",      
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true
  */

});
</script>
    
<div class="row-fluid">
    <div class="col-md-2">
        <div>
            <P class="nav-header"><?php echo __d('cake', 'Actions'); ?></P>
            <ul class="nav nav-tabs nav-stacked">
                <?php if ($this->request->action != 'add'): ?>
                    <li><?php echo $this->BSForm->postLink(__d('cake', 'Delete'), array('action' => 'delete', $this->BSForm->value($modelClass . '.' . $primaryKey)), null, __d('cake', 'Are you sure you want to delete #%s?', $this->BSForm->value($modelClass . '.' . $primaryKey))); ?></li>
                <?php endif;?>
                <li><?php echo $this->Html->link(__d('cake', 'List') . ' ' . str_replace('Admin ', '', $pluralHumanName), array('plugin' => 'admin', 'action' => 'index')); ?></li>
                <?php $done = array(); ?>
                <?php foreach ($associations as $_type => $_data): ?>
                    <?php foreach ($_data as $_alias => $_details): ?>
                        <?php if ($_details['controller'] != $this->name && !in_array($_details['controller'], $done)): ?>
                            <li><?php echo $this->Html->link(__d('cake', 'List %s', Inflector::humanize($_details['controller'])), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' =>'index')); ?></li>
                            <li><?php echo $this->Html->link(__d('cake', 'New %s', Inflector::humanize(Inflector::underscore($_alias))), array('plugin' => 'admin', 'controller' => $_details['controller'], 'action' =>'add')); ?></li>
                            <?php $done[] = $_details['controller']; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="col-md-10">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->BSForm->create($modelClass, array('type' => 'file')); ?>
        <?php echo $this->BSForm->inputs($scaffoldFields, array('created', 'modified', 'updated')); ?>
        <?php echo $this->BSForm->end(__d('cake', 'Save')); ?>
    </div>
</div>
