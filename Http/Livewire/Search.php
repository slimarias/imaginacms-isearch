<?php

namespace Modules\Isearch\Http\Livewire;

use \Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Illuminate\Http\Request;
use Modules\Iblog\Transformers\PostTransformer;
use Modules\Icommerce\Repositories\ProductRepository;
use Modules\Iblog\Repositories\PostRepository;
use Illuminate\Support\Arr;
use Modules\Icommerce\Transformers\ProductTransformer;

class Search extends Component
{
    public $view;
    public $search;
    public $defaultView;
    public $params;
    public $results;
    public $error;
    public $showModal;


    public function mount($layout = 'layout-1', $showModal = false, $params = [])
    {
        $this->defaultView = 'isearch::frontend.livewire.search.layouts.layout-1.index';
        $this->view = isset($layout) ?'isearch::frontend.livewire.search.layouts.'.$layout.'.index' : $this->defaultView;
        $this->params = $params;
        $this->results = [];
        $this->error = "";
        $this->showModal = $showModal;

    }

    private function makeParamsFunction(){

        return [
            "include" => $this->params["include"] ?? [],
            "take" => $this->params["take"] ?? 12,
            "page" => $this->params["page"] ?? false,
            "filter" => $this->params["filter"] ?? ["search" => $this->search ?? null, "locale" => \App::getLocale()],
            "order" => $this->params["order"] ?? null,
        ];
    }

    public function render()
    {

        $validatedData = Validator::make(
            ['search' => $this->search],
            ['search' => 'required|min:4'],
        );

        if($this->search) {

            if ($validatedData->fails()) {
                $this->results = [];
                $this->error = "El campo de búsqueda es requerido y debe tener al menos 4 caracteres";
            } else {

                $params = $this->makeParamsFunction();

                if (is_module_enabled('Iblog')) {

                    $this->results = $this->postRepository()->getItemsBy(json_decode(json_encode($params)));
                }

                if (is_module_enabled('Icommerce')) {
                    $products = $this->productRepository()->getItemsBy(json_decode(json_encode($params)));
                    if (is_module_enabled('Iblog')) {
                        $this->results = $this->results->merge($products);
                    } else {
                        $this->results = $products;
                    }
                }

                $this->error = "";

            }
        }

        return view($this->view);

    }


    /**
     * @return productRepository
     */
    private function productRepository()
    {
        return app('Modules\Icommerce\Repositories\ProductRepository');
    }

    /**
     * @return PostRepository
     */
    private function postRepository()
    {
        return app('Modules\Iblog\Repositories\PostRepository');
    }


}
