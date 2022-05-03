<?php
//livro

class livro{
    private $la_l_idLivro;
    private $la_l_idAutor;
    


    public function __construct($la_idLivro,$la_idAutor){
        $this->la_l_idLivro = $la_idLivro;
        $this->la_l_idAutor = $la_idAutor;
       
    }

    public function getla_idLivro(){  return $this->la_idLivro; }
    public function getla_idAutor(){  return $this->la_idAutor; }
   

    public function setla_idlivro($la_idLivro) { $this->la_l_idLivro = $la_idLivro; }
    public function setla_idAutor($la_idAutor) { $this->la_l_idAutor = $la_idAutor; }
    
    

    public function buscar($idlivro){

        require_once("conexao.php");
        $query .= 'SELECT * FROM livro_autor';
        $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE la_l_idLivro = :la_idLivro';
            $stmt->bindParam(':la_idLivro',$la_idivro);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    function excluir($la_l_idLivro){
        $pdo = Conexao::getInstance();
        $stmt = $pdo ->prepare('DELETE FROM livro WHERE la_l_idLivro = :la_l_idLivro');
        $stmt->bindParam(':la_l_idLivro', $la_l_idLivro);
        
        return $stmt->execute();
    }
    public function editar($la_l_idLivro){
            
        $pdo = Conexao::getInstance();
    $stmt = $pdo->prepare('UPDATE livro SET la_l_idLivro = :la_l_idLivro, pf_id = :pf_id WHERE la_l_idLivro = :la_l_idLivro');
    $stmt->bindParam(':la_l_idLivro', $la_l_idLivro, PDO::PARAM_INT);
    $stmt->bindParam(':la_l_idLivro', $this->la_l_idLivro, PDO::PARAM_STR);
    



        return $stmt->execute();
        
    }

    public function __toString(){
        $str = "id do livro: ".$this->la_l_idLivro.
        "<br>id do autor: ".$this->la_a_idAutor;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO livro_autor (la_l_idLivro, la_a_idAutor) VALUES(:l_idLivro :la_a_idAutor)');
        $stmt->bindParam(':la_l_idLivro', $this->la_l_idLivro, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }

}








?>