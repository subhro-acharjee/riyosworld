

<div class="card" onclick="shop('<?php echo $id;?>');">
  <img src="<?php echo $link; ?>" alt="" class="card-image-top" width=100% >
  <div class="card-header bg-primary">
    <h2 class="card-title"><?php echo $name; ?></h2>
  </div>
  <div class="card-body">
    <h4>Price: <?php echo $cost;?></h4>

    <h6>Description:<?php echo $desc; ?></h6>
  </div>
</div>
