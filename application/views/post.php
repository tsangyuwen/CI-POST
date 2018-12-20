<?php include("_header.php"); ?>
<?php include("_nav.php"); ?>
<div class="content">
  <div class="container">
    <?php foreach($results as $post){ ?>
      <a href="<?=site_url("text/view/".$post->TextID)?>">
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
      </a>
    <?php } ?>
  </div>
</div>