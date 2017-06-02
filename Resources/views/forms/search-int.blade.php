<div id="custom-search-input">
    {!!Form::open(array('route' => locale().'.isearch.search'))!!}
    <div class="input-group">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="glyphicon glyphicon-search"></span>
            </button>
        </span>
        <input type="text" class="form-control" placeholder="{{trans('isearch::common.search')}} " name="search" maxlength="64" >
    </div>
    {!!Form::close()!!}
</div>