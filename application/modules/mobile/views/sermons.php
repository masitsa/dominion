<?php 

$result = '';

if ($query->num_rows() > 0)
{

	$result .='<ul class="posts">';
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
		$result .='
			
			<li>
				<div class="post_entry">
					<div class="post_date">
						<span class="day">'.$day.'</span>
						<span class="month">'.$month.'</span>
					</div>
					<div class="post_title">
					<h2><a href="blog-single.html?id='.$id.'" onclick="get_news_description('.$id.')">'.strip_tags($mini_title).'</a></h2>
					</div>
				</div>
			</li>';
	}
	$result .='
	  </ul>
	<div class="clear"></div>  
	<div id="loadMore"><img src="images/load_posts.png" alt="" title="" /></div> 
	<div id="showLess"><img src="images/load_posts_disabled.png" alt="" title="" /></div> 
	</div>
	  ';
	}
	else
	{
		$result .= "There are no sermons";
	}
echo $result;