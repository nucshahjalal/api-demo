<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>User API List</h2>
<button onclick="getUsers()">Fetch Users</button>

<table id="userTable" style="display:none;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

<p id="error" style="color:red;"></p>

<script>
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

</body>
</html>
