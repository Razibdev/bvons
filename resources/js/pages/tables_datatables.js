
// DataTables, for more examples you can check out https://www.datatables.net/

class pageTablesDatatables {
    /*
     * Init DataTables functionality
     *
     */
    static initDataTables() {
        // Override a few DataTable defaults
        jQuery.extend( jQuery.fn.dataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap4"
        });

        // Init full DataTable
        jQuery('.js-dataTable-full').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]],
            autoWidth: false
        });

        jQuery('.withdrawal-accepted-list').dataTable({
            pageLength: 5,
            lengthMenu: [[5, 10, 20], [5, 10, 20]],
            autoWidth: false
        });

        jQuery('.datatable-user-list').dataTable({
            pageLength: 50,
            lengthMenu: [[50, 100, 200], [50, 100, 200]],
            autoWidth: true
        });

        jQuery('.user-job-list').dataTable({
            pageLength: 1000,
            lengthMenu: [[1000, 2000, 3000], [1000, 2000, 3000]],
            autoWidth: true
        });
    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initDataTables();
    }
}

// Initialize when page loads
jQuery(() => { pageTablesDatatables.init(); });

