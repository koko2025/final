<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>

    <div class="top"><h1>役　登録</h1></div>
    <div class="fm">
        <form action="insert-output.php" method="post" enctype="multipart/form-data">
        <div class="cp_iptxt">
            <input class="e" type="text" name="handsname" placeholder="">
            <label>役名</label>
            <span class="focus_line"></span>
        </div>
        飜数<p>
        <div class="wrap">
            <div class="select">
            <?php
                $pdo = new PDO($connect,USER,PASS);
                $sql=$pdo->query('select * from Category');
                echo '<select name="category" class="select-text">';
                foreach($sql as $row){//表示
                    echo '<option value="',$row['category_id'],'">',$row['category_name'],'</option>';
                }
                echo '</select>';
            ?>
            <span class="select-highlight"></span>
            <span class="select-bar"></span>
            </div>
        </div>
            </p>
        画像<p><input type="file" id="Myimg" name="image"><img id="display" class="display"></p>
        <div class="cp_iptxt">
            <input class="e" type="text" name="explanation" placeholder="">
            <label>説明</label>
            <span class="focus_line"></span>
        </div>
        <div class="regibtn"><button type="submit" name="go">登録</button></div>
        </form></div>
    

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