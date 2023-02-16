<?php
/**
 * Block template file: template-parts/blocks/careers/cards.php
 *
 * Repeatable Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'repeatable-card-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
$card_title = '';
$link_label = '';
// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-repeatable-card';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'cards' ) ) : ?>
		<?php while ( have_rows( 'cards' ) ) : the_row(); 
        $card_title = get_sub_field( 'title' ); 
        ?>
            <div class="card">
                <?php if($card_title){ echo'<h5>'.$card_title.'</h5>';}
                the_sub_field( 'content' ); ?>
                
                <?php if ( have_rows( 'link' ) ) : ?>
                    <?php while ( have_rows( 'link' ) ) : the_row(); ?>
                        <?php if ( get_sub_field( 'external' ) == 1 ) : ?>
                                    
                            <a class="card-link info-link" href="<?php the_sub_field( 'external_link' ); ?>" target='_blank'>
                                <?php the_sub_field( 'link_label' ); ?>
                            </a>
                        <?php else : ?>
                            <?php $page_to_link = get_sub_field( 'page_to_link' );
                            $link_label = get_sub_field( 'link_label');?>
                            <?php if ( $page_to_link ) : ?>
                                <a class="card-link info-link" href="<?php echo get_permalink( $page_to_link ); ?>">
                                    <?php if ($link_label){
                                        echo $link_label;
                                    } else {
                                        echo get_the_title( $page_to_link ); 
                                    }?>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
		<?php endwhile; ?>
	<?php else : ?>
		Add a card for this block to display correctly.
	<?php endif; ?>
</div>