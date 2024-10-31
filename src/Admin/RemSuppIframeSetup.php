<?php

class RemSuppIframeSetup
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

    /**
     * @return string
     */
    public function prepareAuthenticationIframeUrl()
    {
        $userId = get_current_user_id();
        $userInfo = get_userdata($userId);
        $email = $userInfo->user_email;

        $queryParams = array_merge(
            [],
            $this->getDefaultIframeQueryParams()
        );

        return RemSuppConfig::getBaseUrl() . '/user/sign-up/?email=' . urlencode($email) . '&redirectFrom=' . urlencode('/integration/setup/?'. http_build_query($queryParams));
    }

    /**
     * @return string
     */
    public function prepareIntegrationSuccessIframeUrl()
    {
        $queryParams = array_merge(
            [],
            $this->getDefaultIframeQueryParams()
        );

        return RemSuppConfig::getBaseUrl() . '/app/visitors/?' . http_build_query($queryParams);
    }

    /**
     * @return array<string, string>
     */
    private function getDefaultIframeQueryParams()
    {
        $userId = get_current_user_id();
        $localeCode = get_user_locale($userId);

        return [
            'integration' => 'Wordpress',
            'localeCode' => $localeCode,
            'utm_source' => 'platform',
            'utm_medium' => 'wordpress',
        ];
    }

}