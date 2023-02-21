let postDatatable;

$(document).ready(function () {
    /** Check if postList variable exist */
    if (typeof postList === 'undefined') {
        throw new Error('Tag list url not defined.');
    }

    postDatatable = $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: postList,
        order: [],
        columns: [
            { data: 'DT_RowIndex', sortable: false, searchable: false },
            { data: 'title' },
            { data: 'created_by' },
            { data: 'action', searchable: false, sortable: false },
        ],
    });
});
