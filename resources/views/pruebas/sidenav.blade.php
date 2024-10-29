<link rel="stylesheet" href="{{asset('plugins/materialize/css/materialize.min.css')}}">





<ul id="slide-out" class="side-nav">
   <li><div class="user-view">
     <div class="background">
      <img src="images/office.jpg">
     </div>
     <a href="#!user"><img class="circle" src="images/yuna.jpg"></a>
     <a href="#!name"><span class="white-text name">John Doe</span></a>
     <a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>
   </div></li>
   <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
   <li><a href="#!">Second Link</a></li>
   <li><div class="divider"></div></li>
   <li><a class="subheader">Subheader</a></li>
   <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
 </ul>

<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>

<script src="{{asset('plugins/jQuery/jquery.min.js')}}"></script>
 <script src="{{asset('plugins/materialize/js/materialize.js')}}"></script>
 <script src="{{asset('js/funcionesMaterialize.js')}}"></script>

 <script type="text/javascript">

 $(".button-collapse").sideNav();

 </script>
