<?php
   $produtos = ["Produto A", "Produto B", "Playstation"];
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
