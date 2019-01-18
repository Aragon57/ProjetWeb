<html>
<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
       <img src="https://s3-eu-west-1.amazonaws.com/assets.atout-on-line.com/images/ingenieur/Logos_Ecoles/2018_2020/cesi_300.jpg" width="20%/9" height="50%/9" class ="logo">


       <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-lin" href="afafa">NOS EVENEMENTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-lin" href="#">BOITE A IDEE</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-lin dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  BOUTIQUE
              </a>
              <div class="dropdown-menu" >

                <a class="dropdown-item" href="Aventador.html">BOUTIQUE</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="Aventador.html">VETEMENTS</a>
                <a class="dropdown-item" href="Huracan.html">TASSES</a>
                <a class="dropdown-item" href="Urus.html">GOODIES</a>
            </div>
        </li>

    </ul>
</div>
<div class="mx-auto order-0">
    <a class=" cesii" href="#"><h7>BDE CESI STRASBOURG</h7></a> 
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
        <span class="navbar-toggler-icon"></span>
    </button>
</div>
<div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-lin" href="#">CONTACT</a>
        </li>
        <li class="nav-item">
            <?php if(isset($_SESSION['email'])){
               echo  '<li class="nav-item dropdown">
               <a class="nav-lin dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               MON COMPTE
               </a>
               <div class="dropdown-menu" >

               <a class="dropdown-item" href="Aventador.html">';  
               Print_r ($_SESSION['email']); 
               echo '</a>
               <div class="dropdown-divider"></div>
               <a class="dropdown-item" href="Aventador.html">MES INFOS</a>
               <a class="dropdown-item" href="Huracan.html">MON COMPTE</a>
               <a class="dropdown-item" href="/logout">SE DECONNECTER</a>
               </div>
               </li>';

           }else{
             echo '<a class="nav-lin" href="/connexion"> SE CONNECTER </a>';

         } ?>

     </li>

 </ul>
 
 <form class="form-inline">
    <input class="form-control btnsearch mr-sm-2" type="search" placeholder="RECHERCHE" aria-label="Search">
    <button class=" recherche btn btnsearch btn-outline-success my-1 my-sm-0" type="submit">RECHERCHE</button>
</form>
</div>
</nav>
</body>
</html>

