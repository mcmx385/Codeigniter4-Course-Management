<?php

namespace App\Helpers;

define('INVALID_CREDENTIALS_MESSAGE', 'The field username or password is invalid.');

class UserHelper
{
    protected $userModel;
    protected $userSessionUtil;
    protected $pageAccessUtil;
    protected $urlUtil;

    public function __construct()
    {
        $this->userModel = new \App\Models\User();
        $this->userSessionUtil = new \App\Libraries\UserSessionUtil();
        $this->pageAccessUtil = new \App\Libraries\PageAccessUtil();
    }

    public function login(string $username, string $password)
    {
        try {
            $user = $this->userModel->findByUsernameAndPassword($username, $password);
            if (!$user) {
                throw new \Exception(INVALID_CREDENTIALS_MESSAGE);
            }
            $this->userSessionUtil->setLoggedIn($user->id, $user->name);
            $this->pageAccessUtil->redirectToLoggedInPageByRank($user->rank);
        } catch (\Exception $e) {
            $this->pageAccessUtil->goToLoginPageWithStatus($e->getMessage());
        }
    }

    public function getUserRank()
    {
        $userId = $this->userSessionUtil->getUserId();
        return $this->userModel->findRankByUserId($userId);
    }

    public function logout()
    {
        $this->userSessionUtil->logout();
        $this->pageAccessUtil->validateOrRedirectLoggedIn();
    }
}