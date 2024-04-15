 <!-- Mainly scripts -->
 
    <script src="backend/js/bootstrap.min.js"></script>
    <script src="backend/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="backend/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="backend/js/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="backend/library/library.js"></script>
    <script src="backend/js/inspinia.js"></script>
    <script src="backend/js/plugins/pace/pace.min.js"></script>
    <!--Jquery UI-->
   @if(isset($config['js']) && count($config['js']) > 0)
       
      @foreach($config['js'] as $key => $val)
         {!! '<script src="'.$val.'"></script>' !!} 
      @endforeach
   @endif
     
        