<!-- Changement de la barre de navigation selon l'état (connecté ou non) -->

<?php
    session_start();   


    //Si on est connecté
    if(isset($_SESSION['email']))
    {
    echo  '<li class="nav-item dropdown">
    <a class="nav-lin dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    MON COMPTE
    </a>
    <div class="dropdown-menu bg-dark" >

    <a class="dropdown-item nav-lin" href="">';  
    Print_r ($_SESSION['email']); 
    echo '</a>
    <div class="dropdown-diviseur"></div>
    <a class="dropdown-item nav-lin" href="/cart">MON PANIER</a>';
    if($_SESSION['status']==4){
    echo '<a class="dropdown-item nav-lin" href="/admin">PANEL ADMIN</a>';
}
    echo '<a class="dropdown-item nav-lin" href="/logout">SE DECONNECTER</a>
    </div>
    </li>';
    }
    //Si on est déconnecté
    else
    {
        echo '<a class="nav-lin" href="/connexion"> SE CONNECTER </a>';
    }
?>