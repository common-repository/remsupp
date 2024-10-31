<?php

class RemSuppWidgetLoader
{
    /**
     * @var RemSuppIntegrationState
     */
    private $integrationState;

    /**
     * @param RemSuppIntegrationState $integrationState
     */
    public function __construct($integrationState)
    {
        $this->integrationState = $integrationState;

        if (!$this->integrationState->isPluginIntegrated()) {
            return;
        }

        add_action('wp_enqueue_scripts', [$this, 'enqueueScriptsSync'], 1000);
    }

    public function enqueueScriptsSync()
    {
        $companyId = $this->integrationState->getCompanyId();
        $widgetUrl = RemSuppConfig::getWidgetUrl($companyId);
        // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
        wp_enqueue_script(RemSuppConfig::getPluginSlug(), esc_url_raw($widgetUrl), [], RemSuppConfig::getPluginVersion(), true);
    }
}