@extends('backend.app')
@section('page_title','Create Blog')
@section('content')

<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
       <div class="page-header">
            <div class="page-header-left d-flex align-items-center">                    
                <ul class="breadcrumb">
                        <h3 style="text-align: center !important;"> Manage Blog Information</h3>
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
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ url('blog/list') }}" class="btn btn-sm btn-lg btn-primary w-100 text-white fw-bold" >
                            ← Back
                        </a>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>
    <div class="main-content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <form id="uploadForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name"  value="{{ old('name') }}" id="name" placeholder="Name">
                                </div>
                                @error('name')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror 

                                <div class="col-lg-6 mb-3">
                                    <label class="form-label">Image <span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="image[]" multiple  value="{{ old('image') }}" id="image" placeholder="Image">
                                </div>
                                @error('image')
                                    <div style="color: red">{{ $message }}</div>
                                @enderror 
                            </div>
                    
                            <div class="row">    
                                <div class="col-lg-12 mb-7 ">
                                    <button  type="button" onclick="uploadFile()" class="btn btn-success">Submit</button>
                                </div> 
                            </div>

                        </form>
                    </div>
                </div>
            </div>
                
        </div>
    </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <!-- dashboardMainContent -->
        <!-- [ Main Content ] end -->
    </div>
    
    <!-- [ Footer ] start -->
    <!-- @include('backend.footer') -->
    <!-- [ Footer ] end -->
    
</main>

<style>
   .btn {
        text-transform: capitalize;
    }
</style>

<script>

    function uploadFile() {
    
        const form = document.getElementById('uploadForm');
        const formData = new FormData(form);

        fetch('http://127.0.0.1:8000/api/file-upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(res => res.json())
        .then(data => {
           // alert(data.message);
            window.location.href = '/blog-list';
        })
        .catch(err => {
            console.error(err);
            alert('Upload failed');
        });
    }

</script>


@endsection