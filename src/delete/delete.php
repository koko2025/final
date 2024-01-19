<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>
    <div class="btnlist">    
        <button onclick="location.href='./top.php'" class="btnripple3 buttonNeumorphism">一覧へ</button>
    </div>
    <div class="result">
        <?php
            $pdo = new PDO($connect,USER,PASS);
            //delete
            if(isset($_POST['btn'])){
                $sql=$pdo->prepare('delete from SignificantHands where id = ?');
                if($sql->execute([$_POST['id']])){
                    echo '<h2>削除に成功しました。</h2>';
                }else{
                    echo '削除に失敗しました。';
                }
            }
            ?>
    </div>
<?php require '../footer.php'; ?>