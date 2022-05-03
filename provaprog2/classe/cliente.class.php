<?php
//cliente

class cliente{
    private $c_idCliente;
    private $c_nome;
    private $c_cpf;
    private $c_dt_nascimento;
    


    public function __construct($idcliente,$nome,$cpf,$dt_nascimento){
        $this->c_idCliente = $idcliente;
        $this->c_nome = $nome;
        $this->c_cpf = $cpf;
        $this->c_dt_nascimento = $dt_nascimento;
       
    }

    public function getidcliente(){  return $this->c_idCliente; }
    public function getnome(){  return $this->c_nome; }
    public function getcpf(){  return $this->c_cpf; }
    public function getdt_nascimento(){  return $this->c_dt_nascimento; }
   

    public function setidcliente($idcliente) { $this->c_idCliente = $idcliente; }
    public function setnome($nome) { $this->c_nome = $nome; }
    public function setcpf($cpf) { $this->c_cpf = $cpf; }
    public function setdt_nascimento($dt_nascimento) { $this->c_dt_nascimento = $dt_nascimento; }
    
    

    public function buscar($idcliente){

        require_once("conexao.php");
        $query .= 'SELECT * FROM cliente';
        $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE c_idcliente = :idcliente';
            $stmt->bindParam(':idcliente',$idivro);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    function excluir($c_idCliente){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM cliente WHERE c_idCliente = :c_idCliente');
        $stmt->bindParam(':c_idCliente', $c_idCliente);
        
        return $stmt->execute();
    }
    public function editar($c_idCliente){
            
        $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE cliente SET c_idCliente = :c_idCliente WHERE c_idCliente = :c_idCliente');
    $stmt->bindParam(':c_idCliente', $c_idCliente, PDO::PARAM_INT);
    $stmt->bindParam(':c_idCliente', $this->c_idCliente, PDO::PARAM_STR);
    



        return $stmt->execute();
        
    }

    public function __toString(){
        $str = "número do cliente: ".$this->c_idCliente.
        "<br>cliente: ".$this->c_nome;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO cliente (c_idCliente) VALUES(:c_idCliente)');
        $stmt->bindParam(':c_idCliente', $this->cc_numero, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }

    function lista_cliente($idcliente){
        $cliente = new cliente("","","","");
        $lista = $cliente->buscar($idcliente);
        return exibir_como_select(array('c_idCliente','c_nome'),$lista);
    }

}

?>