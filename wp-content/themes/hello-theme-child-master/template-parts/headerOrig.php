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
			<div class="top-menu">
				<ul>
					<li class="active"><a href="">Home</a></li>
					<li><a href="">Company Brochures</a></li>
					<li><a href="">Subsidiaries</a></li>
					<li><a href="">Contact Us</a></li>
				</ul>
			</div>
			<div class="size-web">
				<a href="#" class="size-small">a</a>
				<a href="#" class="size-medium">a</a>
				<a href="#" class="size-big">a</a>
			</div>
			<div class="social-header">
				<ul>
					<li><a aria-label="twitter" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					<li><a aria-label="facebook" href="#"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
					<li><a aria-label="youtube" href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
					<li><a aria-label="linkedin" href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="main-header">
			<div class="logo"><a href="/"><img src="<?= wp_upload_dir()['baseurl'] ?>/images/logo.png" alt="Logo"></a></div>
			<div class="menu-header">
				<div class="top-main-navigation">
					<div class="toggle-menu">
						<span></span>
						<span></span>
						<span></span>
					</div>
				</div>
				<ul>
					<li><a href="">Lines of Business</a></li>
					<li><a href="">About Us</a></li>
					<li><a href="">Investor Relations</a></li>
					<li><a href="">Media</a></li>
					<li><a href="">Careers</a></li>
				</ul>
			</div>
			<div class="form-search"><i class="fa fa-search" aria-hidden="true"></i></div>
		</div>
	</div>
</div>

