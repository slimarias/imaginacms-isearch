<div>
    <div id="search-box" @if($showModal) class="d-none d-lg-block" @endif>
        <div class="search-product row no-gutters">
            <div class="col">
                <div id="content_searcher" class="dropdown">
                    <!-- input -->
                    <div id="dropdownSearch"
                         data-toggle="dropdown"
                         aria-haspopup="true"
                         aria-expanded="false"
                         role="button"
                         class="input-group dropdown-toggle">
                        <div class="input-group">
                            <input type="text" id="input_search" wire:model.debounce.1000ms="search" autocomplete="off"
                                   class="form-control  rounded-right"
                                   placeholder="Busca aquí tu producto"
                                   aria-label="Busca aquí tu producto" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary px-3 " type="submit" id="button-addon2">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if($error)
                        <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endif
                <!-- dropdown search result -->
                    <div id="display_result"
                         class="dropdown-menu w-100 rounded-0 py-3 m-0"
                         aria-labelledby="dropdownSearch"
                         style="z-index: 999999;">
                        @if(!empty($search))
                            @if(count($results) > 0)
                                <div>
                                    @foreach($results as $item)
                                        <div class="cart-items px-3 mb-3" style="max-height: 70px" wire:key="{{ $loop->index }}">
                                            <!--Shopping cart items -->
                                            <div class="cart-items-item row">

                                                <!-- image -->
                                                <a href="{{ $item->url }}"
                                                   class="cart-img pr-0  float-left col-2 text-center">
                                                    <img class="img-fluid"
                                                         src="{{ $item->mediaFiles()->mainimage->smallThumb }}"
                                                         alt="{{ $item->name ?? $item->title }}"
                                                         style="max-height: 76px; width: 70px; object-fit: cover;">
                                                </a>
                                                <!-- dates -->
                                                <div class="col-10">
                                                    <!-- title -->
                                                    <p class="category mb-1">
                                                        <small class="text-truncate"> {{ $item->category->title }}</small>
                                                    </p>
                                                    <h6 class="mb-0">
                                                        <a href="{{ $item->url }}" title="{{ $item->name ?? $item->title }}"
                                                           class="font-weight-bold text-lowercase text-truncate d-block">
                                                            {{ $item->name ?? $item->title }}
                                                        </a>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>
                            @else
                                <h6 class="text-primary text-center">
                                    {{ trans('icommerce::common.search.no_results') }}
                                </h6>
                            @endif
                        @else
                            <h6 class="text-primary text-center">
                                {{ trans('icommerce::common.search.no_results') }}
                            </h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($showModal)
        <a data-toggle="modal" data-target="#searchModal"
           class="btn btn-link text-secondary icon cursor-pointer d-md-none">
            <i class="fa fa-search"></i>
        </a>
        <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <img src="{{ Theme::url('img/logo.png') }}" class="img-fluid mx-auto py-2"/>
                        </div>
                        <h5 class="text-center my-4 font-weight-bold">
                            Encuentra los mejores productos con diseño de autor
                        </h5>
                        <div id="search-box">
                            <div class="search-product row no-gutters">
                                <div class="col">
                                    <div id="content_searcher" class="dropdown">
                                        <!-- input -->
                                        <div id="dropdownSearch"
                                             data-toggle="dropdown"
                                             aria-haspopup="true"
                                             aria-expanded="false"
                                             role="button"
                                             class="input-group dropdown-toggle">
                                            <div class="input-group">
                                                <input type="text" id="input_search" wire:model.debounce.1000ms="search" autocomplete="off"
                                                       class="form-control  rounded-right"
                                                       placeholder="Busca aquí tu producto"
                                                       aria-label="Busca aquí tu producto" aria-describedby="button-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary px-3 " type="submit" id="button-addon2">
                                                        <span class="d-none d-sm-block">Busqueda</span>
                                                        <i class="fa fa-search d-block d-sm-none"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @if($error)
                                            <div class="alert alert-danger" role="alert">{{ $error }}</div>
                                        @endif
                                        <!-- dropdown search result -->
                                        <div id="display_result"
                                             class="dropdown-menu w-100 rounded-0 py-3 m-0"
                                             aria-labelledby="dropdownSearch"
                                             style="z-index: 999999;">
                                            @if(!empty($search))
                                                @if(count($results) > 0)
                                                    <div>
                                                        @foreach($results as $item)
                                                            <div class="cart-items px-3 mb-3" style="max-height: 70px" wire:key="{{ $loop->index }}">
                                                                <!--Shopping cart items -->
                                                                <div class="cart-items-item row">

                                                                    <!-- image -->
                                                                    <a href="{{ $item->url }}"
                                                                       class="cart-img pr-0  float-left col-auto text-center">
                                                                        <img class="img-fluid"
                                                                             src="{{ $item->mediaFiles()->mainimage->smallThumb }}"
                                                                             alt="{{ $item->name ?? $item->title }}"
                                                                             style="max-height: 76px; width: 70px; object-fit: cover;">
                                                                    </a>
                                                                    <!-- dates -->
                                                                    <div class="float-left col-9">
                                                                        <!-- title -->
                                                                        <p class="category mb-1">
                                                                            <small> {{ $item->category->title }}</small>
                                                                        </p>
                                                                        <h6 class="mb-0">
                                                                            <a href="{{ $item->url }}"
                                                                               class="font-weight-bold text-lowercase">
                                                                                {{ $item->name ?? $item->title }}
                                                                            </a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <h6 class="text-primary text-center">
                                                        {{ trans('icommerce::common.search.no_results') }}
                                                    </h6>
                                                @endif
                                            @else
                                                <h6 class="text-primary text-center">
                                                    {{ trans('icommerce::common.search.no_results') }}
                                                </h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a class="btn btn-secondary text-white px-3" style="border-radius: 0 0.5rem 0.5rem 0;" type="button" class="close my-0" data-dismiss="modal" aria-label="Close">
                                        <i class="fa fa-close"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
