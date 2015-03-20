<?php
class BlogController extends AppController {
	public function recent_post(){
		//$recent_posts = Cache::read('recent_posts', 'short');
        //if (!$recent_posts) {
        
			$db_query = "SELECT id, post_date, post_content, post_title, post_name, guid
	                FROM wp_posts
	                WHERE post_type='post' AND post_status='publish' AND post_password=''
	                ORDER BY post_date DESC, id DESC
	                LIMIT 3 ";

	        $db = ConnectionManager::getDataSource("default");
			$recent_posts = $db->fetchAll($db_query);

			foreach($recent_posts as $key => $recent_post){
				$db_query2 = "SELECT meta_value
							FROM wp_postmeta
							WHERE post_id = ? AND meta_key = '_thumbnail_id'
							LIMIT 1";
				$thumb_id = $db->fetchAll($db_query2, array($recent_posts[$key]['wp_posts']['id']));
				if(!empty($thumb_id)) {
					// Thumbnail exists
					$db_query3 = "SELECT meta_value
						FROM wp_postmeta
						WHERE post_id = ? AND meta_key = '_wp_attached_file'
						LIMIT 1";
					$thumb = $db->fetchAll($db_query3, array($thumb_id[0]['wp_postmeta']['meta_value']));
					//Debugger::dump($thumb);
					$recent_posts[$key]['Thumbnail'] = str_replace('.png', '-310x310.png', $thumb[0]['wp_postmeta']['meta_value']);
					$recent_posts[$key]['Thumbnail'] = str_replace('.jpg', '-310x310.jpg', $thumb[0]['wp_postmeta']['meta_value']);
				} else {
					$recent_posts[$key]['Thumbnail'] = 'none';
				}

				$db_query4 = "SELECT slug FROM wp_terms LEFT JOIN wp_term_relationships ON wp_terms.term_id = wp_term_relationships.term_taxonomy_id WHERE wp_term_relationships.object_id = ? LIMIT 1";
				$tag = $db->fetchAll($db_query4, array($recent_posts[$key]['wp_posts']['id']));
				$recent_posts[$key]['url'] = "http://blog.zostanstudentem.pl/".$tag[0]['wp_terms']['slug']."/".$recent_posts[$key]['wp_posts']['post_name'];

				//Cache::write('recent_posts', $recent_posts, 'short');
			//}
		}

		if (!empty($this -> request -> params['requested'])) {
		   return $recent_posts;
		} else {
			$this->set('recent_posts', $recent_posts);
		}
	}
}