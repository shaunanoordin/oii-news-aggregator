<?php
/*
Top 10
------

Mini app for displaying top 10 stories. Reads from a file and writes to HTML.

--------------------------------------------------------------------------------
 */

//Development: Enable errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Config
$json = @file_get_contents('./news/files/top10.json');  //Use @ to suppress errors.

//If the JSON could not be found, try another place.
//On localhost, the file is relative to the home directory, where there router.php file is.
if (!$json) { $json = @file_get_contents('files/top10.json'); }

//Process input
if (!$json) {
  die();
}
$json = json_decode($json);

/*
--------------------------------------------------------------------------------
 */

function p($d) {
  echo htmlspecialchars($d);
}

function print_json($json) {
  $i = 1;
  for ($i = 1; $i <= 10; $i++) {
    $item = $json->{$i};
    if (!$item) continue;
    ?>
<li class="item">
  <div class="left">
    <a 
      href="<?php p($item->link) ?>"
      target="_blank"
      rel="noopener noreferrer"
    >
      <img src="<?php p($item->picture) ?>">
    </a>
    <div class="links">
      <a
        class="link-facebook"
        title="View Facebook post"
        href="<?php p("https://facebook.com/" . $item->post_id) ?>"
        target="_blank"
        rel="noopener noreferrer"
      >
        <img src="./top10-logo-facebook.png">
      </a>
      <a
        class="link-website"
        title="View original article"
        href="<?php p($item->link) ?>"
        target="_blank"
        rel="noopener noreferrer"
      >
        🌐
      </a>
    </div>
  </div>
  <div class="right">
    <div class="header">
      <span class="publisher"><?php p($item->publisher_name) ?></span>
      <span class="time"><?php p($item->created_time) ?></span>
    </div>
    <div class="message">
      <?php p($item->message) ?>
    </div>
    <div class="reactions">
      <div class="row">
        <span class="reaction">
          <span class="key">🔃</span>
          <span class="value"><?php p($item->shares) ?></span>
        </span>
        <span class="reaction">
          <span class="key">💬</span>
          <span class="value"><?php p($item->comments) ?></span>
        </span>
        <span class="reaction">
          <span class="key">👍</span>
          <span class="value"><?php p($item->likes) ?></span>
        </span>
        <span class="reaction">
          <span class="key">❤️</span>
          <span class="value"><?php p($item->LOVEs) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😄</span>
          <span class="value"><?php p($item->HAHAs) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😲</span>
          <span class="value"><?php p($item->WOWs) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😟</span>
          <span class="value"><?php p($item->SADs) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😡</span>
          <span class="value"><?php p($item->ANGRYs) ?></span>
        </span>
        <span class="reaction">
          <span class="key">All</span>
          <span class="value"><?php p($item->totalEngs) ?></span>
        </span>
      </div>
      <div class="row">
        <label>Weighted:</label>
        <span class="reaction">
          <span class="key">🔃</span>
          <span class="value"><?php p($item->w_numSHARES) ?></span>
        </span>
        <span class="reaction">
          <span class="key">💬</span>
          <span class="value"><?php p($item->w_numCOMMENTS) ?></span>
        </span>
        <span class="reaction">
          <span class="key">👍</span>
          <span class="value"><?php p($item->w_numLIKE) ?></span>
        </span>
        <span class="reaction">
          <span class="key">❤️</span>
          <span class="value"><?php p($item->w_numLOVE) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😄</span>
          <span class="value"><?php p($item->w_numHAHA) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😲</span>
          <span class="value"><?php p($item->w_numWOW) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😟</span>
          <span class="value"><?php p($item->w_numSAD) ?></span>
        </span>
        <span class="reaction">
          <span class="key">😡</span>
          <span class="value"><?php p($item->w_numANGRY) ?></span>
        </span>
        <span class="reaction">
          <span class="key">All</span>
          <span class="value"><?php p($item->w_totalEngs) ?></span>
        </span>
      </div>
    </div>
  </div>
</li>

    <?php
  }
  echo "\n";
}

/*
--------------------------------------------------------------------------------
 */
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>News Aggregator</title>
<script src="https://cdn.polyfill.io/v2/polyfill.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<style>
/*  App Theme
 */
/*  Basic Styles
 */
* {
  box-sizing: border-box;
}
:root {
  font-family: "Roboto", sans-serif;
  font-size: 16px;
  background: #fff;
  color: #333;
}
html,
body {
  padding: 0;
  margin: 0;
  width: 100%;
  height: 100%;
}
a {
  color: inherit;
  text-decoration: none;
}
select {
  font-family: inherit;
  font-size: inherit;
}
/* App Style: Main Layout
 */
#app {
  display: flex;
  flex-direction: column;
  width: 100%;
  height: 100%;
  max-width: 50rem;
  margin: 0 auto;
  background: #fff;
}
#app > header {
  flex: 0 0 auto;
}
#app > header .title {
  color: #369;
  display: block;
  text-align: center;
}
#app > header .title h1 {
  font-size: 1.25em;
  margin: 0;
  padding: 0.5em;
}
#app > header nav {
  background: #369;
  color: #fff;
  font-size: 0.75em;
  text-transform: uppercase;
}
#app > header nav a {
  display: block;
}
#app > header nav a:hover {
  background: #3cf;
}
#app > header nav ul {
  display: flex;
  flex-direction: row;
  justify-content: center;
  list-style: none;
  margin: 0;
  padding: 0;
}
@media (max-width: 800px) {
  #app > header nav ul {
    flex-direction: column;
  }
}
#app > header nav ul li {
  flex: 0 0 auto;
  margin: 0;
  min-width: 8em;
  line-height: 3em;
  padding: 0;
  text-align: center;
}
#app > footer {
  flex: 0 0 auto;
  background: #369;
  color: #fff;
  padding: 0.1em 0.5em;
  text-align: right;
}
#app > main {
  background: #fff;
  flex: 1 1 auto;
}
/*  Page Style: Home Page (List-type)
 */
