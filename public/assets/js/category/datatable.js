let categoryDatatable;

$(document).ready(function () {
    /** Check if categoryList variable exist */
    if (typeof categoryList === 'undefined') {
        throw new Error('Tag list url not defined.');
    }

    categoryDatatable = $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: categoryList,
        order: [],
        columns: [
            { data: 'DT_RowIndex', sortable: false, searchable: false },
            { data: 'name' },
            { data: 'created_by' },
            { data: 'action', searchable: false, sortable: false },
        ],
    });
});
