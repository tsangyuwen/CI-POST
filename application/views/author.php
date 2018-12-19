<?php include("_header.php"); ?>
<?php include("_nav.php"); ?>

<div class="content">

  <h1> <?=$user->Account ?></h1>

  <?php foreach($results as $article){ ?>
    <table class="table table-bordered">
      <tr>
        <td width="50px">標題</td>
        <td>
          <a href="<?=site_url("article/view/".$article->ArticleID)?>">
          <?=htmlspecialchars($article->Title)?></a>
        </td>
      </tr>
      <tr>
        <td> 內容 </td>
        <td><?=nl2br(htmlspecialchars($article->Content))?></td>
      </tr>
  </table>
  <?php } ?>

</div>