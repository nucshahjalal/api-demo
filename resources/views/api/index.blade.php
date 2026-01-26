@extends('backend.app')
@section('page_title','User List')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
        <div class="page-header-left d-flex align-items-center gap-2">
             <button class="btn btn-sm btn-success" onclick="getUsers()">Fetch Users</button>
             <button class="btn btn-sm btn-primary" onclick="downloadExcel()">Download Excel</button>
        </div>

        <div class="page-header-left d-flex align-items-center gap-2">
        <div class="page-header-right ms-auto">
            <form method="get" action="">
                @csrf
                <div class="d-flex align-items-center gap-2">
                    <input class="form-control" type="text" name="filter" 
                        value="{{ request('filter') }}" id="filter" placeholder="Search...">
                    <div class="col-auto">
                        <button class="btn btn-sm btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
        <a href="" class="btn btn-sm  btn-success">
            <i class="feather-plus me-2"></i>
            <span>Add New</span>
        </a>
    </div>
</div>

<div class="main-content">   
    <div class="row">
        <div class="col-xl-12">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="card-body custom-card-action p-0">
                        <div class="table-responsive">
                            <table id="userTable" class="table table-hover mb-0">
                                <thead>
                                    <tr class="border-b">
                                        <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col" >SL No</th>
                                        <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Image</th>
                                        <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Name</th>
                                        <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Email</th>
                                        <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        
                                </tbody>
                            </table>
                        </div>
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

{{-- <script>
    function getUsers() {
        fetch('http://172.16.2.181:8000/api/user-list', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer YOUR_API_TOKEN_HERE',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (!result.data && !result.users) {
                throw new Error(result.message || 'Invalid response');
            }

            const users = result.data || result.users;
            const table = document.getElementById('userTable');
            const tbody = table.querySelector('tbody');

            tbody.innerHTML = '';

            users.forEach(user => {
                const row = `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${formatDate(user.created_at)}</td>
                    </tr>
                `;
                tbody.insertAdjacentHTML('beforeend', row);
            });

            table.style.display = 'table';
            document.getElementById('error').textContent = '';
        })
        .catch(error => {
            document.getElementById('error').textContent = error.message;
            document.getElementById('userTable').style.display = 'none';
        });
    }
</script> --}}

<script>
    let currentPage = 1;
    const rowsPerPage = 5;
    let allUsers = [];

    function getUsers() {
        fetch('http://127.0.0.1:8000/api/user-list', {
            method: 'GET',
            headers: {
                'Authorization': 'Bearer YOUR_API_TOKEN_HERE',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(result => {
            if (!result.data && !result.users) {
                throw new Error(result.message || 'Invalid response');
            }

            allUsers = result.data || result.users;
            renderTable();
            renderPagination();

            document.getElementById('userTable').style.display = 'table';
            document.getElementById('error').textContent = '';
        })
        .catch(error => {
            document.getElementById('error').textContent = error.message;
            document.getElementById('userTable').style.display = 'none';
        });
    }

    function renderTable() {
        const table = document.getElementById('userTable');
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = '';

        const startIndex = (currentPage - 1) * rowsPerPage;
        const endIndex = startIndex + rowsPerPage;
        const paginatedUsers = allUsers.slice(startIndex, endIndex);

        paginatedUsers.forEach((user, index) => {
            const row = `
               <tr>
                <td>${startIndex + index + 1}</td> 
                <td>
                    <img  src="${user.image ? '/' + user.image : '/images/default-user.png'}"
                     width="40"  height="40"  style="border-radius:50%; object-fit:cover;" alt="User Image"  >
                </td>
                <td>${user.name}</td>
                <td>${user.email}</td>
                <td>${formatDate(user.created_at)}</td>
            </tr>

            `;
            tbody.insertAdjacentHTML('beforeend', row);
        });
    }

    function renderPagination() {
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const totalPages = Math.ceil(allUsers.length / rowsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.textContent = i;
            btn.className = i === currentPage ? 'active' : '';
            btn.onclick = () => {
                currentPage = i;
                renderTable();
                renderPagination();
            };
            pagination.appendChild(btn);
        }
    }

    function formatDate(date) {
        return new Date(date).toLocaleDateString();
    }

    // function downloadExcel() {
    //     window.location.href = 'http://172.16.2.181:8000/user-list';
    // }
</script>


<script>
    function formatDate(dateString) {
        if (!dateString) return '';

        const date = new Date(dateString);

        const day   = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year  = date.getFullYear();

        return `${day}-${month}-${year}`;
    }
</script>

@endsection
