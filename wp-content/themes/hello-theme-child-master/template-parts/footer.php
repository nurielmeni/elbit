<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="info-footer">
	<div class="container">
		<div class="social-header">
			<span>עקבו אחרינו במדיה החברתית:</span>
			<ul>
				<li><a target="_blank" aria-label="facebook" href="<?= get_option(NlsHunterApi_Admin::NLS_SOCIAL_FACE) ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
				<li><a target="_blank" aria-label="linkedin" href="<?= get_option(NlsHunterApi_Admin::NLS_SOCIAL_IN) ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="info-email">
			<p>ליצירת קשר עם צוות הגיוס : &nbsp;&nbsp;<a href="mailto:Recruitment@elbitsystems.com">Recruitment@elbitsystems.com</a></p>
			<p><a href="https://elbitsystems.com/%D7%9E%D7%93%D7%99%D7%A0%D7%99%D7%95%D7%AA-%D7%9E%D7%90%D7%92%D7%A8-%D7%9E%D7%95%D7%A2%D7%9E%D7%93%D7%99%D7%9D/" target="_blank">מדיניות מאגר מועמדים</a></p>
		</div>
	</div>
</div>

<div class="footer">
	<div class="container">
		<div class="top-footer">
			<div class="menu-footer">
				<ul>
					<li class="active"><a href="https://elbitsystems.com/site-map/">Site Map</a></li>
					<li><a href="https://elbitsystems.com/credit/">Credits</a></li>
					<li><a href="https://elbitsystems.com/terms/">Legal & Terms</a></li>
					<li><a href="https://elbitsystems.com/accessibility-statement/">privacy Policy</a></li>
				</ul>
			</div>	
			<div class="left-footer">
				<p>Elbit Systems Ltd</p>
				<p>Advanced Technology Center</p>
				<p>P.O.B 539 , Haifa 3100401, Israel</p>
				<p>Tel: <a href="tel:"> +972 77 294000 </a></p>
			</div>
			<div class="clearfix"></div>	
		</div>
		<div class="bottom-footer">
			<p>©<?= date("Y") ?> Elbit Systems Ltd., its logo, brand, product, service, and process names appearing in this issue are the trademarks or service marks of Elbit Systems Ltd. or its affiliated companies. All other brand, product, service, and process names appearing are the trademarks of their respective holders. Reference to or use of a product, service, or process other than those of Elbit Systems Ltd. does not imply recommendation, approval, affiliation, or sponsorship of that product, service, or process by Elbit Systems Ltd. Nothing contained herein shall be construed as conferring by implication, estoppel, or otherwise any license or right under any patent, copyright, trademark, or other intellectual property right of Elbit Systems Ltd. or any third party, except as expressly granted herein.</p>
			<p class="text-center powered-by flex space-between"><a href="https://niloosoft.com/he/">POWERED BY HUNTER EDGE</a><a rel="nofollow" href="https://www.anova.co.il" target="_blank" style="margin-left: 40px;">DESIGN BY <span style="color: #428bca;">A</span>NOVA</a></p>
			
		</div>
	</div>
	<a href="#" class="back-top-top">Up<i class="fa fa-long-arrow-up" aria-hidden="true"></i></a>
</div>
<script src="https://cdn.enable.co.il/licenses/enable-L426bjhwem0cio-0817-13561/init.js"></script>
