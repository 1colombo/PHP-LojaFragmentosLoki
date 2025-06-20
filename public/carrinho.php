<?php
session_start();

$carrinho = $_SESSION['carrinho'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Carrinho</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="container py-5">
  <h1 class="mb-4">Seu Carrinho</h1>

  <?php if (empty($carrinho)): ?>
    <p>O carrinho está vazio.</p>
  <?php else: ?>
    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th>Produto</th>
          <th>Preço</th>
          <th>Quantidade</th>
          <th>Subtotal</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($carrinho as $id => $item): 
          $subtotal = $item['preco'] * $item['quantidade'];
          $total += $subtotal;
        ?>
        <tr>
          <td><?= htmlspecialchars($item['nome']) ?></td>
          <td>R$ <?= number_format($item['preco'], 2, ',', '.') ?></td>
          <td><?= $item['quantidade'] ?></td>
          <td>R$ <?= number_format($subtotal, 2, ',', '.') ?></td>
          <td><a href="remover_item.php?id=<?= $id ?>" class="btn btn-sm btn-danger">Remover</a></td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <td colspan="3" class="text-end"><strong>Total:</strong></td>
          <td colspan="2"><strong>R$ <?= number_format($total, 2, ',', '.') ?></strong></td>
        </tr>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="index.php" class="btn btn-light mt-3">Continuar Comprando</a>
</div>
</body>
</html>
