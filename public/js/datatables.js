
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/getSales',
        columns: [
            { data: 'id', name: 'shop.id' },
            { data: 'name', name: 'shop.name' },
            { data: 'date', name: 'sales.date' },
            { data: 'name', name: 'users.name' },
        ],
        success: (function(data) {
           console.log(data);
        }),
    });
