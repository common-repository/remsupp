<?php

final class RemSuppConfig
{
    public static function getPluginSlug() 
    {
        return 'remsupp';
    }

    public static function getPluginVersion() 
    {
        return '1.0.0';
    }

    public static function getBaseUrl() 
    {
        return 'https://remsupp.com';
    }

    public static function getWidgetUrl($companyId)
    {
        return 'https://cdn.remsupp.com/remsupp.js?id=' . $companyId . '&button=floating';
    }

}