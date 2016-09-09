<script type="text/javascript">
$(function(){
	
	// show/hide report filters and layers boxes on home page map
	$("a.toggle").toggle(
		function() { 
			$($(this).attr("href")).show();
			$(this).addClass("active-toggle");
		},
		function() { 
			$($(this).attr("href")).hide();
			$(this).removeClass("active-toggle");
		}
	);
	
});

</script>
<!-- main body -->
<div id="main" class="clearingfix">
	<div id="mainmiddle">

		<!-- right column -->
		<div id="report-map-filter-box" class="clearingfix">
			<a class="btn toggle" id="filter-menu-toggle" class="" href="#the-filters"><?php echo Kohana::lang('ui_main.filter_reports_by'); ?><span class="btn-icon ic-right">&raquo;</span></a>
			
			<!-- filters box -->
			<div id="the-filters" class="map-menu-box">
			
				<?php
				// Action::main_sidebar_pre_filters - Add Items to the Entry Page before filters
				Event::run('ushahidi_action.main_sidebar_pre_filters');
				?>
				
				<!-- report category filters -->
				<div id="report-category-filter">
					<h3><?php echo Kohana::lang('ui_main.category');?></h3>
			
					<ul id="category_switch" class="category-filters">
					<?php
					$color_css = 'class="category-icon swatch" style="background-color:#'.$default_map_all.'"';
					$all_cat_image = '';
					if ($default_map_all_icon != NULL)
					{
						$all_cat_image = html::image(array(
							'src'=>$default_map_all_icon
						));
						$color_css = 'class="category-icon"';
					}
					?>
					<li>
						<a class="active" id="cat_0" href="#">
							<span <?php echo $color_css; ?>><?php echo $all_cat_image; ?></span>
							<span class="category-title"><?php echo Kohana::lang('ui_main.all_categories');?></span>
						</a>
					</li>
					<?php
						foreach ($categories as $category => $category_info)
						{
							$category_title = html::escape($category_info[0]);
							$category_color = $category_info[1];
							$category_image = ($category_info[2] != NULL)
							    ? url::convert_uploaded_to_abs($category_info[2])
							    : NULL;
							$category_description = html::escape(Category_Lang_Model::category_description($category));
	
							$color_css = 'class="category-icon swatch" style="background-color:#'.$category_color.'"';
							if ($category_info[2] != NULL)
							{
								$category_image = html::image(array(
									'src'=>$category_image,
									));
								$color_css = 'class="category-icon"';
							}
	
							echo '<li>'
							    . '<a href="#" id="cat_'. $category .'" title="'.$category_description.'">'
							    . '<span '.$color_css.'>'.$category_image.'</span>'
							    . '<span class="category-title">'.$category_title.'</span>'
							    . '</a>';
	
							// Get Children
							echo '<div class="hide" id="child_'. $category .'">';
							if (sizeof($category_info[3]) != 0)
							{
								echo '<ul>';
								foreach ($category_info[3] as $child => $child_info)
								{
									$child_title = html::escape($child_info[0]);
									$child_color = $child_info[1];
									$child_image = ($child_info[2] != NULL)
									    ? url::convert_uploaded_to_abs($child_info[2])
									    : NULL;
									$child_description = html::escape(Category_Lang_Model::category_description($child));
									
									$color_css = 'class="category-icon swatch" style="background-color:#'.$child_color.'"';
									if ($child_info[2] != NULL)
									{
										$child_image = html::image(array(
											'src' => $child_image
										));
	
										$color_css = 'class="category-icon"';
									}
	
									echo '<li>'
									    . '<a href="#" id="cat_'. $child .'" title="'.$child_description.'">'
									    . '<span '.$color_css.'>'.$child_image.'</span>'
									    . '<span class="category-title">'.$child_title.'</span>'
									    . '</a>'
									    . '</li>';
								}
								echo '</ul>';
							}
							echo '</div></li>';
						}
					?>
					</ul>
					<!-- / category filters -->

				</div>
				<!-- / report category filters -->
				
				<!-- report type filters -->
			
				<?php
				// Action::main_sidebar_post_filters - Add Items to the Entry Page after filters
				Event::run('ushahidi_action.main_sidebar_post_filters');
				?>
						
			</div>
			<!-- / filters box -->
			
			<?php
			if ($layers)
			{
				?>
				<div id="layers-box">
					<a class="btn toggle" id="layers-menu-toggle" class="" href="#kml_switch"><?php echo Kohana::lang('ui_main.layers');?> <span class="btn-icon ic-right">&raquo;</span></a>
					<!-- Layers (KML/KMZ) -->
					<ul id="kml_switch" class="category-filters map-menu-box">
						<?php
						foreach ($layers as $layer => $layer_info)
						{
							$layer_name = $layer_info[0];
							$layer_color = $layer_info[1];
							$layer_url = $layer_info[2];
							$layer_file = $layer_info[3];
							$layer_link = (!$layer_url) ?
								url::base().Kohana::config('upload.relative_directory').'/'.$layer_file :
								$layer_url;
							echo '<li><a href="#" id="layer_'. $layer .'">
							<span class="swatch" style="background-color:#'.$layer_color.'"></span>
							<span class="layer-name">'.$layer_name.'</span></a></li>';
						}
						?>
					</ul>
				</div>
				<!-- /Layers -->
				<?php
			}
			?>
			
			
			<!-- additional content -->
			<!-- / additional content -->
		</div>
		<!-- / right column -->

		<!-- content column -->
		<div id="content" class="clearingfix">
				<?php
				// Map and Timeline Blocks
				echo $div_map;
				echo $div_timeline;
				?>
			</div>
		</div>
		<!-- / content column -->

	</div>
</div>
<!-- / main body -->

<!-- content -->
<div class="content-container">

	<!-- content blocks -->
	<div class="content-blocks clearingfix">
		<ul class="content-column">
			<?php blocks::render(); ?>
		</ul>
	</div>
	<!-- /content blocks -->

</div>
<!-- content -->
