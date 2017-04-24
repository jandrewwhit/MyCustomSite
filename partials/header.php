<header class="">
<div class="container-override">
<nav class="navbar navbar-toggleable-sm navbar navbar-inverse bg-inverse">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="home">LOGO</a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!--<li class="nav-item">
        <a class="nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
      </li>-->
      <li class="nav-item">
        <a class="nav-link" href="popular">Popular</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="top-rated">Top Rated</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="upcoming">Upcoming</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="now-playing">Now Playing</a>
      </li>
    </ul>
    <form class="form-inline" method="get" action="../?s=">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" name="s" value="">
      <span class="error"><?php echo $searchErr;?></span>
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
</div>
</header>
