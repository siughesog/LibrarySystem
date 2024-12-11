<?php
	include("../function/condb.php");
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>index.php</title>
  <style>
	body {
		margin: 0px;
	}
	a {
		text-decoration: none;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
	}
	

	.menu {
		position:fixed;
		width: 100%;
		height: 40px;
		background-color: #1a5f7a;
		z-index: 9999999;
	}
	
	.menu a {
		text-decoration: none;
		color: white;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
	}
	
	.menu_css {
		float: left;
		width: 70%;
		height: inherit;
		overflow: hidden;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
		color: white;
		border-spacing: 0px;
	}
	.menu_css tr {
		display: block;
	}
	.menu_css td {
		height: 40px;
		padding: 0px 15px 0px 15px;
		white-space: nowrap;
	}
	.menu_css td:hover {
		background-color: black;
	}
	
	.menu_search{
		width: 30%;
		height: inherit;
		white-space: nowrap;
		overflow: hidden;
		font-family: 微軟正黑體,新細明體,標楷體;
		font-weight: bold;
		font-size: 17px;
		color: white;
	}
	.menu_search tr {
		display: block;
	}
	.menu_search td {
		height: 40px;
		padding: 0px 15px 0px 15px;
	}
	.menu_search td:hover {
		background-color: black;
	}
	
	.content {
		position: relative;
		word-wrap: break-word;
		width: 100%;
		top: 40px;
		background-color: #f1f1f1;
	}
	
	.inner_content {
		padding: 50px 130px 220px 130px;
	}
	
	.inner_content table {
		background-color: white;
	}
	
	li img {
		width: 100%;
		height: 100%;
	}
	
	input[type=text] {
		color: black;
	}
	
	form {
		margin-bottom: 0em;
	}
  </style>
  <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.css">
  <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.css">
  <link type="text/css" rel="stylesheet" href="bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
</head>
<body>
<div class="menu">
	<table class="menu_css">
		<tr>
			<td>
				<a href="../index.php">回首頁</a>
			</td>
			<td>
				<a href="toy.php">圖書館管理</a>
			</td>
			<td>
				<a href="toy_edit.php">編輯圖書館</a>
			</td>
		</tr>
	</table>
	<table class="menu_search">
		<tr>
			<td>
				<form method="post" action="toy.php">
				Search
				  <input type="text" id="keyword" name="keyword" value="" placeholder="輸入搜尋關鍵字" />
				  <input type="submit" value="送出">				
				</form>
			</td>
		</tr>
	</table>
</div>
<div class="content">
	<div class="inner_content">
		<div style="text-align: left;font-family: &quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size: 15px;font-weight: bold;">
			總數量為: 
			<?php
				$sql = "SELECT COUNT(*) FROM toy WHERE AreaCode = '201609260001'";
				$stmt =  $db->prepare($sql);
				$error = $stmt->execute();
				
				if($rowcount = $stmt->fetchColumn())
					echo $rowcount;
			?>
		</div>
		<table class="table"> 
		  <thead> 
			<tr> 
			  <th>#</th> 
			  <th>BranchCode</th> 
			  <th>ZHName</th> 
			  <th>OpenHour</th> 
			  <th>Location</th> 
			  <th>Description</th> 
			  
			</tr> 
		  </thead> 
		  <tbody> 
			<?php
				if (isset($_POST["keyword"]))
				{
					$keyword = $_POST["keyword"];
					
					if($keyword == ''){
					  $keyword = '%';
				    }else{
					  $keyword = '%'.$keyword.'%';
				    }
					
					$sql = "SELECT t.Name TName,t.Price,t.Description,ts.Name,ts.Address,ts.Phone FROM `toy` t left join `toysupplier` ts on t.ToyID = ts.ToyID where t.Name like ? or t.Price like ? or t.Description like ? or ts.Name like ? or ts.Address like ? or ts.Phone like ?";
					if($stmt = $db->prepare($sql)){
						$stmt->execute(array($keyword, $keyword, $keyword, $keyword, $keyword, $keyword));
						for($rows = $stmt->fetchAll(), $count = 0; $count < count($rows); $count++){
			?>
						<tr> 
						  <th scope="row"><?php echo $count;?></th> 
						  <td>TaipeiMain</td> 
						  <td><?php echo $rows[$count]['Price'];?></td> 
						  <td></td> 
						  <td><?php echo $rows[$count]['Name'];?></td> 
						  <td><?php echo $rows[$count]['Address'];?></td> 
						  <td><?php echo $rows[$count]['Phone'];?></td> 
						</tr> 
			<?php
						}		
					}
				}else{
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
</div>
</body>
</html>