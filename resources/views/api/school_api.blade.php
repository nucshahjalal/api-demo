@extends('backend.app')
@section('page_title','School Settings')
@section('content')

<main class="nxl-container">
<div class="nxl-content">
        <!-- [ page-header ] start -->
    <div class="page-header d-flex align-items-center justify-content-between">
        <div class="page-header-left d-flex align-items-center gap-2">
             <button class="btn btn-sm btn-success" onclick="getSettings()">Fetch Users</button>
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
                    <table id="settingTable" class="table table-hover mb-0">
                        <thead>
                            <tr class="border-b">
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col" >SL No</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">School Name</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Email</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Phone</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col"> Address</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Logo</th>
                                <th style="font-size:14px; width:5%; white-space: nowrap; text-transform: capitalize;" scope="col">Action</th>
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
    .btn { text-transform: capitalize; }
</style>

<script>
    function getSettings() {
        fetch('https://nextgentechies.sbs/api/settings', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer YOUR_REAL_API_TOKEN'
            }
        })
        .then(res => res.json())
        .then(json => {
            console.log('API RESPONSE:', json);

            // Handle multiple response structures
            const data =
                json.data ||
                json.settings ||
                json.result ||
                json;

            if (!data || typeof data !== 'object') {
                throw new Error('Settings data not found');
            }

            renderUserTable(data);
            document.getElementById('settingTable').style.display = 'table';
            document.getElementById('error').textContent = '';
        })
        .catch(err => {
            console.error(err);
            document.getElementById('error').textContent = err.message;
            document.getElementById('settingTable').style.display = 'none';
        });
    }

    function renderUserTable(data) {
        const tbody = document.querySelector('#settingTable tbody');
        tbody.innerHTML = '';

        const createdDate = data.created_at
            ? formatDate(data.created_at)
            : '-';

        //image show method call
        const logoUrl = getLogoUrl(data);
        const row = `
        <tr>
            <td>1</td>
            <td>${data.school_name ?? '-'}</td>
            <td>${data.contact_email ?? '-'}</td>
            <td>${data.contact_phone ?? '-'}</td>
            <td>${data.contact_address ?? '-'}</td>
            <td>
                ${logoUrl
                    ? `<img src="${logoUrl}" width="50" style="border-radius:6px;">`
                    : 'N/A'}
            </td>
            <td>
                <a href="/settings/edit" class="btn btn-sm btn-primary">Edit</a>
            </td>
        </tr>
        `;

        tbody.insertAdjacentHTML('beforeend', row);
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        if (isNaN(date)) return '-';

        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();

        return `${day}-${month}-${year}`;
    }

    document.addEventListener('DOMContentLoaded', getSettings);

    //image show
    function getLogoUrl(data) {
        if (!data) return null;

        const logo =
            data.school_logo ||
            data.logo ||
            data.school_logo_url ||
            data.logo_url ||
            null;

        if (!logo) return null;

        if (logo.startsWith('http')) {
            return logo;
        }

        return `https://nextgentechies.sbs/api${logo}`;
    }

</script>


{{-- <script>
    function getSettings() {
        fetch('https://nextgentechies.sbs/api/settings', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer YOUR_REAL_API_TOKEN'
            }
        })
        .then(async res => {
            const json = await res.json();

            console.log('API RESPONSE:', json); // 🔍 debug

            if (!res.ok) {
                throw new Error(json.message || 'API request failed');
            }

            // 🔥 HANDLE ALL POSSIBLE STRUCTURES
            const data =
                json.data ||
                json.settings ||
                json.result ||
                json;

            if (!data || typeof data !== 'object') {
                throw new Error('Settings data not found');
            }

            renderTable(data);
            document.getElementById('settingsTable').style.display = 'table';
            document.getElementById('error').textContent = '';
        })
        .catch(err => {
            console.error(err);
            document.getElementById('error').textContent = err.message;
            document.getElementById('settingsTable').style.display = 'none';
        });
    }

    function renderTable(data) {
        const tbody = document.querySelector('#settingsTable tbody');

        tbody.innerHTML = `
            <tr><td>School Name</td><td>${data.school_name ?? '-'}</td></tr>
            <tr><td>School Tagline</td><td>${data.school_tagline ?? '-'}</td></tr>
            <tr><td>Contact Email</td><td>${data.contact_email ?? '-'}</td></tr>
            <tr><td>Contact Phone</td><td>${data.contact_phone ?? '-'}</td></tr>
            <tr><td>Facebook</td><td>${link(data.facebook_url)}</td></tr>
            <tr><td>Twitter</td><td>${link(data.twitter_url)}</td></tr>
            <tr><td>Instagram</td><td>${link(data.instagram_url)}</td></tr>
            <tr><td>LinkedIn</td><td>${link(data.linkedin_url)}</td></tr>
        `;
    }

    function link(url) {
        return url
            ? `<a href="${url}" target="_blank">${url}</a>`
            : '-';
    }

    document.addEventListener('DOMContentLoaded', getSettings);
</script> --}}


@endsection
