<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://www.brettshumaker.com
 * @since      1.0.0
 *
 * @package    Simple_Staff_List
 * @subpackage Simple_Staff_List/admin/partials
 */
?>
<div class="wrap">
	<h2><?php _e( 'Simple Staff List', 'simple-staff-list' ); ?></h2>
	<h2><?php _e( 'Order Staff', 'simple-staff-list' ); ?></h2>
	<p><?php _e( 'Simply drag the staff member up or down and they will be saved in that order.', 'simple-staff-list' ); ?></p>
<?php $staff = new WP_Query( array( 'post_type' => 'staff-member', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'menu_order' ) );
	  if( $staff->have_posts() ) : ?>

	<table class="wp-list-table widefat fixed posts sslp-order" id="sortable-table">
		<thead>
			<tr>
				<th class="column-order"><?php _e( 'Order', 'simple-staff-list' ); ?></th>
				<th class="column-photo"><?php _e( 'Photo', 'simple-staff-list' ); ?></th>
				<th class="column-name"><?php _e( 'Name', 'simple-staff-list' ); ?></th>
				<th class="column-title"><?php _e( 'Position', 'simple-staff-list' ); ?></th>
				<th class="column-bio"><?php _e( 'Bio', 'simple-staff-list' ); ?></th>
			</tr>
		</thead>
		<tbody data-post-type="product">
		<?php while( $staff->have_posts() ) : $staff->the_post();
			global $post;
			$custom = get_post_custom();
		?>
			<tr id="post-<?php the_ID(); ?>">
				<td class="column-order"><img src="<?php echo STAFFLIST_URI . 'admin/img/move-icon.png'; ?>" title="" alt="Move Icon" width="24" height="24" class="" /></td>
				<td class="column-photo"><?php if ( has_post_thumbnail() ) echo get_the_post_thumbnail( $post->ID, array( 75, 75 ) ); ?></td>
				<td class="column-name"><strong><?php the_title(); ?></strong></td>
				<td class="column-title"><?php echo $custom["_staff_member_title"][0]; ?></td>
				<td class="column-bio"><?php   echo Simple_Staff_List_Admin::get_staff_bio_excerpt($custom["_staff_member_bio"][0], 10); ?></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
		<tfoot>
			<tr>
				<th class="column-order"><?php _e( 'Order', 'simple-staff-list' ); ?></th>
				<th class="column-photo"><?php _e( 'Photo', 'simple-staff-list' ); ?></th>
				<th class="column-name"><?php _e( 'Name', 'simple-staff-list' ); ?></th>
				<th class="column-title"><?php _e( 'Position', 'simple-staff-list' ); ?></th>
				<th class="column-bio"><?php _e( 'Bio', 'simple-staff-list' ); ?></th>
			</tr>
		</tfoot>

	</table>

<?php else: ?>

	<p><?php _e( 'No staff members found, why not <a href="post-new.php?post_type=staff-member">create one?', 'simple-staff-list' ); ?></a></p>

<?php endif; ?>
<?php wp_reset_postdata(); // Don't forget to reset again! ?>
</div><!-- .wrap -->