<?php include("_header.php"); ?>
<?php include("_nav.php"); ?>

<div class="container">
  <form action="<?=site_url("/user/registering")?>" method="post"  >
    <?php  if (isset($errorMessage)){?>
      <div class="alert alert-error">
        <?=$errorMessage?>
      </div>
    <?php }?>

    <table class="table table-bordered">
      <tr>
        <td>Account</td>
        <td>
          <?php if(isset($account)){ ?>
            <input type="text" name="account" value="<?=htmlspecialchars($account)?>" />
          <?php }else{ ?>
            <input type="text" name="account" />
          <?php } ?>
        </td>
      </tr>

      <tr>
        <td>Password</td>
        <td>
          <input type="password" name="password" />
        </td>
      </tr>

      <tr>
        <td>Re-type Password</td>
        <td>
          <input type="password" name="passwordrt" />
        </td>
      </tr>

    </table>

    <input class="btn btn-primary" type="submit" value="送出" />

  </form>
</div>