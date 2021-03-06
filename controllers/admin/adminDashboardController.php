<?php

namespace Over_Code\Controllers\Admin;

use Over_Code\Controllers\MainController;

/**
 * Admin dashboard controller
 */
class AdminDashboardController extends MainController
{
    use \Over_Code\Libraries\User\Tests;

    /**
     * Set template for admin dashboard
     *
     * @param array $params uri parameters after .../dashboard/
     *
     * @return void
     */
    public function index(): void
    {
        if ($this->userToTwig['admin']) {
            $this->preventCsrf();

            $this->userToTwig['template'] = 'admin';
            
            $this->template = $this->template = 'admin' . DS . 'dashboard.twig';
        }
    }
}
