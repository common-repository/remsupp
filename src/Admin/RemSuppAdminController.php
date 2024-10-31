<?php

class RemSuppAdminController
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
    }

    public function handleIntegrateProjectAction()
    {
        if (!$this->isRequestNonceValid(RemSuppAdminRouting::INTEGRATE_PROJECT_ACTION)) {
            wp_send_json(['status' => 'error', 'message' => 'Invalid nonce value'], 403);
        }

        $data = json_decode(file_get_contents("php://input"));
        $companyId = $data->companyId;
        $this->integrationState->integrate($companyId);
        wp_send_json(['status' => 'ok'], 200);
    }

    /**
     * @param string $action
     * @return bool
     */
    private function isRequestNonceValid($action)
    {
        if (!RemSuppQueryParameters::has('_wpnonce')) {
            return false;
        }

        return (bool) wp_verify_nonce(RemSuppQueryParameters::get('_wpnonce'), $action);
    }

}