#app > main.home-page {
  display: flex;
  flex-direction: column;
}
#app > main.home-page .filter-panel {
  background: #ccc;
}
#app > main.home-page .filter-panel .row {
  display: flex;
  flex: 0 0 auto;
  flex-direction: row;
  justify-content: center;
  padding: 0.25em 1em;
}
@media (max-width: 800px) {
  #app > main.home-page .filter-panel .row {
    flex-direction: column;
  }
}
#app > main.home-page .filter-panel .row > span {
  flex: 0 0 auto;
  line-height: 2em;
}
#app > main.home-page .filter-panel .row > input,
#app > main.home-page .filter-panel .row > button,
#app > main.home-page .filter-panel .row > select {
  flex: 0 0 auto;
  margin: 0 0.5em;
}
@media (max-width: 800px) {
  #app > main.home-page .filter-panel .row > input,
  #app > main.home-page .filter-panel .row > button,
  #app > main.home-page .filter-panel .row > select {
    min-height: 2.5em;
    margin: 0;
  }
}
#app > main.home-page .sort-panel {
  color: #999;
}
#app > main.home-page .sort-panel .row {
  display: flex;
  flex: 0 0 auto;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
  padding: 0.25em 1em;
}
#app > main.home-page .sort-panel .row > label {
  display: inline-block;
  padding: 0.5em;
  line-height: 1em;
}
#app > main.home-page .sort-panel .row > span {
  display: inline-block;
}
@media (max-width: 800px) {
  #app > main.home-page .sort-panel .row > span {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
  }
}
#app > main.home-page .sort-panel .row > span a {
  display: inline-block;
  padding: 0.5em;
  line-height: 1em;
  border-right: 1px solid #999;
}
#app > main.home-page .sort-panel .row > span a:last-child {
  border-right: none;
}
#app > main.home-page .list {
  box-shadow: inset 0 -0.2em 1em #999;
  flex: 1 1 auto;
  list-style: none;
  margin: 0;
  overflow: auto;
  padding: 0;
}
#app > main.home-page .list .info {
  background: #369;
  color: #fff;
  padding: 2em;
  text-align: center;
}
#app > main.home-page .list .info.error {
  background: #c33;
}
#app > main.home-page .list .item {
  align-items: flex-start;
  border: 1px solid #369;
  display: flex;
  margin: 0.5em;
  overflow: auto;
}
#app > main.home-page .list .item .left {
  display: block;
  flex: 0 0 auto;
  width: 10em;
  margin: 0.5em;
}
#app > main.home-page .list .item .left .photo {
  background: #999;
  width: 100%;
}
#app > main.home-page .list .item .left .photo img {
  width: 100%;
  display: block;
}
#app > main.home-page .list .item .left .links {
  display: flex;
  flex-direction: row;
  align-items: center;
}
#app > main.home-page .list .item .left .links .link-facebook {
  display: inline-block;
  padding: 0.25em;
}
#app > main.home-page .list .item .left .links .link-facebook img {
  width: 1em;
  display: block;
}
#app > main.home-page .list .item .left .links .link-website {
  display: inline-block;
  font-size: 1em;
  padding: 0.25em;
}
#app > main.home-page .list .item .right {
  color: #333;
  flex: 1 1 auto;
  margin: 0.5em;
}
#app > main.home-page .list .item .right .header {
  align-items: center;
  display: flex;
  margin-bottom: 1em;
}
#app > main.home-page .list .item .right .header .publisher {
  flex: 1 1 auto;
  font-size: 1.1em;
  font-weight: bold;
}
#app > main.home-page .list .item .right .header .time {
  color: #999;
  cursor: pointer;
  flex: 0 0 auto;
  font-size: 0.8em;
}
#app > main.home-page .list .item .right .message {
  line-height: 1.5em;
  margin-bottom: 1em;
}
#app > main.home-page .list .item .right .reactions .row {
  display: flex;
  flex-wrap: wrap;
  font-size: 0.8em;
  justify-content: flex-end;
  line-height: 2em;
}
#app > main.home-page .list .item .right .reactions .row label {
  color: #ccc;
  margin: 0.25em 0.5em;
}
#app > main.home-page .list .item .right .reactions .row .reaction {
  flex: 0 0 auto;
  margin: 0.25em 0.5em;
  cursor: help;
}
#app > main.home-page .list .item .right .reactions .row .reaction .key {
  color: #ccc;
  margin: 0 0.05em;
}
#app > main.home-page .list .item .right .reactions .row .reaction .value {
  color: #999;
  margin: 0 0.05em;
}
/*  Page Style: About Page, Contact Page (Info-type)
 */
#app > main.about-page,
#app > main.contact-page {
  padding: 1em 2em;
}
#app > main.about-page a,
#app > main.contact-page a {
  color: #369;
}
#app > main.about-page a:hover,
#app > main.contact-page a:hover {
  color: #3cf;
}

</style>
</head>
<body>
<div id="app" class="top10-app">
<header>
  <a class="title" href="./">
    <h1>
      News Aggregator
    </h1>
  </a>
</header>
<main class="home-page">
  <ul id="list" class="list">
    <?php print_json($json) ?>
  </ul>
</main>
</div><!--/#app-->
</body>
</html>
