<?php 
	// include"./phpQuery.php";

/*
*需要包含PHPquery对象
*获取的一个ip代理地址格式为：
*	$this->proxy['ip'],$this->proxy['port']
 */
class proxy
{
	public $domain='http://www.xicidaili.com/';
	public $proxy=array();
	public $find=array();
	public $page_contents;


	function __construct($ip=null)
	{
		$conn=$this->db_connect();
		if($ip){
			$this->updata($ip,$conn);
			$conn=null;
			return;
		}

		$this->select($conn);
		while(empty($this->proxy)){
			$num=mt_rand(0,count($this->find));
			if($this->get_proxy()){
				$this->proxy['ip']=$this->find[$num]['ip'];
				$this->proxy['port']=$this->find[$num]['port'];
			}
		}
		if(!empty($this->find))
			$this->save($conn);
		$conn=null;
	}
	
	function db_connect()
	{
		$conn=new pdo("mysql:host=localhost;dbname=meituan","root","");
		$conn->query("SET characterset'utf-8'");
		$conn->query("SET names'utf8'");
		return $conn;
	}
	function select($conn)
	{
		$conn->query("UPDATE proxy set state=0 WHERE adddate(create_time,INTERVAL 600 SECOND)<curtime()");
		$conn->query("DELETE FROM proxy WHERE state=0");
		$query="SELECT ip,port FROM `proxy` WHERE  adddate(create_time,INTERVAL 600 SECOND)>curtime() AND state=1  ORDER BY RAND() LIMIT 1";
  		
  		$res= $conn->query($query);
  		if($res){
  			$arr=$res->fetch(PDO::FETCH_ASSOC);
  			$this->proxy=$arr;
  		}
  		else
  			$this->proxy=null;

	}

	function updata($ip,$conn)
	{
		$query="UPDATE proxy SET state=0 WHERE ip='".$ip."'";
		$conn->query($query);
	}

	function get_proxy(){
		$this->page_contents=$this->likeBrowse($this->domain);
			phpQuery::newDocumentHTML($this->page_contents);
			$page=phpQuery::pq("#ip_list tr");
			$dom=phpQuery::pq($page);
			$i=0;
			foreach ($dom as $tr) {
				$pq_tr=phpQuery::pq($tr);
				$https=$pq_tr->find("td:eq(5)")->text();
				if(strpos($https,"HTTPS")!==false)//去掉https的ip
					break;
				if(!($pq_tr->find("th")->text())){
					$this->find[$i]['ip']=$pq_tr->
						find("td:eq(1)")->text();
					$this->find[$i]['port']=$pq_tr->
						find("td:eq(2)")->text();
					$this->find[$i]['addr']=$pq_tr->find("td:eq(3)")->text();
					$this->find[$i]['type']=$pq_tr->find("td:eq(5)")->text();
					$this->find[$i++]['exsit']=$pq_tr->find("td:eq(6)")->text();
				}
			}
			if(!empty($this->find))
				return true;
			else
				return false;
	}

	function save($conn)
	{
		$pre=$conn->prepare
		("INSERT INTO proxy(ip,port,addr,create_time,type,state) VALUES(?,?,?,curtime(),?,1)");
		foreach ($this->find as $v) {
			$pre->bindparam(1,$v['ip']);
			$pre->bindparam(2,$v['port']);
			$pre->bindparam(3,$v['addr']);
			$pre->bindparam(4,$v['type']);
			$pre->execute();
		}
	}

	function likeBrowse($url,$isPost=false){
		$curl = curl_init (); // 启动一个CURL会话
		curl_setopt ( $curl, CURLOPT_URL, $url ); // 要访问的地址
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYPEER, 0 ); // 对认证证书来源的检查
		curl_setopt ( $curl, CURLOPT_SSL_VERIFYHOST, 2 ); // 从证书中检查SSL加密算法是否存在
		curl_setopt ( $curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0); 360Spider'); // 模拟用户使用的浏览器
		curl_setopt ( $curl, CURLOPT_FOLLOWLOCATION, 1 ); // 使用自动跳转
		curl_setopt ( $curl, CURLOPT_AUTOREFERER, 1 ); // 自动设置Referer

		if ($isPost) {
			curl_setopt ( $curl, CURLOPT_POST, 1 ); // 发送一个常规的Post请求
			curl_setopt ( $curl, CURLOPT_POSTFIELDS, $data ); // Post提交的数据包
		}
		curl_setopt ( $curl, CURLOPT_TIMEOUT, 30 ); // 设置超时限制防止死循环
		curl_setopt ( $curl, CURLOPT_HEADER, 0 ); // 显示返回的Header区域内容
		curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 ); // 获取的信息以文件流的形式返回
		$tmpInfo = curl_exec ( $curl ); // 执行操作
	                                 // print_r($tmpInfo);exit;
		if (curl_errno ( $curl )) {
			echo 'Errno' . curl_error ( $curl ); // 捕抓异常
			return;
		}
		curl_close ( $curl ); // 关闭CURL会话
	                       // 解析HTTP数据流
		return $tmpInfo;
	}

}

$n=new proxy();
echo "<pre>";
print_r($n);
echo $n->page_contents;