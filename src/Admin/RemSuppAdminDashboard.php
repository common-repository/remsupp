<?php

class RemSuppAdminDashboard
{
    const ICON_BASE64 = 'PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2aWV3Qm94PSIwIDAgMjg5LjI5IDIyNSI+PGRlZnM+PHN0eWxlPi5jbHMtMXtmaWxsOiNhN2FhYWQ7fTwvc3R5bGU+PC9kZWZzPjxwYXRoIGNsYXNzPSJjbHMtMSIgZD0iTTI1MS43OSwwSDEyMy4yMkEzNy41NiwzNy41NiwwLDAsMCw4NS43MSwzNy41MVY2NC4yOUgzNy41MUEzNy41NCwzNy41NCwwLDAsMCwwLDEwMS43OXY4NS43MkEzNy41NSwzNy41NSwwLDAsMCwzNy41MSwyMjVIMTY2LjA4YTM3LjU0LDM3LjU0LDAsMCwwLDM3LjQ5LTM3LjQ5di0yNi44aDQ4LjIyYTM3LjUzLDM3LjUzLDAsMCwwLDM3LjUtMzcuNDlWMzcuNTFBMzcuNTQsMzcuNTQsMCwwLDAsMjUxLjc5LDBabTUuMzUsMTIzLjIyYTUuMzYsNS4zNiwwLDAsMS01LjM1LDUuMzVIODYuMDlhMzcuNTcsMzcuNTcsMCwwLDAsMzcuMTMsMzIuMTRoNDguMjF2MjYuOGE1LjM2LDUuMzYsMCwwLDEtNS4zNSw1LjM1SDM3LjUxYTUuMzYsNS4zNiwwLDAsMS01LjM3LTUuMzVWMTAxLjc5YTUuMzYsNS4zNiwwLDAsMSw1LjM3LTUuMzZIMjAzLjE5YTM3LjUzLDM3LjUzLDAsMCwwLTM3LjExLTMyLjE0SDExNy44NlYzNy41MWE1LjM2LDUuMzYsMCwwLDEsNS4zNi01LjM3SDI1MS43OWE1LjM2LDUuMzYsMCwwLDEsNS4zNSw1LjM3WiIvPjwvc3ZnPg==';

    /**
     * @var RemSuppIntegrationState
     */
    private $integrationState;
    /**
     * @var RemSuppIframeSetup
     */
    private $iframeSetup;

    /**
     * @param RemSuppIntegrationState $integrationState
     * @param RemSuppIframeSetup $iframeSetup
     */
    public function __construct($integrationState, $iframeSetup)
    {
        $this->integrationState = $integrationState;
        $this->iframeSetup = $iframeSetup;

        add_action('admin_menu', [$this, 'addAdminMenuLink']);
    }

    public function addAdminMenuLink()
    {
        // https://developer.wordpress.org/reference/functions/add_menu_page/
        add_menu_page(
            'RemSupp - Remote Access & Co-Browsing Software', 
            'RemSupp',
            'manage_options',
            RemSuppConfig::getPluginSlug(),
            [$this, 'addAdminPage'],
            'data:image/svg+xml;base64,' . self::ICON_BASE64
        );
    }

    public function addAdminPage()
    {
        $dir = plugin_dir_path(__FILE__);
        if ($this->integrationState->isPluginIntegrated()) {
            $iframeUrl = $this->iframeSetup->prepareIntegrationSuccessIframeUrl();
        } else {
            $integrateActionUrl = RemSuppAdminRouting::getEndpointForIntegrateProjectAction();
            $iframeUrl = $this->iframeSetup->prepareAuthenticationIframeUrl();
        }

        include $dir . '../../views/iframe.php';
    }
}
