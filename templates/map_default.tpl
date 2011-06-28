
<div class="<?php echo $this->class; ?> block"<?php echo $this->cssID; ?><?php if ($this->style): ?> style="<?php echo $this->style; ?>"<?php endif; ?>>
<?php if ($this->headline): ?>

<<?php echo $this->hl; ?>><?php echo $this->headline; ?></<?php echo $this->hl; ?>>
<?php endif; ?>

<div id="map<?php echo $this->id; ?>" style="position:relative">
<?php foreach($this->locations as $location): ?>
<?php $coords = split(',', $location['mapLocation']); ?>
	<div class="mappin pos_<?php echo $location['id']; ?>" style="position: absolute; z-index: 20; left: <?php echo $coords[0]; ?>px; top: <?php echo $coords[1]; ?>px">
		<?php if($location['url']): ?><a href="<?php echo $location['url']; ?>"><?php endif; ?><img src="<?php echo $location['customPin'] ? $location['pinSRC'] : $this->pinSRC; ?>" alt="<?php echo $this->pinLabel; ?>" onmouseover="map<?php echo $this->id; ?>.show_posdesc('posdesc_<?php echo $location['id']; ?>')" /><?php if($location['url']): ?></a><?php endif; ?>
	</div>
	<div class="mapdescription pos_<?php echo $location['id']; ?>" style="position: absolute; z-index: 60; left: <?php echo $coords[0]+10; ?>px; top: <?php echo $coords[1]+15; ?>px">
		<div id="posdesc_<?php echo $location['id']; ?>" class="location_description<?php if($location['addImage']) echo ' has_image'; ?>" style="display: none; position: absolute; z-index: 10">

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

</div>

<script type="text/javascript">
<!--//--><![CDATA[//><!--
var map<?php echo $this->id; ?>
window.addEvent('domready', function() {
	map<?php echo $this->id; ?> = new MapLocations('map<?php echo $this->id; ?>');
});
//--><!]]>
</script>