<?php 
//Controllo utente per scelta d'icona di avatar
if (isset($_SESSION["logged"])) {
  $avatar= "user.png";
  if ($_SESSION["email"] == "root@root.rt") {
    $_SESSION["admin"] = true;
    $avatar= "admin.png";
  }
} else {
  $avatar= "log-in.png";
}
?>
<style>
  <?php include "./css/NavCSS.css";?> 
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top Nav">
  <a class="navbar-brand" href="./index.php" ><img src="./resources/Logo.png" alt="LOGO" height="46px" width="46px"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation" _msthidden="A" _msthiddenattr="203541" _mstaria-label="320099">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbars">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" style="color:#fff" href="./index.php">Home</a>
      </li>      
    </ul>
    <ul class="navbar-nav justify-content-end">
      <li class="nav-item dropdown justify-content-end">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown"  role="button" aria-haspopup="true" aria-expanded="false">
        <img src="./resources/<?php echo $avatar;?>" alt="users" width="32" height="32" class="rounded-circle">
        </a>
        
        <div class="dropdown-menu dropdown-menu-right">
               
          <?php
            if(isset($_SESSION["logged"])){
              if (isset($_SESSION["admin"])) {
                echo '
                <a class="dropdown-item" href="user.php" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                      <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                      <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                  </svg>
                  Pagina Utente
                </a>
                <a class="dropdown-item" href="modifica_inserimento.php" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 16 16">
                    <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"/>
                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"/>
                  </svg>
                  Aggiungi Libro
                </a>
                <a class="dropdown-item" href="#" >
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                    <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5v-3zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5v-3zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5v-3zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5v-3z"/>
                  </svg>
                    Amministrazione
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item exit" href="cleanSession.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                  </svg>
                    Disconnetti
                </a>
                ';
              }else{
                echo '          
                <a class="dropdown-item" href="user.php" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1h8zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4z"/>
                        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>
                    Pagina Utente
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item exit" href="cleanSession.php">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-door-open-fill" viewBox="0 0 16 16">
                  <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
                  </svg>
                    Disconnetti
                </a>
                ';
              }  
            }else{
              echo '
                <a class="dropdown-item " onclick="Form()">
                <span class="iconify" data-icon="fa-solid:door-open" data-inline="false" ></span>
                  Accedi
                </a>
                <a class="dropdown-item" onclick="Form()">
                  <span class="iconify" data-icon="fa-solid:user-lock" data-inline="false" ></span>
                  Registrati
                </a>
              ';
            }
          ?>
        </div>
      </li>
    </ul>
  </div>
</nav>
<div class="BackNav"></div>       

