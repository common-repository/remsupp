<?php

class RemSuppAdminRouting
{
    const INTEGRATE_PROJECT_ACTION = 'remsupp_integrate';

    /**
     * @param RemSuppAdminController $adminController
     */
    public function __construct($adminController)
    {
        add_action('wp_ajax_' . self::INTEGRATE_PROJECT_ACTION, [$adminController, 'handleIntegrateProjectAction']);
    }

    /**
     * @return string
     */
    public static function getEndpointForIntegrateProjectAction()
    {
        return self::getEndpointForAction(self::INTEGRATE_PROJECT_ACTION);
    }

    /**
     * @param string $action
     * @return string
     */
    private static function getEndpointForAction($action)
    {
        $queryString = http_build_query([
            'action' => $action,
            '_wpnonce' => wp_create_nonce($action),
        ]);
        return admin_url('admin-ajax.php?' . $queryString);
    }

}