<!DOCTYPE html>
<?php 

$procurar = isset($_POST["procurar"]) ? $_POST["procurar"] : ""; 
   $procura = isset($_POST["procura"]) ? $_POST["procura"] : "";

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";
    require_once "classe/cliente.class.php";
    $title = "item venda";
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : "2";
    $procurar = isset($_POST['procurar']) ? $_POST['procurar'] : "";
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title>
    
    <script>
        function excluirRegistro(url){
            if (confirm("Confirma Exclusão?"))
                location.href = url;
        }
    </script>
</head>
<body>

<script> function adicionarItem(){

var valor_total = parseInt(document.getElementById("valor_total").value);
var iv_quantidade = parseInt(document.getElementById("iv_quantidade").value);
document.getElementById("iv_quantidade").innerHTML = "iv_quantidade:" + 1;

} 

</script>

<br>
<h2 class="text-dark">item venda</h2>
</br>
<form method="post">
<h3 ><input type="radio"  name="tipo" id="tipo" value="1" <?php if ($tipo == 1) { echo "checked"; }?>>quantidade</h3><br>
    <h3><input  type="radio"  name="tipo" id="tipo" value="2" <?php if ($tipo == 2) { echo "checked"; }?>>data de venda</h3><br>
  
   <input type="text"   name="procurar" id="procurar"  value="<?php echo $procurar;?>">
    <input type="submit" class="btn btn-dark"  value="Consultar">
</form>
<br>

<table class="table table-dark table-striped">
    <tr><th>ID venda</th>
<th>ID livro</th>
        <th>quantidade</th> 
        <th>valor total</th>
       
         

    </tr>

<?php
$pdo = Conexao::getInstance();
    
    if($procura==""){
        $consulta = $pdo->query("SELECT * FROM item_venda 
                                 WHERE iv_quantidade LIKE '$procurar%' 
                                 ORDER BY iv_quantidade");
}

else if($procura=="pro2"){
    $consulta = $pdo->query("SELECT * FROM item_venda 
                             WHERE iv_data_venda LIKE '$procurar%' 
                             ORDER BY iv_data_venda");
}

else if($procura=="pro1"){
    $consulta = $pdo->query("SELECT * FROM item_venda 
                             WHERE iv_quantidade = '$procurar%' 
                             ORDER BY iv_quantidade");
}




    
while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    ?>

    <tr><td><?php echo $linha['iv_v_idVenda'];?></td>
    <td><?php echo $linha['iv_l_idLivro'];?></td>
    <button type="button" onclick="Soma()" >+</button>
    <td><?php echo $linha['iv_quantidade'];?></td>
    <button type="button" onclick="Subtrai()" id='sub' > - </button> <br>
    <td><?php echo $linha['iv_valor_total_item'];?></td>
    
   <!-- <td><a href='livro.php?acao_cliente.php=editar&c_idcliente=<?php echo $linha['c_idCliente'];?>'>editar</a></td>
    <td><a href="javascript:excluirRegistro('cliente.php?acao_cliente.php=excluir&c_idCliente=<?php echo $linha['c_idCliente'];?>')">xxxx</a></td>
-->    </tr>

<?php } ?>
</table>    

<br><br><br><br>

<a href="venda.php" > venda </a> <br>
<a href="item_venda.php"> item venda </a><br>
<a href="livro.php" > livro </a><br>
<a href="autor.php" > autor </a><br>
</body>
</html>



