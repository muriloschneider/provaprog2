<?php
//autor

class autor{
    private $a_idAutor;
    private $a_nome;
    private $a_sobrenome;
    
    


    public function __construct($idAutor,$nome,$sobrenome){
        $this->a_idAutor = $idAutor;
        $this->a_nome = $nome;
        $this->a_sobrenome = $sobrenome;
        
       
    }

    public function getidAutor(){  return $this->a_idAutor; }
    public function getnome(){  return $this->a_nome; }
    public function getsobrenome(){  return $this->a_sobrenome; }
  
   

    public function setidAutor($idAutor) { $this->a_idAutor = $idAutor; }
    public function setnome($nome) { $this->a_nome = $nome; }
    public function setsobrenome($sobrenome) { $this->a_sobrenome = $sobrenome; }
    
    
    

    public function buscar($idAutor){

        require_once("conexao.php");
        $query .= 'SELECT * FROM Autor';
        $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE a_idAutor = :idAutor';
            $stmt->bindParam(':idAutor',$idivro);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    function excluir($a_idAutor){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM Autor WHERE a_idAutor = :a_idAutor');
        $stmt->bindParam(':a_idAutor', $a_idAutor);
        
        return $stmt->execute();
    }
    public function editar($a_idAutor){
            
        $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE Autor SET a_idAutor = :a_idAutor WHERE a_idAutor = :a_idAutor');
    $stmt->bindParam(':a_idAutor', $a_idAutor, PDO::PARAM_INT);
    $stmt->bindParam(':a_idAutor', $this->a_idAutor, PDO::PARAM_STR);
    



        return $stmt->execute();
        
    }

    public function __toString(){
        $str = "número do Autor: ".$this->a_idAutor.
        "<br>Autor: ".$this->a_nome;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO Autor (a_idAutor) VALUES(:a_idAutor)');
        $stmt->bindParam(':a_idAutor', $this->a_idAutor, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }

}

?>