<?php
//acao Cliente
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao_Cliente = isset($_GET['acao_Cliente']) ? $_GET['acao_Cliente'] : "";
    if ($acao_Cliente == "excluir"){
        $c_idCliente = isset($_GET['c_idCliente']) ? $_GET['c_idCliente'] : 0;
        require_once ("classe/Cliente.class.php");
        $Cliente = new Cliente("", "", "");
        $resultado = $Cliente->excluir($c_idCliente);
        header("location:Cliente.php");
    }

  
    $acao_Cliente = isset($_POST['acao_Cliente']) ? $_POST['acao_Cliente'] : "";
    if ($acao_Cliente == "salvar"){
        $c_idCliente = isset($_POST['c_idCliente']) ? $_POST['c_idCliente'] : "";
        if ($c_idCliente == 0){
            require_once ("classe/Cliente.class.php");

            $Cliente = new Cliente("", $_POST['c_idCliente'], $_POST['l_preco']);
            
            $resultado = $Cliente->inserir();
            header("location:Cliente.php");
        }
        else
        require_once ("classe/Cliente.class.php");

        $Cliente = new Cliente("", $_POST['c_idCliente'], $_POST['l_preco']);
        
        $resultado = $Cliente->editar($c_idCliente);
        header("location:Cliente.php");

    }



//Consultar dados
    function buscarDados($c_idCliente){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM Cliente WHERE c_idCliente = $c_idCliente");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['c_idCliente'] = $linha['c_idCliente'];
            $dados['c_nome'] = $linha['c_nome'];
            $dados['c_cpf'] = $linha['c_cpf'];

        }
        //var_dump($dados);
        return $dados;
    

    
}

?>