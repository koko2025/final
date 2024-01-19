<?php require '../db-connect.php'; ?>
<?php require '../header.php'; ?>

        <div class="result">
            <?php
                $pdo = new PDO($connect,USER,PASS);
              
                if (isset($_POST['up'])){//更新ボタンが押された場合
                    if(!empty($_FILES['image']['name'])){// 画像ファイルが選択されているとき
                    $folder = 'img/';//保存するフォルダの名前
                    $fileName = basename($_FILES['image']['name']);//登録したいファイルの名前
                    $path = $folder . $fileName;//二つをドッキング
                    $fileType = pathinfo($path,PATHINFO_EXTENSION);
        
                        $sql=$pdo->prepare('update SignificantHands set hands_name=?,img=?,explanation=?,category_id=? where id=?');
                        $allowTypes = array('jpg','png','jpeg','gif');
                        if(in_array($fileType,$allowTypes)){
                            if(move_uploaded_file($_FILES['image']['tmp_name'],"../".$path)){
                                if (exif_imagetype("../".$path)) {//画像ファイルかのチェック
                                    $message = '画像をアップロードしました<br>';
                                } else {
                                    $message = '画像ファイルではありません';
                                }
                            }
                        }
                        $flag = 0;
                    }else{
                        $sql=$pdo->prepare('update SignificantHands set hands_name=?,explanation=?,category_id=? where id=?');
                        $flag = 1;
                    }
                    // $ex = '<script>let element = document.getElementById("ex");</script>';
                    if($flag==0){
                        $sql->execute([$_POST['handsname'],$fileName,$_POST['explanation'],$_POST['category'],$_POST['id']]);
                        echo '<h2>更新に成功しました。</h2>';
                    }else if($flag==1){
                        $sql->execute([$_POST['handsname'],$_POST['explanation'],$_POST['category'],$_POST['id']]);
                        echo '<h2>更新に成功しました。</h2>';
                        echo '<p></p>';
                    }else{
                        echo '<h2>更新に失敗しました。</h2>';
                    }
                }
            ?>
        </div>
        
<?php require '../footer.php'; ?>

