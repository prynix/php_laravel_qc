    @extends('layout.main')
    @section('content')             
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            404 Error Page
        </h1>
        <ol class="breadcrumb">
            <li><a href="dashboard"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">404 error</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     <div class="wrapper">

        <div class="mainWrapper">

            <div class="mainHolder">
                <div class="message">Oooops....we can’t find that page.</div>
                <!-- end .message -->
                <div class="errorNumber">404</div> 
                <!-- end .errorNumber -->
                <!-- Search Form -->
                <div class="search">
                    <form action="" method="post">
                      <div class="searchInput">
                        <input type="text" name="search_term" value="Search" />
                    </div>
                    <div class="searchButton">
                        <input type="submit" name="submit" value="" />
                    </div>

                </form>
            </div>
            <!-- end .search -->

            <div class="trafficLight">404 Error</div>

        </div>
        <!-- end .mainHolder -->
    </div>
    <!-- end .mainWrapper -->

</div>
<!-- end .wrapper -->

</section><!-- /.content -->
@stop                
