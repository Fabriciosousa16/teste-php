<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand" href="#">Teste PHP</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Usuários
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/users/create">Cadastrar</a>
            <a class="dropdown-item" href="/users">Listar</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Cor
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="/colors/create">Cadastrar</a>
            <a class="dropdown-item" href="/colors">Listar</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/users-colors/add-colors/">Vincular</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/reports">Relatórios</a>
        </li>
      </ul>
    </div>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </div>
</nav>
<div class="container flex-grow-1">
