#!/bin/sh

#
# Bootstrap script
#

function big_sea_timber_bootstrap()
{
	# variables
	WP_CLI_PATH='https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar'
	TIMBER_PLUGIN_NAMESPACE='timber-library'
	WP_CLI_VERBIAGE="[ Installing and configuring wp-cli... ]"
	TIMBER_SETUP_VERBIAGE="[ Installing and configuring the Timber WordPress plugin... ]"
	COLOR_NONE='\033[0m'
	COLOR_MAIN='\033[1;34m' # blue

	# wp-cli installer
	function get_wp_cli()
	{
		echo "${COLOR_MAIN}${WP_CLI_VERBIAGE}${COLOR_NONE}"
		# download it
		curl -O $WP_CLI_PATH
		# modify its permissions
		chmod +x wp-cli.phar
		# then move it so we can use it from anywhere
		sudo mv wp-cli.phar /usr/local/bin/wp
	}

	# Install and activate the Timber WordPress plugin
	function get_timber()
	{
		echo "${COLOR_MAIN}${TIMBER_SETUP_VERBIAGE}${COLOR_NONE}"
		wp plugin install $TIMBER_PLUGIN_NAMESPACE --activate
	}

	# check if wp-cli is installed
	if [ "`type -t wp`" = 'file' ]; then
		# if it is, run the Timber installer function
		get_timber
	else
		# otherwise install and setup wp-cli
		get_wp_cli
		# and then install and activate the Timber plugin
		get_timber
	fi
}

# make the function accessible
big_sea_timber_bootstrap
