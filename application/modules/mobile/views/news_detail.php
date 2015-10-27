<?php
if ($query->num_rows() > 0)
{
            
	foreach ($query->result() as $row)
	{
		$id = $row->post_id;
		$title = $row->post_title;

		$post_content = $row->post_content;
		$date = date('jS M Y',strtotime($row->created));
		$day = date('j',strtotime($row->created));
		$month = date('M',strtotime($row->created));

		$mini_string = (strlen($post_content) > 15) ? substr($post_content,0,50).'...' : $post_content;
		$mini_title = (strlen($title) > 15) ? substr($title,0,50).'...' : $title;
	}
	$result = '<h2 class="page_title">'.strip_tags($title).'</h2>
	 
	          <div class="post_single">
					<div class="featured_image">
						<img title="" alt="" src="images/post_photo.jpg" class="">
						<div class="post_title_single"><h2>Design is not just what it looks like and feels like.</h2></div>
						<div class="post_author">
							<a class="open-panel" data-panel="left" href="#"><img title="" alt="" src="images/author.jpg"></a>
						</div> 
						<div class="post_social">
							<a class="open-popup" data-popup=".popup-social" href="#"><img title="" alt="" src="images/icons/white/heart.png"></a>              
						</div> 
					</div>
				
	            <div class="page_content"> 

	              <div class="entry">
	              	'.$post_content.'
	              </div>
	            </div>
	            
	          </div>
	          
	          
	          ';
}else
{
	$result = 'Data not found';
}
echo $result;
?>