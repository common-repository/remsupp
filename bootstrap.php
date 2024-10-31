<?php
/**
 * Plugin Name: RemSupp
 * Author URI: https://remsupp.com
 * Description: RemSupp <strong>Co-Browsing</strong> enables you to interact with the customer's browser in real time without any software download.
 * Version: 1.0.0
 * Author: RemSupp
 * Text Domain: remsupp
 * License: GPL2
 */

require_once __DIR__ . '/src/RemSuppConfig.php';
require_once __DIR__ . '/src/RemSuppWidgetLoader.php';
require_once __DIR__ . '/src/Admin/RemSuppAdminController.php';
require_once __DIR__ . '/src/Admin/RemSuppIframeSetup.php';
require_once __DIR__ . '/src/Admin/RemSuppAdminDashboard.php';
require_once __DIR__ . '/src/Admin/RemSuppAdminRouting.php';
require_once __DIR__ . '/src/Utils/RemSuppQueryParameters.php';
require_once __DIR__ . '/src/RemSuppIntegrationState.php';

function remsupp_initialize() {
    $integrationState = new RemSuppIntegrationState();
    if (!is_admin()) {
        // Non administrative interface page (does not check if the user is an administrator)
        new RemSuppWidgetLoader($integrationState);
        return;
    }

    if (current_user_can('activate_plugins')) {
        $adminController = new RemSuppAdminController($integrationState);
        $iframeSetup = new RemSuppIframeSetup($integrationState);
        new RemSuppAdminRouting($adminController);
        new RemSuppAdminDashboard($integrationState, $iframeSetup);
    }
}

function remsupp_uninstall() {
    $integrationState = new RemSuppIntegrationState();
    $integrationState->removeIntegration();
}

// Fires after WordPress has finished loading but before any headers are sent
add_action('init', 'remsupp_initialize');
// Clear data after plugin uninstallation
register_uninstall_hook(__FILE__, 'remsupp_uninstall');