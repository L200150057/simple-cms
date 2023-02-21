let tagDatatable;

$(document).ready(function () {
    /** Check if tagList variable exist */
    if (typeof tagList === 'undefined') {
        throw new Error('Tag list url not defined.');
    }

    tagDatatable = $('table').DataTable({
        processing: true,
        serverSide: true,
        ajax: tagList,
        order: [],
        columns: [
            { data: 'DT_RowIndex', sortable: false, searchable: false },
            { data: 'name' },
            { data: 'created_by' },
            { data: 'action', searchable: false, sortable: false },
        ],
    });
});
