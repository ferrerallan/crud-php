<?php
   $produtos = ["Produto A", "Produto B", "Produto C"];
?>
<html>
<body>
   <ul>
   <?php foreach ($produtos as $produto): ?>
      <li><?php echo $produto; ?></li>
   <?php endforeach; ?>
   </ul>
</body>
</html>
