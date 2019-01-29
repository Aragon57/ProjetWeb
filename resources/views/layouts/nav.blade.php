<script src="{{ asset('js/jquery.min.js') }}"></script>

 <!-- Code de la navbar de notre site -->

<nav class="navbar navbar-expand-md navbar-dark bg-dark">

     <!-- Logo du site -->

    <img src="http://127.0.0.1:8000/img/logo.png" alt="logo"  class ="logo">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">


         <!-- Différents lien de notre navbar -->

            <li class="nav-item">
                <a class="nav-lin" href="/event">NOS EVENEMENTS</a>
            </li>
            <li class="nav-item">
                <a class="nav-lin" href="/idee">BOITE A IDEE</a>
            </li>
          <li class="nav-item">
                <a class="nav-lin" href="/boutique">BOUTIQUE</a>
            </li>
        </ul>
    </div>
    <div class="mx-auto order-0">
        <a class=" cesii" href="/">BDE CESI STRASBOURG</a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">

                        <li id="user_depend" class="nav-item">
                
            </li>
            <li class="nav-item">
                <a class="nav-lin" href="#">CONTACT</a>
            </li>

        </ul>

       
    </div>
</nav>


 <!-- Script afin de savoir si l'utilisateur est connecté ou non -->


<script>

    $(document).ready(() => {
        $.get('/islogged', (data, status) => {
            console.log(data);
            console.log(status);

            if(data != 'true')
            {
                $.get('/logout', (data, status)=>{

                });
            }

            console.log('hello');
            $('#user_depend').load('/usernav');
        });
    });
</script>
