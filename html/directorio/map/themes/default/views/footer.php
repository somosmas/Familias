			</div>
		</div>
		<!-- / main body -->

	</div>
	<!-- / wrapper -->

	<!-- footer -->
	<div id="footer" class="clearingfix">

		<div id="underfooter"></div>

		<!-- footer content -->
		<div class="wrapper floatholder rapidxwpr">



		</div>
		<!-- / footer content -->

	</div>
	<!-- / footer -->

	<?php
	echo $footer_block;
	// Action::main_footer - Add items before the </body> tag
	Event::run('ushahidi_action.main_footer');
	?>
</body>
</html>
