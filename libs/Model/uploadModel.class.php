<?php
class uploadModel
{
    public function small()
    {
        $picname = $_FILES['small']['name'];
        $picsize = $_FILES['small']['size'];
        if ($picname != "") {
            if ($picsize > 2048000) {
                echo '图片大小不能超过1M';
                exit;
            }
            $type = strstr($picname, '.');
            if ($type != ".gif" && $type != ".jpg") {
                echo '图片格式不对！';
                exit;
            }
            $rand = rand(100000, 999999);
            $pics = date("YmdHis") . $rand . $type;
            //上传路径
            $account = $_SESSION['u_id'];
            if (!file_exists('files/' . $account)) {
                mkdir('files/' . $account);
            }
            $pic_path = 'files/' . $account . '/' . $pics;
            move_uploaded_file($_FILES['small']['tmp_name'], $pic_path);
        }
        $size = round($picsize / 1024, 2);
        $arr  = array(
            'name' => $picname,
            'pic'  => $pics,
            'size' => $size,
            'small' => $pic_path
        );
        echo json_encode($arr);
    }
    public function big()
    {
        $picname = $_FILES['big']['name'];
        $picsize = $_FILES['big']['size'];
        if ($picname != "") {
            if ($picsize > 2048000) {
                echo '图片大小不能超过1M';
                exit;
            }
            $type = strstr($picname, '.');
            if ($type != ".gif" && $type != ".jpg") {
                echo '图片格式不对！';
                exit;
            }
            $rand = rand(100000, 999999);
            $pics = date("YmdHis") . $rand . $type;
            //上传路径
            $account = $_SESSION['u_id'];
            if (!file_exists('files/' . $account)) {
                mkdir('files/' . $account);
            }
            $pic_path = 'files/' . $account . '/' . $pics;
            move_uploaded_file($_FILES['big']['tmp_name'], $pic_path);
        }
        $size = round($picsize / 1024, 2);
        $arr  = array(
            'name' => $picname,
            'pic'  => $pics,
            'size' => $size,
            'big' => $pic_path
        );
        echo json_encode($arr);
    }    
}
