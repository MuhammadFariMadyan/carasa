<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Carasa User | {{Auth::user()->username}}</title>

    <!-- Bootstrap core CSS -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <link href="{{asset('fonts/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/icheck/flat/green.css')}}" rel="stylesheet">
    <link href="{{asset('css/datatables/tools/css/dataTables.tableTools.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery.min.js')}}"></script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">
                @if($errors->any())
                <div class="alert alert-danger" id="alert"><span class="glyphicon glyphicon-remove-sign">{{$errors->first()}}</span><span class ="glyphicon glyphicon-remove pull-right" id="closebutton"></span></div>
                @endif
    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-hospital-o"></i> <span>CARASA</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="{{asset('images/img.jpg')}}" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome, {{Auth::user()->username}}</span>
                            <h2></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    @include('admin.sidemenu')
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

              @include('admin.navmenu')

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>
                   Tambah Admin
                    <!-- <small>
                        Some examples to get you started
                    </small> -->
                            </h3>
                        </div>

                    </div>
                    <div class="clearfix"></div>

                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                            @include('content.addingadmin')
                            </div>
                        </div>

                        <br />
                        <br />
                        <br />

                    </div>
                </div>
                <!--modal-content -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="asking">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Konfirmasi delete</h4>
                          </div>
                          <div class="modal-body">
                            <p>Apakah anda yakin ingin mengahpus data tersebut?&hellip;</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-primary" class="close" data-dismiss="modal">Ya</button>
                            <button type="button" class="btn btn-primary" class="close" data-dismiss="modal">Cancel</button>
                          </div>
                        </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
                    </div>
                <!-- /.modal -->
                    <!-- footer content -->
                <footer>
                    <div class="">
                        <!-- <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                            <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                        </p> -->
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
                    
                </div>
                <!-- /page content -->
            </div>

        </div>

        <div id="custom_notifications" class="custom-notifications dsp_none">
            <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
            </ul>
            <div class="clearfix"></div>
            <div id="notif-group" class="tabbed_notifications"></div>
        </div>

           <script type="text/javascript">
                    $(document).ready(function()
                    {
                        $('#closebutton').click(function()
                        {
                            $('#alert').remove();
                        });
                    });        
        </script>

        <script src="{{asset('js/bootstrap.min.js')}}"></script>

        <!-- chart js -->
        <script src="{{asset('js/chartjs/chart.min.js')}}"></script>
        <!-- bootstrap progress js -->
        <script src="{{asset('js/progressbar/bootstrap-progressbar.min.js')}}"></script>
        <script src="{{asset('js/nicescroll/jquery.nicescroll.min.js')}}"></script>
        <!-- icheck -->
        <script src="{{asset('js/icheck/icheck.min.js')}}"></script>

        <script src="{{asset('js/custom.js')}}"></script>


        <!-- Datatables -->
        <script src="{{asset('js/datatables/js/jquery.dataTables.js')}}"></script>
        <script src="{{asset('js/datatables/tools/js/dataTables.tableTools.js')}}"></script>
        
        <!-- pace -->
      
</body>

</html>