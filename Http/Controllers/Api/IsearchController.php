<?php

namespace Modules\Isearch\Http\Controllers\Api;

use Mockery\CountValidator\Exception;
use Illuminate\Contracts\Foundation\Application;
use Modules\Core\Http\Controllers\BasePublicController;
use Modules\Iblog\Entities\Post;
use Modules\Isearch\Http\Requests\IsearchRequest;
use Modules\Setting\Contracts\Setting;
use Illuminate\Support\Facades\Input;
use Modules\Iblog\Transformers\PostTransformer;
use Illuminate\Http\Request;

use Log;

class IsearchController extends BasePublicController
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


  public function search(Request $request)
  {
    try {
      $searchParameter = $request->input('search');

      $modules = config('asgard.isearch.config.queries');

      if (isset($modules) && !empty($modules)) {
        foreach ($modules as $k => $module) {
          $data = $module($searchParameter);
          if (!$data->isEmpty()) {
            $results_post[$k] = $data;
          }
        }
      }
      $iblog = $this->post->where('title', 'LIKE', "%{$searchParameter}%")
        ->orWhere('description', 'LIKE', "%{$searchParameter}%")
        ->orderBy('created_at', 'DESC')->paginate(12);

      if (!$iblog->isEmpty()) $results_post['iblog'] = PostTransformer::collection($iblog);
      if (!isset($results_post) && empty($results_post)) $results_post = null;


      $response = [
        "data" => is_null($results_post) ? false : $results_post];
    } catch (\Exception $e) {
      //Message Error
      $status = 500;
      $response = [
        "errors" => $e->getMessage()
      ];
    }
    return response()->json($response, $status ?? 200);
  }


}
