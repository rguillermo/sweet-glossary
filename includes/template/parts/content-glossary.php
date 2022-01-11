<?php
/**
 * Template part for displaying glossary
 *
 * @link       https://techpecialist.com/
 * @since      1.0.0
 *
 * @package    Sweet_Glossary
 */

?>

<div class="index-item">
	<div class="index-item-letter"></div>
	<ul>
		<?php the_title( sprintf( '<li><a href="%s">', esc_url( get_permalink() ) ), '</a></li>'); ?>
	</ul>
</div>