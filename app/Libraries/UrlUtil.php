<?php

namespace App\Libraries;

class UrlUtil
{
    public function goToUrl(string $location)
    {
        header("location: $location");
        exit;
    }

    public function goToUrlWithStatus(string $location, string $status)
    {
        $this->goToUrl($location . '?status=' . urlencode($status));
    }

    public function getHostUrl()
    {
        return $_SERVER['SERVER_NAME'];
    }

    public function getPreviousUrl()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    public function goToPreviousUrl()
    {
        $this->goToUrl($this->getPreviousUrl());
    }

    public function goToPreviousUrlWithStatus(string $status)
    {
        $this->goToUrlWithStatus($this->getPreviousUrl(), $status);
    }
}
