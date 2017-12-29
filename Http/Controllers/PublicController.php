<?php

namespace Modules\Isearch\Http\Controllers;

use Mockery\CountValidator\Exception;
use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iblog\Entities\Post;
use Modules\Isearch\Http\Requests\IsearchRequest;
use Modules\Setting\Contracts\Setting;
use Illuminate\Support\Facades\Input;

use Request;
use Log;

class PublicController extends BasePublicController
{

    /**
     * @var Application
     */
    private $search;
    /**
     * @var setingRepository
     */
    private $seting;
    private $post;


    public function __construct(Setting $setting)
    {
        parent::__construct();

        $this->seting = $setting;
        $this->post = Post::query();


    }


    public function search($search)
    {

        $searchphrase = $search;

        $modules = config('asgard.isearch.config.queries');

        if (isset($modules) && !empty($modules)) {
            foreach ($modules as $k => $module) {
                $data = $module($searchphrase);
                if (!$data->isEmpty()) {
                    $results_post[$k] = $data ;
                }
            }
        }
        $iblog = $this->post->where('title','LIKE',"%{$searchphrase}%")
                        ->orWhere('description','LIKE',"%{$searchphrase}%")
                        ->orderBy('created_at', 'DESC')->paginate(12);

        if(!$iblog->isEmpty())$results_post['iblog']= $iblog;
        if(!isset($results_post) && empty($results_post))$results_post=null;

        $tpl = 'isearch::index';

        return view($tpl, compact('results_post', 'searchphrase'));


    }

}
