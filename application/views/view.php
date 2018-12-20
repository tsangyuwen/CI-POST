<?php include("_header.php"); ?>
<?php include("_nav.php"); ?>
<div class="content">
  <div class="container">
    <table class="table table-bordered">
      <tr>
        <td width="50px">標題</td>
        <td>
          <?=htmlspecialchars($post->Title)?>
        </td>
      </tr>

      <tr>
        <td> 內容 </td>
        <td><?=nl2br(htmlspecialchars($post->Content))?></td>
      </tr>

      <tr>
        <td> 作者 </td>
        <td><?=nl2br(htmlspecialchars($post->Account))?></td>
      </tr>
    </table>
    <br><br>

    <form action="<?=site_url("text/commenting/".$post->TextID)?>" method="post" > 
      <?php if(isset($errorMessage)){ ?>
        <div class="alert alert-error"><?=$errorMessage?></div>
      <?php } ?>

      <div class="form-group">
        回復
        <textarea placeholder="leave comment" rows="5" cols="60" name="comment" class="form-control input-style"></textarea>
      </div>

      <input type="submit" class="btn btn-primary" value="送出" />
    </form>

    <br><br>

    <?php foreach($comments as $comment){ ?>
      <table class="table table-bordered">
        <tr>
          <td width="50px">作者</td>
          <td>
            <?= htmlspecialchars($comment->Account) ?>
          </td>
        </tr>
        <tr>
          <td> 內容 </td>
          <td><?= nl2br(htmlspecialchars($comment->Comment)) ?></td>
        </tr>
      </table>
    <?php } ?>

  </div>
</div>