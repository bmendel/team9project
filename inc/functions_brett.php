<?php
  session_start();
  
  function displayGenres() {
    global $dbConn;
    $sql = "SELECT DISTINCT bb_genre FROM blockbuster";
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($records as $record) {
      echo "<option value='".$record['bb_genre']."'>".$record['bb_genre']."</option>";
    }
  }
  
  function getResults() {
    global $dbConn;
    if(!isset($_POST['submit'])) return;
    
    $title = $_POST['title'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];
    $yearMin = $_POST['yearMin'];
    $yearMax = $_POST['yearMax'];
    $timeMin = $_POST['timeMin'];
    $timeMax = $_POST['timeMax'];
    $genreSort = $_POST['genreSort'];
    $order = $_POST['order'];
    
    $np = array();
    $sql = "SELECT * FROM blockbuster WHERE 1";
    
    if(!empty($_POST['title'])) {
      $sql .= " AND bb_title LIKE :title";
      $np[':title'] = "%$title%";
    }
    
    if(!empty($_POST['director'])) {
      $sql .= " AND bb_director LIKE :director";
      $np[':director'] = "%$director%";
    }
    
    if(!empty($_POST['genre'])) {
      $sql .= " AND bb_genre = :genre";
      $np[':genre'] = $genre;
    }
    
    if(!empty($_POST['yearMin']) || !empty($_POST['yearMax'])) {
      if(!empty($_POST['yearMin']) && !empty($_POST['yearMax'])) {
        $sql .= " AND bb_year BETWEEN :yearMin AND :yearMax";
        $np[':yearMin'] = $yearMin;
        $np[':yearMax'] = $yearMax;
      } else if(!empty($_POST['yearMin'])) {
        $sql .= " AND bb_year >= :yearMin";
        $np[':yearMin'] = $yearMin;
      } else {
        $sql .= " AND bb_year <= :yearMax";
        $np[':yearMax'] = $yearMax;
      }
    }
    
    if(!empty($_POST['timeMin']) || !empty($_POST['timeMax'])) {
      if(!empty($_POST['timeMin']) && !empty($_POST['timeMax'])) {
        $sql .= " AND bb_runtime BETWEEN :timeMin AND :timeMax";
        $np[':timeMin'] = $timeMin;
        $np[':timeMax'] = $timeMax;
      } else if(!empty($_POST['timeMin'])) {
        $sql .= " AND bb_runtime >= :timeMin";
        $np[':timeMin'] = $timeMin;
      } else {
        $sql .= " AND bb_runtime <= :timeMax";
        $np[':timeMax'] = $timeMax;
      }
    }
    
    if (!empty($_POST['genreSort'])) {
      $sql .= " ORDER BY " . $genreSort;
      switch ($order) {
        case "asc":
          $sql .= " ASC";
          break;
        case "desc":
          $sql .= " DESC";
          break;
      }
    }
    
    $stmt = $dbConn->prepare($sql);
    $stmt->execute($np);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $records;
  }
?>