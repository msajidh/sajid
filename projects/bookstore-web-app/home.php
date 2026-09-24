<!doctype html>
<html lang="en">
<?php
session_start();
require_once "internal/dbconnect.php";
// include "internal/home/index.html";

if( ! isset($_SESSION['username'])) {
	$_SESSION['username']='?';
}
if( ! isset($_SESSION['is_admin'])) {
	$_SESSION['is_admin']=0;
}
?>
  <head> 
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap/dashboard.css" rel="stylesheet">
    <script src="js/ajax.js"></script>
    <script src="js/home.js"></script>

        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap/jquery-3.2.1.min.js"></script>
    <script src="bootstrap/popper.min.js"></script>
    <script src="bootstrap/bootstrap.min.js"></script>

    <script> 

    $(function(){
      $("#header2").load("internal/header2.php");  
      $("#footer").load("internal/footer.php"); 
      // $("#section").load("internal/" + $("#section_name").val() + ".php"); 
    });

    function load_section(page)
    {
      $("#section").load("internal/" + page + ".php");       

    }

    function load_header()
    {
      var header_type = $(".header").attr('id');
      $(".header").load("internal/" + header_type + ".php");
    }

    </script> 

    <!-- Script to add live chat option -->
    <script>
    !function(g,s,q,r,d){r=g[r]=g[r]||function(){(r.q=r.q||[]).push(arguments)};
    d=s.createElement(q);d.src='//d1l6p2sc9645hc.cloudfront.net/gosquared.js';q=
    s.getElementsByTagName(q)[0];q.parentNode.insertBefore(d,q)}(window,document
    ,'script','_gs');

    _gs('GSN-210799-K');
    // anonymize IPs
    _gs('set', 'anonymizeIP', true);
    // works in localhost environment
    _gs('set', 'trackLocal', true);
  </script>
  </head> 

  <body> 
    <?php
      // $_SESSION['username'] = "?";
      $_SESSION['is_admin'] = 0;
      
      $header_type = "";
      if($_SESSION['is_admin'] == 1)
      { 
        // is the logged in user an admin?
        $header_type = "admin_header";
      }
      else
      {
        // is the session for a logged in user?
        if($_SESSION['username']!='?')
        {
          $header_type = "user_header";
        }
        else
        {
          // show header with login and registration options
          $header_type = "guest_header";
        }
      }
      echo "<div class=\"header\" id=\"" . $header_type . "\">header</div>";
      echo "<script>load_header()</script>";
      
    ?>

    
    <div id="header2"></div>
    <div id="section">
      <?php
      if( ! isset($_REQUEST['p'])) 
      {
        $_REQUEST['p']='home';
        require "internal/home/index.html";
      }
      $p = $_REQUEST['p'];
      // list of the permited pages

      // $pages = array('blog','home','shopinfo','login','do_login','after_login','logout','myinfo','contact','books','cart','catinfo','productinfo','add_cart','empty_cart','buy_cart');

      $pages = array('blog','home','login','logout','myinfo','contact','cart','catinfo','add_cart','empty_cart','buy_cart', 'search', 'editorspicks', 'registration', 'thank_you', 'review', 'page_not_found', 'wishlist');


      if(isset($_REQUEST['query']) && $_REQUEST['p']=='search') 
      {
        $_REQUEST['query'] = "'" . $_REQUEST['query'] . "'";
        require "internal/search.php";
      }

      $ok=false;
      foreach($pages as $pp) {
        if($pp==$p) {
          require "internal/$p.php";
          $ok=true;
        }
      }
      if($_REQUEST['p']=='books') 
      {
        $_REQUEST['orderBy'] = "'title'";
        require "internal/search.php";
        $ok=true;
      }
      if(isset($_REQUEST['isbn']) && $_REQUEST['p']=='book_preview') 
      {
        
        $_REQUEST['isbn'] = "'" . $_REQUEST['isbn'] . "'";

        require "internal/book_preview.php";
        $ok = true;
      }
      if($_REQUEST['p']=='register') 
      {
        // $_REQUEST["firstName_insert_cust"] = "'" + $_REQUEST["firstName_insert_cust"] + "'";
        // $_REQUEST["lastName_insert"] =  "'" + $_REQUEST["lastName_insert"] + "'";
        // $_REQUEST["email_insert"] = "'" + $_REQUEST["email_insert"] + "'";
        
        // if(isset($_REQUEST["dob_insert"])) 
        // { 
        //   $_REQUEST["dob_insert"] = "'" + $_REQUEST["dob_insert"]  + "'";
        // }
        // else
        // {
        //   $_REQUEST["dob_insert"] =  "''";
        // }
        // $_REQUEST["passwordencrypted_insert"] =   "'" +  $_REQUEST["passwordencrypted_insert"]  + "'";
        // if(isset($_REQUEST["phone_insert"]))
        // {
        //   $_REQUEST["phone_insert"]  = "'" + $_REQUEST["phone_insert"]  + "'";
        // }
        // else
        // {
        //   $_REQUEST["phone_insert"]  = "''";

        // }

        require "internal/register.php";
        $ok = true;
      }


      if(! $ok) {
        require "internal/page_not_found.php";
      }
    ?>
    </div>

    <div id="footer"></div>


  </body> 
</html>