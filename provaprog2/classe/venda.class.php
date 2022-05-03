<?php
//venda

class venda{
    private $v_idVenda;
    private $v_valor_total_venda;
    private $v_desconto;
    private $v_c_idcliente;


    public function __construct($idvenda,$valor_total,$desconto,$v_idcliente){
        $this->v_idVenda = $idvenda;
        $this->v_valor_total_venda = $valor_total;
        $this->v_desconto = $desconto;
        $this->v_c_idcliente = $v_idcliente;
       
    }

    public function getidvenda(){  return $this->v_idVenda; }
    public function getvalor_total(){  return $this->v_valor_total_venda; }
    public function getdesconto(){  return $this->v_desconto; }
    public function getv_idcliente(){  return $this->v_c_idcliente; }
    

    public function setidvenda($idvenda) { $this->v_idVenda = $idvenda; }
    public function setvalor_total($valor_total) { $this->v_valor_total_venda = $valor_total; }
    public function setdesconto($desconto) { $this->v_desconto = $desconto; }
    public function setv_idcliente($v_idcliente) { $this->v_c_idcliente = $v_idcliente; }
    
    

    public function buscar($idvenda){

        require_once("conexao.php");
        $query .= 'SELECT * FROM venda';
        $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE v_idVenda = :idvenda';
            $stmt->bindParam(':idvenda',$idvenda);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    function excluir($v_idVenda){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM venda WHERE v_idVenda = :v_idVenda');
        $stmt->bindParam(':v_idVenda', $v_idVenda);
        
        return $stmt->execute();
    }
    public function editar($v_idVenda){
            
        $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE venda SET v_idVenda = :v_idVenda, v_c_idcliente = :v_idcliente WHERE v_idVenda = :v_idVenda');
    $stmt->bindParam(':v_idVenda', $v_idVenda, PDO::PARAM_INT);
    $stmt->bindParam(':v_idVenda', $this->v_idVenda, PDO::PARAM_STR);
    $stmt->bindParam(':v_idcliente', $this->v_idcliente, PDO::PARAM_STR);



        return $stmt->execute();
        
    }

    public function __toString(){
        $str = "número da venda: ".$this->v_idVenda.
        "<br>valor: ".$this->valor_total;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO venda (v_idVenda) VALUES(:v_idVenda)');
        $stmt->bindParam(':v_idVenda', $this->v_idVenda, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }
    function listar_venda($v_idVenda){
        try{
    
        $venda = new venda("","","","");
        }catch(Exception $e){
            echo "Erro: ".$e->getMessage();
        }
        $lista = $venda->buscar($id);
        return exibir_como_select(array('v_idVenda','v_idVenda'),$lista);
    }
    


}








?>