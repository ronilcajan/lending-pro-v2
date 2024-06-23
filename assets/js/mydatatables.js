$(document).ready(function(){

    $('#borrowersTable').DataTable();
    
    $('#btransTable').DataTable({
        "order": [[ 0, "desc" ]],
    });
    $('#bloanTable').DataTable({
        "order": [[ 5, "asc" ]],
    });
    $('#transactionTable').DataTable({
        "order": [[ 0, "desc" ]],
    });
    $('#loanTable').DataTable({
        "order": [[ 8, "asc" ]],
    });
    $('#reportTable').DataTable({
        "oLanguage": {
            "sLengthMenu": "_MENU_ Entries"
        },
        dom: 'Blfrtip',
        buttons: [
            { 
                "extend": 'csv', 
                "text":'CSV',
                "filename": 'active_loan_report',
                "title":'List of Active Loans',
                "className": 'btn btn-primary btn-sm text-light mb-2',
                "exportOptions": {
                    "columns": [0,1,2,3,4,5,6],
                   
                },
            },
            { 
                "extend": 'print', 
                "text":'PRINT',
                "filename": 'active_loan_report',
                "title":'List of Active Loans',
                "className": 'btn btn-primary btn-sm text-light mb-2',
                "exportOptions": {
                    "columns": [0,1,2,3,4,5,6],
                   
                },
            },
            { 
                "extend": 'pdf', 
                "text":'PDF',
                "filename": 'active_loan_report',
                "title":'List of Active Loans',
                "className": 'btn btn-primary btn-sm text-light mb-2',
                "exportOptions": {
                    "columns": [0,1,2,3,4,5,6],
                   
                },
            }
        ]
    });
})