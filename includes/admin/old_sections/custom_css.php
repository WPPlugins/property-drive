<div class="jtg-admin-section-header">
			<h2>Additional CSS</h2>
		</div>

<div class="jtg-row jtg-clearfix">
	<div class="jtg-col-1-1">
<?php
$options = get_option('pm_css_options');

$custom_css = nl2br($options['custom_css']);
?>
<div class="jtg-admin-custom-css">
<br>
	<?php echo '<textarea id="jtg_custom_css" class="form-control" style="width: 100%; height: 350px;" name="custom_css">'.$custom_css.'</textarea>' ?>
</div>

</div>
</div>