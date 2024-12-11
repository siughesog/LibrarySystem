<?php
	include("../function/condb.php");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>圖書館管理系統</title>
  <style>
    body {
        margin: 0;
        font-family: '微軟正黑體', sans-serif;
        background-color: #f1f1f1;
    }

    .menu {
        position: fixed;
        width: 100%;
        height: 60px;
        background-color: #1a5f7a;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 20px;
        z-index: 1000;
    }

    .nav-links {
        display: flex;
        gap: 20px;
    }

    .menu a {
        color: white;
        text-decoration: none;
        font-weight: 500;
        font-size: 16px;
        padding: 8px 16px;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .menu a:hover {
        background-color: rgba(255,255,255,0.1);
    }

    .search-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .search-container input[type="text"] {
        padding: 8px 12px;
        border: none;
        border-radius: 4px;
        width: 200px;
        font-size: 14px;
    }

    .search-container input[type="submit"] {
        padding: 8px 16px;
        background-color: white;
        color: #1a5f7a;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
    }

    .search-container input[type="submit"]:hover {
        background-color: #f0f0f0;
    }

    .content {
        padding-top: 80px;
        margin: 0 auto;
        max-width: 1200px;
        min-height: calc(100vh - 80px);
    }

    .stats-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .table {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        padding: 12px;
        font-weight: 600;
    }

    .table tbody td {
        padding: 12px;
        border-bottom: 1px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    @media (max-width: 768px) {
        .menu {
            flex-direction: column;
            height: auto;
            padding: 10px;
        }

        .nav-links {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }

        .search-container {
            width: 100%;
            margin-top: 10px;
        }

        .content {
            padding: 80px 20px 20px;
        }
    }
  </style>
  <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
</head>
<body>
<div class="menu">
    <div class="nav-links">
        <a href="../index.php">首頁</a>
        <a href="toy.php">圖書館管理</a>
        <a href="toy_edit.php">編輯圖書館</a>
    </div>
    <form method="post" action="toy.php" class="search-container">
        <input type="text" id="keyword" name="keyword" placeholder="搜尋關鍵字..." />
        <input type="submit" value="搜尋">
    </form>
</div>

<div class="content">
    <div class="stats-container">
        <h4>館藏統計</h4>
        <div>
            總數量: 
            <?php
                $sql = "SELECT COUNT(*) FROM toy WHERE AreaCode = '201609260001'";
                $stmt = $db->prepare($sql);
                $error = $stmt->execute();
                
                if($rowcount = $stmt->fetchColumn())
                    echo $rowcount;
            ?>
        </div>
    </div>

    <table class="table"> 
      <thead> 
        <tr> 
          <th>#</th> 
          <th>分館代碼</th> 
          <th>圖書館名稱</th> 
          <th>開放時間</th> 
          <th>地址</th> 
          <th>簡介</th> 
        </tr> 
      </thead> 
      <tbody> 
        <?php
            if (isset($_POST["keyword"])) {
                // Your existing search code here
                // ...
            } else {
                $sql = "SELECT t.Name TName,t.Price,t.Description,ts.Name,ts.Address,ts.Phone FROM `toy` t left join `toysupplier` ts on t.ToyID = ts.ToyID";
                if($stmt = $db->prepare($sql)){
                    $stmt->execute();
                    for($rows = $stmt->fetchAll(), $count = 0; $count < count($rows); $count++){
        ?>
                <tr> 
                  <th scope="row"><?php echo $count;?></th> 
                  <td>TaipeiMain</td> 
                  <td>市立總圖書館</td> 
                  <td>08:00 - 21:00</td> 
                  <td>臺北市建國南路二段125號</td> 
                  <td>臺北市立圖書館總館位於臺灣臺北市大安區，面對大安森林公園，近捷運大安森林公園站，樓板總面積約6,000餘坪，啟用至今，已累積50萬1500冊的藏書和視聽資料。</td> 
                </tr> 
        <?php
                    }
                }
            }
        ?>
      </tbody> 
    </table>
</div>
</body>
</html>