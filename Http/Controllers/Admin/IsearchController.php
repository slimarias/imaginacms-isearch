<?php

namespace Modules\Isearch\Http\Controllers\Admin;

use Modules\Core\Http\Controllers\Admin\AdminBaseController;
use Modules\Workshop\Manager\ModuleManager;
use MongoDB\Driver\Exception\AuthenticationException;
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

    public function __construct(Authentication $auth, ModuleManager $moduleManager, Repository $modules)
    {
        parent::__construct();
        $this->auth = $auth;
        $this->moduleManager = $moduleManager;
        $this->modules = $modules;
        $driver = config('asgard.user.config.driver');
    }

    /**
     * Display a list of all modules
     * @return View
     */
    public function index()
    {
        $modules = $this->modules->all();

        return view('isearch::admin.index', compact('modules'));
    }
    /*   public function update( UpdateSearchRequest $request)
      {
      $this->modules->update($page, $request->all());

          if ($request->get('button') === 'index') {
              return redirect()->route('admin.page.page.index')
                  ->withSuccess(trans('page::messages.page updated'));
          }

          return redirect()->back()
              ->withSuccess(trans('page::messages.page updated'));
      }

}*/

}
