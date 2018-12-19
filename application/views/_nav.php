<div class="content-header">
  <div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <a class="brand" href="<?=site_url("/")?>">POST</a>
      <ul class="nav">
        <li><a href="#">Home</a></li>
        <li><a href="<?=site_url("text/author")?>">My Post</a></li>
      </ul>
      <!-- login status -->
      <?php if(isset($_SESSION["user"]) && $_SESSION["user"] != null){ ?>
        <ul class="nav pull-right">
          <li><a href="#">Hi <?= $_SESSION["user"]->Account ?></a></li>
          <li class="divider-vertical"></li>
          <li><a href="<?=site_url("text/post")?>">發文</a></li>
          <li><a href="<?= site_url("user/logout") ?>">登出</a></li>
        </ul>
      <?php }else{ ?>
        <ul class="nav pull-right">
          <li><a href="<?= site_url("user/login") ?>">登入</a></li>
          <li class="divider-vertical"></li>
          <li><a href="<?= site_url("user/register") ?>">註冊</a></li>
        </ul>
      <?php } ?>
    </div>
  </div>
</div>