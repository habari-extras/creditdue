<?php

/**
 * Credit Due plugin, allows output of theme and plugin information for Habari sites.
 */

class CreditDue extends Plugin
{
	/**
	 * Add help text to plugin configuration page
	 **/
	public function help()
	{
		$help = _t( '<p>To use, add <code>&lt;?php $theme->show_credits(); ?&gt;</code> in your theme.</p><p>To customize the output template, copy creditdue.php to your theme\'s directory</p>'
		);
		return $help;
	}

	/**
	 * function theme_show_credits
	 * retrieves information about the active theme and returns it for display by a theme.
	 * 
	 * Usage: This function is called using <?php $theme->show_credits(); ?>
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
	 * Add update beacon support
	 **/
	public function action_update_check()
	{
	 	Update::add( 'CreditDue', 'fb0b8460-38f2-11dd-ae16-0800200c9a66', $this->info->version );
	}

	/**
	 * On plugin init, add the template included with this plugin to the available templates in the theme
	 */
	public function action_init()
	{
		$this->add_template('creditdue', dirname(__FILE__) . '/creditdue.php');
	}

}
?>
