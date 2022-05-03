<?php
//item _venda
class item_venda{
    private $iv_v_idVenda;
    private $iv_l_idLivro;
    private $iv_quantidade;
    private $iv_valor_total_item;
    private $iv_data_venda;

    public function __construct($iv_idvenda, $iv_idlivro, $quantidade, $iv_valor, $iv_data ){ 
        $this->iv_v_idVenda = $iv_idvenda;
        $this->iv_l_idLivro = $iv_idlivro;
        $this->iv_quantidade = $quantidade;
        $this->iv_valor_total_item = $iv_valor;
        $this->iv_data_venda = $iv_data;
    }


    public function getiv_idvenda(){  return $this->iv_v_idVenda; }
    public function getiv_idlivro(){  return $this->iv_l_idLivro; }
    public function getquantidade(){  return $this->iv_quantidade; }
    public function getiv_valor(){  return $this->iv_valor_total_item; }
    public function getiv_data(){  return $this->iv_data_venda; }

    public function setId($iv_idvenda) { $this->iv_v_idVenda = $iv_idvenda; }
    public function setiv_idlivro($iv_idlivro) { $this->iv_l_idLivro = $iv_idlivro; }
    public function setNome($iv_quantidade) { $this->quantidade = $iv_quantidade; }
    public function setiv_valor($iv_valor) { $this->iv_valor_total_item = $iv_valor; }
    public function setiv_data($iv_data) { $this->iv_data_venda = $iv_data; }
    

    public function buscar($iv_idlivro){

        require_once("conexao.php");
        $query .= 'SELECT * FROM item_venda';
       $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE iv_l_idLivro = :iv_idlivro';
            $stmt->bindParam(':iv_idlivro',$iv_idlivro);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    function excluir($iv_idlivro){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM item_venda WHERE iv_v_idVenda,iv_l_idLivro = :iv_l_idLivro, :iv_v_idVenda');
        $stmt->bindParam(':iv_v_idVenda, :iv_l_idLivro', $iv_l_idLivro, $iv_v_idVenda);
        
        return $stmt->execute();
    }
    public function editar($iv_idlivro){
            
        $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE item_venda SET iv_l_idLivro = :iv_idlivro, iv_v_idVenda = :iv_idvenda WHERE l_idlivro = :l_idlivro');
    $stmt->bindParam(':iv_l_idLivro', $iv_l_idLivro, PDO::PARAM_INT);
    $stmt->bindParam(':iv_l_idLivro', $this->iv_l_idLivro, PDO::PARAM_STR);
    $stmt->bindParam(':v_idvenda', $this->v_idvenda, PDO::PARAM_STR);



        return $stmt->execute();
        
    }

    public function __toString(){
        $str = "número do livro: ".$this->l_idlivro.
        "<br>quantidade vendida: ".$this->iv_quantidade;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO item_venda (iv_l_idLivro) VALUES(:iv_l_idLivro)');
        $stmt->bindParam(':l_idlivro', $this->l_idlivro, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }

  


}








?>