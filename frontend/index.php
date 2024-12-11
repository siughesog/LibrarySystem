<?php
include("function/condb.php");
$backgroundImage = 'image/library.jpg';
?>
<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>圖書館管理系統</title>
    <style>
        :root {
            --primary-color: #1a5f7a;
            --hover-color: #2c88aa;
            --text-light: #ffffff;
            --background-light: #f5f6fa;
			
        }

        body {
            margin: 0;
            font-family: 'Microsoft JhengHei', sans-serif;
            background-color: var(--background-light);
			background-image: url('<?php echo $backgroundImage; ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .menu {
            position: fixed;
            width: 100%;
            height: 40px;
            background-color: var(--primary-color);
            z-index: 9999999;
        }

        .menu_css {
            margin: 0 auto;
            max-width: 1200px;
            height: inherit;
            display: flex;
            align-items: center;
        }

        .menu_item {
            padding: 0 15px;
            height: 40px;
            display: flex;
            align-items: center;
            color: var(--text-light);
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .menu_item:hover {
            background-color: var(--hover-color);
        }

        .submenu {
            position: relative;
            display: inline-block;
        }

        .submenu-content {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background-color: var(--primary-color);
            min-width: 160px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        .submenu:hover .submenu-content {
            display: block;
        }

        .submenu-item {
            padding: 12px 15px;
            display: block;
            color: var(--text-light);
            text-decoration: none;
            font-size: 15px;
        }

        .submenu-item:hover {
            background-color: var(--hover-color);
        }

        .content {
            padding-top: 40px;
        }

        .slider-container {
            max-width: 1200px;
            margin: 20px auto;
            position: relative;
        }

        .bxslider img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .announcements {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .announcements h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--primary-color);
        }

        .announcement-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .announcement-item:last-child {
            border-bottom: none;
        }

        .announcement-date {
            color: #666;
            font-size: 14px;
        }

        .announcement-title {
            margin: 5px 0;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.bxslider.min.js"></script>
    <link href="css/jquery.bxslider.min.css" rel="stylesheet" />
    <script>
        $(document).ready(function(){
            $('.bxslider').bxSlider({
                auto: true,
                pause: 4000,
                mode: 'fade',
                adaptiveHeight: true,
                responsive: true,
                touchEnabled: true,
                pager: true,
                autoHover: true
            });
        });
    </script>
</head>
<body>
    <div class="menu">
        <div class="menu_css">
            <a href="index.php" class="menu_item">首頁</a>
            
            <div class="submenu">
                <a href="library.php" class="menu_item">圖書館管理</a>
                <div class="submenu-content">
                    <a href="library.php" class="submenu-item">分館查詢</a>
                    <a href="library_edit.php" class="submenu-item">分館管理</a>
                </div>
            </div>
            
            <div class="submenu">
                <a href="book.php" class="menu_item">館藏管理</a>
                <div class="submenu-content">
                    <a href="book.php" class="submenu-item">館藏查詢</a>
                    <a href="book_edit.php" class="submenu-item">館藏編輯</a>
                </div>
            </div>
            
            <div class="submenu">
                <a href="publisher.php" class="menu_item">出版社管理</a>
                <div class="submenu-content">
                    <a href="publisher.php" class="submenu-item">出版社查詢</a>
                    <a href="publisher_edit.php" class="submenu-item">出版社編輯</a>
                </div>
            </div>
        </div>
    </div>

    
</body>
</html>