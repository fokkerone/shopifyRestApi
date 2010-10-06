<?php
/**
 * Short description for file.
 *
 * @package         default
 * @subpackage      layouts
 * @version         $Revision$ ($Date$)
 * @author          Created by Marcus Spiegel on 2010-05-13. Last Editor: $Author$
 * @copyright       Copyright (c) 2010 uscreen GmbH. All rights reserved.
 * 
 * 	<div id="applesearch">
 *		<span class="sbox_l"></span><span class="sbox"><input type="search" id="srch_fld" placeholder="Search..."  value="<?=$q?>" autosave="applestyle_srch" results="5" onkeyup="applesearch.onChange('srch_fld','srch_clear')" /></span><span class="sbox_r" id="srch_clear"></span>
 *	</div>
 * 
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
    <title><?=$title_for_layout?></title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <?=$scripts_for_layout ?>
    <?=$this->Html->script('jquery-1.4.2.min.js')?>
    <?=$this->Html->script('jquery.uniform.min.js')?>
    <?=$this->Html->script('jquery.blockUI.js')?>
    <?=$this->Html->script('jquery.chili.min.js')?>
    <?=$this->Html->script('jquery.chili.recipes.js')?>
    <?=$this->Html->script('app.js')?>
	<script type="text/javascript" charset="utf-8">
		// $.chili.options.automatic.active = true;
		// $.chili.options.automatic.selector = 'pre';
		// $.chili.options.automatic.context = '#content';
	</script>

    <?=$this->Html->css('tripoli/tripoli.simple.css')?>
    <?=$this->Html->css('960.css')?>
    <?=$this->Html->css('uniform.default.css')?>
    <?=$this->Html->css('style.css')?>
    <!--[if IE]><?=$this->Html->css('tripoli/tripoli.simple.ie.css')?><![endif]-->

</head>
<body>
    <div id="header">
		<div class="c12 clearfix">
			<div class="g9 alpha">
        		<h1><?=@$appName?></h1>
			</div>
		</div>
        <div class="c12 clearfix" id="menu">
			<? if(!empty($tabs)):?>

	            <ul>
	                <? foreach($tabs as $link => $l): ?>
	                    <? $active = (!empty($l['active']))? 'active':'' ?>
	                    <li class="<?=$active?>"><?=$html->link($l['text'], array('controller' => $link, 'action' => 'index'))?></li>
	                <? endforeach ?>
	            </ul>

	        <? else: ?>
				
	            <!-- <ul>
	                <li><a href="">Home</a></li>
	                <li class="active"><a href="">A SuperLong-Menu-Item</a></li>
	                <li><a href="">One</a></li>
	                <li><a href="">Two</a></li>
	                <li><a href="">Free</a></li>
	            </ul> -->

			<? endif ?>
        </div>
    </div>
    <div id="flash">
        <div id="flash2">
			<?php echo $session->flash(); ?>
			<div class="c12">
				<?
					if(empty($q)) $q = '';
				?>
				<div class="g2 alpha">
					<? if(!empty($searchable)): ?>
					<?=$form->create(array('action' => 'index')); ?>
					<input name="q" autosave="applestyle_srch" results="5" type="text" placeholder="Search..."  value="<?=htmlspecialchars($q)?>">
					<?=$form->end(); ?>
					<? endif ?>
				</div>
				<? if(!empty($subtabs)):?>
				<div class="g10 omega" id="subtabs">
					<? foreach($subtabs as $link => $l):?>
						<?=$html->link($l['text'], array('action' => $link), array('class' => 'awesome'))?>
					<? endforeach ?>
				</div>
				<? endif ?>
			</div>
        </div>		
    </div>
    <div id="page">
        <div id="content" class="content c12">
            <?=$content_for_layout ?>
            <div class="clear"><!-- --></div>
			<?php echo $this->element('sql_dump'); ?>
        </div>
        <div id="footer">
            <div class="c12">
                <small>@ <?=date('Y')?> // uscreen GmbH</small>
            </div>
        </div>
    </div>
</body>
</html>