<!DOCTYPE html>
<html ng-app="FrontpagesApp">
  <head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-site-verification" content="xk__bFcVfFtrLn8-sPClo9K2xZ1XRH7-1f-z7L-2Of0" />
    <title>Frontpages - NobisNews</title>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,400italic">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">

    <!-- Begin Package Styles -->
    <link rel="stylesheet" href="bower_components/html5-boilerplate/dist/css/normalize.css">
    <link rel="stylesheet" href="bower_components/html5-boilerplate/dist/css/main.css">
    <link rel="stylesheet" href="bower_components/materialize/dist/css/materialize.min.css">
    <!-- End Package Styles -->

    <!-- Begin Application-specific Styles -->
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/templatemo-style.css">
    <link rel="stylesheet" href="css/photoswipe.css">
    <link rel="stylesheet" href="css/default-skin/default-skin.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/newsSource.css">
    <link rel="stylesheet" type="text/css" href="css/sweetalert.css">
    <!-- End Application-specific Styles -->
    
    <script src="bower_components/html5-boilerplate/dist/js/vendor/modernizr-2.8.3.min.js"></script>

  </head>
  <body>
        <header class="site-header container-fluid">
            <div class="main-header">
                <div class="row">
                    <div class="logo col s9">
                        <h1><a href="#!/">Frontpages</a></h1>
                        <span>A NobisNews Project</span>
                    </div>
                    <div class="col s3">
                        <ul class="home__user_details">
                        <!-- {% if is_granted('IS_AUTHENTICATED_FULLY') %} -->
                        @if (isset($user))
                            <li>
                                <b>Username:</b> <span>{{ $user->email }}</span>
                            </li>
                            <li>
                                <b>News Sources Added:</b> <span>{{ count($user->newsSources) }}</span>
                            </li>
                            <li>
                                <b>Last Used:</b> <span>November 5, 2016</span>
                            </li>
                            <li>
                                <button id="logout-btn"> Logout </button>
                            </li>

                        @else
                        <a href="{{ route('login') }}">Login</a>
                        @endif
                        </ul>
                    </div> <!-- /.menu-wrapper -->
                </div> <!-- /.row -->
        </div> <!-- /.main-header -->
    </header> <!-- /.site-header -->
        <!-- views -->
        <div ng-view></div>
    <!-- scripts -->
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-sanitize/1.5.8/angular-sanitize.js"></script>
    <script src="bower_components/materialize/dist/js/materialize.min.js"></script>
    <script src="scripts/sweetalert.min.js"></script>
    <script src="scripts/photoswipe.js"></script>
    <script src="scripts/photoswipe-ui-default.js"></script>
    <script src="scripts/moment.js"></script>
    <script src="scripts/moment-timezone.js"></script>
    <script src="scripts/moment-timezone-data-load.js"></script>
    <script>
    // handle logout button action
    function post(path, method) {
        method = method || "post"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        document.body.appendChild(form);
        form.submit();
    }

    $('#logout-btn').click(function(evt){
        post(
            'logout'
        );
    });

    var user = {
        username: '{{ isset($user->username) ? $user->username : null }}',
        loggedIn: '{{ isset($user) ? true : null }}',
        newsSources: JSON.parse({!! isset($user) ?  json_encode($newsSources) : 'null' !!})
        
    };
    </script>
    <script src="/build/js/bundled.js" type="text/javascript"></script>
    
    <!-- Preloader -->
    <script type="text/javascript">
        //<![CDATA[
        // $(window).load(function() { 
        //  $('.loader-item').fadeOut(); 
        //  $('#pageloader').delay(1000).fadeOut('slow');
        //  $('body').delay(1000).css({'overflow-y':'visible'});
        // });
        //]]>
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-62758284-2', 'auto');
        ga('send', 'pageview');

    </script>
  </body>
</html>