<?php 

	$content_type = "-";
	if (isset($component_data['content_type'])) $content_type = $component_data['content_type'];

	$rows_count = 0;
	if (isset($component_data['rows_count'])) $rows_count = (int)$component_data['rows_count'];

	
	$image_type = "thumbnail";
	if (isset($component_data['image_type'])) $image_type = $component_data['image_type'];

	$title_column_name = "title_column_name";
	if (isset($component_data['title_column_name'])) $title_column_name = $component_data['title_column_name'];
	
	$subtitle_column_name = "subtitle_column_name";
	if (isset($component_data['subtitle_column_name'])) $subtitle_column_name = $component_data['subtitle_column_name'];

	$preview_column_name = "preview_column_name";
	if (isset($component_data['preview_column_name'])) $preview_column_name = $component_data['preview_column_name'];

	$image_column_name = "image_column_name";
	if (isset($component_data['image_column_name'])) $image_column_name = $component_data['image_column_name'];

	$note_column_name = "note_column_name";
	if (isset($component_data['note_column_name'])) $note_column_name = $component_data['note_column_name'];	

	$visibility_column_name = "visibility_column_name";
	if (isset($component_data['visibility_column_name'])) $visibility_column_name = $component_data['visibility_column_name'];
	
	$sort_column_name = "-";
	if (isset($component_data['sort_column_name'])) $sort_column_name = $component_data['sort_column_name'];	
	
	$sort_column_name = "";
	if (isset($component_data['sort_column_name'])) $sort_column_name = $component_data['sort_column_name'];
	

	$sort_direction = "ASC";
	if (isset($component_data['sort_direction'])) $sort_direction = $component_data['sort_direction'];	
	
	$divider_type = "inset";
	if (isset($component_data['divider_type'])) $divider_type = $component_data['divider_type'];	
	
	$divider_color = '--ion-color-light';
    if (isset($component_data['divider_color'])) $divider_color = $component_data['divider_color'];
	$divider_color_value = '';		
	if (isset($component_data['divider_color_value'])) $divider_color_value = $component_data['divider_color_value'];	


	$store_first = "yes";
	if (isset($component_data['store_first'])) $store_first = $component_data['store_first'];	
	
	//Insert into code page our code
    if (file_exists(public_path().'/storage/application/'.$component_data['application']->id.'-'.$component_data['application']->unique_string_id.'/sources/src/app/page'.$component_data['page']->id.'/page'.$component_data['page']->id.'.page.ts')) {
        $content = file_get_contents(public_path().'/storage/application/'.$component_data['application']->id.'-'.$component_data['application']->unique_string_id.'/sources/src/app/page'.$component_data['page']->id.'/page'.$component_data['page']->id.'.page.ts');

		$content = str_replace("/*simple_list_variable*/", "/*simple_list_variable*/" . "\nprivate simple_list_".$component_data['page_component_id'].": any = [];\nprivate simple_list_loaded_".$component_data['page_component_id'].": boolean = false;", $content);
		$content = str_replace("/*simple_list_load_function*/", "/*simple_list_load_function*/" . "\nthis.load_simple_list(".$content_type.",".$component_data['page_component_id'].",'{$sort_column_name}','{$sort_direction}',{$rows_count},'{$store_first}');", $content);

        file_put_contents(public_path().'/storage/application/'.$component_data['application']->id.'-'.$component_data['application']->unique_string_id.'/sources/src/app/page'.$component_data['page']->id.'/page'.$component_data['page']->id.'.page.ts',$content);
    }	
	
	
	$card_background_color = $component_data['component']['card_background_color'];
	$card_background_color_value = "";
	$card_border_color = $component_data['component']['card_border_color'];
	$card_border_color_value = "";
	
	//далее, создам массив, чтобы не заморачиваться обработкой кучи полей
	$text_fields = [
		["name"=>"Title","code"=>"title"],
		["name"=>"Subitle","code"=>"subtitle"],
		["name"=>"Preview text","code"=>"preview"],
		["name"=>"Note text","code"=>"note"],
	];	
	
	foreach ($text_fields as $text_field) {
		$code = $text_field['code'];
		
		${$code."_wrap"} = "wrap";
		if (isset($component_data[$code."_wrap"])) ${$code."_wrap"} = $component_data[$code."_wrap"];

		${$code."_bold"} = "no";
		if (isset($component_data[$code."_bold"])) ${$code."_bold"} = $component_data[$code."_bold"];

		${$code."_color"} = "--ion-color-dark";
		if (isset($component_data[$code."_color"])) ${$code."_color"} = $component_data[$code."_color"];
		
		${$code."_color_value"} = "";
		if (isset($component_data[$code."_color_value"])) ${$code."_color_value"} = $component_data[$code."_color_value"];
		
		${$code."_font_size"} = "16";
		if ($code=="subtitle") ${$code."_font_size"} = "14";
		if ($code=="preview") ${$code."_font_size"} = "14";
		if ($code=="note") ${$code."_font_size"} = "11";

		if (isset($component_data[$code."_font_size"])) ${$code."_font_size"} = $component_data[$code."_font_size"];
		
		
	}	
	
	//Colors
	if (isset($component_data['colors'])) {
		foreach($component_data['colors'] as $color) {
			if ($color->color_name==$card_background_color) $card_background_color_value = $color->color_value;
			if ($color->color_name==$card_border_color) $card_border_color_value = $color->color_value;
			if ($color->color_name==$title_color) $title_color_value = $color->color_value;
			if ($color->color_name==$subtitle_color) $subtitle_color_value = $color->color_value;
			if ($color->color_name==$preview_color) $preview_color_value = $color->color_value;
			if ($color->color_name==$note_color) $note_color_value = $color->color_value;
		}
	}
	
	
	//set button actions variable
	$button_action = "-";
	if (isset($component_data['actions']) && isset($component_data['button_action']))  {
	foreach ($component_data['actions'] as $action) {
		if ($action['code']==$component_data['button_action']) $button_action=$action['angular'];
	}
}
	
