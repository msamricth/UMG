<?php
/**
 * Block template file: template-parts/blocks/careers/values.php
 *
 * Careers Value Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'careers-value-grid-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-careers-value-grid';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
$blockTitle = '';
$blockContent = '';

?>

<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
	<?php if ( have_rows( 'values' ) ) : ?>
		<?php while ( have_rows( 'values' ) ) : the_row();
            if ( have_rows( 'block_content' ) ) : 
                while ( have_rows( 'block_content' ) ) : the_row(); 
                    $blockContent = get_sub_field('content');
                endwhile; 
            endif;
            ?>
            <div class="block-careers-value-grid__col">
                
                <?php if ( have_rows( 'block_header' ) ) : ?>
                    <?php while ( have_rows( 'block_header' ) ) : the_row(); 
                        $type = get_sub_field( 'type' ); 
                        if(empty($type)) {
                            $type = 'h5';
                        }
                        $blockTitle = get_sub_field('title');
                        if($blockTitle){
                            $blockTitle = '<'.$type.'>'.$blockTitle.'</'.$type.'>';
                            $blockTitle .= $blockContent;
                            
                        }
                        echo $blockTitle;
                        
                    endwhile; 
                endif;
                ?>
            </div>
		<?php endwhile; ?>
	<?php else : ?>
		<?php // No rows found ?>
	<?php endif; ?>
</div>