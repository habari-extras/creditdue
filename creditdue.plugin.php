<?php

/**
 * Credit Due plugin, allows output of theme and plugin information for Habari sites.
 */

class CreditDue extends Plugin
{
	/**
	 * function theme_show_credits
	 * retrieves information about the active theme and returns it for display by a theme.
	 *
	 * Usage: This function is called using <?php echo $theme->show_credits(); ?>
	 * This loads the template creditdue.php (which can be copied to the theme directory and customized) and shows the theme and plugins in unordered lists
	 */
	public function theme_show_credits( $theme )
	{
		$theme_credits = Themes::get_active();
		$plugin_credits = Plugins::get_active();

		$theme->theme_credits = $theme_credits;
		$theme->plugin_credits = $plugin_credits;

		return $theme->fetch( 'creditdue' );
	}

	/**
	 * On plugin init, add the template included with this plugin to the available templates in the theme.
	 */
	public function action_init()
	{
		$this->add_template( 'creditdue', dirname(__FILE__) . '/creditdue.php' );
		$this->add_template( 'block.creditdue', dirname(__FILE__) . '/block.creditdue.php' );
	}

	/**
	 * Register this block type.
	 */
	public function filter_block_list( $blocklist )
	{
		$blocklist[ 'creditdue' ] = _t( 'Credit Due', 'creditdue' );
		return $blocklist;
	}

	/**
	 * Fill the block.
	 */
	public function action_block_content_creditdue( $block )
	{
		$block->theme_credits = Themes::get_active();
		$block->plugin_credits = Plugins::get_active();
	}

}
?>
