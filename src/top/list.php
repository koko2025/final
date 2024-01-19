<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>

<div class="wrap">
    <div class="select">
    <form action="list.php" method="post">

        <select class="select-text" name="category">
        <?php
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->query('select * from Category');
        echo '<option value="all">すべて</option>';
            foreach($sql as $row){//表示
                echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
            }
        echo '</select>';
        ?>
        <span class="select-highlight"></span>
        <span class="select-bar"></span>
        <label class="select-label">Search</label>
        <div class="regibtn"><button type="submit" class="btn" name="search">検索</button></div>
    </div>
</div>
</form>

<div class="tb">
        <?php
            if(isset($_POST['category'])&&$_POST['category']!='all'){
                $sql=$pdo->prepare('select * from SignificantHands sh,Category c where sh.category_id = c.category_id and sh.category_id=?');//作品名の部分一致検索
                $sql->execute([$_POST['category']]);                
            }else{
                $sql=$pdo->query('select id,hands_name,img,explanation,sh.category_id,c.category_id,category_name from SignificantHands sh,Category c where sh.category_id = c.category_id');
            }
            foreach($sql as $row){//表示
                $id = $row['id'];
                echo '<div class="gz">';
                if($row['img']==null){
                    echo '<img src="../img/noimage.png">';
                }else{
                    echo '<img src="../img/',$row['img'],'">';
                }
                echo '<p><strong>',$row['hands_name'],'</strong></p>';
                echo '',$row['category_name'],' : ';
                echo '',$row['explanation'],'';
                echo '';
                echo '<form action="../update/update-insert.php" method="post">';//update
                echo '<input type="hidden" name="id" value="',$id,'">';
                echo '<input type="hidden" name="handsname" value="',$row['hands_name'],'">';
                echo '<input type="hidden" name="category" value="',$row['category_id'],'">';
                echo '<input type="hidden" name="img" value="',$row['img'],'">';
                echo '<input type="hidden" name="explanation" value="',$row['explanation'],'">';
                echo '<button type="submit" id="btn">更新</button>';
                echo '</form>';
                echo '';
                echo '';//delete
                echo '<form action="../delete/delete.php" method="post">';
                echo '<input type="hidden" name="id" value="',$id,'">';
                echo '<button type="submit" id="btn" name="btn">削除</button>';
                echo '</form>';
                echo '';
                echo '</div>';
                echo "\n";
                }
                echo '</select>';
            ?>
</div>

<?php require '../footer.php'; ?>