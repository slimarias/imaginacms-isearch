<div class="row">
    <div class="search">
        {!!Form::open(array('route' => locale().'.isearch.search', 'class' => 'form-inline', 'id' => 'custom-search-input'))!!}
        <div class="input-group">
            <input type="text" class="form-control" placeholder="{{trans('isearch::common.search')}} " name="search" maxlength="64" >
            <span class="input-group-btn">
                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                </span>
        </div><!-- /input-group -->
        {!!Form::close()!!}

    </div>
</div>
