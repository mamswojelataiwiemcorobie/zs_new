<?php
class BlogController extends AppController {
	public function recent_post(){
		$db_query = "SELECT id, post_date, post_content, post_title, post_name, guid
                FROM wp_posts
                WHERE post_type='post' AND post_status='publish' AND post_password=''
                ORDER BY post_date DESC, id DESC
                LIMIT 3 ";

        $db = ConnectionManager::getDataSource("default");
		$recent_posts = $db->fetchAll($db_query);

		foreach($recent_posts as $key => $recent_post) {
			$db_query2 = "SELECT meta_value
						FROM wp_postmeta
						WHERE post_id = ? AND meta_key = '_thumbnail_id'
						LIMIT 1";
			$thumb_id = $db->fetchAll($db_query2, array($recent_posts[$key]['wp_posts']['id']));
			if($thumb_id != 0) {
					// Thumbnail exists
					$db_query3 = "SELECT meta_value
						FROM wp_postmeta
						WHERE post_id = ?
						LIMIT 1";
					$thumb = $db->fetchAll($db_query3, array($thumb_id[$key]['wp_postmeta']['meta_value']));
					$recent_posts[$key]['Thumbnail'] = str_replace('.png', '-310x310.png', $thumb[$key]['wp_postmeta']['meta_value']);
				}
		}

		if (!empty($this -> request -> params['requested'])) {
		   return $recent_posts;
		} else {
			$this->set('recent_post', $recent_posts);
		}
	}
}