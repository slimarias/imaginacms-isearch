<div id="custom-search-input">

    <form id="custom-search-input" class="form-inline" method="GET" onsubmit="return redirectForm('term')">

        <div class="input-group">
            <span class="input-group-btn">
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
            <input type="text" class="form-control" placeholder="{{trans('isearch::common.search')}} " name="search" id="term" maxlength="64" required>
        </div>

    </form>

</div>

@include('isearch::forms.search-script')