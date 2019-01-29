<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.css"/>
 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.18/b-1.5.4/b-html5-1.5.4/b-print-1.5.4/datatables.min.js"></script>

    <title>Data - BDE Strasbourg</title>

    <script>$(document).ready(()=>{getdata('/data');});</script>
</head>

<body>
    <!-- nav through tables -->
    <nav class="navbar navbar-light bg-light">
        <div class="navbar-nav mr-auto">
            <button id="userbtn" class="btn btn-outline-success">Utilisateur</button>
            <button id="eventbtn" class="btn btn-outline-success">Evenement</button>
            <button id="commandbtn" class="btn btn-outline-success">Commande</button>
            <button id="articlebtn" class="btn btn-outline-success">Article</button>
        </div>
    </nav>
    
    <!-- datatable -->
    <table id="datatable" class="display"></table>

    <script>
    function getdata(link)
    {
        $.get(link, (data, status)=>{
            console.log(status);

            if($.fn.dataTable.isDataTable('#datatable')) {//if datatable exist, destroy it
                let table = $('#datatable').DataTable();
                table.destroy();
            }

            $('#datatable').html(data);//load html returned by get

            let table = $('#datatable').DataTable({//setup datatable
                paging: true,
                responsive: true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend : 'copy',
                        text: 'Copy to clipboard'
                    },
                    'excel',
                    'pdf'
                ]    
            });

            table.buttons().container().appendTo($('.col-sm-6:eq(0)', table.table().container()));
        });
    }
</script>
<script>
    $(document).ready(()=>{
        $('#userbtn').click(()=>{//load user table
            getdata('/data');
        });

        $('#eventbtn').click(()=>{//load event table
            getdata('/data/event');
        });

        $('#commandbtn').click(()=>{//load command table
            getdata('/data/command');
        })

        $('#articlebtn').click(()=>{//load article table
            getdata('/data/article');
        });
    });
</script>
</body>
</html>