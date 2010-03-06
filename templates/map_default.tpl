<script type="text/javascript">
<!--//--><![CDATA[//><!--

	var posdesc_timer;
	var active_posdesc;

	function show_posdesc(id)
	{
		if (active_posdesc) hide_posdesc();
		active_posdesc = id;
		document.getElementById(id).style.display='block';
	}
	
	function hide_posdesc()
	{
		stop_posdesc();
		document.getElementById(active_posdesc).style.display='none';
	}
	
	function fire_posdesc(id)
	{
		posdesc_timer = window.setTimeout(hide_posdesc, 1000);
	}
	
	function stop_posdesc()
	{
		window.clearTimeout(posdesc_timer);
	}

//--><!]]>
</script>


<?php if ($this->headline): ?>
<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div <?php if($this->cssID) echo $this->cssID; ?> class="<?php echo $this->class; ?>" style="position: relative">
<?php foreach($this->locations as $location): ?>
<?php $coords = split(',', $location['mapLocation']); ?>
	<div class="mappin pos_<?php echo $location['id']; ?>" style="position: absolute; z-index: 20; left: <?php echo $coords[0]; ?>px; top: <?php echo $coords[1]; ?>px">
		<img src="<?php echo $location['customPin'] ? $location['pinSRC'] : $this->pinSRC; ?>" alt="<?php echo $this->pinLabel; ?>" onmouseover="show_posdesc('posdesc_<?php echo $location['id']; ?>')" onmouseout="fire_posdesc()" />
	</div>
	<div class="mapdescription pos_<?php echo $location['id']; ?>" style="position: absolute; z-index: 60; left: <?php echo $coords[0]+10; ?>px; top: <?php echo $coords[1]+15; ?>px">
		<div id="posdesc_<?php echo $location['id']; ?>" class="location_description<?php if($location['addImage']) echo ' has_image'; ?>" style="display: none; position: absolute; z-index: 10" onmouseover="stop_posdesc()" onmouseout="fire_posdesc()">


			<?php if($location['addImage'] && $location['addBefore']): ?>		
			<div class="image_container"<?php if ($location['margin'] || $location['float']): ?> style="<?php echo $location['margin'].$location['float']; ?>"<?php endif; ?>>
				<?php if($location['fullsize']): ?><a href="<?php echo $location['singleSRC']; ?>" rel="lightbox" title="<?php echo $location['alt']; ?>"><?php endif; ?>
				<img src="<?php echo $location['src']; ?>"<?php echo $location['imgSize']; ?> alt="<?php echo $location['alt']; ?>" />
				<?php if($location['fullsize']): ?></a><?php endif; ?>
				
				<?php if ($location['caption']): ?><div class="caption"><?php echo $location['caption']; ?></div><?php endif; ?>
			</div>
			<?php endif; ?>		
		
			<<?php echo $location['headline']['unit']; ?>><?php echo $location['headline']['value']; ?></<?php echo $location['headline']['unit']; ?>>
			<?php echo $location['text']; ?>
			
			<?php if ($location['linkAddress']): foreach( $location['address'] as $field => $value ) { ?>
			<label for="<?php echo $field; ?>"><?php echo $value; ?></label>
			<?php } endif; ?>
		
			<?php if($location['addImage'] && !$location['addBefore']): ?>		
			<div class="image_container"<?php if ($location['margin']): ?> style="<?php echo $location['margin']; ?>"<?php endif; ?>>
			<?php if($location['fullsize']): ?><a href="<?php echo $location['singleSRC']; ?>" rel="lightbox" title="<?php echo $location['alt']; ?>"><?php endif; ?>
			<img src="<?php echo $location['src']; ?>"<?php echo $location['imgSize']; ?> alt="<?php echo $location['alt']; ?>" />
			<?php if($location['fullsize']): ?></a><?php endif; ?>
				
			<?php if ($location['caption']): ?><div class="caption"><?php echo $location['caption']; ?></div><?php endif; ?>
			</div>
			<?php endif; ?>
		</div>

	</div>
<?php endforeach; ?>
	
	<div class="image_container"><img src="<?php echo $this->mapImage; ?>" alt="<?php echo $this->description; ?>" title="<?php echo $this->title; ?>" /></div>
</div>