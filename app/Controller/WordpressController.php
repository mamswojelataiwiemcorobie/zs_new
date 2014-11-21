<?php
class BlogController extends AppController {
	public function recent_post(){
		$db_query = "SELECT id, post_date, post_content, post_title, post_name, guid
                FROM wp_posts
                WHERE post_type='post' AND post_status='publish' AND post_password=''
                ORDER BY post_date DESC, id DESC
                LIMIT 1 ";

        $db = ConnectionManager::getDataSource("default");
		$recent_post = $db->fetchAll($db_query);

		$db_query2 = "SELECT meta_value
					FROM wp_postmeta
					WHERE post_id = ? AND meta_key = '_thumbnail_id'
					LIMIT 1";
		$thumb_id = $db->fetchAll($db_query2, array($recent_post[0]['wp_posts']['id']));
		if($thumb_id != 0) {
				// Thumbnail exists
				$db_query3 = "SELECT meta_value
					FROM wp_postmeta
					WHERE post_id = ?
					LIMIT 1";
				$thumb = $db->fetchAll($db_query3, array($thumb_id[0]['wp_postmeta']['meta_value']));
				$recent_post[0]['Thumbnail'] = str_replace('.png', '-310x310.png', $thumb[0]['wp_postmeta']['meta_value']);
			}

		if (!empty($this -> request -> params['requested'])) {
		   return $recent_post;
		} else {
			$this->set('recent_post', $recent_post);
		}
	}
}