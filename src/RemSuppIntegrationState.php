<?php

class RemSuppIntegrationState
{
    const COMPANY_ID = 'remsupp_company_id';

    /**
     * @return string|null
     */
    public function getCompanyId()
    {
        return get_option(self::COMPANY_ID, null);
    }

    /**
     * @return bool
     */
    public function isPluginIntegrated()
    {
        return !empty(get_option(self::COMPANY_ID));
    }

    public function integrate($companyId)
    {
        update_option(self::COMPANY_ID, $companyId);
    }

    public function removeIntegration()
    {
        delete_option(self::COMPANY_ID);
    }

}
