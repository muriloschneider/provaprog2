<?php
//acao livro
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao_livro = isset($_GET['acao_livro']) ? $_GET['acao_livro'] : "";
    if ($acao_livro == "excluir"){
        $l_idLivro = isset($_GET['l_idLivro']) ? $_GET['l_idLivro'] : 0;
        require_once ("classe/livro.class.php");
        $livro = new livro("", "", "");
        $resultado = $livro->excluir($l_idLivro);
        header("location:livro.php");
    }

  
    $acao_livro = isset($_POST['acao_livro']) ? $_POST['acao_livro'] : "";
    if ($acao_livro == "salvar"){
        $l_idLivro = isset($_POST['l_idLivro']) ? $_POST['l_idLivro'] : "";
        if ($l_idLivro == 0){
            require_once ("classe/livro.class.php");

            $livro = new livro("", $_POST['l_idLivro'], $_POST['l_preco']);
            
            $resultado = $livro->inserir();
            header("location:livro.php");
        }
        else
        require_once ("classe/livro.class.php");

        $livro = new livro("", $_POST['l_idLivro'], $_POST['l_preco']);
        
        $resultado = $livro->editar($l_idLivro);
        header("location:livro.php");

    }



//Consultar dados
    function buscarDados($l_idLivro){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM livro WHERE l_idLivro = $l_idLivro");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['l_idLivro'] = $linha['l_idLivro'];
            $dados['l_titulo'] = $linha['l_titulo'];
            $dados['l_preco'] = $linha['l_preco'];

        }
        //var_dump($dados);
        return $dados;
    

    
}

?>