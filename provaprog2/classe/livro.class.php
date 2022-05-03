<?php
//livro

class livro{
    private $l_idLivro;
    private $l_titulo;
    private $l_ano_publicacao;
    private $l_isdn;
    private $l_preco;


    public function __construct($idlivro,$titulo,$ano,$isdn, $preco){
        $this->l_idLivro = $idlivro;
        $this->l_titulo = $titulo;
        $this->l_ano_publicacao = $ano;
        $this->l_isdn = $isdn;
        $this->l_preco = $preco;
    }

    public function getidlivro(){  return $this->l_idLivro; }
    public function gettitulo(){  return $this->l_titulo; }
    public function getano(){  return $this->l_ano_publicacao; }
    public function getisdn(){  return $this->l_isdn; }
    public function getpreco(){  return $this->l_preco; }

    public function setidlivro($idlivro) { $this->l_idLivro = $idlivro; }
    public function settitulo($titulo) { $this->l_titulo = $titulo; }
    public function setano($ano) { $this->l_ano_publicacao = $ano; }
    public function setisdn($isdn) { $this->l_isdn = $isdn; }
    public function setpreco($preco) { $this->l_preco = $preco; }
    

    public function buscar($idlivro){

        require_once("conexao.php");
        $query .= 'SELECT * FROM livro';
        $conexao = Conexao::getInstance();
        if($id > 0){
            $query = $query . ' WHERE l_idLivro = :idLivro';
            $stmt->bindParam(':idLivro',$idivro);
        }

        $stmt = $conexao->prepare($query);
        if ($stmt->execute())
            return $stmt->fetchAll();
        
        return false; 
    }

    

    public function __toString(){
        $str = "número do livro: ".$this->l_idLivro.
        "<br>livro: ".$this->l_titulo;
        return $str;
    }

    public function inserir(){
        
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('INSERT INTO livro (l_idLivro) VALUES(:l_idLivro)');
        $stmt->bindParam(':l_idLivro', $this->l_idLivro, PDO::PARAM_STR);
        

        return $stmt->execute();
        
    }


    function lista_livro($idlivro){
        $livro = new livro("","","","");
        $lista = $livro->buscar($idliro);
        return exibir_como_select(array('l_idlivro','l_titulo'),$lista);
    }


}








?>