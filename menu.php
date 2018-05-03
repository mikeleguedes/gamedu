
<?php include 'php/VerificarSession.php';
  //  echo $_SESSION['tipousuario'];
?>

<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./">
                 <img src="img/ifpec.png" width="100" height="100" alt="Logo">
                </a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashboard.php"> <i class="menu-icon fa fa-home"></i>Página Inicial </a>
                    </li>
                    <li class="active">
                        <a href="consultarRanking.php"> <i class="menu-icon fa fa-cubes"></i>Ranking de pontuação </a>
                    </li>
                    <h3 class="menu-title">Tópicos</h3>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Usuário</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="registrarusuario.php">Registrar usuário</a></li>
                            <li><a href="visualizarusuario.php">Usuários existentes</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Aluno</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="registraralunos.php">Registrar aluno</a></li>
                            <li><a href="visualizaraluno.php">Alunos existentes</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Atividade</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="registraratividades.php">Registrar atividade</a></li>
                        </ul>
                    </li>
                     <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-card"></i>Disciplina</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="registrardisciplinas.php">Registrar disciplina</a></li>
                            <li><a href="registrardisciplina_professor.php">Víncular disciplina</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-graduation-cap"></i>Turma</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><a href="registrarturmas.php">Registrar turma</a></li>
                            <li><a href="visualizarturmas.php">Turmas existentes</a></li>
                        </ul>
                    </li>

                    <h3 class="menu-title">Feedback</h3>
                    <li>
                        <a href="feedback.php"> <i class="menu-icon fa fa-reply"></i>Enviar Feedbacks </a>
                    </li>
                    <li>
                        <a href="meusfeedbacks.php"> <i class="menu-icon fa fa-envelope-open"></i>Meus Feedbacks </a>
                    </li>
                    
                    <h3 class="menu-title">Notificação</h3>
                    <li>
                        <a href="notificacoes.php"> <i class="menu-icon fa fa-envelope"></i>Enviar notificações </a>
                    </li>
                    <li>
                        <a href="minhasnotificacoes.php"> <i class="menu-icon fa fa-bell"></i>Minhas notificações </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>


<!-- Menu superior -->
 <div id="right-panel" class="right-panel">

        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa-close"></i></a>
                    <div class="header-left">
                        
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="pull-right">
                        <a>
                         <?php echo $_SESSION['nomeusuario']; ?>
                        </a>
                    </div>            
                </div>
                <div class="col-sm-1">
                    <div class="pull-right">
                        <button type="button" class="btn btn-danger" style="border-radius: 5px;">Sair</button>
                    </div>
                </div>
            </div>

        </header>
