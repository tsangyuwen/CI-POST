<?php include("_header.php"); ?>
<?php include("_nav.php"); ?>

<div class="content">

  <div class="container">

    <h1> <?= $user->Account ?></h1>
    
    <form action="<?=site_url("text/posting")?>" method="post" > 
      <?php if(isset($errorMessage)){ ?>
        <div class="alert alert-error"><?=$errorMessage?></div>
      <?php } ?>

      <div class="form-group">
        標題
        <?php if(isset($title)){ ?>
          <td><input class="input-style" type="text" name="title" 
            value="<?=htmlspecialchars($title)?>" /></td>
        <?php }else{ ?>
          <td><input class="input-style" type="text" name="title" /></td>
        <?php } ?>
      </div>

      <div class="form-group">
        內容
        <textarea placeholder="leave content" rows="5" cols="60" name="content" class="form-control input-style"></textarea>
      </div>

      <input type="submit" class="btn btn-primary" value="送出" />
    </form>

    <br><br>

    <?php foreach($results as $post){ ?>
      <a href="<?= site_url("text/view/".$post->TextID) ?>">
      <table class="table table-bordered">
        <tr>
          <td width="50px">標題</td>
          <td>
            <?= htmlspecialchars($post->Title) ?>
          </td>
        </tr>
        <tr>
          <td> 內容 </td>
          <td><?= nl2br(htmlspecialchars($post->Content)) ?></td>
        </tr>
      </table>
      </a>
    <?php } ?>

  </div>

</div>