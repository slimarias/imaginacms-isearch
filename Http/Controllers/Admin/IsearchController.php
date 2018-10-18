<?php

namespace Modules\Isearch\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Workshop\Manager\ModuleManager;
use Nwidart\Modules\Module;
use Nwidart\Modules\Repository;

class IsearchController extends AdminBaseController
{

    /**
     * @var ModuleManager
     */
    private $moduleManager;
    /**
     * @var Repository
     */
    private $modules;
    /**
     * @var AuthenticationException
     */

    private $auth;

    public function __construct()
    {
        parent::__construct();

    }

}
