<?php
$comment_file = 'comments';
$data = file_get_contents($comment_file);
$obj = json_decode($data);

if(isset($_POST['author']) && isset($_POST['text'])) {
	$id = 0;
	foreach($obj as $row) {
		if($row->id >= $id) {
			$id = $row->id;
		}
	}
	$comment = new stdClass;
	$comment->id = $id + 1;
	$comment->author = $_POST['author'];
	$comment->text = $_POST['text'];
	$obj[] = $comment;

	file_put_contents($comment_file, json_encode($obj));
}
echo json_encode($obj);
