
@if(session()->has('success'))
    <div class="m-0 text-center alert alert-success alert-dismissible fade show w-75 mx-auto mb-3" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session()->has('error'))
    <div class="m-0 text-center alert alert-danger alert-dismissible fade show w-75 mx-auto mb-3" role="alert">
        {{ session()->get('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session()->has('warning'))
    <div class="m-0 text-center alert alert-warning alert-dismissible fade show w-75 mx-auto mb-3" role="alert">
        {{ session()->get('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


@if(session()->has('info'))
    <div class="m-0 text-center alert alert-info alert-dismissible fade show w-75 mx-auto mb-3" role="alert">
        {{ session()->get('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


{{--@if ($errors->any())
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>
        Please check the form below for errors
    </div>
@endif--}}
