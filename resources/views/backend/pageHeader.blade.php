
<div class="page-header">
    <div class="page-header-left d-flex align-items-center">                    
        <ul class="breadcrumb">
            <h3 style="text-align: center !important;"> </h3>
        </ul>
    </div>
    <div class="page-header-right ms-auto">
        <div class="page-header-right-items">
            <div class="d-flex d-md-none">
                <a href="javascript:void(0)" class="page-header-right-close-toggle">
                    <i class="feather-arrow-left me-2"></i>
                    <span>Back</span>
                </a>
            </div>
            <form method="get" action="{{ url('tractor/create/list') }}">
                @csrf
                <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">  
                    <div class="col-auto">
                        <input class="form-control" type="text" name="filter" value="{{ request('filter') }}"  id="filter" placeholder="Search...">
                    </div>
                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="d-md-none d-flex align-items-center">
            <a href="javascript:void(0)" class="page-header-right-open-toggle">
                <i class="feather-align-right fs-20"></i>
            </a>
        </div>
    </div>
</div>
