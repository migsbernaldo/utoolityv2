<?php
include ('dbconnection.php');
session_start();
if($_SESSION['Login']==0){
    header("Location:login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Schedule</title>
    <link rel="icon" href="img/comteq_E.png">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="modal.css">

</head>

<header>
    <div class="header">
        <nav class="navbar navbar-light bg-light">
        <div class="container-fluid headertab align-bottom b-0">
            <a class="navbar-brand navtitle" href="#">
                <img src="img/comteq_logo2.png" alt="Comteq Logo" width="220" height="45" class="d-inline-block align-bottom">
                Class Scheduling System 2.0
            </a>
        </div>
        </nav>
    </div>
    
    <div class="navtab navbar-default">
        <nav class="navbar navibar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav navbar-left">
                    <li class="nav-item">
                            <a class="nav-link navleft" aria-current="page" href="Admin-rec-instructors.php">Records</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link navleft active" href="Admin-view-sched.php">Schedule</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link navleft dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Utilities
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown1">
                                <a class="dropdown-item" href="Admin-util-archive-instructors.php">Archive</a>
                                <a class="dropdown-item" href="Admin-util-Accounts.php">Accounts</a>
                                <a class="dropdown-item" href="Admin-util-logs.php">Logs</a>
                            </div>
                        </li>
                    </ul>
                </div>
                <ul class="navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link navleft dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user-circle" style="font-size: 25px;"></i>
                            Administrator
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">
                            <a class="dropdown-item" href="edit-password-admin.php">Edit Password</a>
                            <a class="dropdown-item logout" href="logout.php">Log Out</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<body>
    <div class="container mt-3 mx-auto" style="width: 80em;">
        <table id="data-table" class="display table table-striped table-bordered" style="width: 100%;">
            <thead>
                    <tr>
                        <th>Academic Year</th>
                        <th>Year Level</th>
                        <th>Semester</th>
                        <th>Class</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Room</th>
                        <th>Units</th>
                        <th>Instructor</th>
                    </tr>
                </thead>
                <?php
                    $sqldb = "SELECT * FROM classschedule WHERE Active=1 AND Status='Official'";
                    if($result = mysqli_query($conn, $sqldb)){
                        if($result-> num_rows >0){
                            while ($row = $result -> fetch_assoc()){
                                $ClassSchedID = $row['ClassSchedID'];
                                $AcademicYear = $row['AcademicYear'];
                                $Semester = $row['Semester'];
                                $YearLevel = $row['YearLevel'];
                                $Day = $row['Day'];
                                $AvailD = $row['AvailID'];
                                $TimeStart = $row['TimeStart'];
                                $TimeEnd = $row['TimeEnd'];
                                $CourseID = $row['CourseID'];
                                $ipsID = $row['ipsID'];
                                $RoomID = $row['RoomID'];

                                $sTime = date("h:i a", strtotime("$TimeStart"));
                                $ETime = date("h:i a", strtotime("$TimeEnd"));

                                $sqlcourse = "SELECT * FROM course WHERE CourseID=$CourseID";
                                if($resultcourse= mysqli_query($conn, $sqlcourse)){
                                    if(mysqli_num_rows($resultcourse) > 0){
                                        while($rowcourse = mysqli_fetch_array($resultcourse)){
                                            $CourseCode= $rowcourse['CourseCode'];
                                            $CourseDescription= $rowcourse['CourseDescription'];
                                        }
                                    }
                                }

                                $sqlips = "SELECT * FROM instructorpreferredsubject WHERE ipsID=$ipsID";
                                if($resultips = mysqli_query($conn, $sqlips)){
                                    if(mysqli_num_rows($resultips) > 0){
                                        while($rowips = mysqli_fetch_array($resultips)){
                                            $SubjectIDd= $rowips['SubjectID'];
                                            $InstructorID= $rowips['InstructorID'];
                                        }
                                    }
                                }

                                $sqlsub = "SELECT * FROM subjects WHERE SubjectID=$SubjectIDd";
                                if($resultsub = mysqli_query($conn, $sqlsub)){
                                    if(mysqli_num_rows($resultsub) > 0){
                                        while($rowsub = mysqli_fetch_array($resultsub)){
                                            $SubjectCode= $rowsub['SubjectCode'];
                                            $SubjectDescription= $rowsub['SubjectDescription'];
                                            $Units= $rowsub['Units'];
                                        }
                                    }
                                }

                                $sqlins = "SELECT * FROM instructors WHERE InstructorID=$InstructorID";
                                if($resultins = mysqli_query($conn, $sqlins)){
                                    if(mysqli_num_rows($resultins) > 0){
                                        while($rowins = mysqli_fetch_array($resultins)){
                                            $FirstName= $rowins['FirstName'];
                                            $MiddleName= $rowins['MiddleName'];
                                            $lastName= $rowins['LastName'];
                                        }
                                    }
                                }
                                $FullName = $FirstName.' '.$MiddleName.' '.$lastName;

                                $sqlroom = "SELECT * FROM rooms WHERE RoomID=$RoomID";
                                if($resultroom = mysqli_query($conn, $sqlroom)){
                                    if(mysqli_num_rows($resultroom) > 0){
                                        while($rowroom = mysqli_fetch_array($resultroom)){
                                            $RoomNo= $rowroom['RoomNo'];
                                        }
                                    }
                                }

                                echo '<tr> 
                                    <td>'.$AcademicYear.'</td>
                                    <td>'.$YearLevel.'</td>
                                    <td>'.$Semester.' '.'Semester'.'</td>
                                    <td>'.$CourseCode.'/'.$YearLevel.'</td> 
                                    <td>'.$Day.'</td> 
                                    <td>'.$sTime.' - '.$ETime.'</td> 
                                    <td>'.$SubjectCode.'</td> 
                                    <td>'.$SubjectDescription.'</td>
                                    <td>'.$RoomNo.'</td>
                                    <td>'.$Units.'</td>
                                    <td>'.$FullName.'</td>
                                    
                                    
                                    </tr>';
                                    $YrLevel = strtoupper($YearLevel);
                            }
                        }
                    }
                    ?>

                <tbody>
                   
                </tbody>
                <tfoot>
                    <tr>
                    <th>Academic Year</th>
                        <th>Year Level</th>
                        <th>Semester</th>
                        <th>Class</th>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Subject Code</th>
                        <th>Description</th>
                        <th>Room</th>
                        <th>Units</th>
                        <th>Instructor</th>
                    </tr>
                </tfoot>
        </table>
    </div>

    <a id="back-to-top" href="#" class="btn btn-light btn-lg back-to-top" role="button"><i class="fa fa-chevron-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#data-table').DataTable( {
                //button
                buttons: [            
                {
                    extend: 'print',
                    orientation: 'landscape',
                    title: '<div class="container justify-content-center" style="line-height:5px; font-size:16px;"> <div class="row"> <div class="col-md-3"> <img src="img/comteq_logo3.png" alt="Comteq Logo" width="220" height="55"> </div> <div class="col-md-9 mt-1"> <div class="row"> <p style="color: #05517a;">COMTEQ COMPUTER AND BUSINESS COLLEGE, INC.</p> </div> <div class="row"> <p>SAVERS BUILDING, #1200 Rizal Ave., Ext., East Tapinac Olongapo CIty, Zambales, Philippines</p> </div> <div class="row"> <p>Mobile No.: 09770163443/09293110963 | Tel No. (047) 602 4778</p> </div> </div> </div> </div> <hr style="border: 1px solid black;"></hr>',
                    orientation: 'landscape',
                    messageTop: '<div class="container justify-content-center font-weight-bold" style="line-height:10px; font-size:25px;"> <div class="row justify-content-center"> <p style="color: red;"><u>FIRST YEAR </u></p> <p class="mx-1">|</p> <p style="color:#05517a; "> SECOND SEMESTER <p class="mx-1">|</p> <p>SY 2020-2021</p> </div> <div class="row justify-content-center"> <p>ASSOCIATE IN COMPUTER TECHNOLOGY /</p> </div> <div class="row justify-content-center"> <p>B.S. INFORMATION TECHNOLOGY / B.S. COMPUTER SCIENCE</p> </div> </div>',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
    
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    
                    },
                    messageBottom:'<table id="footer-table" class="display table table-striped table-bordered w-100"> <thead> <tr> <td> <p class="font-weight-bold">Prepared By</p> <p class="font-weight-bold mb-0">NOEL R. MARCELINO</p> <p class="mb-0">IT Coordinator</p> </td> <td> <p class="font-weight-bold">Checked By</p> <p class="font-weight-bold mb-0">EDUARDO J. PIANO</p> <p class="mb-0">Assistant Dean College / SHS Principal</p> </td> <td> <p class="font-weight-bold">Approved By</p> <p class="font-weight-bold mb-0">PROF. MARCOS DANILO J. PIANO</p> <p class="mb-0">School President</p> </td> </tr> </thead> </table>'

                },
                'pageLength','colvis', 'pdf', 'excel'],
                "paging": true,
                //lengthmenu
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                lengthChange: false,

                //table filter
                "ordering": true,
                initComplete: function () {
                    this.api().columns().every( function () {
                        var column = this;
                        var select = $('<select><option>Filter by</option></select>')
                            .appendTo( $(column.footer()).empty() )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
            
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                                } );
            
                            column.data().unique().sort().each( function ( d, j ) {
                                select.append( '<option value="'+d+'">'+d+'</option>' )
                            } );
                    } );
                }
                    
            } );

            $('div.dataTables_filter input').addClass('form-control');
            $('div.dataTables_filter input').placeholder = "Search Providers";
            $( "select" ).addClass( "form-control" );

            table.buttons().container()
                .appendTo( '#data-table_wrapper .col-md-6:eq(0)' );

                        // back to top button
                        $(window).scroll(function () {
                if ($(this).scrollTop() > 100) {
                    $('#back-to-top').fadeIn();
                } else {
                    $('#back-to-top').fadeOut();
                }
            });

            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('body, html').animate({
                    scrollTop: 0
                }, 400);
                return false;
            });
        } );
    </script>

    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";
        
        $(window).on("load resize", function() {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                function() {
                    const $this = $(this);
                    $this.addClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "true");
                    $this.find($dropdownMenu).addClass(showClass);
                },
                function() {
                    const $this = $(this);
                    $this.removeClass(showClass);
                    $this.find($dropdownToggle).attr("aria-expanded", "false");
                    $this.find($dropdownMenu).removeClass(showClass);
                }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });
    </script>
</body>
</html>