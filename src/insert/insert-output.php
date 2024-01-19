<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>

<div class="result">
    <?php
        $pdo = new PDO($connect,USER,PASS);
        // $sql = prepare('insert into NIJI values(?,?,?,?)');
        // var_dump($_POST);
        if (isset($_POST['go'])){//ボタンが押された場合
            $folder = 'img/';//保存するフォルダの名前
            $fileName = basename($_FILES['image']['name']);//登録したいファイルの名前
            $path = $folder . $fileName;//二つをドッキング
            $fileType = pathinfo($path,PATHINFO_EXTENSION);

            if(!empty($_FILES['image']['name'])){
                $allowTypes = array('jpg','png','jpeg','gif');
                if(in_array($fileType,$allowTypes)){
                    if(move_uploaded_file($_FILES['image']['tmp_name'],"../". $path)){
                        if (exif_imagetype("../".$path)) {//画像ファイルかのチェック
                            $message = '<h2>画像をアップロードしました</h2>';
                        } else {
                            $message = '<h2>画像ファイルではありません<h2>';
                        }
                    }
                }
                $sql=$pdo->prepare('select count(*) from SignificantHands where hands_name = ?');
                $sql->execute([$_POST['handsname']]);
                if($sql->fetchColumn()>0){
                    $message = '<h2>同じ名前が登録されています。</h2>';
                }else if(empty($_POST['handsname'])){
                    $message = '<h2>名前が入力されていません。</h2>';
                }else{
                    $sql = $pdo->prepare('insert into SignificantHands(hands_name,img,explanation,category_id) values(?,?,?,?)');
                    // var_dump($date);
                    $sql->execute([$_POST['handsname'],$fileName,$_POST['explanation'],$_POST['category']]);//登録日と更新日の追加をする
                    $message = '<h2>登録が完了しました。</h2><p></p>'; 
                }
            }else{
                $sql=$pdo->prepare('select count(*) from SignificantHands where hands_name = ?');
                $sql->execute([$_POST['handsname']]);
                if($sql->fetchColumn()>0){
                    $message = '<h2>同じ名前が登録されています。</h2>';
                }else if(empty($_POST['handsname'])){
                    $message = '<h2>名前が入力されていません。</h2>';
                }else{
                    $sql = $pdo->prepare('insert into SignificantHands(hands_name,explanation,category_id) values(?,?,?)');
                    // var_dump($date);
                    $sql->execute([$_POST['handsname'],$_POST['explanation'],$_POST['category']]);//登録日と更新日の追加をする
                    $message = '<h2>登録が完了しました。</h2><p></p>'; 
                }
            }
        echo $message;
    }
    ?>
    </div>
<?php require '../footer.php'; ?>