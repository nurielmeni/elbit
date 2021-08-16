<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="header">
	<div class="login">
		<?php if ($personalArea) : ?>
		<a href="#"> &lt; התחברות  <i class="fa fa-user-o" aria-hidden="true"></i></a>
		<?php endif; ?>
	</div>
	<div class="container">
		<div class="top-header">

		</div>
		<div class="main-header flex space-between align-center">
			<div class="logo"><a href="/"><img src="<?= wp_upload_dir()['baseurl'] ?>/images/logo.png" alt="Logo"></a></div>
			<div class="menu-header-new">
				<ul>
					<li><a href="https://elbitsystems.com/">אתר אלביט</a></li>
				</ul>
			</div>
		</div>
	</div>
</div>