?>
<div id="list_row_<?php echo $component_data['page_component_id']?>" class="component-resizeble-hv component-draggable component_inner_wrapper <?php echo $component_data['component']['css_class']?>" <?php if (isset($component_data['page_component_id'])) {?>component-id="<?php echo $component_data['page_component_id']?>"<?php } ?>>

<?php if ($component_data['component']['use_card']==1) { ?>
		<ion-card style="
		border-style: solid; 
		margin: 0px; 
		padding: <?php echo $component_data['component']['card_padding_top']?>px  <?php echo $component_data['component']['card_padding_left']?>px; 
		--background: <?php echo $card_background_color_value?><?php echo dechex(255/100*$component_data['component']['card_opacity'])?>; 
		border-color: <?php echo $card_border_color_value?>; 
		border-width: <?php echo $component_data['component']['card_border_width'];?>px; 
		border-radius: <?php echo $component_data['component']['card_border_radius'];?>px;
		-webkit-box-shadow: <?php echo $component_data['component']['card_shadow'];?>;
		box-shadow: <?php echo $component_data['component']['card_shadow'];?>;
		" id="simple_text_<?php echo $component_data['page_component_id']?>" class="<?php echo $component_data['component']['css_class']?>" <?php if (isset($component_data['page_component_id'])) {?>component-id="<?php echo $component_data['page_component_id']?>"<?php } ?>
		>
<?php }?>


<ion-list lines="<?php echo $divider_type?>">
          
          <div *ngFor="let item of simple_list_<?php echo $component_data['page_component_id']?>">
		  <ion-item <?php if ($visibility_column_name!="-") {?>*ngIf="item.<?php echo $visibility_column_name?>"<?php }?> style="--border-color: <?php echo $divider_color_value?>" (click)="contentService.setCurrentContent('content_type_<?php echo $content_type?>',item); <?php if ($button_action!="-") echo $button_action.';'; ?>" <?php if ($button_action!="-") echo 'button'; ?>>
			<?php if ($image_column_name!="-") {?>
				<?php if ($image_type=="thumbnail") {?>
				<ion-thumbnail slot="start">
				  <img [src]="item.<?php echo $image_column_name?>" />
				</ion-thumbnail>
				<?php } else {?>
				<ion-avatar slot="start">
				  <img [src]="item.<?php echo $image_column_name?>" />
				</ion-avatar>			
				<?php } ?>
			<?php } ?>
			<?php if ($note_column_name!="-") {?>
				<ion-note slot="end" <?php if ($note_wrap=="wrap") echo "class='ion-text-wrap'";?> style="<?php if ($note_bold=="yes") echo "font-weight: bold;";?>  font-size:<?php echo $note_font_size?>px; color: var(<?php echo $note_color?>);" >{{item.<?php echo $note_column_name?>}}</ion-note>
			<?php } ?>			
            <ion-label>
				<?php if ($title_column_name!="-") {?>
					<h2 <?php if ($title_wrap=="wrap") echo "class='ion-text-wrap'";?> style="<?php if ($title_bold=="yes") echo "font-weight: bold;";?> font-size:<?php echo $title_font_size?>px; color: var(<?php echo $title_color?>);" [innerHtml]="item.<?php echo $title_column_name?>"></h2>
				<?php } ?>
				<?php if ($subtitle_column_name!="-") {?>
					<h3 <?php if ($subtitle_wrap=="wrap") echo "class='ion-text-wrap'";?> style="<?php if ($subtitle_bold=="yes") echo "font-weight: bold;";?> font-size:<?php echo $subtitle_font_size?>px; color: var(<?php echo $subtitle_color?>);" [innerHtml]="item.<?php echo $subtitle_column_name?>"></h3>
				<?php } ?>
				<?php if ($preview_column_name!="-") {?>
					<p <?php if ($preview_wrap=="wrap") echo "class='ion-text-wrap'";?> style="<?php if ($preview_bold=="yes") echo "font-weight: bold;";?>  font-size:<?php echo $preview_font_size?>px; color: var(<?php echo $preview_color?>);" [innerHtml]="item.<?php echo $preview_column_name?>"></p>
				<?php } ?>
            </ion-label>
          </ion-item>
		 </div>
</ion-list>		
<?php if ($component_data['component']['use_card']==1) { ?>
</ion-card>
<?php }?>
</div>