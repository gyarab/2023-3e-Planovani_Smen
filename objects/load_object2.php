<?php

/** Recursion function - main purpose of this function is to look for objects in the sub hierarchie*/
function sub_object($searching, $dat2, $dat3, $counter, $nms)
{
  $find = 0;
  for ($i = 0; $i < count($dat2); $i++) {
    if ($searching == $dat3[$i]) {
      if ($find == 0) {
        $find = 1;
        ?>
        <ul>

          <hr>
          <?php
      }
      ?>
        <li>
          <a href="#"><?php echo $dat2[$i]; ?></a>
          <?php
          $co = $counter + 1;

          $sea = $dat2[$i];
          if ($sea != null) {
            sub_object($sea, $dat2, $dat3, $co, $nms);

          } else {
            /**end of chain */
            ?>
          </li>

          <?php
          break;
          }
    }
  }
  ?>

  </ul>
  </li>



  <?php
}
/**End of the printing process for object hierarchie */
?>