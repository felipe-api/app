<?php
/*
* Como usar o Debug
*
 try {
  //call the function above here
  } catch (Exception $e) {
      $data['error'] = $e;
      $this->load->view('exception', $data);
  }
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<body>
    <div>
        <?php echo $error ?>
    </div>
</body>
</html>