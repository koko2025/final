<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>

    <?php
        $pdo = new PDO($connect,USER,PASS);
        $sql=$pdo->prepare('select * from SignificantHands where id=?');
        if($sql->execute([$_POST['id']])){
            echo '<div class="fm2">';
            echo '<form action="update-output.php" method="post" enctype="multipart/form-data">';
            if($_POST['img']=="なし"||$_POST['img']==NULL){
                echo '<p>画像</p><p>なし</p>';   
            }else{
                echo '<p>画像</p><p><img class="display" src="../img/',$_POST['img'],'"></p>';
            }
            echo '<p><input type="file" id="Myimg" name="image"><img id="display" class="display"></p>';
            echo '<div class="cp_iptxt">';
                echo '<label>役名</label>';
                echo '<input class="e" type="text" name="handsname" value="',$_POST['handsname'],'"></p>';
                echo '<span class="focus_line"></span>';
            echo '</div>';
            echo '<div class="wrap"><div class="select">';
            echo '<select name="category">';
            foreach($pdo->query('select * from Category') as $row){
                if($_POST['category']==$row['category_id']){
                    echo '<option value=',$row['category_id'],' selected class="select-text">',$row['category_name'],'</option>';
                }else{
                    echo '<option value=',$row['category_id'],' class="select-text">',$row['category_name'],'</option>';
                }
            }  
            echo '</select>';
            echo '<span class="select-highlight"></span><span class="select-bar"></span>';
            echo '</div></div>';
            echo '<input type="hidden" name="id" value="',$_POST['id'],'">';
            echo '<div class="cp_iptxt">';       
                echo '<label>説明</label>';
                echo '<input class="e" type="text" name="explanation" value="',$_POST['explanation'],'">';
                echo '<span class="focus_line"></span>';
            echo '</div>';
            echo '<p><button type="submit" class="btnripple3 buttonNeumorphism" name="up">更新</button></p>';
            echo '</form>';
            echo '</div>';
        }else{
            echo '<h2>情報が取得できませんでした。</h2>';
        }
    ?>
    <script type="text/javascript">//選択した画像を表示する
        const Myimg = document.getElementById("Myimg");
        Myimg.addEventListener("change", function (e) {
        const file = e.target.files[0];//複数ファイルはfiles配列をループで回す
        const reader = new FileReader();
        const display = document.getElementById("display");
        reader.addEventListener("load", function () {
            display.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
        })
    </script>
<?php require '../footer.php'; ?>
