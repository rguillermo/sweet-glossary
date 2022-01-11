<?php
/**
 * The template for displaying glossary archive page
 *
 * @link       https://techpecialist.com/
 * @since      1.0.0
 *
 * @package    Sweet_Glossary
 *
 */

get_header();

// $description = get_the_archive_description();
$description = 'My description';
$placeholder = 'Search in Glossary';

?>

<?php if ( have_posts() ) : ?>

	<?php $content_template = SWEET_GLOSSARY_TEMPLATE_PATH . 'parts/content-glossary.php'; ?>
	<?php $current_letter = ''; ?>

	<header class="page-header alignwide">
		<!-- <?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?> -->
		<h1 class="page-title">My Sweet Glossary Title</h1>
		<?php if ( $description ) : ?>
			<div class="archive-description"><?php echo wp_kses_post( wpautop( $description ) ); ?></div>
		<?php endif; ?>
	</header><!-- .page-header -->

	<article class="post type-glossary status-publish format-standard hentry entry">

	<div class="entry-content">

		<div class="index-search">
			<input type="search" id="glossary-search-box" class="search-icon" name="s" placeholder="<?php echo $placeholder ?>">
		</div>

		<div class="index-wrapper">

		<?php $index_items = ''; ?>
		<?php $index_item = '<div class="index-item">%s</div>'; ?>
		<?php $index_list = '<ul>%s</ul>'; ?>
		<?php $index_item_letter = ''; ?>


		<?php while ( have_posts() ) : ?>

			<?php the_post(); ?>
			<?php

			$initial = strtoupper( substr( get_the_title(), 0, 1 ) );

			if ( $initial != $current_letter ) {

				if ( $current_letter != '' ) {
					echo sprintf( $index_item, $index_item_letter . sprintf( $index_list, $index_items ) );
				}
				// reset
				$current_letter = $initial;
				$index_items = '';
				$index_item_letter = sprintf( '<div class="index-item-letter">%s</div>', $current_letter );
			}

			$index_items .= sprintf( '<li class><a href="%s">%s</a></li>', esc_url( get_permalink() ), get_the_title() );

			?>
			<?php // load_template( $content_template, false ); ?>

		<?php endwhile; ?>

	</div>

	</div>

	</article>



<?php else : ?>
	<?php get_template_part( 'template/parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>
