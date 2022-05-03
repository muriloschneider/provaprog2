<!DOCTYPE html>
<html lang="en">
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "classe/item_venda.class.php";
    $title = "livro";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
?>
<head>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>item_venda </title>

  
    </head>
    <body>
    <script>

function Soma(){

var n1 = parseInt(document.getElementById("n1").value);
var n2 = parseInt(document.getElementById("n2").value);
document.getElementById("res").innerHTML = "Resposta:" + (n1 + n2);
}


    </script>

    <fieldset>

  <?php  $pdo = Conexao::getInstance();
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM item_venda 
                                 WHERE iv_quantidade LIKE '$procurar%' 
                                 ORDER BY iv_quantidade");
}

if($procura=="1"){
    $consulta = $pdo->query("SELECT * FROM item_venda 
                             WHERE iv_quantidade LIKE '$procurar%' 
                             ORDER BY iv_quantidade");
}

if($procura=="2"){
    $consulta = $pdo->query("SELECT * FROM item_venda 
                             WHERE iv_valor_total_venda >= '$procurar%' 
                             ORDER BY iv_valor_total_venda");
}

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>
<button type="button" onclick="Soma()" >+</button> <br>
<tr><td><?php echo "quantidade:  ",  $linha['iv_quantidade'];?></td> <br>
<button type="button" onclick="Subtrai()" id='sub' > - </button> <br>
    <td><?php echo "valor total:   ", $linha['iv_valor_total_venda'];?></td>

  

    <script> function adicionarItem(){

var valor_total = parseInt(document.getElementById("valor_total").value);
var iv_quantidade = parseInt(document.getElementById("iv_quantidade").value);
document.getElementById("iv_quantidade").innerHTML = "iv_quantidade:" + 1;

}  </script> <br>


    
<?php } ?>
<br><br>
<a href="venda.php" > venda </a> <br><br>
<a href="cliente.php"> cliente </a><br><br>
<a href="livro.php" > livro </a><br><br>
<a href="autor.php" > autor </a><br><br>

</body>
</html>
