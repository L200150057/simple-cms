let userDatatable;

$(document).ready(function () {
    /** Check if userList variable exist */
    if (typeof userList === 'undefined') {
        throw new Error('User list url not defined.');
    }

    userDatatable = $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: userList,
        order: [],
        columns: [
            { data: 'DT_RowIndex', sortable: false, searchable: false },
            { data: 'photo', searchable: false, sortable: false },
            { data: 'name' },
            { data: 'email' },
            { data: 'status' },
            { data: 'action', searchable: false, sortable: false },
        ],
    });
});
