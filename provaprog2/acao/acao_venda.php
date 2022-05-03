<?php
//acao venda
    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    
    $acao_venda = isset($_GET['acao_venda']) ? $_GET['acao_venda'] : "";
    if ($acao_venda == "excluir"){
        $v_idVenda = isset($_GET['v_idVenda']) ? $_GET['v_idVenda'] : 0;
        require_once ("classe/venda.class.php");
        $venda = new venda("", "", "");
        $resultado = $venda->excluir($v_idVenda);
        header("location:venda.php");
    }

  
    $acao_venda = isset($_POST['acao_venda']) ? $_POST['acao_venda'] : "";
    if ($acao_venda == "salvar"){
        $v_idVenda = isset($_POST['v_idVenda']) ? $_POST['v_idVenda'] : "";
        if ($v_idVenda == 0){
            require_once ("classe/venda.class.php");

            $venda = new venda("", $_POST['v_idVenda'], $_POST['l_preco']);
            
            $resultado = $venda->inserir();
            header("location:venda.php");
        }
        else
        require_once ("classe/venda.class.php");

        $venda = new venda("", $_POST['v_idVenda'], $_POST['v_valor_total_venda']);
        
        $resultado = $venda->editar($v_idVenda);
        header("location:venda.php");

    }



//Consultar dados
    function buscarDados($v_idVenda){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM venda WHERE v_idVenda = $v_idVenda");
        $dados = array();
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $dados['v_idVenda'] = $linha['v_idVenda'];
            $dados['v_valor_total_venda'] = $linha['v_valor_total_venda'];
            $dados['v_desconto'] = $linha['v_desconto'];

        }
        //var_dump($dados);
        return $dados;
    

    
}

?>