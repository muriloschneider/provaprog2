<?php
//acao Autor
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao_Autor = isset($_GET['acao_Autor']) ? $_GET['acao_Autor'] : "";
    if ($acao_Autor == "excluir"){
        $a_idAutor = isset($_GET['a_idAutor']) ? $_GET['a_idAutor'] : 0;
        require_once ("classe/Autor.class.php");
        $Autor = new Autor("", "", "");
        $resultado = $Autor->excluir($a_idAutor);
        header("location:Autor.php");
    }

  
    $acao_Autor = isset($_POST['acao_Autor']) ? $_POST['acao_Autor'] : "";
    if ($acao_Autor == "salvar"){
        $a_idAutor = isset($_POST['a_idAutor']) ? $_POST['a_idAutor'] : "";
        if ($a_idAutor == 0){
            require_once ("classe/Autor.class.php");

            $Autor = new Autor("", $_POST['a_idAutor'], $_POST['l_preco']);
            
            $resultado = $Autor->inserir();
            header("location:Autor.php");
        }
        else
        require_once ("classe/Autor.class.php");

        $Autor = new Autor("", $_POST['a_idAutor'], $_POST['l_preco']);
        
        $resultado = $Autor->editar($a_idAutor);
        header("location:Autor.php");

    }



//Consultar dados
    function buscarDados($a_idAutor){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM Autor WHERE a_idAutor = $a_idAutor");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['a_idAutor'] = $linha['a_idAutor'];
            $dados['a_nome'] = $linha['a_nome'];
            $dados['a_sobrenome'] = $linha['a_sobrenome'];

        }
        //var_dump($dados);
        return $dados;
    

    
}

?>