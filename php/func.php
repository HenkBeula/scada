<?
function user_id($con){
	if(isset($_SESSION['user_id'])){
		$id = $_SESSION['user_id'];
        echo $id;
		return $id;
	}
    return null;
}
?>